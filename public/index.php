<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/db.php';


header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:X-Request-With');

header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath("/rent/public");

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello");
    return $response;
});

//Houses routes
require __DIR__ . "/../routes/houses.php";

$app->run();

?>