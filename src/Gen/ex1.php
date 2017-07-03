<?php

declare(strict_types=1);

namespace Gen;

function lines($file) {
    $handle = fopen($file, "r");

    while (!feof($handle)) {
        yield trim(fgets($handle));
    }

    fclose($handle);
}

foreach (lines(__FILE__) as $i => $line) {
    print $i . ". " . $line . "\n";
}

print_r(lines(__FILE__));

print_r(get_class_methods(lines(__FILE__)));

$generator = call_user_func(function () {
    $input = (yield "foo");

    print "inside: " . $input . "\n";
});

print $generator->current() . "\n";

$generator->send("bar");

$multiply = function ($x, $y) {
    try {
        yield $x * $y;
    } catch (\InvalidArgumentException $exception) {
        print "ERRORS";
    }
};

print $multiply(5, 6)->current();

$calculate = function ($op, $x, $y) use ($multiply) {
    if ($op === "multiply") {
        $generator = $multiply($x, $y);

        if (!is_numeric($x) || !is_numeric($y)) {
            $generator->throw(new \InvalidArgumentException());
        }

        return $generator->current();
    }
};

print $calculate("multiply", 5, "foo");