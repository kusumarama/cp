# Production Deployment Guide

## 🚀 Complete Production Deployment Checklist

### Pre-Deployment Preparation

#### 1. Code Optimization
```bash
# Install production dependencies only
composer install --optimize-autoloader --no-dev

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build production assets
npm run build
```

#### 2. Environment Configuration

Create `.env` with production settings:
```env
APP_NAME="PT Markat Digdaya Konstruksi"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=your-production-host
DB_PORT=3306
DB_DATABASE=your_production_db
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.your-mail-server.com
MAIL_PORT=587
MAIL_USERNAME=your_email@domain.com
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### 3. Security Hardening

**Generate secure keys**:
```bash
php artisan key:generate
```

**Set proper permissions**:
```bash
# Laravel application
chmod -R 755 /path/to/your/project
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data /path/to/your/project

# Or for specific files
find /path/to/your/project -type f -exec chmod 644 {} \;
find /path/to/your/project -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache
```

**Database security**:
- Use strong passwords
- Create dedicated database user
- Grant only necessary permissions
- Enable SSL connections

#### 4. Database Migration

```bash
# Backup existing database first!
php artisan backup:run --only-db

# Run migrations
php artisan migrate --force

# Verify migration status
php artisan migrate:status
```

### Server Setup

#### Option A: Apache Server

**1. Install required modules**:
```bash
sudo a2enmod rewrite
sudo a2enmod ssl
sudo systemctl restart apache2
```

**2. Virtual Host Configuration** (`/etc/apache2/sites-available/yourdomain.conf`):
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    ServerAdmin admin@yourdomain.com
    DocumentRoot /var/www/html/cp/public

    <Directory /var/www/html/cp/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/yourdomain-error.log
    CustomLog ${APACHE_LOG_DIR}/yourdomain-access.log combined

    # Security Headers
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
</VirtualHost>

# HTTPS Configuration (after SSL certificate)
<VirtualHost *:443>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    ServerAdmin admin@yourdomain.com
    DocumentRoot /var/www/html/cp/public

    SSLEngine on
    SSLCertificateFile /path/to/your/certificate.crt
    SSLCertificateKeyFile /path/to/your/private.key
    SSLCertificateChainFile /path/to/your/chain.crt

    <Directory /var/www/html/cp/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/yourdomain-ssl-error.log
    CustomLog ${APACHE_LOG_DIR}/yourdomain-ssl-access.log combined

    # Security Headers
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
</VirtualHost>
```

**3. Enable site**:
```bash
sudo a2ensite yourdomain.conf
sudo systemctl reload apache2
```

#### Option B: Nginx Server

**Configuration** (`/etc/nginx/sites-available/yourdomain`):
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/html/cp/public;

    # SSL Configuration
    ssl_certificate /path/to/your/certificate.crt;
    ssl_certificate_key /path/to/your/private.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;

    # Security Headers
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Disable access to sensitive files
    location ~ /\.(env|git|gitignore) {
        deny all;
    }

    # Cache static assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types text/plain text/css text/xml text/javascript application/json application/javascript application/xml+rss application/rss+xml font/truetype font/opentype application/vnd.ms-fontobject image/svg+xml;
}
```

**Enable site**:
```bash
sudo ln -s /etc/nginx/sites-available/yourdomain /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### SSL Certificate Setup

#### Using Let's Encrypt (Free)

```bash
# Install Certbot
sudo apt update
sudo apt install certbot python3-certbot-apache  # For Apache
# Or
sudo apt install certbot python3-certbot-nginx   # For Nginx

# Obtain certificate
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com  # Apache
# Or
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com   # Nginx

# Auto-renewal (check)
sudo certbot renew --dry-run

# Setup auto-renewal cron job
sudo crontab -e
# Add this line:
0 0 * * * certbot renew --quiet
```

### Post-Deployment Steps

#### 1. Create Storage Link
```bash
cd /var/www/html/cp
php artisan storage:link
```

#### 2. Setup Cron Jobs (if needed)

```bash
sudo crontab -e
```

Add:
```cron
* * * * * cd /var/www/html/cp && php artisan schedule:run >> /dev/null 2>&1
```

#### 3. Setup Queue Worker (if using queues)

Create systemd service (`/etc/systemd/system/laravel-worker.service`):
```ini
[Unit]
Description=Laravel Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/html/cp/artisan queue:work --sleep=3 --tries=3 --max-time=3600
StandardOutput=append:/var/www/html/cp/storage/logs/worker.log
StandardError=append:/var/www/html/cp/storage/logs/worker-error.log

[Install]
WantedBy=multi-user.target
```

Enable and start:
```bash
sudo systemctl enable laravel-worker
sudo systemctl start laravel-worker
sudo systemctl status laravel-worker
```

#### 4. Configure Firewall

```bash
# UFW (Ubuntu)
sudo ufw allow 22/tcp    # SSH
sudo ufw allow 80/tcp    # HTTP
sudo ufw allow 443/tcp   # HTTPS
sudo ufw enable
sudo ufw status
```

#### 5. Setup Backup System

Install Laravel Backup package:
```bash
composer require spatie/laravel-backup
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```

Configure in `config/backup.php` and add cron:
```cron
0 2 * * * cd /var/www/html/cp && php artisan backup:run >> /var/www/html/cp/storage/logs/backup.log 2>&1
```

### Monitoring and Maintenance

#### 1. Setup Error Monitoring

**Sentry (Recommended)**:
```bash
composer require sentry/sentry-laravel
php artisan vendor:publish --provider="Sentry\Laravel\ServiceProvider"
```

Add to `.env`:
```env
SENTRY_LARAVEL_DSN=your-sentry-dsn
```

#### 2. Setup Uptime Monitoring

Use services like:
- UptimeRobot (free)
- Pingdom
- StatusCake

#### 3. Log Rotation

Create `/etc/logrotate.d/laravel`:
```
/var/www/html/cp/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data www-data
    sharedscripts
}
```

#### 4. Performance Monitoring

**Install New Relic or similar**:
```bash
# For PHP monitoring
sudo apt install newrelic-php5
sudo newrelic-install install
```

### Security Checklist

- [ ] Strong passwords for database and admin users
- [ ] SSL certificate installed and working
- [ ] Firewall configured
- [ ] SSH key-based authentication (disable password auth)
- [ ] Regular security updates enabled
- [ ] Backup system configured
- [ ] Error reporting disabled (`APP_DEBUG=false`)
- [ ] Security headers configured
- [ ] File permissions properly set
- [ ] `.env` file secured (not in git)
- [ ] Database user has minimum required permissions
- [ ] CSRF protection enabled
- [ ] XSS protection enabled
- [ ] SQL injection prevention (using Eloquent)
- [ ] Rate limiting configured

### Performance Optimization

#### 1. OPcache Configuration

Edit `/etc/php/8.1/apache2/php.ini` (or nginx/fpm/php.ini):
```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

#### 2. Database Optimization

```sql
-- Add indexes for frequently queried columns
ALTER TABLE portofolio ADD INDEX idx_slug (slug);
ALTER TABLE design ADD INDEX idx_slug (slug);
ALTER TABLE legality ADD INDEX idx_slug (slug);

-- Optimize tables
OPTIMIZE TABLE portofolio, design, legality, portfolio_images, design_images, legality_images;
```

#### 3. Enable Redis (Optional but Recommended)

```bash
# Install Redis
sudo apt install redis-server php-redis

# Configure Laravel
# In .env:
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

#### 4. CDN Setup (Optional)

For static assets (images, CSS, JS), consider using:
- Cloudflare (Free CDN + DDoS protection)
- Amazon CloudFront
- MaxCDN

### Rollback Plan

#### Quick Rollback Steps

1. **Keep previous version**:
```bash
# Before deploying new version
cp -r /var/www/html/cp /var/www/html/cp-backup-$(date +%Y%m%d)
```

2. **Database backup before migrations**:
```bash
php artisan backup:run --only-db
```

3. **Git-based rollback**:
```bash
git log  # Find previous stable commit
git checkout <commit-hash>
composer install --no-dev
php artisan migrate:rollback
php artisan config:cache
```

### Deployment Automation (Optional)

**Using Deployer**:
```bash
composer require deployer/deployer
php vendor/bin/dep init

# Edit deploy.php with your configuration
# Deploy: dep deploy production
```

**Or use CI/CD**:
- GitHub Actions
- GitLab CI/CD
- Jenkins
- Bitbucket Pipelines

### Testing Before Go-Live

#### 1. Functionality Testing
- [ ] All pages load
- [ ] Forms work
- [ ] Image uploads work
- [ ] Admin login works
- [ ] CRUD operations work
- [ ] Contact form works
- [ ] Email sending works

#### 2. Performance Testing
- [ ] Page load time < 3 seconds
- [ ] Images optimized
- [ ] Caching working
- [ ] Database queries optimized

#### 3. Security Testing
- [ ] SSL working
- [ ] HTTPS redirect working
- [ ] Security headers present
- [ ] No sensitive data exposed
- [ ] File upload restrictions working

### Go-Live Checklist

- [ ] Domain DNS pointed to server
- [ ] SSL certificate valid
- [ ] All tests passed
- [ ] Backups configured
- [ ] Monitoring setup
- [ ] Error tracking enabled
- [ ] Performance monitoring active
- [ ] Documentation updated
- [ ] Team trained
- [ ] Rollback plan ready
- [ ] Support contact info updated

### Post-Launch

#### First 24 Hours
- Monitor error logs closely
- Watch server resources
- Check uptime monitoring
- Test all critical features
- Be ready for quick fixes

#### First Week
- Review analytics
- Check performance metrics
- Gather user feedback
- Monitor backups
- Review security logs

#### First Month
- Performance optimization
- SEO improvements
- Content updates
- Feature enhancements
- Security audit

---

**Deployment Date**: _________________  
**Deployed By**: _________________  
**Version**: _________________  
**Rollback Plan**: _________________
