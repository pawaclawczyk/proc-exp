<?php

declare(strict_types=1);

namespace Gen;

require_once __DIR__."/../../vendor/autoload.php";

$scheduler = new Scheduler();

$task1 = new Task(call_user_func(function () {
    for ($i = 0; $i < 3; $i++) {
        print "task 1: " . $i . "\n";
        yield;
    }
}));

$task2 = new Task(call_user_func(function () {
    for ($i = 0; $i < 6; $i++) {
        print "task 2: " . $i . "\n";
        yield;
    }
}));

$scheduler->enqueue($task1);
$scheduler->enqueue($task2);

$scheduler->run();