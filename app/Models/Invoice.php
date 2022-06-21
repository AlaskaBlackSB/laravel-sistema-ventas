<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_cost',
        'total_tax',
        'user_id',
    ];

    /* Extrae las tareas del usuario */
    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sales_invoices')->orderBy('created_at', 'desc');
            // ->withPivot(['sale_id', 'product_id']);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // public function user()
    // {
    //     return $this->hasMany(User::class, 'user_id');
    // }
}
