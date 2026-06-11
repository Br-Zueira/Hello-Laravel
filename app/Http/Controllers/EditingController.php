<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditingController extends Controller
{
    public function save(Request $request) {
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

    public function add(Request $request) {
        $model = strtolower($request->model);
        $id = $request->id;

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
        return redirect('/detail/' . $model . '/' . $id);
    }
}