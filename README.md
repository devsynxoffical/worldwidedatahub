# World Wide Data Hub & Associated Sites

This repository contains the full WordPress codebase for the project.

## Directory Structure

```
├── worldwidedatahub.com/     # World Wide Data Hub WordPress installation
├── fitofyhub.com/             # Fitofy Hub WordPress installation
├── smsmyntra.com/             # SMS Myntra WordPress installation
├── wp-content/                # Root site wp-content (themes, plugins, uploads)
├── wp-admin/                  # Root site admin core
├── wp-includes/               # Root site includes
├── wp-config.php              # Root site WordPress database configuration
└── .gitignore                 # Excluded large backups (.wpress, .tar.gz), caches, and logs
```

## Getting Started for Developers

### 1. Clone the Repository
```bash
git clone https://github.com/devsynxoffical/worldwidedatahub.git
# or with SSH
git clone git@github.com:devsynxoffical/worldwidedatahub.git

cd worldwidedatahub
```

### 2. Configure Database
Each WordPress installation uses its own `wp-config.php` file:
- Root site: `wp-config.php`
- World Wide Data Hub: `worldwidedatahub.com/wp-config.php`
- Fitofy Hub: `fitofyhub.com/wp-config.php`
- SMS Myntra: `smsmyntra.com/wp-config.php`

Update the database credentials in the corresponding `wp-config.php` to match your local or staging environment:
```php
define( 'DB_NAME',     'your_local_db' );
define( 'DB_USER',     'your_local_user' );
define( 'DB_PASSWORD', 'your_local_password' );
define( 'DB_HOST',     'localhost' );
```

### 3. Local Server Setup
You can run this project locally using any standard WordPress environment:
- **LocalWP** / **Docker** / **XAMPP** / **MAMP** / **Valet** / **Laragon**
- Point your web server document root to the repository root or the specific site subfolder (e.g. `worldwidedatahub.com/`).

### 4. Backups and Excluded Files
Large backup archives (`.wpress`, `.tar.gz`) and runtime caches/logs are excluded from version control via `.gitignore` to comply with GitHub file size limits.
