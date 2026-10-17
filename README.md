# Startpage

[![License: Lagom](https://img.shields.io/badge/license-lagom-9E2B25)](https://klppl.github.io/lagom-license/)

A clean, customizable browser startpage with theme support, application shortcuts, and bookmarks.

![Screenshot](screenshot.png)

## Features

- Dynamic date and greeting display
- Application shortcuts with icons
- Bookmarks organized by categories
- Theme switcher with multiple themes
- Search functionality with multiple providers
- Responsive design

## Structure

```
├── index.php           # Main page
├── data.php            # Data loading and helper functions
├── admin.php           # Admin interface
├── apps.json           # Application data
├── links.json          # Bookmarks data
├── providers.json      # Search provider data
├── assets/
│   ├── css/
│   │   └── styles.css  # Styling
│   └── js/
│       ├── script.js   # Date and greeting functions
│       ├── themer.js   # Theme switching
│       └── search.js   # Search functionality
└── README.md
```

## Installation

1. Copy all files to your web server
2. Ensure PHP is installed and running
3. Access via your web server

## Configuration

You can customize the startpage by editing the JSON files directly or through the admin interface:

- **apps.json**: Add/modify application shortcuts
- **links.json**: Modify your bookmarks
- **providers.json**: Change search providers

Access the admin interface at `admin.php` to edit these files through a web interface.

### Changing Admin Password

To change the admin password, edit `admin.php` and modify the password constant:

```php
define('ADMIN_PASSWORD', 'your-new-password');
```

## Requirements

- PHP 7.0 or higher
- Web server with PHP support (Apache, Nginx, etc.)

## Credits

Based on [SUI](https://github.com/jeroenpardon/sui) by [jeroenpardon](https://github.com/jeroenpardon)
