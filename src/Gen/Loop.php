<?php

declare(strict_types=1);

namespace Gen;

class Loop
{
    private $stop;
    private $watchers = [];

    public function run()
    {
        $this->stop = false;

        $generator = call_user_func(function () {
            $i = 0;

            while (!$this->stop) {
                print "next " . $i . "\n";
                $i++;
                (yield $i);
            }
        });

        foreach ($generator as $iteration =>$value){
            print_r($iteration);
            print "calling...\n";
            $this->call();
        }
//        while ($generator->valid()) {
//            $x = $generator->next();
//            print_r($x);
//            print "calling...\n";
//            $this->call();
//        }
    }

    public function stop()
    {
        $this->stop = true;
    }

    public function watch(\Generator $w)
    {
        $this->watchers[] = $w;
    }

    private function call()
    {
        foreach ($this->watchers as $i => $watcher) {
            if ($watcher->valid()) {
                $watcher->next();
            } else {
                unset($this->watchers[$i]);
            }
        }
    }
}
