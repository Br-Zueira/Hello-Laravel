<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    public function excuses() {
        return $this->hasMany(Excuse::class);
    }

    public static $searchableField = 'tag';

    public static $validationRules = [
        'tag' => 'required|string|min:3|max:255',
        'severity_score' => 'required|integer|between:1,10'
    ];
}
