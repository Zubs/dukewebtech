<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
    {
        // Sort relationship later
    }
}
