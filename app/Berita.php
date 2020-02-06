<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'tb_berita';

    protected $fillable = [
        'id_berita', 'judul_berita', 'gambar_berita', 'id_kategori', 'isi_berita'
    ];

    // protected $hidden = [
    //     'id_kategori'
    // ];

}

?>