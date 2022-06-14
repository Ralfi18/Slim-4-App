<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Controller\HomeController;

require __DIR__ . '/../vendor/autoload.php';

$doctrineContainer = require_once dirname(__DIR__ ). '/bootstrap.php';
AppFactory::setContainer($doctrineContainer);
$app    = AppFactory::create();
$twig   = Twig::create(dirname(__DIR__).'/views', ['cache' => false]);
// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));
$app->get('/', [HomeController::class, 'index']);
$app->run();