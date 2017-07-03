<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use React\EventLoop\Factory;
use React\Http\Server;
use React\Socket\Server as Socket;
use React\Http\Response;
use Psr\Http\Message\ServerRequestInterface;

$loop = Factory::create();

$server = new Server(function (ServerRequestInterface $req) {
    echo "handling request...", PHP_EOL;

    for ($i = 0; $i < 20; $i++) {
        usleep(10000);
    }

    return new Response(200, [], 'OK');
});

$socket = new Socket(8080, $loop);

$server->listen($socket);

$loop->run();
