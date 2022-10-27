<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComponentsController extends Controller
{
    public function index(){

        $response = Component::get();
        //dd(json_decode($response));
        $content = json_decode($response);
        //$y = array_column(array_column(array_column($content, 'options'), 'position'), 'y');
        $y = collect($content)->map(fn($c) => $c->options->position->y)->toArray();
        array_multisort($y, SORT_ASC, $content);

        return $content;

    }

    public function store(Request $request){

        $names = Component::pluck('name')->toArray();
        //dd($names);
        if(in_array($request->name, $names)){
            echo 'cè già';
            return response()->json([
                'status' => 0,
                'message' => "Component already present",
            ], 422);
        } else {
            echo 'non cè';
            $c = Component::factory()->create(['name' => $request->name]);
            //return response($c, 200);
            return response()->json([
                'status' => 0,
                'message' => "Component added",
                'component' => $c
            ], 200);
        }
        //return Component::factory()->create(['name' => $request->name]);

    }

    public function clean_me(Request $request){

        $request->validate([
            'user_id' => 'required',
            'components' => 'required'
        ]);

        $user = User::where('id', $request->user_id)->first();
        //dd($request->all());
        if($user->exists){
            foreach($request->components as $c){
                if( ($c['name'] != "") && ($c['options'] != "") && (is_array($c['options'])) && (!str_contains("_8", $c['name'])) ){
                    if(str_contains("_1", $c['name'])){
                        Log::debug("Inserisco il primo componente!!");
                    }
                    //dd($c);
                    $component = new Component;
                    $component->fill($c);
                    $component->save();
                }else{
                    return response()->json([
                        'status' => 0,
                        'message' => "Component with missing data",
                    ], 422);
                }
            }
        }else{
            return response()->json([
                'status' => 0,
                'message' => "User not found",
            ]);
        }
    }
}
