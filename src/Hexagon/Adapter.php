<?php

namespace DDDHH\Hexagon;

use Psr\Http\Message\ResponseInterface;

abstract class Adapter {
    /**
     * @param ResponseInterface $content
     */
    abstract public function response(ResponseInterface $content);
}