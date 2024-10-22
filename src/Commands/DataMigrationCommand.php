<?php

namespace MuhammadAbdElHay\DataMigration\Commands;

use Illuminate\Console\Command;

class DataMigrationCommand extends Command
{
    public $signature = 'data-migration';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
