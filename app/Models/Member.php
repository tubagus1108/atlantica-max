<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Member extends Model 
{
    protected $table = 'gm_member'; // Specify the table name if it's different from the default convention
    protected $connection = 'member';

    protected $fillable = [
        'user_id', 'passwd', 'email', // Ubah 'password' menjadi 'passwd'
        // ...
    ];
    
    public function getAuthPassword()
    {
        return $this->passwd; // Gunakan 'passwd' sesuai dengan nama kolom yang benar
    }
    

}
