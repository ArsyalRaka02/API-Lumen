<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Berita;
use App\kategori;
use Illuminate\Http\Request;

class BeritaController extends Controller {


    public function get($id){
        $data = Berita::where('id_berita', $id)->get();
        return response($data);
    }

    public function cobaJoin(){
        $data = DB::table('tb_berita')
            ->join('tb_kategori', 'tb_berita.id_kategori', '=', 'tb_kategori.id_kategori')
            ->select('tb_berita.id_berita', 'tb_berita.judul_berita', 'tb_berita.gambar_berita',
            'tb_berita.isi_berita',
            'tb_kategori.id_kategori', 'tb_kategori.nama_kategori',
            'tb_berita.updated_at', 'tb_berita.created_at')
            ->get();
        // // $get = Berita::all();
        // foreach($get as $row){

        //     $kategori = kategori::where('id_kategori',$row->id_kategori)->first();

        //     $row->kategori = [
        //         'id_kategori' => $kategori->id_kategori,
        //         'nama_kategori' => $kategori->nama_kategori
        //     ];
        // }
        // dd($data);

        return response()->json([
            'result' => $data
        ], 200);
        // return Berita::orderByDesc(
        //     kategori::select('nama_kategori')
        //     ->whereColumn('id_kategori', 'id_berita.id')
        //     ->orderBy('nama_kategori', 'desc')
        // )->get();
            // $data = Berita::select('id_berita', 'judul_berita', 'id_kategori');



    }

    public function tambahBerita(Request $request){
        $judul = $request->input('judul_berita');
        $gambar =  $request->input('gambar_berita');
        $isiBerita = $request->input('isi_berita');
        $namaKategori = $request->input('nama_kategori');

        $kategori = DB::table('tb_kategori')->where('nama_kategori',$namaKategori)->first();
        
        if($kategori == null){
            return response()->json([
                'massage' => 'Kategori tidak ada!',
            ], 201);
        }

        $tambah = DB::table('tb_berita')->insert([
            'judul_berita' => $judul,
            'gambar_berita' => $gambar,
            'isi_berita' => $isiBerita,
            'id_kategori' => $kategori->id_kategori
        ]);
        if ($tambah){
            return response()->json([
                'massage' => 'Tambah success!'
            ], 201);
        } else {
            return response()->json([
                'massage' => 'Tambah Failed!'
            ], 400);
        }


    }

    public function destroy($id){
        $data = Berita::where('id_berita', $id);
        if ($data->delete()){
            return response()->json([
                'massage' => 'Delete Sukses'
            ]);
        }
        else {
            return response()->json([
                'massage' => 'delete gagal'
            ]);
        }
    }

    public function getKategory($id)
    {
        $data = DB::table('tb_berita')->where('id_kategori',$id)->get();
        if ($data == null){
            return response()->json([
                'data' => 'data tidak ada'
            ]);
        }
        else {
            return response()->json([
                'message' => $data
            ]);
        }
    }

    public function update(Request $request, $id){

        $judul = $request->input('judul_berita');
        $gambar =  $request->input('gambar_berita');
        $isiBerita = $request->input('isi_berita');
        $namaKategori = $request->input('nama_kategori');

        $kategori = kategori::where('nama_kategori', $namaKategori)->first();

        if($kategori == null){
            return response()->json([
                'massage' => 'kategori tidak ada',
            ], 201);
        }

        $data = Berita::where('id_berita', $id)->update([
            'judul_berita' => $judul,
            'gambar_berita' => $gambar,
            'isi_berita' => $isiBerita,
            'id_kategori' => $kategori->id_kategori,
        ]);

        if($data){
            return response()->json([
                'massage'  => 'data sukses di update bro'
            ]);
        }
        else{
            return response()->json([
                'massage'  => 'data gagal di update'
            ]);
        }

    }


}

?> 