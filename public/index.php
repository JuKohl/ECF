<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

$kernel = function (array $context) {
  return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
// echo 'ok ça marche'.$context['APP_ENV'].$context['APP_DEBUG'];
};

$kernelInstance = $kernel($_SERVER);

function configureTrustedProxies() {
  $trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false;
  $trustedProxies = $trustedProxies ? explode(',', $trustedProxies) : [];
  if($_SERVER['APP_ENV'] == 'prod') $trustedProxies[] = $_SERVER['REMOTE_ADDR'];
  if($trustedProxies) {
      Request::setTrustedProxies($trustedProxies, Request::HEADER_X_FORWARDED_AWS_ELB);
  }
}

configureTrustedProxies();

$request = Request::createFromGlobals();

$response = $kernelInstance->handle($request);

$response->send();

$kernelInstance->terminate($request, $response);