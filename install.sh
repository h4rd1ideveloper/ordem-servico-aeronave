#!/bin/bash

echo "=== Sistema de Ordem de Serviço para Aeronaves ==="
echo "Script de Instalação Automatizada"
echo ""

# Verificar se está rodando como root para instalação de pacotes
if [[ $EUID -eq 0 ]]; then
   echo "Este script não deve ser executado como root para a configuração do Laravel."
   echo "Execute como usuário normal. O script solicitará sudo quando necessário."
   exit 1
fi

# Detectar sistema operacional
if [[ -f /etc/debian_version ]]; then
    OS="debian"
    echo "Sistema detectado: Debian/Ubuntu"
elif [[ -f /etc/redhat-release ]]; then
    OS="redhat"
    echo "Sistema detectado: CentOS/RHEL"
else
    echo "Sistema operacional não suportado automaticamente."
    echo "Instale manualmente: PHP 8.1+, Composer, wkhtmltopdf"
    exit 1
fi

# Instalar dependências do sistema
echo ""
echo "1. Instalando dependências do sistema..."

if [[ $OS == "debian" ]]; then
    sudo apt update
    sudo apt install -y php php-cli php-sqlite3 php-gd php-mbstring php-curl php-xml php-zip wkhtmltopdf
    
    # Instalar Composer se não estiver instalado
    if ! command -v composer &> /dev/null; then
        echo "Instalando Composer..."
        curl -sS https://getcomposer.org/installer | php
        sudo mv composer.phar /usr/local/bin/composer
    fi
elif [[ $OS == "redhat" ]]; then
    sudo yum install -y php php-cli php-sqlite3 php-gd php-mbstring php-curl php-xml php-zip wkhtmltopdf
    
    # Instalar Composer se não estiver instalado
    if ! command -v composer &> /dev/null; then
        echo "Instalando Composer..."
        curl -sS https://getcomposer.org/installer | php
        sudo mv composer.phar /usr/local/bin/composer
    fi
fi

# Verificar se as dependências foram instaladas
echo ""
echo "2. Verificando instalação..."

if ! command -v php &> /dev/null; then
    echo "ERRO: PHP não foi instalado corretamente"
    exit 1
fi

if ! command -v composer &> /dev/null; then
    echo "ERRO: Composer não foi instalado corretamente"
    exit 1
fi

if ! command -v wkhtmltopdf &> /dev/null; then
    echo "ERRO: wkhtmltopdf não foi instalado corretamente"
    exit 1
fi

echo "✓ PHP $(php -r 'echo PHP_VERSION;')"
echo "✓ Composer $(composer --version --no-ansi | head -n1)"
echo "✓ wkhtmltopdf $(wkhtmltopdf --version | head -n1)"

# Configurar projeto Laravel
echo ""
echo "3. Configurando projeto Laravel..."

# Instalar dependências PHP
echo "Instalando dependências do Composer..."
composer install --no-dev --optimize-autoloader

# Configurar permissões
echo "Configurando permissões..."
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/logs storage/framework

# Criar banco de dados SQLite
echo "Configurando banco de dados..."
touch database/database.sqlite

# Executar migrations
echo "Executando migrations..."
php artisan migrate --force

# Perguntar se deseja popular com dados de exemplo
echo ""
read -p "Deseja popular o banco com dados de exemplo? (s/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Ss]$ ]]; then
    echo "Populando banco com dados de exemplo..."
    php artisan db:seed --class=OrdemServicoSeeder --force
fi

# Gerar chave da aplicação se necessário
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Gerando chave da aplicação..."
    php artisan key:generate --force
fi

echo ""
echo "=== Instalação Concluída! ==="
echo ""
echo "Para iniciar o servidor:"
echo "  php artisan serve --host=0.0.0.0 --port=8000"
echo ""
echo "Acesse no navegador:"
echo "  http://localhost:8000"
echo ""
echo "Para usar em produção, configure um servidor web (Apache/Nginx)"
echo "e aponte o DocumentRoot para a pasta 'public/'"
echo ""

