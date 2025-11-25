@echo off
REM PT Markat Digdaya Konstruksi - Installation Script (Windows)
REM This script automates the installation process

echo ==================================
echo Installation Script v1.0
echo PT Markat Digdaya Konstruksi
echo ==================================
echo.

REM Check if artisan file exists
if not exist "artisan" (
    echo [ERROR] Please run this script from the project root directory
    pause
    exit /b 1
)

echo [Step 1] Checking requirements...

REM Check PHP
php -v >nul 2>&1
if %errorlevel% neq 0 (
    echo   X PHP is not installed or not in PATH
    pause
    exit /b 1
) else (
    echo   √ PHP is installed
)

REM Check Composer
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo   X Composer is not installed or not in PATH
    pause
    exit /b 1
) else (
    echo   √ Composer is installed
)

REM Check Node.js
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo   X Node.js is not installed or not in PATH
    pause
    exit /b 1
) else (
    echo   √ Node.js is installed
)

REM Check NPM
npm --version >nul 2>&1
if %errorlevel% neq 0 (
    echo   X NPM is not installed or not in PATH
    pause
    exit /b 1
) else (
    echo   √ NPM is installed
)

echo.
echo [Step 2] Installing PHP dependencies...
call composer install
if %errorlevel% neq 0 (
    echo [ERROR] Composer install failed
    pause
    exit /b 1
)

echo.
echo [Step 3] Installing JavaScript dependencies...
call npm install
if %errorlevel% neq 0 (
    echo [ERROR] NPM install failed
    pause
    exit /b 1
)

echo.
echo [Step 4] Setting up environment...
if not exist ".env" (
    copy .env.example .env
    echo   √ Created .env file
) else (
    echo   ! .env file already exists, skipping
)

echo.
echo [Step 5] Generating application key...
php artisan key:generate

echo.
echo [Step 6] Database configuration
echo Please configure your database settings in .env file:
echo   DB_DATABASE=your_database_name
echo   DB_USERNAME=your_database_user
echo   DB_PASSWORD=your_database_password
echo.
echo Create the database using phpMyAdmin or MySQL command line
echo.
pause

echo.
echo [Step 7] Running database migrations...
php artisan migrate
if %errorlevel% neq 0 (
    echo [ERROR] Migration failed. Please check database configuration
    pause
    exit /b 1
)

echo.
echo [Step 8] Creating storage link...
php artisan storage:link

echo.
echo [Step 9] Building frontend assets...
call npm run dev

echo.
echo ==================================
echo Installation Complete! 🎉
echo ==================================
echo.
echo To start the development server, run:
echo   php artisan serve
echo.
echo Then visit: http://localhost:8000
echo.
echo Default admin credentials (if seeded):
echo   Email: admin@example.com
echo   Password: password
echo.
echo ⚠️  Remember to change default credentials in production!
echo.
echo For more information, see:
echo   - QUICKSTART.md for quick start guide
echo   - DOCUMENTATION.md for full documentation
echo   - DEPLOYMENT.md for deployment guide
echo.
pause
