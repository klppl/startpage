# SUI Startpage - PHP Version

This is a PHP version of the SUI Startpage project. It maintains the exact same design and functionality as the original JavaScript version.

## Features

- Server-side rendering with PHP
- Dynamic date and greeting display
- Application shortcuts with icons
- Bookmarks organized by categories
- Theme switcher (10+ themes)
- Search functionality with multiple providers
- Responsive design

## Directory Structure

```
php/
├── index.php           # Main entry point
├── data.php            # PHP data loading and helper functions
├── apps.json           # Application data
├── links.json          # Bookmarks data
├── providers.json      # Search provider data
├── assets/
│   ├── css/
│   │   └── styles.css  # All styling (identical to original)
│   └── js/
│       ├── script.js   # Date and greeting functions
│       ├── themer.js   # Theme switching functionality
│       └── search.js   # Search functionality
└── README.md
```

## How It Works

### Original vs PHP Version

**Original (JavaScript):**
- Loads JSON files via AJAX
- Uses Handlebars for client-side templating
- All data rendered on the client

**PHP Version:**
- Loads JSON files server-side via PHP
- PHP generates HTML directly (no templates needed)
- Data rendered on the server
- Same JavaScript functionality for search and theming
- Identical CSS and visual appearance

### Key Changes

1. **`index.php`**: Main HTML file with PHP inline rendering
   - Date and greeting rendered server-side
   - Apps and links rendered in PHP loops
   - No AJAX calls needed

2. **`data.php`**: Data loading and helper functions
   - Loads JSON files
   - Provides `getCurrentDate()` and `getGreeting()` functions
   - Pure PHP - no server dependencies

3. **JavaScript files**: Unchanged functionality
   - `script.js`: Date/greeting updates
   - `themer.js`: Theme switching
   - `search.js`: Search functionality
   - Works identically to original

## Installation

1. Copy all files to your web server
2. Ensure PHP is installed and running
3. Make sure the PHP directory has proper permissions
4. Access via `http://yourserver/path/to/php/`

## Configuration

Edit the JSON files to customize:
- **apps.json**: Add/modify application shortcuts
- **links.json**: Modify your bookmarks
- **providers.json**: Change search providers

## Requirements

- PHP 7.0 or higher
- Web server with PHP support (Apache, Nginx, etc.)

## Design & Functionality

Maintains 100% parity with the original:
- Same visual design
- Same CSS styling
- Same themes
- Same search providers
- Same responsive behavior
- Same animations and effects

The only difference is server-side rendering instead of client-side AJAX data loading.

