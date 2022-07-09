<?php

namespace Laraflow\TripleA\Commands;

use Illuminate\Console\Command;

class TripleACommand extends Command
{
    public $signature = 'TripleA';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
