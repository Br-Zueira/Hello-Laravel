<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditingController extends Controller
{
    public function save(Request $request) 
    {
        $model = strtolower($request->model);
        $id = $request->id;

        $modelName = 'App\\Models\\' . ucfirst($model);
        if (!class_exists($modelName)) {
            abort(404);
        }

        $request->validate($modelName::$validationRules ?? []);

        $instance = $modelName::findOrFail($id);

        foreach (array_keys($modelName::$validationRules) as $field) {
            $instance->{$field} = $request->{$field};
        }

        $instance->save();
        return redirect('/detail/' . $model . '/' . $id);
    }

    public function add(Request $request) 
    {
        $model = strtolower($request->model);

        $modelName = 'App\\Models\\' . ucfirst($model);
        if (!class_exists($modelName)) {
            abort(404);
        }

        $request->validate($modelName::$validationRules ?? []);

        $instance = new $modelName;

        foreach (array_keys($modelName::$validationRules) as $field) {
            $instance->{$field} = $request->{$field};
        }

        $instance->save();
        return redirect('/detail/' . $model . '/' . $instance->id);
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'model' => 'required|string',
            'id'    => 'required|integer', 
        ]);

        $modelName = 'App\\Models\\' . ucfirst(strtolower($validated['model']));
        if (!class_exists($modelName)) {
            abort(404);
        }

        $instance = $modelName::findOrFail($validated['id']);
        $instance->delete();
        
        return redirect('/list');
    }
}