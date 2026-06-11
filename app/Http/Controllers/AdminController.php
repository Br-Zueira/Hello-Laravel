<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Risk;
use App\Models\Excuse;

class AdminController extends Controller
{
    public function panel() 
    {
        return view('adminpanel');
    }

    public function makeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        Category::create($validated);
        return true;
    }

    public function makeRisk(Request $request)
    {
        $validated = $request->validate([
            'tag' => 'required|string|max:255',
            'severity_score' => 'required|integer|min:1|max:10'
        ]);
        Risk::create($validated);
        return true;
    }

    public function makeExcuse(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'believability_rate' => 'required|integer|min:0|max:100',
            'category_id' => 'required|integer',
            'risk_id' => 'required|integer'
        ]);
        Excuse::Create($validated);
        return true;
    }

    public function edit($model, $id) 
    {
        $model = ucfirst(strtolower($model));
        $modelName = 'App\\Models\\' . $model;
    
        $query = $modelName::query();

        if (method_exists($modelName, 'getModelRelations')) {
            $query->with($modelName::getModelRelations());
        }

        $object = $query->findOrFail($id);

        return view('adminedit', compact('object', 'model'));
    }
}
