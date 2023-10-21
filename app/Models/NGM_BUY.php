<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NGM_BUY extends Model
{
    protected $connection = 'atlantica';
    protected $table = 'dbo.NGM_BUY'; // Set the correct table name

    protected $primaryKey = 'buy_seq'; // Set the correct primary key column

    protected $fillable = [
        'buy_seq',
        'product_seq',
        'status',
        'user_id',
        'get_id',
        'order_count',
        'order_price',
        'money_real',
        'money_bonus',
        'money_event',
        'tx_no',
        'comment',
        'reg_ip',
        'origin',
    ];

    public $timestamps = false; // If the table does not have created_at and updated_at columns
}
