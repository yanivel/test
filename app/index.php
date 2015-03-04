<?php
require_once __DIR__ . '/autoload.php';

$app = new \Slim\Slim(array(
	'debug' => 'false'
));

$app->notFound(function () use ($app) {
    $responder = new JsonResponder($app);
    $responder->setErrorByCode(404);
    $responder->sendResponseAndStop();
});

$app->container->singleton('db', function () {
    return new MySqlDBWrapper();
});

/* Create a new user
 *
 * Params : POST UserName string
 *          POST Password string
 */
$app->post('/Users/Register', function () use ($app) {
	$validator = new RequestValidator($app->request);
	$validator->requireParams([ 'POST' => ['UserName','Password'] ]);

	$userController = (new UserController($app, $validator));
	$userController->run();

	$userController->registerUser();
});

/* Perform a login request for a registered user
 *
 * Params : POST UserName string
 *          POST Password string
 */
$app->post('/Users/Login', function() use ($app) {
	$validator = new RequestValidator($app->request);
	$validator->requireParams(['POST' => ['UserName', 'Password'] ]);

	$userController = (new UserController($app, $validator));
	$userController->run();

	$userController->loginUser();
});


/* Add an item to the cart
 *
 * Params : HEAD SessionId string
 *          POST ItemId string
 */
$app->put('/Cart/Item', function() use ($app) {
	$validator = new RequestValidator($app->request);
	$validator->requireParams([	'HEAD' => ['SessionId'],
						 	   	'POST' => ['ItemId']     ]);

	$cartController = (new CartController($app, $validator));
	$cartController->run();

	$cartController->addItem();
});

/* Remove an item from the cart
 *
 * Params : HEAD SessionId string
 *          POST ItemId string
 */
$app->delete('/Cart/Item', function() use ($app) {
	$validator = new RequestValidator($app->request);
	$validator->requireParams([	'HEAD' => ['SessionId'],
						 	   	'POST' => ['ItemId']     ]);

	$cartController = (new CartController($app, $validator));
	$cartController->run();

	$cartController->deleteItem();
});

/* List the items in the cart
 *
 * Params : HEAD SessionId string
 */
$app->get('/Cart', function() use ($app) {
	$validator = new RequestValidator($app->request);
	$validator->requireParams(['HEAD' => ['SessionId'] ]);

	$cartController = (new CartController($app, $validator));
	$cartController->run();

	$cartController->getCart();
});

// TODO: deny access to other method with same Uris.. 

$app->run();

?>