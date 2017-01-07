<?php

namespace DDDHH\Hexagon;

abstract class Hexagon {
    /** @var  Port */
    protected $port;
    /** @var  Adapter */
    protected $adapter;

    public function __construct(Port $port, Adapter $adapter)
    {
        $this->port = $port;
        $this->adapter = $adapter;
    }
}