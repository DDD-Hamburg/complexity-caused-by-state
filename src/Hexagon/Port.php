<?php

namespace DDDHH\Hexagon;

use \Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class Port {
    /** @var  RequestInterface */
    protected $request;

    /**
     * Port constructor.
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param PortMapper $mapper
     * @return ResponseInterface
     */
    abstract public function send(PortMapper $mapper) : ResponseInterface;

}
