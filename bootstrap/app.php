<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$app = new Jenssegers\Lean\App();

$container = $app->getContainer();

$container->get('settings')->set('displayErrorDetails', true);

$container->get('settings')->set('jwt', [
    'expiry' => getenv('JWT_EXPIRY'),
    'secret' => getenv('JWT_SECRET'),
]);

$container->get('settings')->set('db', [
    'driver' => 'pgsql',
    'host' => '127.0.0.1',
    'database' => 'jwt',
    'username' => 'alexgarrett',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')->get('db'));

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container->addServiceProvider(new App\Providers\AuthServiceProvider());

require_once __DIR__ . '/../routes/web.php';
