<?php

/* START UP SETTINGS FOR ERRORS AND SESSIONS START */
require_once "vendor/autoload.php";

use MyApp\Controller\IndexController;
use MyApp\Route;

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

/*
 * INSTANCING ALL CONTROLLERS
 */

$IndexController = new IndexController();

Route::add('/', function() use ($IndexController) {
    $IndexController->getAll();
}, ['get', 'post']);

Route::add('/students', function() use ($IndexController) {
    $IndexController->getAll();
}, ['get'] );

Route::add('/students', function() use ($IndexController) {
    $IndexController->store();
}, ['post'] );

Route::add('/students/(\d+)', function($id) use ($IndexController) {
    $IndexController->show($id);
}, ['get'] );

Route::run();


