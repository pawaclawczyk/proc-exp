<?php

namespace MT;

class HardWork extends \Thread
{
    public function run()
    {
        $counter = 0;

        echo sprintf("Hello I'm thread with id %lu.%s", $this->getThreadId(), PHP_EOL);

        while ($counter < 1000000) {
            usleep(10);
            $counter++;
        }

        echo sprintf("Hello I'm thread with id %lu and I'm done.%s", $this->getThreadId(), PHP_EOL);
    }
}