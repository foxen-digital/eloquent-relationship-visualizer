<?php

namespace Foxen\EloquentRelationshipVisualizer\Commands;

use Illuminate\Console\Command;

class EloquentRelationshipVisualizerCommand extends Command
{
    public $signature = 'eloquent-relationship-visualizer';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
