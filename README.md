# Sistema de Ordem de Serviço para Aeronaves

Sistema desenvolvido em Laravel para geração de PDFs dinâmicos de Ordens de Serviço de aeronaves com layout adaptativo e quebra de página precisa usando wkhtmltopdf.

## 🚀 Instalação Rápida com Docker (Recomendado)

```bash
# 1. Extrair o projeto
unzip ordem-servico-aeronave.zip
cd ordem-servico-aeronave

# 2. Executar instalação automatizada
chmod +x install-docker.sh
./install-docker.sh

# 3. Acessar no navegador
# http://localhost:8000
```

## 📋 Instalação Manual

Para instalação sem Docker, consulte as instruções detalhadas no final deste documento.

## 🐳 Uso com Docker

### Comandos Básicos

```bash
# Iniciar aplicação
docker-compose up -d

# Ver logs
docker-compose logs -f

# Parar aplicação
docker-compose down

# Acessar container
docker-compose exec app bash

# Reset completo (apaga dados)
docker-compose down -v
```

### Configuração

- **Porta padrão**: 8000
- **Banco de dados**: SQLite (persistente)
- **Logs**: Disponíveis via `docker-compose logs`

Para configurações avançadas, consulte `README-DOCKER.md`.

## Características

- **Layout Adaptativo**: O sistema se adapta automaticamente à quantidade de itens da OS
- **Quebra de Página Precisa**: Margens fixas de 1cm e quebras de página inteligentes
- **Componentes Dinâmicos**: Suporte a diferentes tipos de aeronaves (AIRFRAME, ENGINES, PROPELLERS)
- **Interface Web**: Sistema completo com CRUD para gerenciar Ordens de Serviço
- **Geração de PDF**: Utiliza wkhtmltopdf para gerar PDFs de alta qualidade

## Requisitos do Sistema

- PHP 8.1 ou superior
- Composer
- SQLite (ou MySQL/PostgreSQL)
- wkhtmltopdf
- Extensões PHP: sqlite3, gd, mbstring, curl, xml

## Instalação

### 1. Instalar Dependências do Sistema

```bash
# Ubuntu/Debian
sudo apt update
sudo apt install -y php php-cli php-sqlite3 php-gd php-mbstring php-curl php-xml wkhtmltopdf composer

# CentOS/RHEL
sudo yum install -y php php-cli php-sqlite3 php-gd php-mbstring php-curl php-xml wkhtmltopdf composer
```

### 2. Configurar o Projeto

```bash
# Extrair o projeto
unzip ordem-servico-aeronave.zip
cd ordem-servico-aeronave

# Instalar dependências PHP
composer install

# Configurar permissões
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/logs storage/framework

# Configurar banco de dados
touch database/database.sqlite

# Executar migrations
php artisan migrate

# Popular com dados de exemplo (opcional)
php artisan db:seed --class=OrdemServicoSeeder
```

### 3. Executar o Sistema

```bash
# Iniciar servidor de desenvolvimento
php artisan serve --host=0.0.0.0 --port=8000

# Acessar no navegador
# http://localhost:8000
```

## Uso do Sistema

### Interface Web

1. **Listar Ordens de Serviço**: Página inicial mostra todas as OS cadastradas
2. **Criar Nova OS**: Botão "Nova OS" para cadastrar uma nova ordem
3. **Visualizar OS**: Ícone de olho para ver detalhes da OS
4. **Editar OS**: Ícone de lápis para editar uma OS existente
5. **Gerar PDF**: Ícone de PDF para visualizar o PDF no navegador
6. **Download PDF**: Ícone de download para baixar o PDF

### Estrutura de Dados

#### Ordem de Serviço
- Número da OS
- Matrícula da aeronave
- Data de início
- Término previsto
- Informações da empresa

#### Componentes da Aeronave
- AIRFRAME
- LEFT ENGINE / RIGHT ENGINE
- LEFT PROPELLER / RIGHT PROPELLER
- Dados técnicos (SN, TSN, TSO, CSO, etc.)

#### Itens de Serviço
- Número do item
- Descrição do serviço
- Equipe responsável
- Intervalos e observações

## API de Geração de PDF

### Rotas Disponíveis

```php
// Visualizar PDF no navegador
GET /ordem-servico/{id}/pdf

// Download do PDF
GET /ordem-servico/{id}/download

// Preview HTML (para debug)
GET /ordem-servico/{id}/preview
```

### Programaticamente

```php
use App\Services\PdfService;
use App\Models\OrdemServico;

$pdfService = new PdfService();
$ordemServico = OrdemServico::find(1);
$pdfContent = $pdfService->generateOrdemServicoPdf($ordemServico);

// Salvar em arquivo
file_put_contents('ordem_servico.pdf', $pdfContent);

// Retornar como resposta HTTP
return response($pdfContent, 200)
    ->header('Content-Type', 'application/pdf')
    ->header('Content-Disposition', 'inline; filename="OS.pdf"');
```

## Configurações de Layout

O sistema implementa as seguintes especificações:

- **Margens**: 1cm em todas as bordas
- **Quebra de Página**: Automática e precisa
- **Cabeçalho**: Apenas na primeira página
- **Fonte**: Arial, tamanhos variados conforme seção
- **Tabelas**: Bordas sólidas, layout responsivo

## Personalização

### Modificar Template

Edite o arquivo `resources/views/pdf/ordem-servico.blade.php` para alterar o layout do PDF.

### Ajustar Configurações do PDF

Modifique o arquivo `app/Services/PdfService.php` para alterar parâmetros do wkhtmltopdf:

```php
$command = sprintf(
    'wkhtmltopdf --page-size A4 --margin-top 10mm --margin-bottom 10mm --margin-left 10mm --margin-right 10mm --encoding UTF-8 --disable-smart-shrinking --print-media-type --dpi 300 --enable-local-file-access %s %s',
    escapeshellarg($tempHtmlFile),
    escapeshellarg($tempPdfFile)
);
```

## Estrutura do Projeto

```
ordem-servico-aeronave/
├── app/
│   ├── Http/Controllers/
│   │   └── OrdemServicoController.php
│   ├── Models/
│   │   ├── OrdemServico.php
│   │   ├── AeronaveComponente.php
│   │   └── ServicoItem.php
│   └── Services/
│       └── PdfService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── ordem-servico/
│       └── pdf/
│           └── ordem-servico.blade.php
└── routes/
    └── web.php
```

## Solução de Problemas

### Erro "wkhtmltopdf not found"
```bash
# Verificar se wkhtmltopdf está instalado
which wkhtmltopdf

# Instalar se necessário
sudo apt install wkhtmltopdf
```

### Erro de permissões
```bash
# Ajustar permissões do Laravel
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/logs storage/framework
```

### Erro de banco de dados
```bash
# Recriar banco SQLite
rm database/database.sqlite
touch database/database.sqlite
php artisan migrate
```

## Suporte

Para suporte técnico ou dúvidas sobre implementação, consulte:

- Documentação do Laravel: https://laravel.com/docs
- Documentação do wkhtmltopdf: https://wkhtmltopdf.org/usage/wkhtmltopdf.txt

## Licença

Este projeto foi desenvolvido para uso específico em sistemas de manutenção de aeronaves.

