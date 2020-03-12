<?php

namespace Fc9\Auth\Architect;

interface ModeResolverInterface
{
    public function resolve($property, &$object, &$root, $fullPropertyPath);
}
