<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $table = 'tbl_guildinfo'; // Specify the table name if it's different from the default convention
    protected $connection = 'community';

}
