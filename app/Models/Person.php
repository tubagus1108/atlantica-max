<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'tbl_person'; // Specify the table name if it's different from the default convention
    protected $connection = 'game';

    public function solMain()
    {
        return $this->hasOne(SolMain::class, 'PersonID', 'PersonID');
    }
}
