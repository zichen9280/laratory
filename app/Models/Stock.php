<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function create_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function update_user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function delete_user()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function sell_user()
    {
        return $this->belongsTo( User::class, 'sold_by');
    }

    public function product_of()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function sell_customer(){
        return $this->belongsTo( Customer::class, 'sold_to');
    }

}
