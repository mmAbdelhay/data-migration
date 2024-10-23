<?php

namespace MuhammadAbdElHay\DataMigration;

use MuhammadAbdElHay\DataMigration\Commands\DataMigrationCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
