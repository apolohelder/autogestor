<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'address',
        'description',
        'price',
        'user_id',
        'is_active',
        'brand_id'
    ];

    // Relação com Brand (Marca)
    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault([
            'name' => 'Sem Marca' // Valor padrão se não houver marca
        ]);
    }

    // Mantenha a relação com categories
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
