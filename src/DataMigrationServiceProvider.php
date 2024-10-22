<?php

namespace MuhammadAbdElHay\DataMigration;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use MuhammadAbdElHay\DataMigration\Commands\DataMigrationCommand;

class DataMigrationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('data-migration')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_data_migration_table')
            ->hasCommand(DataMigrationCommand::class);
    }
}
