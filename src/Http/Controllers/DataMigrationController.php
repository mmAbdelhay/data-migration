<?php

namespace MuhammadAbdElHay\DataMigration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataMigrationController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('data-migration::data-migration');
    }

    public function getDatabaseStructure(): \Illuminate\Http\JsonResponse
    {
        $databaseName = DB::getDatabaseName();
        $results = DB::select("
            SELECT TABLE_NAME as table_name, COLUMN_NAME as column_name
            FROM information_schema.columns
            WHERE table_schema = ?
            ORDER BY TABLE_NAME, ORDINAL_POSITION
        ", [$databaseName]);

        $structure = [];
        foreach ($results as $row) {
            $structure[$row->table_name][] = $row->column_name;
        }

        return response()->json($structure);
    }
}
