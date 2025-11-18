<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
    /**
     * fillable
     *
     * @var array
     */
{
    protected $fillable = [
        'pakaian_id', 'size', 'price', 'stock'
    ];
    
    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class);
    }

}
