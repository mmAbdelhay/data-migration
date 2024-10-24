<?php

namespace MuhammadAbdElHay\DataMigration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DataMigrationController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('data-migration::data-migration');
    }
}
