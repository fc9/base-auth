<?php

namespace Fc9\Auth\Architect;

class EmbedModeResolver implements ModeResolverInterface
{
    /**
     * Simply returns the object since embedded is the default
     * transformation
     * @param  string $property
     * @param  object $object
     * @param  array $root
     * @param  string $fullPropertyPath
     * @return object                   
     */
    public function resolve($property, &$object, &$root, $fullPropertyPath)
    {
        return $object;
    }
}
