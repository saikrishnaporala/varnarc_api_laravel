<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\RowResource;

class RowsController extends Controller
{
    public function index($table)
    {
        $data = \DB::table($table)->get();
        return RowResource::collection($data);
    }

    public function store(Request $request, $table)
    {
        $id = \DB::table($table)->insertGetId($request->all());
        $row = \DB::table($table)->where('id', $id)->first();
        return new RowResource((object)$row);
    }

    public function show($table, $id)
    {
        $row = \DB::table($table)->where('id', $id)->first();
        if (!$row) return response()->json(['error'=>'Not found'], 404);
        return new RowResource((object)$row);
    }

    public function update(Request $request, $table, $id)
    {
        \DB::table($table)->where('id', $id)->update($request->all());
        $row = \DB::table($table)->where('id', $id)->first();
        return new RowResource((object)$row);
    }

    public function destroy($table, $id)
    {
        \DB::table($table)->where('id', $id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function toggleActive($table, $id)
    {
        $row = \DB::table($table)->where('id', $id)->first();
        if (!$row) return response()->json(['error'=>'Not found'], 404);
        $active = isset($row->active) ? !$row->active : true;
        \DB::table($table)->where('id', $id)->update(['active' => $active]);
        $row = \DB::table($table)->where('id', $id)->first();
        return new RowResource((object)$row);
    }
}
