<?php

declare(strict_types=1);

namespace MT;

class Sleep extends \Thread
{
    private $seconds;

    public function __construct(int $seconds)
    {
        $this->seconds = $seconds;
    }

    public function run()
    {
        echo sprintf("Hello I'm thread with id %lu.%s", $this->getThreadId(), PHP_EOL);

        sleep($this->seconds);

        echo sprintf("Hello I'm thread with id %lu and I'm done.%s", $this->getThreadId(), PHP_EOL);
    }
}
