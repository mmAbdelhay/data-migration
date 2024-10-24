<?php

use Illuminate\Support\Facades\Route;
use MuhammadAbdElHay\DataMigration\Http\Controllers\DataMigrationController;

Route::get('data-migration', [DataMigrationController::class, 'index'])->name('data-migration.index');
