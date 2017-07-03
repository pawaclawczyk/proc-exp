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

        echo "Handling by {$this->getThreadId()}...", PHP_EOL;

        usleep(200000);

        fwrite($incoming, sprintf('HTTP/%s %d %s', '1.1', 200, 'OK'));
        fwrite($incoming, "\r\n");
        fwrite($incoming, 'Content-Type: text/html');
        fwrite($incoming, "\r\n");
        fwrite($incoming, 'Content-Length: 2');
        fwrite($incoming, "\r\n");
        fwrite($incoming, 'Connection: Closed');
        fwrite($incoming, "\r\n");
        fwrite($incoming, "\r\n");
        fwrite($incoming, 'OK');
        fclose($incoming);

        echo PHP_EOL;
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
