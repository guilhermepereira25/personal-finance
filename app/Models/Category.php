<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'category_id';
    protected $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'category_name',
        'category_type'
    ];
}
