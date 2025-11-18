<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class History extends Model
{




    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'pakaian_id', 'quantity'
    ];
        /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        /**
     * pakaian
     *
     * @return void
     */
    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class);
    }

        public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }


    /**
     * createdAt
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y'),
        );
    }


    /**
     * updatedAt
     *
     * @return Attribute
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y'),
        );
    }

}
