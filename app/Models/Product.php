<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
}

