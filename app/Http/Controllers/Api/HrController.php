<?php

namespace App\Http\Controllers\Api;

use App\Models\Hr;
use App\Models\Tlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HrResource;
use Illuminate\Support\Facades\Validator;

class HrController extends Controller
{
    public function index()
    {
        $hr = Hr::latest()->paginate(5);
        return new HrResource(true, 'List Data Hr', $hr);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'tgl_lahir'   => 'required',
            'gaji'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $hr = Hr::create([
            'nama'     => $request->nama,
            'tgl_lahir'   => $request->tgl_lahir,
            'gaji'   => $request->gaji
        ]);

        Tlog::create([
            'tanggal'     => date('Y-m-d'),
            'jam'   => date('H:i:s'),
            'keterangan'   => 'Create data baru'
        ]);

        return new HrResource(true, 'Data Hr Berhasil Ditambahkan!', $hr);
    }

    public function show($id)
    {
        $hr = Hr::find($id);
        return new HrResource(true, 'Detail Data Hr!', $hr);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => '',
            'tgl_lahir'   => '',
            'gaji'   => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $hr = Hr::find($id);

        $hr-> update([
            'nama'     => $request->nama,
            'tgl_lahir'   => $request->tgl_lahir,
            'gaji'   => $request->gaji,
        ]);

        Tlog::create([
            'tanggal'     => date('Y-m-d'),
            'jam'   => date('H:i:s'),
            'keterangan'   => 'Edit data'
        ]);

        return new HrResource(true, 'Data Hr Berhasil Diubah!', $hr);
    }

    public function destroy($id)
    {
        $hr = Hr::find($id);
        $hr->delete();

        Tlog::create([
            'tanggal'     => date('Y-m-d'),
            'jam'   => date('H:i:s'),
            'keterangan'   => 'Delete data'
        ]);
        return new HrResource(true, 'Data Hr Berhasil Dihapus!', null);
    }
}
