<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimalistic Startpage</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            width: 90%;
            max-width: 1200px;
            gap: 10px; /* Reduce the gap between categories */
        }
        .category {
            margin: 0;
            padding: 0 10px;
            flex: 1 1 200px; /* Ensure categories take up only as much space as needed */
        }
        .category h2 {
            font-weight: 700;
            font-size: 1.2em;
            color: #c0c0c0;
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
        }
        .link {
            text-align: center;
        }
        .link a {
            color: #1e90ff;
            text-decoration: none;
            display: block;
            margin: 5px 0;
            font-weight: 400;
        }
        .link a:hover {
            text-decoration: underline;
            color: #4682b4;
        }
        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 0.8em;
            color: #666;
        }
        @media (max-width: 600px) {
            .category h2 {
                font-size: 1em;
            }
            .link a {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
    $file = fopen("links.txt", "r");
    $current_category = "";
    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        if (strpos($line, "category") === 0) {
            if ($current_category !== "") {
                echo "</div>";
            }
            $current_category = substr($line, 9, -1);
            echo "<div class='category'><h2>$current_category</h2>";
        } elseif (strpos($line, "name:") === 0) {
            $name = trim(substr($line, 6), '"');
            $url_line = fgets($file);
            $url = trim(substr(trim($url_line), 5), '"');
            echo "<div class='link'><a href='$url' target='_blank'>$name</a></div>";
        }
    }
    if ($current_category !== "") {
        echo "</div>";
    }
    fclose($file);

    // Get the user's IP address
    $user_ip = $_SERVER['REMOTE_ADDR'];
    ?>
    </div>
    <div class="footer">
        IP: <?php echo $user_ip; ?>
    </div>
</body>
</html>
