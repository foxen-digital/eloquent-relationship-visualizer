<?php

namespace Foxen\EloquentRelationshipVisualizer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Foxen\EloquentRelationshipVisualizer\EloquentRelationshipVisualizer
 */
class EloquentRelationshipVisualizer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Foxen\EloquentRelationshipVisualizer\EloquentRelationshipVisualizer::class;
    }
}
