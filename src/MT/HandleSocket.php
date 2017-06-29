<?php

namespace MT;


class HandleSocket extends \Thread
{
    private $socket;

    public function __construct($socket)
    {
        $this->socket = $socket;
    }

    public function run()
    {
        $incoming = stream_socket_accept($this->socket);

        echo "Handling...", PHP_EOL;

        fwrite($incoming, sprintf('Handled by %ul.%s', $this->getThreadId(), PHP_EOL));
        fwrite($incoming, json_encode($this->stats()));
        fclose($incoming);
    }

    private function stats()
    {
        return [
            'memory' => memory_get_usage() / 1024,
            'memory_peak' => memory_get_peak_usage() / 1024,
            'cpu' => sys_getloadavg(),
        ];
    }
}
