<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'user_name', 'status', 'title', 'description', 'location', 
    'titipkan_ke', 'whatsapp', 'instagram', 'time', 'image_path'
];
}
