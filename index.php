<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once './core/db_connect.php';



$view = '';

if (!empty($_GET['view'])) {
    $view = htmlspecialchars($_GET['view']);
    $view = str_replace("/", "", $view);
}

$page = '';
$style = '';
$js = '';

switch ($view) {
    case '':
        $page = 'home.php';
        $style = 'home.css';
        $js = 'home.js';
        break;
    case 'pages':
        $page = 'pages.php';
        $style = 'pages.css';
        $js = 'pages.js';
        break;
    case 'contact':
        $page = 'contact.php';
        $style = 'contact.css';
        $js = 'contact.js';
        break;
    case 'login':
        $page = 'login.php';
        $style = 'login.css';
        $js = 'login.js';
        break;
    case 'admin':
        $page = 'admin.php';
        $style = 'admin.css';
        $js = 'admin.js';
        break;
    default:
        $page = '404.php';
        $style = '404.css';
        $js = '404.js';
        break;
}

require_once "./views/" . $page;
