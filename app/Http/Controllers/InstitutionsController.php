<?php

namespace App\Http\Controllers;

use App\Institutions;
use Illuminate\Http\Request;
use Validator;

class InstitutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institutions::all();
        return response()->json($institutions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);
        if ($validate->passes()){

            $institutions = Institutions::create($request->all());
            return response()->json([
                'message' => 'Data Berhasil Disimpan',
                'data' => $institutions
            ]);
        }
        return response()->json([
            'message' => 'Data Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institutions  $institutions
     * @return \Illuminate\Http\Response
     */
    public function show($institutions)
    {
        $data = Institutions::where('id', $institutions)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institutions  $institutions
     * @return \Illuminate\Http\Response
     */
    public function edit(Institutions $institutions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institutions  $institutions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $institutions)
    {
        // $institutions->update($request->all());
        // return response()->json([
        //     'message' => 'Data berhasil diupdate',
        //     'data' => $institutions
        // ]);
        $data = Institutions::where('id', $institutions)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Berhasil Disimpan',
                    'data' => $data
                ], 200);
            } else {
                
                return response()->json([
                    'message' => 'Data Gagal Disimpan',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institutions  $institutions
     * @return \Illuminate\Http\Response
     */
    public function destroy($institutions)
    {
        $data = Institutions::where('id', $institutions)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 404);
            # code...
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}
