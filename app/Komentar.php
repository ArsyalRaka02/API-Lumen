<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'tb_komentar';

    protected $fillable = [
        'id_komentar', 'komentar', 'id_berita', 'id_user'
    ];

    // protected $hidden = [
    //     'id_berita', 'id_user'
    // ];

}

?>