<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    // Map this model to the existing barangs table
    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'stok',
        'harga',
        'kondisi',
        'lokasi',
        'deskripsi',
        'image',
        'users_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
