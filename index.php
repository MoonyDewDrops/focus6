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
    case 'deleteRow':
        $page = 'functions/deleting/deleteRow.php';
        $style = 'functions/deleting/deleteRow.css';
        $js = 'functions/deleting/deleteRow.js';
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
    case 'deleteContactProcess':
        $page = 'functions/contact/contactDelete.php';
        $style = 'functions/contact/deleteContact.css';
        $js = 'functions/contact/deleteContact.js';
        break;
    case 'deleteNotitieProcess':
        $page = 'functions/contact/notitieDelete.php';
        $style = 'functions/contact/notitieDelete.css';
        $js = 'functions/contact/notitieDelete.js';
        break;
    case 'editNotitieProcess':
        $page = 'functions/contact/notitieEdit.php';
        $style = 'functions/contact/notitieEdit.css';
        $js = 'functions/contact/notitieEdit.js';
        break;
    case 'addNotitieProcess':
        $page = 'functions/contact/notitieAdd.php';
        $style = 'functions/contact/notitieAdd.css';
        $js = 'functions/contact/notitieAdd.js';
    case 'createSocial':
        $page = 'functions/socials/createSocial.php';
        $style = 'functions/socials/createSocial.css';
        $js = 'functions/socials/createSocial.js';
        break;
    case 'deleteSocial':
        $page = 'functions/socials/deleteSocial.php';
        $style = 'functions/socials/deleteSocial.css';
        $js = 'functions/socials/deleteSocial.js';
        break;
    case 'formCreationSocial':
        $page = 'functions/socials/formCreationSocial.php';
        $style = 'functions/socials/formCreationSocial.css';
        $js = 'functions/socials/formCreationSocial.js';
        break;
    default:
        $page = '404.php';
        $style = '404.css';
        $js = '404.js';
        break;
}

require_once "./views/" . $page;
