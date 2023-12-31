<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use App\Models\Diskon;

class DiskonController extends Controller
{

    public function index()
    {
        $produk = produk::all();
        $diskon = Diskon::all();
        $data = [
            'diskon'=>'diskon'
        ];
        return view('diskon.index', compact('diskon', 'produk'));
    }

    public function data()
    {
        $diskon = Diskon::all();

        return datatables()
            ->of($diskon)
            ->addIndexColumn()
            ->addColumn('select_all', function ($diskon) {
                return '
                    <input type="checkbox" name="id_diskon[]" value="'. $diskon->id_diskon .'">
                ';
            })
            ->addColumn('harga', function ($diskon) {
                return format_angka($diskon->total_diskon);
            })
            ->addColumn('aksi', function ($diskon) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('diskon.update', $diskon->id_diskon) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`'. route('diskon.destroy', $diskon->id_diskon) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'select_all'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $diskon = new Diskon();
        $diskon->nama_diskon = $request->nama_diskon;
        $diskon->total_diskon = $request->total_diskon;
        $diskon->save();

        return redirect('/diskon');
    }

    public function show($id)
    {
        $diskon = Diskon::find($id);

        return response()->json($diskon);
    }

    public function update(Request $request, $id)
    {
        $diskon = Diskon::find($id);
        $diskon->update($request->all());

        return response()->json('Data berhasil diubah', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $diskon = Diskon::find($id);
        $diskon->delete();

        return response(null, 204);
    }
}
