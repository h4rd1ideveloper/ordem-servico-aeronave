#!/bin/bash

echo "=========================================="
echo "  Sistema de Ordem de Serviço - Docker"
echo "  MTX Aviation Manutenção de Aeronaves"
echo "=========================================="
echo ""

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Função para imprimir mensagens coloridas
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[OK]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[AVISO]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERRO]${NC} $1"
}

# Verificar se está rodando como root
if [[ $EUID -eq 0 ]]; then
   print_error "Este script não deve ser executado como root."
   print_warning "Execute como usuário normal. O script solicitará sudo quando necessário."
   exit 1
fi

# Verificar se Docker está instalado
print_status "Verificando instalação do Docker..."

if ! command -v docker &> /dev/null; then
    print_warning "Docker não encontrado. Instalando..."
    
    # Detectar sistema operacional
    if [[ -f /etc/debian_version ]]; then
        print_status "Sistema Debian/Ubuntu detectado"
        curl -fsSL https://get.docker.com -o get-docker.sh
        sudo sh get-docker.sh
        rm get-docker.sh
    elif [[ -f /etc/redhat-release ]]; then
        print_status "Sistema CentOS/RHEL detectado"
        curl -fsSL https://get.docker.com -o get-docker.sh
        sudo sh get-docker.sh
        rm get-docker.sh
    else
        print_error "Sistema operacional não suportado automaticamente."
        print_warning "Instale o Docker manualmente: https://docs.docker.com/get-docker/"
        exit 1
    fi
    
    # Adicionar usuário ao grupo docker
    print_status "Configurando permissões do Docker..."
    sudo usermod -aG docker $USER
    
    print_warning "Você precisa fazer logout/login ou executar 'newgrp docker' para usar Docker sem sudo"
else
    print_success "Docker já está instalado: $(docker --version)"
fi

# Verificar se Docker Compose está disponível
print_status "Verificando Docker Compose..."

if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
    print_warning "Docker Compose não encontrado. Instalando..."
    
    # Instalar docker-compose
    sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
    
    print_success "Docker Compose instalado"
else
    print_success "Docker Compose disponível"
fi

# Verificar se o serviço Docker está rodando
print_status "Verificando serviço Docker..."

if ! sudo systemctl is-active --quiet docker; then
    print_status "Iniciando serviço Docker..."
    sudo systemctl start docker
    sudo systemctl enable docker
fi

print_success "Serviço Docker está rodando"

# Verificar se pode executar docker sem sudo
print_status "Testando permissões Docker..."

if docker ps &> /dev/null; then
    print_success "Docker configurado corretamente"
elif sudo docker ps &> /dev/null; then
    print_warning "Docker funciona apenas com sudo"
    print_warning "Execute 'newgrp docker' ou faça logout/login para corrigir"
    DOCKER_CMD="sudo docker"
    COMPOSE_CMD="sudo docker-compose"
else
    print_error "Erro ao acessar Docker"
    exit 1
fi

# Definir comandos Docker
DOCKER_CMD=${DOCKER_CMD:-"docker"}
COMPOSE_CMD=${COMPOSE_CMD:-"docker-compose"}

# Verificar se já existe container rodando na porta 8000
print_status "Verificando porta 8000..."

if netstat -tuln 2>/dev/null | grep -q ":8000 "; then
    print_warning "Porta 8000 já está em uso"
    read -p "Deseja usar uma porta diferente? (ex: 8080) [8080]: " NEW_PORT
    NEW_PORT=${NEW_PORT:-8080}
    
    # Atualizar docker-compose.yml
    if [[ -f docker-compose.yml ]]; then
        sed -i "s/8000:80/${NEW_PORT}:80/g" docker-compose.yml
        print_success "Porta alterada para ${NEW_PORT}"
    fi
fi

# Construir e iniciar aplicação
print_status "Construindo imagem Docker..."

if $COMPOSE_CMD build; then
    print_success "Imagem construída com sucesso"
else
    print_error "Erro ao construir imagem"
    exit 1
fi

print_status "Iniciando aplicação..."

if $COMPOSE_CMD up -d; then
    print_success "Aplicação iniciada com sucesso"
else
    print_error "Erro ao iniciar aplicação"
    exit 1
fi

# Aguardar aplicação ficar pronta
print_status "Aguardando aplicação ficar pronta..."
sleep 10

# Verificar se aplicação está respondendo
PORT=$(grep -o '[0-9]*:80' docker-compose.yml | cut -d: -f1)
PORT=${PORT:-8000}

if curl -s -o /dev/null -w "%{http_code}" http://localhost:${PORT} | grep -q "200\|302"; then
    print_success "Aplicação está rodando!"
    echo ""
    echo "=========================================="
    echo "  🚀 INSTALAÇÃO CONCLUÍDA!"
    echo "=========================================="
    echo ""
    echo "📱 Acesse a aplicação:"
    echo "   http://localhost:${PORT}"
    echo ""
    echo "🐳 Comandos úteis:"
    echo "   ${COMPOSE_CMD} logs -f     # Ver logs"
    echo "   ${COMPOSE_CMD} down        # Parar aplicação"
    echo "   ${COMPOSE_CMD} up -d       # Iniciar aplicação"
    echo "   ${COMPOSE_CMD} exec app bash # Acessar container"
    echo ""
    echo "📚 Documentação completa:"
    echo "   README-DOCKER.md"
    echo ""
else
    print_warning "Aplicação pode não estar respondendo corretamente"
    print_status "Verificando logs..."
    $COMPOSE_CMD logs --tail=20
    echo ""
    print_warning "Tente acessar: http://localhost:${PORT}"
    print_warning "Ou execute: ${COMPOSE_CMD} logs -f para ver logs em tempo real"
fi

echo "=========================================="

