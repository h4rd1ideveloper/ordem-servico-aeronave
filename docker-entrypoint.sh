#!/bin/bash

echo "=== Iniciando Sistema de Ordem de Serviço ==="

# Aguardar um momento para garantir que tudo está pronto
sleep 2

# Verificar se o banco de dados existe e tem tabelas
echo "Verificando banco de dados..."
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Criando banco de dados SQLite..."
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
fi

# Criar diretórios de cache e sessão se não existirem
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/views

# Definir permissões para storage e cache
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Executar migrations
echo "Executando migrations..."
php artisan migrate --force

# Verificar se o banco está vazio e popular com dados de exemplo
echo "Verificando dados de exemplo..."
TABLES_COUNT=$(sqlite3 /var/www/html/database/database.sqlite "SELECT COUNT(*) FROM ordem_servicos;" 2>/dev/null || echo "0")

if [ "$TABLES_COUNT" = "0" ]; then
    echo "Populando banco com dados de exemplo..."
    php artisan db:seed --class=OrdemServicoSeeder --force
    echo "Dados de exemplo inseridos com sucesso!"
else
    echo "Banco já contém dados. Pulando seed."
fi

# Limpar cache se necessário
echo "Limpando cache..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Verificar se wkhtmltopdf está funcionando
echo "Testando wkhtmltopdf..."
if /usr/local/bin/wkhtmltopdf-wrapper --version > /dev/null 2>&1; then
    echo "✓ wkhtmltopdf funcionando corretamente"
else
    echo "⚠ Aviso: wkhtmltopdf pode não estar funcionando corretamente"
fi

echo "=== Sistema pronto! ==="
echo "Acesse: http://localhost:8000"
echo ""

# Iniciar Apache
echo "Iniciando servidor web..."
apache2-foreground
