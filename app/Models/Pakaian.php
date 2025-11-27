<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class Pakaian extends Model
{
 


    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'image'
    ];

        /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function variants()
    {
        return $this->hasMany(Stock::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('storage/pakaian/' . $value),
        );
    }


}
