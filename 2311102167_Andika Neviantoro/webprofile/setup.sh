#!/bin/bash

echo "=================================================="
echo " Portfolio Laravel - Setup Script"
echo " by Andika Neviantoro (2311102167)"
echo "=================================================="
echo ""

# Check PHP
if ! command -v php &> /dev/null; then
    echo "[ERROR] PHP tidak ditemukan. Install PHP 8.1+ terlebih dahulu."
    exit 1
fi

# Check Composer
if ! command -v composer &> /dev/null; then
    echo "[ERROR] Composer tidak ditemukan. Install Composer terlebih dahulu."
    exit 1
fi

echo "[1/6] Menginstall dependencies Composer..."
composer install --no-interaction --prefer-dist

echo ""
echo "[2/6] Membuat file .env..."
cp .env.example .env

echo ""
echo "[3/6] Generate APP_KEY..."
php artisan key:generate

echo ""
echo "[4/6] Membuat database SQLite..."
touch database/portfolio.sqlite

echo ""
echo "[5/6] Menjalankan migrasi dan seeder..."
php artisan migrate --seed --force

echo ""
echo "[6/6] Membuat symlink storage..."
php artisan storage:link

echo ""
echo "=================================================="
echo " Setup selesai!"
echo ""
echo " Jalankan server:"
echo "   php artisan serve"
echo ""
echo " Buka di browser:"
echo "   http://localhost:8000"
echo ""
echo " Login Admin:"
echo "   URL    : http://localhost:8000/login"
echo "   Email  : admin@portfolio.com"
echo "   Password: password123"
echo "=================================================="
