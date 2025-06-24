# Arquivos Docker Incluídos

## 🐳 Arquivos de Configuração Docker

### Principais
- `Dockerfile` - Imagem principal com PHP 8.1, Apache, wkhtmltopdf
- `docker-compose.yml` - Orquestração da aplicação
- `docker-entrypoint.sh` - Script de inicialização do container
- `.dockerignore` - Arquivos ignorados no build
- `.env.docker` - Configurações específicas para Docker

### Scripts de Instalação
- `install-docker.sh` - Instalação automatizada com Docker
- `install.sh` - Instalação manual (sem Docker)

### Documentação
- `README.md` - Documentação principal (inclui Docker)
- `README-DOCKER.md` - Documentação específica do Docker

## 📋 Características da Imagem Docker

### Base
- **Imagem**: php:8.1-apache
- **Sistema**: Debian/Ubuntu
- **Servidor Web**: Apache 2.4

### Dependências Instaladas
- PHP 8.1 com extensões: pdo_mysql, pdo_sqlite, mbstring, gd, etc.
- Composer (latest)
- wkhtmltopdf com wrapper para ambiente headless
- SQLite3
- Xvfb (para wkhtmltopdf headless)

### Configurações
- **Porta**: 8000 (externa) → 80 (interna)
- **Banco**: SQLite persistente
- **Volumes**: database/ e storage/ persistentes
- **Auto-start**: Migrations e seed automáticos

## 🚀 Como Usar

### Instalação Rápida
```bash
unzip ordem-servico-aeronave-docker.zip
cd ordem-servico-aeronave
chmod +x install-docker.sh
./install-docker.sh
```

### Manual
```bash
docker-compose up -d
```

### Acesso
- Interface: http://localhost:8000
- Logs: `docker-compose logs -f`
- Shell: `docker-compose exec app bash`

## 🔧 Personalização

### Alterar Porta
Edite `docker-compose.yml`:
```yaml
ports:
  - "9000:80"  # Porta 9000
```

### Configurações
Edite `.env.docker` para personalizar variáveis de ambiente.

### Banco de Dados
Por padrão usa SQLite. Para MySQL, veja `README-DOCKER.md`.

## 📊 Tamanho da Imagem

- **ZIP**: ~127KB (sem vendor/)
- **Imagem Docker**: ~500MB (após build)
- **Container**: ~50MB (dados persistentes)

## 🛠️ Desenvolvimento

### Rebuild
```bash
docker-compose build --no-cache
docker-compose up -d
```

### Debug
```bash
docker-compose logs app
docker-compose exec app bash
```

### Reset
```bash
docker-compose down -v  # Remove dados
docker-compose up -d
```

