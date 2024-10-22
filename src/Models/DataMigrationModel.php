<?php

namespace MuhammadAbdElHay\DataMigration\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $table_from
 * @property string $to_type
 * @property string|null $table_to
 * @property array $columns_from
 * @property array|null $columns_to
 *
 * */
class DataMigrationModel extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'table_from',
        'to_type',
        'table_to',
        'columns_from',
        'columns_to',
    ];

    protected $casts = [
        'columns_from' => 'array',
        'columns_to' => 'array',
    ];
}
