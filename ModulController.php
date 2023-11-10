<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\submodul;
class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'tittle' => $request->modul,
            'course_id' => $request->course_id,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $data = DB::table('modul')->insert($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = DB::table('modul')->where('id', $id)->delete();
        return back();
    }
    public function destroymodul($id)
    {
        $data = DB::table('modul')->where('id', $id)->delete();
        return back();
    }
    public function listmodul($id)
    {
        $data = DB::table('courses')->where('id', $id)->first();
        $modul = DB::table('modul')->where('course_id', $id)
            ->orderBy('created_at', 'ASC')
            ->get();
        // dd($modul);
        return view('trainer.pages.modul.index', compact('data', 'modul'));
    }
    public function listsubmodul($id)
    {
        $item = DB::table('sub_modul')
            ->select('sub_modul.*', 'modul.id as id_modul')
            ->rightJoin('modul', 'sub_modul.modul_id', '=', 'modul.id')
            ->where('sub_modul.modul_id', $id)
            ->get();
        // dd($item);
        $data = [
            'status' => 'ok',
            'message' => 'Message successfully send!!.',
            'data' => $item,
            'id_moduls' => $id,
        ];
        return response()->json($data);
    }
    public function addsubmodulcheckid($id)
    {

        $data = [
            'id_modul' => $id,
        ];
        return response()->json($data);
    }
    public function storesubmodul(Request $request)
    {
        // dd($request->all());
        $data = [
            'modul_id' => $request->modul_id,
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $simpan = DB::table('sub_modul')->insert($data);
        return response()->json(200);
    }
    public function getsubmodulbyid($id)
    {
        $data = DB::table('sub_modul')->where('id', $id)->first();
        return response()->json($data);
    }
    public function editdetailsubmodul(Request $request, $id)
    {
        // dd($request->all());
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $update = DB::table('sub_modul')->where('id', $id)->update($data);
    }
    public function destroysubmodul($id)
    {
        $delete = DB::table('sub_modul')->where('id', $id)->delete();
        return response()->json(200);
    }
}
