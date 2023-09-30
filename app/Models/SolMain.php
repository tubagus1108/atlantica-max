<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolMain extends Model
{
    protected $table = 'dbo.tbl_SolMain';
    protected $primaryKey = 'PersonID'; // Ganti sesuai dengan kunci utama yang sesuai

    // Jika Anda memiliki relasi dengan model lain, Anda dapat mendefinisikannya di sini
    // public function person()
    // {
    //     return $this->belongsTo(Person::class, 'PersonID', 'PersonID');
    // }
}
