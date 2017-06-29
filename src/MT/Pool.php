<?php

namespace MT;

class Pool
{
    private $threads = [];

    public function spawn()
    {
        $thread = new HardWork(10);
        $thread->start();

        $this->add($thread);
    }

    public function handle($socket)
    {
        $thread = new HandleSocket($socket);
        $thread->start();

        $this->add($thread);
    }

    private function add(\Thread $thread)
    {
        $this->threads[$thread->getThreadId()] = $thread;
    }
}
