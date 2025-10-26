<?php
// Load JSON data files
$apps_data = json_decode(file_get_contents('apps.json'), true);
$links_data = json_decode(file_get_contents('links.json'), true);
$providers_data = json_decode(file_get_contents('providers.json'), true);

// Function to get current date
function getCurrentDate() {
    $weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return $weekday[date('w')] . ', ' . $months[date('n')-1] . ' ' . date('j') . ', ' . date('Y');
}

// Function to get greeting based on time
function getGreeting() {
    $hour = (int)date('H');
    $greeting_index = floor($hour / 6);
    switch ($greeting_index) {
        case 0:
            return "Good night!";
        case 1:
            return "Good morning!";
        case 2:
            return "Good afternoon!";
        case 3:
            return "Good evening!";
    }
}
?>

