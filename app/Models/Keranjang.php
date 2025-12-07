<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class Keranjang extends Model
{




    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'pakaian_id', 'size', 'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class);
    }


}
