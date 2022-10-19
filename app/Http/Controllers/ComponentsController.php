<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Component;
use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    public function index(){

        return Component::get();

    }

    public function store(Request $request){

        return Component::factory()->create(['name' => $request->name]);

    }

    public function clean_me(Request $request){

        $request->validate([
            'user_id' => 'required',
            'components' => 'required'
        ]);

        $user = User::where('id', $request->user_id)->first();

        if($user->exists){

            foreach($request->components as $c){

                if($c['name'] != "" && $c['options'] != ""){

                    if(is_array($c['options'])){

                        if(!str_contains("_8", $c['name'])){

                            if(str_contains("_1", $c['name'])){
                                Log::debug("Inserisco il primo componente!!");
                            }


                            $component = new Component;
                            $component->parent_id = $c['parent_id'];
                            $component->name = $c['name'];
                            $component->description = $c['description'];
                            $component->options = $c['options'];
                            $component->save();

                        }
                    }else{

                        return response()->json([
                            'status' => 0,
                            'message' => "Component with missing data",
                        ], 422);

                    }





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
