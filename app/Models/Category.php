<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function excuses() {
        return $this.hasMany(Excuse::class);
    }

    public static $searchableField = 'name';
}
