<?php

declare(strict_types=1);

namespace Core;

use Exception;

class Container
{
    private array $bindings = [];

    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key)
    {
        $resolver = $this->bindings[$key];

        if (array_key_exists($key, $this->bindings)) {
            return is_callable($resolver) ? call_user_func($resolver) : $resolver;
        }

        throw new Exception("No instance found for $key");
    }
}