<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

$_SERVER['APP_RUNTIME_OPTIONS'] = [
    'dotenv_overload' => true,
];


require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
