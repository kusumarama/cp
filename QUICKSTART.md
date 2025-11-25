# Quick Start Guide - PT Markat Digdaya Konstruksi

## 🚀 5-Minute Setup

### Prerequisites Check
```bash
php -v      # Should be 8.1 or higher
composer -v # Should be installed
node -v     # Should be 16.x or higher
npm -v      # Should be installed
mysql -V    # Should be installed
```

### Step 1: Installation (2 minutes)
```bash
# Navigate to project
cd c:\laragon\www\cp

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate
```

### Step 2: Database Configuration (1 minute)

Edit `.env`:
```env
DB_DATABASE=cp_database
DB_USERNAME=root
DB_PASSWORD=
```

Create database:
```bash
# Via MySQL command line
mysql -u root -e "CREATE DATABASE cp_database"

# Or via Laragon/phpMyAdmin
```

### Step 3: Setup (2 minutes)
```bash
# Run migrations
php artisan migrate

# Create storage link
php artisan storage:link

# Build assets
npm run dev
```

### Step 4: Launch
```bash
# Start development server
php artisan serve

# Open browser: http://localhost:8000
```

### Default Login Credentials
```
Email: admin@example.com
Password: password

(Change these immediately in production!)
```

## 📱 Feature Overview

### Public Website
- **Home** (`/`): Company introduction, services, portfolio showcase
- **Portfolio** (`/portfolio`): Construction projects with image galleries
- **Design** (`/design`): Architectural and engineering designs
- **Legality** (`/legality`): Company certifications and legal documents
- **Contact**: Contact form with Google Maps

### Admin Panel (`/editor`)
- **Dashboard**: Overview and statistics
- **Master Head**: Homepage banner management
- **Services**: Service offerings CRUD
- **About**: Company information
- **Portfolio**: Project management with multiple images
- **Design**: Design project management
- **Legality**: Legal document management
- **Clients**: Client logo management
- **Contact**: View contact form submissions
- **Users**: Admin user management

## 🎯 Quick Tasks

### Adding a New Portfolio Project

1. Login to admin panel (`/login`)
2. Navigate to Portfolio menu
3. Click "Add New" button
4. Fill in project details:
   - Project Name
   - Status
   - Location
   - Owner
   - Address
   - Contract Value
   - Building Type
   - Timeline
   - Status Update
5. Upload images (multiple supported)
6. Click "Save"

### Managing Images

**Add More Images to Existing Project**:
1. Go to Portfolio list
2. Click "Edit" on project
3. Scroll to "Additional Images" section
4. Drag & drop or click to upload
5. Click "Add Images"

**Delete Image**:
1. View project details
2. Click trash icon on image thumbnail
3. Confirm deletion

### Changing Homepage Banner

1. Go to Master Head menu
2. Click "Edit" on existing banner
3. Update title, subtitle, or image
4. Click "Update"

### Viewing Contact Form Submissions

1. Go to Contact menu
2. View all submissions in table
3. Click "View" for details
4. Click "Delete" to remove

## 🛠️ Common Customizations

### Changing Theme Color

Edit color variables in views (search for `#2d5a3d`):
```css
/* Current primary color */
color: #2d5a3d;

/* Change to your brand color */
color: #YOUR_COLOR;
```

### Adding a New Service

1. Admin Panel → Services
2. Click "Add New"
3. Enter:
   - Service Title
   - Subtitle
   - Description
   - Upload Icon/Image
4. Save

### Updating Company Information

1. Admin Panel → About
2. Click "Edit" on existing content
3. Update company description, history, mission, vision
4. Save

### Managing Client Logos

1. Admin Panel → Clients
2. Add new clients with logos
3. Logos appear on homepage and clients page

## 📊 Understanding the Modules

### Portfolio vs Design vs Legality

| Feature | Portfolio | Design | Legality |
|---------|-----------|--------|----------|
| Purpose | Construction projects | Architectural designs | Legal documents |
| Fields | Full (9 fields) | Medium (5 fields) | Simple (2 fields) |
| Images | Multiple | Multiple | Multiple |
| Grid Layout | 3-4 columns | 5 columns | 5 columns |
| Detail View | Full info | Simplified | Minimal |

**When to use Portfolio**: Completed construction and renovation projects
**When to use Design**: Architectural drawings, engineering designs, plans
**When to use Legality**: Certificates, licenses, legal documents

## 🔧 Troubleshooting

### Images Not Showing
```bash
php artisan storage:link
# Verify: ls -la public/storage
```

### 500 Error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Fix permissions
chmod -R 755 storage bootstrap/cache
```

### Database Connection Error
```bash
# Verify credentials in .env
# Test connection: php artisan migrate:status
```

### CSRF Token Mismatch
```bash
php artisan cache:clear
php artisan config:clear
# Clear browser cookies
```

### Assets Not Loading
```bash
npm run dev
# Or for production: npm run build
```

## 📝 Daily Operations

### Morning Routine
1. Check error logs: `tail -f storage/logs/laravel.log`
2. Review contact submissions
3. Monitor system resources

### Adding New Content
1. Portfolio projects: As completed
2. Design projects: When finalized
3. Client logos: After onboarding
4. Services: As offerings expand

### Maintenance Tasks
- **Weekly**: Review and delete old logs
- **Monthly**: Update dependencies: `composer update`
- **Quarterly**: Security audit

## 🎨 Customization Tips

### Logo Change
Replace file: `public/template_fe/assets/img/logo.png`

### Favicon Change
Replace file: `public/favicon.ico`

### Contact Info Update
Edit views: `resources/views/pages/fe/legality/index.blade.php` (footer section)

### Social Media Links
Edit navbar: `resources/views/include/fe/navbar.blade.php`

## 📈 Next Steps

1. **Add Sample Content**: Create 5-10 portfolio items with real data
2. **Configure Email**: Setup SMTP in `.env` for contact form
3. **SEO Setup**: Add meta descriptions, sitemap
4. **Analytics**: Integrate Google Analytics
5. **Backup**: Configure automated backups
6. **SSL**: Install SSL certificate for HTTPS
7. **Performance**: Enable caching, optimize images

## 🆘 Getting Help

### Documentation
- Full Documentation: `DOCUMENTATION.md`
- Laravel Docs: https://laravel.com/docs
- Bootstrap Docs: https://getbootstrap.com

### Support
- Email: alhadidarchives@gmail.com
- Check logs: `storage/logs/laravel.log`
- Debug mode: Set `APP_DEBUG=true` in `.env` (development only!)

## ✅ Success Checklist

- [ ] Application installed and running
- [ ] Database created and migrated
- [ ] Storage link created
- [ ] Admin login working
- [ ] Sample portfolio item added
- [ ] Images uploading successfully
- [ ] Public website accessible
- [ ] Contact form tested
- [ ] All menus working
- [ ] Responsive on mobile

**Once all checked, you're ready to go! 🎉**

---

Need help? Check `DOCUMENTATION.md` for detailed information or contact support.
