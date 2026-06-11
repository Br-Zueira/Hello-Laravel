<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Excuse;

class IndexController extends Controller
{
    public function index() 
    {
        return view('index');
    }
    
    public function getExcuse() 
    {
        $excuse = Excuse::inRandomOrder()->first();
        if (!$excuse) {
            return response()->json(['error', 'No excuses found'], 404);
        }

        $response = [
            'id' => $excuse->id,
            'category' => $excuse->category->name,
            'risk' => $excuse->risk->tag,
            'severity_score' => $excuse->risk->severity_score,
            'excuse' => $excuse->text,
            'believability_rate' => $excuse->believability_rate,
            'chaos_score' => $excuse->chaos_score
        ];
        return response()->json($response);
    }
}
