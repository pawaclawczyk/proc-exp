<?php

require_once __DIR__.'/vendor/autoload.php';

use MT\Pool;

$server = stream_socket_server('tcp://0.0.0.0:8080');

if (false === $server) {
    die('Ble...');
}

stream_set_blocking($server, false);

$pool = new Pool();

//$timer = new EvTimer(.0, .5, function (EvTimer $watcher) use ($pool) {
//    if (Ev::iteration() > 100) {
//        $watcher->getLoop()->stop();
//
//        return ;
//    }
//
//    $pool->spawn();
//});

$serverWatcher = new EvIo($server, Ev::READ, function () use ($server, $pool) {
    $pool->handle($server);
});

Ev::run();
