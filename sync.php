<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use Zend\Diactoros\Server;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;

$request = ServerRequestFactory::fromGlobals();

$server = Server::createServerFromRequest(function ($req, Response $res) {
    $res->withStatus(200)->getBody()->write('OK');
}, $request);

$server->listen();
