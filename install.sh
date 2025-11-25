#!/bin/bash

# PT Markat Digdaya Konstruksi - Installation Script
# This script automates the installation process

echo "=================================="
echo "Installation Script v1.0"
echo "PT Markat Digdaya Konstruksi"
echo "=================================="
echo ""

# Color codes
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if running in project directory
if [ ! -f "artisan" ]; then
    echo -e "${RED}Error: Please run this script from the project root directory${NC}"
    exit 1
fi

echo -e "${GREEN}Step 1: Checking requirements...${NC}"

# Check PHP version
PHP_VERSION=$(php -r "echo PHP_VERSION;" 2>/dev/null)
if [ $? -eq 0 ]; then
    echo -e "  ✓ PHP Version: $PHP_VERSION"
else
    echo -e "${RED}  ✗ PHP is not installed${NC}"
    exit 1
fi

# Check Composer
if command -v composer &> /dev/null; then
    COMPOSER_VERSION=$(composer --version 2>/dev/null | head -n 1)
    echo -e "  ✓ Composer: $COMPOSER_VERSION"
else
    echo -e "${RED}  ✗ Composer is not installed${NC}"
    exit 1
fi

# Check Node.js
if command -v node &> /dev/null; then
    NODE_VERSION=$(node --version 2>/dev/null)
    echo -e "  ✓ Node.js Version: $NODE_VERSION"
else
    echo -e "${RED}  ✗ Node.js is not installed${NC}"
    exit 1
fi

# Check NPM
if command -v npm &> /dev/null; then
    NPM_VERSION=$(npm --version 2>/dev/null)
    echo -e "  ✓ NPM Version: $NPM_VERSION"
else
    echo -e "${RED}  ✗ NPM is not installed${NC}"
    exit 1
fi

echo ""
echo -e "${GREEN}Step 2: Installing PHP dependencies...${NC}"
composer install || { echo -e "${RED}Composer install failed${NC}"; exit 1; }

echo ""
echo -e "${GREEN}Step 3: Installing JavaScript dependencies...${NC}"
npm install || { echo -e "${RED}NPM install failed${NC}"; exit 1; }

echo ""
echo -e "${GREEN}Step 4: Setting up environment...${NC}"
if [ ! -f ".env" ]; then
    cp .env.example .env
    echo -e "  ✓ Created .env file"
else
    echo -e "${YELLOW}  ! .env file already exists, skipping${NC}"
fi

echo ""
echo -e "${GREEN}Step 5: Generating application key...${NC}"
php artisan key:generate

echo ""
echo -e "${YELLOW}Step 6: Database configuration${NC}"
echo "Please configure your database settings in .env file:"
echo "  DB_DATABASE=your_database_name"
echo "  DB_USERNAME=your_database_user"
echo "  DB_PASSWORD=your_database_password"
echo ""
read -p "Press Enter when database is configured and created..."

echo ""
echo -e "${GREEN}Step 7: Running database migrations...${NC}"
php artisan migrate || { echo -e "${RED}Migration failed. Please check database configuration${NC}"; exit 1; }

echo ""
echo -e "${GREEN}Step 8: Creating storage link...${NC}"
php artisan storage:link

echo ""
echo -e "${GREEN}Step 9: Setting permissions...${NC}"
chmod -R 755 storage bootstrap/cache
echo -e "  ✓ Permissions set"

echo ""
echo -e "${GREEN}Step 10: Building frontend assets...${NC}"
npm run dev

echo ""
echo -e "${GREEN}=================================="
echo -e "Installation Complete! 🎉"
echo -e "==================================${NC}"
echo ""
echo "To start the development server, run:"
echo -e "${YELLOW}php artisan serve${NC}"
echo ""
echo "Then visit: ${GREEN}http://localhost:8000${NC}"
echo ""
echo "Default admin credentials (if seeded):"
echo "  Email: admin@example.com"
echo "  Password: password"
echo ""
echo -e "${YELLOW}⚠️  Remember to change default credentials in production!${NC}"
echo ""
echo "For more information, see:"
echo "  - QUICKSTART.md for quick start guide"
echo "  - DOCUMENTATION.md for full documentation"
echo "  - DEPLOYMENT.md for deployment guide"
echo ""
