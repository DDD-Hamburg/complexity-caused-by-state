<?php

namespace DDDHH\Hexagon;

abstract class Port {
    protected $adapter;

    abstract public function request(array $request = []);
}
