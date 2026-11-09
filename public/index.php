<?php
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../app/core/Database.php';
require __DIR__ . '/../app/core/Request.php';
require __DIR__ . '/../app/core/Response.php';
require __DIR__ . '/../app/core/Router.php';
require __DIR__ . '/../app/core/BaseModel.php';
require __DIR__ . '/../app/core/BaseController.php';

spl_autoload_register(function ($class) {
    $folders = [
        __DIR__ . '/../app/models/',
        __DIR__ . '/../app/controllers/',
        __DIR__ . '/../app/middleware/'
    ];
    foreach ($folders as $folder) {
        $file = $folder . $class . '.php';
        if (is_file($file)) {
            require_once $file;
            return;
        }
    }
});

try {
    $router = new Router();
    $router->get('/api/students', [StudentApiController::class, 'index']);
    $router->get('/api/students/{id}', [StudentApiController::class, 'show']);
    $router->post('/api/students', [StudentApiController::class, 'store']);
    $router->put('/api/students/{id}', [StudentApiController::class, 'update']);
    $router->delete('/api/students/{id}', [StudentApiController::class, 'destroy']);

    $request = new Request();
    if (str_starts_with($request->path(), '/api/') &&
        in_array($request->method(), ['POST', 'PUT', 'DELETE'], true)) {
        AuthMiddleware::handle($request);
    }
    $router->dispatch($request);
} catch (Throwable $e) {
    error_log($e->getMessage());
    Response::json(['error' => 'Internal server error. Check database configuration.'], 500);
}
