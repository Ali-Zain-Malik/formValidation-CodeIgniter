<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'FormController::index');
$routes->post("/validate-form", "FormController::validateForm");