<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use Aerys\Host;
use Aerys\Request;
use Aerys\Response;
use function Aerys\router;

$options = [
    'connectionsPerIP' => 1000,
    'disableKeepAlive' => true,
    'maxConcurrentStreams' => 1000,
];

$host = (new Host($options))
    ->expose('0.0.0.0', 8080);

$handler = function (Request $req, Response $res) {
    usleep(200000);

    $res->end('OK');
};

$router = router()->route('GET', '/', $handler);

$host->use($handler);
