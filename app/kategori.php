<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'tb_kategori';

    protected $fillable = [
        'id_kategori', 'nama_kategori'
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    // protected $hidden = [
    //     'password'
    // ];

}

?>