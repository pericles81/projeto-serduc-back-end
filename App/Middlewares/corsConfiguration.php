<?php

use Tuupola\Middleware\CorsMiddleware;

return new CorsMiddleware([
    "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "DELETE", "OPTIONS"],
    "headers.allow" => ["Content-Type", "Authorization"],
    "headers.expose" => ["Authorization"],
    "credentials" => false,
    "cache" => 0,
]);