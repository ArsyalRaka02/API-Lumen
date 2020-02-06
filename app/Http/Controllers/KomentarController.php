<?php 
namespace App\Http\Controllers;

use App\Komentar;
use App\users;
use App\Berita;
use Illuminate\Http\Request;


class KomentarController extends Controller {


    public function index(){
        $data = Komentar::all();
        return response($data);
    }

    public function getId($id){
        $data = Komentar::where('id_komentar', $id)->get();
        return response($data);
    }

    public function create(Request $request){

        $insert = Komentar::insert([
            'komentar'  => $request->komentar,
            'id_user'   => $request->id_user,
            'id_berita' => $request->id_berita
        ]);

        if($insert){
            return response()->json([
                'success' => true,
                'massage' => 'komentar telah di tambahkan'
            ], 200);
        } else {
            return response()->json([
                'succes' => false,
                'massage' => 'komentar gagal geblek'
            ], 404);
        }
        
    }
}