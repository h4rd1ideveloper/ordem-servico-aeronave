# Sistema de Ordem de Serviço para Aeronaves - Docker

Sistema Laravel dockerizado para geração de PDFs dinâmicos de Ordens de Serviço de aeronaves.

## 🐳 Instalação com Docker

### Pré-requisitos

- Docker 20.10 ou superior
- Docker Compose 2.0 ou superior
- 2GB de RAM disponível
- 1GB de espaço em disco

### Instalação do Docker

#### Ubuntu/Debian
```bash
# Instalar Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Adicionar usuário ao grupo docker
sudo usermod -aG docker $USER

# Reiniciar sessão ou executar:
newgrp docker
```

#### Windows
1. Baixar Docker Desktop: https://www.docker.com/products/docker-desktop
2. Instalar e reiniciar o sistema
3. Verificar instalação: `docker --version`

#### macOS
```bash
# Com Homebrew
brew install --cask docker

# Ou baixar Docker Desktop do site oficial
```

### Uso Rápido

```bash
# 1. Extrair o projeto
unzip ordem-servico-aeronave-docker.zip
cd ordem-servico-aeronave

# 2. Iniciar com Docker Compose
docker-compose up -d

# 3. Acessar no navegador
# http://localhost:8000
```

### Comandos Docker

```bash
# Iniciar aplicação
docker-compose up -d

# Ver logs
docker-compose logs -f

# Parar aplicação
docker-compose down

# Rebuild da imagem
docker-compose build --no-cache

# Acessar container
docker-compose exec app bash

# Limpar volumes (reset completo)
docker-compose down -v
```

## 📁 Estrutura Docker

```
ordem-servico-aeronave/
├── Dockerfile              # Imagem principal
├── docker-compose.yml      # Orquestração
├── docker-entrypoint.sh    # Script de inicialização
├── .dockerignore           # Arquivos ignorados
├── .env.docker             # Configurações Docker
└── README-DOCKER.md        # Esta documentação
```

## ⚙️ Configurações

### Portas
- **8000**: Interface web principal
- **80**: Porta interna do Apache

### Volumes
- `./database`: Persistência do banco SQLite
- `./storage`: Logs e arquivos temporários

### Variáveis de Ambiente

Edite `.env.docker` para personalizar:

```env
APP_NAME="Ordem de Serviço - MTX Aviation"
APP_URL=http://localhost:8000
APP_DEBUG=false
DB_CONNECTION=sqlite
WKHTMLTOPDF_CMD=/usr/local/bin/wkhtmltopdf-wrapper
```

## 🔧 Personalização

### Alterar Porta

```yaml
# docker-compose.yml
services:
  app:
    ports:
      - "9000:80"  # Muda para porta 9000
```

### Usar MySQL

```yaml
# docker-compose.yml
services:
  app:
    environment:
      - DB_CONNECTION=mysql
      - DB_HOST=mysql
      - DB_DATABASE=ordem_servico
      - DB_USERNAME=root
      - DB_PASSWORD=secret
    depends_on:
      - mysql
  
  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_DATABASE: ordem_servico
    volumes:
      - mysql_data:/var/lib/mysql

volumes:
  mysql_data:
```

## 🐛 Solução de Problemas

### Container não inicia

```bash
# Verificar logs
docker-compose logs app

# Verificar se porta está ocupada
sudo netstat -tulpn | grep :8000

# Limpar e rebuild
docker-compose down -v
docker-compose build --no-cache
docker-compose up -d
```

### Erro de permissões

```bash
# Ajustar permissões locais
sudo chown -R $USER:$USER ./database ./storage
chmod -R 755 ./database ./storage
```

### PDF não gera

```bash
# Verificar wkhtmltopdf no container
docker-compose exec app /usr/local/bin/wkhtmltopdf-wrapper --version

# Verificar logs específicos
docker-compose exec app tail -f /var/log/apache2/error.log
```

### Banco de dados corrompido

```bash
# Reset completo do banco
docker-compose down
rm -f ./database/database.sqlite
docker-compose up -d
```

### Erro de memória

```bash
# Aumentar limite de memória do Docker
# Docker Desktop > Settings > Resources > Memory > 4GB
```

## 🚀 Produção

### Docker Compose para Produção

```yaml
version: '3.8'
services:
  app:
    build: .
    restart: always
    ports:
      - "80:80"
    volumes:
      - ./database:/var/www/html/database
      - ./storage:/var/www/html/storage
    environment:
      - APP_ENV=production
      - APP_DEBUG=false
    healthcheck:
      test: ["CMD", "curl", "-f", "http://localhost/"]
      interval: 30s
      timeout: 10s
      retries: 3

  nginx:
    image: nginx:alpine
    ports:
      - "443:443"
    volumes:
      - ./nginx.conf:/etc/nginx/nginx.conf
      - ./ssl:/etc/nginx/ssl
    depends_on:
      - app
```

### Backup

```bash
# Backup do banco
docker-compose exec app cp /var/www/html/database/database.sqlite /tmp/
docker cp $(docker-compose ps -q app):/tmp/database.sqlite ./backup-$(date +%Y%m%d).sqlite

# Backup completo
tar -czf backup-$(date +%Y%m%d).tar.gz database/ storage/
```

### Monitoramento

```bash
# Status dos containers
docker-compose ps

# Uso de recursos
docker stats

# Logs em tempo real
docker-compose logs -f --tail=100
```

## 🔒 Segurança

### Recomendações

1. **Alterar APP_KEY** em produção
2. **Usar HTTPS** com certificados SSL
3. **Configurar firewall** para portas específicas
4. **Backup regular** do banco de dados
5. **Monitorar logs** de acesso e erro

### Configuração SSL

```bash
# Gerar certificado auto-assinado (desenvolvimento)
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout ssl/private.key -out ssl/certificate.crt
```

## 📊 Performance

### Otimizações

```dockerfile
# Dockerfile otimizado
FROM php:8.1-apache

# Cache do Composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader

# Multi-stage build para reduzir tamanho
FROM php:8.1-apache as production
COPY --from=composer /app/vendor ./vendor
```

### Limites de Recursos

```yaml
# docker-compose.yml
services:
  app:
    deploy:
      resources:
        limits:
          memory: 512M
          cpus: '0.5'
        reservations:
          memory: 256M
          cpus: '0.25'
```

## 📞 Suporte

### Logs Importantes

```bash
# Logs da aplicação
docker-compose logs app

# Logs do Apache
docker-compose exec app tail -f /var/log/apache2/error.log

# Logs do Laravel
docker-compose exec app tail -f storage/logs/laravel.log
```

### Comandos de Debug

```bash
# Entrar no container
docker-compose exec app bash

# Verificar configuração PHP
docker-compose exec app php -i

# Testar conectividade
docker-compose exec app curl -I http://localhost

# Verificar banco de dados
docker-compose exec app sqlite3 database/database.sqlite ".tables"
```

---

**Desenvolvido para MTX Aviation**  
Sistema de Ordem de Serviço para Aeronaves v1.0

