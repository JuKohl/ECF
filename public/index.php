<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
  return new Kernel($context['APP_ENV'], (bool) $context['0']);
};

echo 'ok ça marche';