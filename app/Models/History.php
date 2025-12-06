<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'location', 'image_path', 
        'reporter_name', 'reporter_id', // Tambah ID
        'resolver_name', 'resolver_id', // Tambah ID
        'completion_note', 'completed_at'
    ];
}