<?php 

namespace App\Http\Controllers;

use App\users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function view()
    {
        $data = users::all();
        return response($data);
    }

    public function show($id){
        $data = users::where('id_user', $id)->get();
        return response($data);
    }

    public function editUser(Request $request ,$id)
    {
        $data = users::where('id_user',$id)->update([
            'username' => $request->input('username')
        ]);

        $all = users::where('id_user', $id)->get();

        if($data){
            return response()->json([
                'success' => true,
                'message' => 'berhasil',
                'data'    => $all
            ], 201);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'gagal'
            ],400);
        }

    }

    public function editAccount(Request $request, $id){
        $hasher    = app()->make('hash');
        $username  = $request->input('username');
        $password  = $hasher->make($request->input('password'));

        $data = users::where('id_user', $id)->update([
            'username' => $username,
            'password' => $password
        ], 201);

        if($data){
            return response()->json([
                'success' => true,
                'massage' => 'update sukses'
            ], 200);
        }
        else {
            return response()->json([
                'success'  => false,
                'massage'  => 'update gagal'
            ], 400);
        }
    }


    public function register(Request $Request)
    {
        $hasher = app()->make('hash');
        $username = $Request->input('username');
        $password    = $hasher->make($Request->input('password'));
        
        $register = users::create([
            'username' => $username,
            'password' => $password,
            'api_token'=> '',
            'id_role'  => '2'
        ]);

        if ($register){
            return response()->json([
                'success' => true,
                'massage' => 'Register success!',
                'data'    => $register
            ], 201);
        } else {
            return response()->json([
                'succes' => false,
                'massage' => 'Register Failed!',
                'data'    => ''
            ], 400);
        }

    }
    public function login(Request $request)
    {
        $hasher = app()->make('hash');
        $username = $request->input('username');
        $password = $request->input('password');

        $user = users::where('username', $username)->first();

        if($hasher->check($password, $user->password)){
            $apiToken = $this->generateRandomString();
            
        users::where('id_user',$user->id_user)->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'succes'  => true,
                'message' => 'login sukses cuy',
                'data'    => [
                        'username' => $user->username,
                        'api_token' => $apiToken
                ]
            ], 201);
        }else {
            return response()->json([
                'succes'  => false,
                'massage' => 'login gagal bro harap coba lagi',
                'data'    => ''
            ], 400);
        }
    }
    public function destroy($id){
        $data = users::where('id_user',$id);
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
    public function generateRandomString($length = 80)
    {
        $karakter = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
        $panjang_karakter = strlen($karakter);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $karakter[rand(0, $panjang_karakter - 1)];
        }
        return $str;
    }
}

?>