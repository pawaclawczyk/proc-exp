<?php

declare(strict_types=1);

namespace Gen;

class Task
{
    protected $generator;

    protected $run;

    public function __construct(\Generator $generator)
    {
        $this->generator = $generator;
    }

    public function run()
    {
        if ($this->run) {
            $this->generator->next();
        } else {
            $this->generator->current();
        }

        $this->run = true;
    }

    public function finished()
    {
        return !$this->generator->valid();
    }
}