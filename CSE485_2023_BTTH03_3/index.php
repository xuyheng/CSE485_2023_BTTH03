<?php

// index.php
require_once './controllers/UserController.php';
require_once 'vendor/autoload.php';

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$routes = new RouteCollection();

// List all users
$routes->add('user.index', new Route('/', array(
    '_controller' => 'UserController::Signup',
)));

// Show user details
$routes->add('user.show', new Route('/home', array(
    '_controller' => 'UserController::home',
)));

// Create a new user (show form)
$routes->add('user.create', new Route('/users/create', array(
    '_controller' => 'UserController::create',
)));

// Store a new user (handle form submission)
$routes->add('user.store', new Route('/users', array(
    '_controller' => 'UserController::store',
), array(), array(), '', array(), array('POST')));

// Edit user details (show form)
$routes->add('user.edit', new Route('/users/{id}/edit', array(
    '_controller' => 'UserController::edit',
)));

// Update user details (handle form submission)
$routes->add('user.update', new Route('/users/{id}', array(
    '_controller' => 'UserController::update',
), array(), array(), '', array(), array('PUT', 'PATCH')));

// Delete user
$routes->add('user.delete', new Route('/users/{id}', array(
    '_controller' => 'UserController::delete',
), array(), array(), '', array(), array('DELETE')));

// Initialize the routing context
$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);

// Match the current request to a route
$matcher = new UrlMatcher($routes, $context);
$parameters = $matcher->match($request->getPathInfo());

// Call the appropriate controller method with the matched parameters
$controller =  $parameters['_controller'];
list($class, $action) = explode('::',$controller);

$controller = new $class();
$response = $controller->$action($parameters);
// $response = call_user_func_array(array($controller, $parameters['_action']), $parameters);

// Send the response to the browser
$response->send();


// Error handling middleware
// function handleError($exception, $request, $debug) {
//     $response = new Response('An error occurred: ' . $exception->getMessage(), 500);
//     return $response;
// }

// $dispatcher = new FastRoute\Dispatcher\GroupCountBased();
// $dispatcher->register('GET', '/error', 'handleError');

// $request = Request::createFromGlobals();
// $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
// switch ($routeInfo[0]) {
//     case FastRoute\Dispatcher::NOT_FOUND:
//         // Handle 404 errors
//         break;
//     case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
//         // Handle 405 errors
//         break;
//     case FastRoute\Dispatcher::FOUND:
//         $handler = $routeInfo[1];
//         $vars = $routeInfo[2];
//         // Call the error handling middleware with the caught exception
//         $response = call_user_func_array($handler, array($e, $request, $debug));
//         // Send the response to the browser
//         $response->send();
//         break;
// }


?>