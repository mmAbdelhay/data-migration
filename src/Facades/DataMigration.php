<?php

namespace MuhammadAbdElHay\DataMigration\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MuhammadAbdElHay\DataMigration\DataMigration
 */
class DataMigration extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \MuhammadAbdElHay\DataMigration\DataMigration::class;
    }
}
