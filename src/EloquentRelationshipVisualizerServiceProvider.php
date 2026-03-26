<?php

namespace Foxen\EloquentRelationshipVisualizer;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Foxen\EloquentRelationshipVisualizer\Commands\EloquentRelationshipVisualizerCommand;

class EloquentRelationshipVisualizerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('eloquent-relationship-visualizer')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_eloquent_relationship_visualizer_table')
            ->hasCommand(EloquentRelationshipVisualizerCommand::class);
    }
}
