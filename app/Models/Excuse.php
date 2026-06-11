<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Excuse extends Model
{
    protected $appends = ['chaos_score'];

    // Calculate whole chaosScore of situation and excuse
    protected function chaosScore(): Attribute
    {
        return Attribute::make(
            get: function () {
                $severity = $this->risk->severity_score ?? 5;
                return $severity + (100 - $this->believability_rate);
            }
        );
    }

    public static function getModelRelations()
    {
        return ['category', 'risk'];
    }

    // Standard Eloquent Relationships
    public function risk()
    {
        return $this->belongsTo(Risk::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static $searchableField = 'text';

    public static $validationRules = [
        'text' => 'required|string|min:5|max:255',
        'believability_rate' => 'required|integer|between:0,100',

        'risk_id' => 'required|integer|exists:risk.id',
        'categories_id' => 'required|integer|exists:categories.id',
    ];
}