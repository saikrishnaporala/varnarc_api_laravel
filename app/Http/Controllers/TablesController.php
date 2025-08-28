<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Http\Resources\TableResource;

class TablesController extends Controller
{
    public function index()
    {
        return TableResource::collection(Table::all());
    }

    public function columns($table)
    {
        return response()->json(['columns' => ['id','name','created_at','updated_at']]);
    }

    public function preview($table)
    {
        $rows = \DB::table($table)->limit(10)->get();
        return response()->json($rows);
    }

    public function destroy($table)
    {
        \Schema::dropIfExists($table);
        return response()->json(['message' => 'Table dropped: ' . $table]);
    }
}
