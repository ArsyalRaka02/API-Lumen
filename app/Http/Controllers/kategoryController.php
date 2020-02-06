<?php 
namespace App\Http\Controllers;

use App\kategori;
use Illuminate\Http\Request;


class kategoryController extends Controller {

    public function view(){
        $data = kategori::all();
        return response($data);
    }

    public function show($id){
        $data = kategori::where('id_kategori', $id)->get();
        return response($data);
    }

    public function create(Request $request){
        $kategori = $request->input('nama_kategori');

        $create = kategori::create([
            'nama_kategori' => $kategori
        ]);

        if($create){
            return response()->json([
                'succes'  => true,
                'massage' => 'data telah di tambah',
                'data'    => $create
            ], 201);
        }else {
            return response()->json([
                'succes'  => false,
                'massage' => 'data gagal di tambah',
                'data'    => ''
            ], 400);
        }
    }

    public function destroy($id)
    {
        $data = kategori::where('id_kategori',$id);
        if ($data->delete()){
            return response()->json([
                'succes'  => true,
                'massage' => 'Delete Sukses'
            ]);
        }
        else {
            return response()->json([
                'succes'  => faile,
                'massage' => 'delete gagal'
            ]);
        }

    }
    
    public function update(Request $request, $id){
        
        $data = kategori::where('id_kategori', $id);
        // $data->update($request->all());

        if($data->update($request->all())){
            return response()->json([
                'success'  => true,
                'massage'    => 'update sukses'
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'massage' => 'data belum di update'
            ]);
        }
    }
    
    }

?>