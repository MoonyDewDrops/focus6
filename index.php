<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'core/db_connect.php';

//Set the default view
$view = '';

//Check if the view is set in the URL and not empty
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
    case 'registreren':
        $page = 'registreren.php';
        $style = 'registreren.css';
        $js = 'registreren.js';
        break;
    case 'createProcess':
        $page = 'functions/creating/process.php';
        $style = 'functions/creating/process.css';
        $js = 'functions/creating/process.js';
        break;
    case 'creating':
        $page = 'functions/creating/create.php';
        $style = 'functions/creating/create.css';
        $js = 'functions/creating/create.js';
        break;
    case 'deletePageProcess':
        $page = 'functions/deleting/deletePage.php';
        $style = 'functions/deleting/deletePage.css';
        $js = 'functions/deleting/deletePage.js';
        break;
    case 'deleting':
        $page = 'functions/deleting/delete.php';
        $style = 'functions/deleting/delete.css';
        $js = 'functions/deleting/delete.js';
        break;
    case 'addingRow':
        $page = 'functions/editing/addingRow.php';
        $style = 'functions/editing/addingRow.css';
        $js = 'functions/editing/addingRow.js';
        break;
    case 'baseData':
        $page = 'functions/editing/baseDataRow.php';
        $style = 'functions/editing/baseDataRow.css';
        $js = 'functions/editing/baseDataRow.js';
        break;
    case 'editProcess':
        $page = 'functions/editing/process.php';
        $style = 'functions/editing/process.css';
        $js = 'functions/editing/process.js';
        break;
    case 'editRow':
        $page = 'functions/editing/editRow.php';
        $style = 'functions/editing/editRow.css';
        $js = 'functions/editing/editRow.js';
        break;
    case 'customPage':
        $page = 'customPage.php';
        $style = 'customPage.css';
        $js = 'customPage.js';
        break;
    case 'contactAdd':
        $page = 'functions/contact/contactAdd.php';
        $style = 'functions/contact/contactAdd.css';
        $js = 'functions/contact/contactAdd.js';
        break;
    case 'contactProcess':
        $page = 'functions/contact/Process.php';
        $style = 'functions/contact/Process.css';
        $js = 'functions/contact/Process.js';
        break;
    default:
        $page = '404.php';
        $style = '404.css';
        $js = '404.js';
        break;
}

require_once "./views/" . $page;
