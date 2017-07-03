<?php

declare(strict_types=1);

require_once __DIR__.'/../../vendor/autoload.php';

$loop = new \Gen\Loop();

$watcher = call_user_func(function () use ($loop) {
    for($i = 0; $i < 10; $i++) {
        print "watching...\n";
        yield $i;
    }

    print "stopping...\n";
    $loop->stop();
});

$loop->watch($watcher);

$loop->run();

