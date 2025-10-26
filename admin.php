<?php
session_start();

// Password for admin access
define('ADMIN_PASSWORD', 'hunter2');

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Handle login
if (isset($_POST['login'])) {
    if ($_POST['password'] === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Invalid password';
    }
}

// Check if logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    // Show login form
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Login</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="assets/css/styles.css" media="screen,projection"/>
        <style>
            #login-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                width: 100vw;
                background-color: var(--color-background, #f5f5f5);
            }
            #login-form {
                background: white;
                padding: 3em;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                max-width: 400px;
                width: 100%;
            }
            #login-form h1 {
                margin-bottom: 1.5em;
                color: #333;
            }
            #login-form input[type="password"] {
                width: 100%;
                padding: 1em;
                margin-bottom: 1em;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            #login-form button {
                width: 100%;
                padding: 1em;
                background-color: #333;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 1em;
                text-transform: uppercase;
                font-weight: 500;
            }
            #login-form button:hover {
                background-color: #555;
            }
            .error {
                color: #d32f2f;
                margin-bottom: 1em;
            }
            .back-link {
                display: block;
                text-align: center;
                margin-top: 1em;
                color: #666;
            }
        </style>
    </head>
    <body>
        <div id="login-container">
            <div id="login-form">
                <h1>Admin Login</h1>
                <?php if (isset($error)): ?>
                    <div class="error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form method="post">
                    <input type="password" name="password" placeholder="Password" required autofocus>
                    <button type="submit" name="login">Login</button>
                </form>
                <a href="index.php" class="back-link">← Back to Home</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Load JSON files
$apps_data = json_decode(file_get_contents('apps.json'), true);
$links_data = json_decode(file_get_contents('links.json'), true);
$providers_data = json_decode(file_get_contents('providers.json'), true);

// Handle save operations
if (isset($_POST['save_apps'])) {
    $apps_data = json_decode($_POST['apps_json'], true);
    if ($apps_data !== null) {
        file_put_contents('apps.json', json_encode($apps_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $apps_success = 'Apps saved successfully!';
    } else {
        $apps_error = 'Invalid JSON format';
    }
}

if (isset($_POST['save_links'])) {
    $links_data = json_decode($_POST['links_json'], true);
    if ($links_data !== null) {
        file_put_contents('links.json', json_encode($links_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $links_success = 'Bookmarks saved successfully!';
    } else {
        $links_error = 'Invalid JSON format';
    }
}

if (isset($_POST['save_providers'])) {
    $providers_data = json_decode($_POST['providers_json'], true);
    if ($providers_data !== null) {
        file_put_contents('providers.json', json_encode($providers_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $providers_success = 'Providers saved successfully!';
    } else {
        $providers_error = 'Invalid JSON format';
    }
}

// Reload data after save
if (isset($_POST['save_apps']) || isset($_POST['save_links']) || isset($_POST['save_providers'])) {
    $apps_data = json_decode(file_get_contents('apps.json'), true);
    $links_data = json_decode(file_get_contents('links.json'), true);
    $providers_data = json_decode(file_get_contents('providers.json'), true);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="assets/css/styles.css" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, Helvetica Neue, Roboto, sans-serif;
        }
        #admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2em;
        }
        #admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2em;
            padding-bottom: 1em;
            border-bottom: 2px solid #ddd;
        }
        #admin-header h1 {
            margin: 0;
            color: #333;
            font-size: 2em;
        }
        .logout-btn {
            padding: 0.5em 1.5em;
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: 500;
        }
        .logout-btn:hover {
            background-color: #c62828;
        }
        .section {
            background: white;
            padding: 2em;
            margin-bottom: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .section h2 {
            color: #333;
            margin-top: 0;
            margin-bottom: 1em;
        }
        textarea {
            width: 100%;
            min-height: 300px;
            padding: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            resize: vertical;
        }
        .button-group {
            margin-top: 1em;
            display: flex;
            gap: 1em;
        }
        button[type="submit"] {
            padding: 0.75em 2em;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            text-transform: uppercase;
            font-weight: 500;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 1em;
            border-radius: 4px;
            margin-bottom: 1em;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 1em;
            border-radius: 4px;
            margin-bottom: 1em;
        }
        .info-box {
            background-color: #e3f2fd;
            padding: 1em;
            border-radius: 4px;
            margin-bottom: 1em;
            font-size: 0.9em;
            color: #0d47a1;
        }
        .back-link {
            color: #666;
            text-decoration: none;
            display: inline-block;
            margin-top: 1em;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div id="admin-container">
        <div id="admin-header">
            <h1>Admin Panel</h1>
            <a href="?logout" class="logout-btn">Logout</a>
        </div>

        <a href="index.php" class="back-link">← Back to Home</a>

        <!-- Apps Section -->
        <div class="section">
            <h2>Applications (apps.json)</h2>
            <?php if (isset($apps_success)): ?>
                <div class="success"><?php echo $apps_success; ?></div>
            <?php endif; ?>
            <?php if (isset($apps_error)): ?>
                <div class="error"><?php echo $apps_error; ?></div>
            <?php endif; ?>
            <div class="info-box">
                Each app requires: name, url, and icon (icon name without "mdi-" prefix, e.g., "music" for "mdi-music")
            </div>
            <form method="post">
                <textarea name="apps_json"><?php echo htmlspecialchars(json_encode($apps_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)); ?></textarea>
                <div class="button-group">
                    <button type="submit" name="save_apps">Save Apps</button>
                </div>
            </form>
        </div>

        <!-- Links Section -->
        <div class="section">
            <h2>Bookmarks (links.json)</h2>
            <?php if (isset($links_success)): ?>
                <div class="success"><?php echo $links_success; ?></div>
            <?php endif; ?>
            <?php if (isset($links_error)): ?>
                <div class="error"><?php echo $links_error; ?></div>
            <?php endif; ?>
            <div class="info-box">
                Categories contain links, and each link needs: name and url
            </div>
            <form method="post">
                <textarea name="links_json"><?php echo htmlspecialchars(json_encode($links_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)); ?></textarea>
                <div class="button-group">
                    <button type="submit" name="save_links">Save Bookmarks</button>
                </div>
            </form>
        </div>

        <!-- Providers Section -->
        <div class="section">
            <h2>Search Providers (providers.json)</h2>
            <?php if (isset($providers_success)): ?>
                <div class="success"><?php echo $providers_success; ?></div>
            <?php endif; ?>
            <?php if (isset($providers_error)): ?>
                <div class="error"><?php echo $providers_error; ?></div>
            <?php endif; ?>
            <div class="info-box">
                Each provider needs: name, url (with %s or parameter placeholder), and prefix
            </div>
            <form method="post">
                <textarea name="providers_json"><?php echo htmlspecialchars(json_encode($providers_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)); ?></textarea>
                <div class="button-group">
                    <button type="submit" name="save_providers">Save Providers</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

