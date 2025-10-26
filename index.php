<?php
require_once 'data.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>SUI</title>
    <meta charset="utf-8">
    <meta http-equiv="Default-Style" content="">
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <link type="text/css" rel="stylesheet" href="assets/css/styles.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.1/handlebars.min.js"></script>
    <script src="https://code.iconify.design/1/1.0.0-rc7/iconify.min.js"></script>
</head>

<body onload="loadFunctions()">
    
    <section id="modal">
        <div>
            <header id="modal-header">
                <h1>Options</h1>
                <a href="#" title="Close" class="modal-close">
                    <span class="iconify" data-icon="mdi-close"></span>
                </a>
            </header>

            <h2>Color themes</h2>

            <div id="modal-theme">
                <button data-theme="blackboard" class="theme-button theme-blackboard">Blackboard</button>
                <button data-theme="gazette" class="theme-button theme-gazette">Gazette</button>
                <button data-theme="espresso" class="theme-button theme-espresso">Espresso</button>
                <button data-theme="cab" class="theme-button theme-cab">Cab</button>
                <button data-theme="cloud" class="theme-button theme-cloud">Cloud</button>
                <button data-theme="lime" class="theme-button theme-lime">Lime</button>
                <button data-theme="passion" class="theme-button theme-passion">Passion</button>
                <button data-theme="blues" class="theme-button theme-blues">Blues</button>
                <button data-theme="chalk" class="theme-button theme-chalk">Chalk</button>
                <button data-theme="tron" class="theme-button theme-tron">Tron</button>
                <button data-theme="paper" class="theme-button theme-paper">Paper</button>
            </div>

            <h2>Search options</h2>

            <section id="providers">
                <table>
                    <tr>
                        <th>Website</th>
                        <th>Prefix</th>
                    </tr>
                    <?php foreach ($providers_data['providers'] as $provider): ?>
                    <tr>
                        <td><a target="_blank" href="<?php echo htmlspecialchars($provider['url']); ?>"><?php echo htmlspecialchars($provider['name']); ?></a></td>
                        <td><?php echo htmlspecialchars($provider['prefix']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </section>

            <header id="modal-footer">
                <a href="admin.php"><span class="iconify" data-icon="mdi-shield-crown"></span></a>
                <a href="https://materialdesignicons.com/"><span class="iconify" data-icon="mdi-material-design"></a></span>
            </header>
        </div>
    </section>    

    <main id="container" class="fade">

        <section id="search">
            <input name="keywords" type="text" id="keywords" size="50" spellcheck="false" autofocus="true" onkeydown="handleKeyPress(event)">
        </section>
            
        <section id="header">
            <h2 id="header_date"><?php echo getCurrentDate(); ?></h2>
            <h1 id="header_greet"><?php echo getGreeting(); ?></h1>
        </section>

        <section id="apps">
            <h3>Applications</h3>
            <div id="apps_loop">
                <?php foreach ($apps_data['apps'] as $app): ?>
                    <div class="apps_item">
                        <div class="apps_icon">
                            <span class="iconify icon" data-icon="mdi-<?php echo htmlspecialchars($app['icon']); ?>"></span>
                        </div>
                        <div class="apps_text">
                            <a target="_blank" href="<?php echo htmlspecialchars($app['url']); ?>"><?php echo htmlspecialchars($app['name']); ?></a>
                            <span><?php echo htmlspecialchars($app['url']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

         <section id="links">
            <h3>Bookmarks</h3>
            <div id="links_loop">
                <?php foreach ($links_data['bookmarks'] as $bookmark): ?>
                    <div id="links_item">
                        <h4><?php echo htmlspecialchars($bookmark['category']); ?></h4>
                        <?php foreach ($bookmark['links'] as $link): ?>
                            <a target="_blank" href="<?php echo htmlspecialchars($link['url']); ?>" class="theme_color-border theme_text-select"><?php echo htmlspecialchars($link['name']); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <div id="modal_init">
        <a class="btn" href="#modal">
            <span class="iconify icon" data-icon="mdi-xbox-controller-menu"></span>
        </a>
    </div>

    <script src="assets/js/script.js" type="text/javascript"></script>
    <script src="assets/js/themer.js" type="text/javascript"></script>
    <script src="assets/js/search.js" type="text/javascript"></script>
    
</body>
</html>

