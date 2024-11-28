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
        break;
    case 'admin':
        $page = 'admin.php';
        $style = 'admin.css';
        break;
    case 'registreren':
        $page = 'registreren.php';
        $style = 'login.css';
        break;
    case 'createProcess':
        $page = 'functions/creating/process.php';
        $style = 'cms.css';
        break;
    case 'creating':
        $page = 'functions/creating/create.php';
        break;
    case 'deletePageProcess':
        $page = 'functions/deleting/deletePage.php';
        break;
    case 'deleteRow':
        $page = 'functions/deleting/deleteRow.php';
        break;
    case 'addingRow':
        $page = 'functions/editing/addingRow.php';
        break;
    case 'baseData':
        $page = 'functions/editing/baseDataRow.php';
        break;
    case 'editProcess':
        $page = 'functions/editing/process.php';
        $style = 'cms.css';
        break;
    case 'editRow':
        $page = 'functions/editing/editRow.php';
        break;
    case 'customPage':
        $page = 'customPage.php';
        $style = 'customPage.css';
        $js = 'customPage.js';
        break;
    case 'contactAdd':
        $page = 'functions/contact/contactAdd.php';
        break;
    case 'contactProcess':
        $page = 'functions/contact/Process.php';
        $style = 'admin_berichten.css';
        break;
    case 'deleteContactProcess':
        $page = 'functions/contact/contactDelete.php';
        break;
    case 'deleteNotitieProcess':
        $page = 'functions/contact/notitieDelete.php';
        break;
    case 'editNotitieProcess':
        $page = 'functions/contact/notitieEdit.php';
        break;
    case 'addNotitieProcess':
        $page = 'functions/contact/notitieAdd.php';
        break;
    case 'createSocial':
        $page = 'functions/socials/createSocial.php';
        break;
    case 'deleteSocial':
        $page = 'functions/socials/deleteSocial.php';
        break;
 case 'contact_process':
            $page = 'contact_process.php';
            $style = 'bedankt.css';
            // $js = 'customPage.js';
        break;
    default:
        $page = '404.php';
        $style = '404.css';
        $js = '404.js';
        break;
}

require_once "./views/" . $page;
