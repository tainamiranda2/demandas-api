<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes. //tava true
  /*  $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => false,
    ]));*/

    /*
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered through `Application::routes()` with `registerMiddleware()`
     */
   // $routes->applyMiddleware('csrf');

    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /*
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
   
    $routes->connect('/papel', ['controller' => 'Papel', 'action' => 'index', 'index']);
    $routes->connect('/papel/view/id', ['controller' => 'Papel', 'action' => 'view', 'view']);
    $routes->connect('/papel/add', ['controller' => 'Papel', 'action' => 'add', 'add']);
    $routes->connect('/papel/edit/id/', ['controller' => 'Papel', 'action' => 'edit', 'edit']);
    $routes->connect('/papel/delete/id/', ['controller' => 'Papel', 'action' => 'delete', 'delete']);
  
    $routes->connect('/status', ['controller' => 'Status', 'action' => 'index', 'index']);
    $routes->connect('/status/view/id', ['controller' => 'Status', 'action' => 'view', 'view']);
    $routes->connect('/stasus/add', ['controller' => 'Status', 'action' => 'add', 'add']);
    $routes->connect('/status/edit/id/', ['controller' => 'Status', 'action' => 'edit', 'edit']);
    $routes->connect('/status/delete/id/', ['controller' => 'Status', 'action' => 'delete', 'delte']);

    $routes->connect('/setor', ['controller' => 'Setor', 'action' => 'index', 'index']);
    $routes->connect('/setor/view/id', ['controller' => 'Setor', 'action' => 'view', 'view']);
    $routes->connect('/setor/add', ['controller' => 'Setor', 'action' => 'add', 'add']);
    $routes->connect('/setor/edit/id/', ['controller' => 'Setor', 'action' => 'edit', 'edit']);
    $routes->connect('/setor/delete/id/', ['controller' => 'Setor', 'action' => 'delete', 'delete']);

    $routes->connect('/demandas', ['controller' => 'Demandas', 'action' => 'index', 'index']);
    $routes->connect('/demandas/view/id', ['controller' => 'Demandas', 'action' => 'view', 'view']);
    $routes->connect('/demandas/add', ['controller' => 'Demandas', 'action' => 'add', 'add']);
    $routes->connect('/demandas/edit/id/', ['controller' => 'Demandas', 'action' => 'edit', 'edit']);
    $routes->connect('/demandas/delete/id/', ['controller' => 'Demandas', 'action' => 'delete', 'delete']);

  
    $routes->connect('/usuario', ['controller' => 'Usuario', 'action' => 'index', 'index']);
    $routes->connect('/usuario/view/id', ['controller' => 'Usuario', 'action' => 'view', 'view']);
    $routes->connect('/usuario/add', ['controller' => 'Usuario', 'action' => 'add', 'add']);
    $routes->connect('/usuario/edit/id/', ['controller' => 'Usuario', 'action' => 'edit', 'edit']);
    $routes->connect('/usuario/delete/id/', ['controller' => 'Usuario', 'action' => 'delete', 'delete']);

    $routes->fallbacks(DashedRoute::class);
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
