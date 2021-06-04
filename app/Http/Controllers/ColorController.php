<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Color;
use App\Helpers\JwtAuth;

class ColorController extends Controller
{
    public function __construct(){
        
        $this->middleware('api.auth');
    }

    public function index(){
        $colors = Color::all();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'posts' => $colors
        ], 200);

    }

    public function show($id){
        $color = Color::find($id);
        if(is_object($color)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'post' => $color
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Registro no encontrado'
            ];

        }

        return response()->json($data, $data['code']);

    }

    public function store(Request $request){
        
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){
            
            $validate = \Validator::make($params_array, [
                'name' => 'required',
                'color' => 'required',
                'pantone' => 'required',
                'year' => 'required'

            ]);

            if($validate->fails()){
                $data = [
                    'code'=> 400,
                    'status' => 'error',
                    'message' => 'Faltan datos'
                ];
            }else{
                $color = new Color();

                $color->name = $params->name;
                $color->color = $params->color;
                $color->pantone = $params->pantone;
                $color->year = $params->year;

                $color->save();

                
                $data = [
                    'code'=> 200,
                    'status' => 'success',
                    'post' => $color
                ];
            }

            
        }else{
            $data = [
                'code'=> 400,
                'status' => 'error',
                'message' => 'Envia datos correctamente'
            ];
        }



        //Devolver la respuesta
        return response()->json($data, $data['code']);
    }

    public function update(Request $request, $id){
        
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'Datos enviados incorrectamente'
        ];

        if(!empty($params_array)){

            $validate = \Validator::make($params_array, [
                'name' => 'required',
                'color' => 'required',
                'pantone' => 'required',
                'year' => 'required'
            ]);

            if($validate->fails()){
                $data['message'] = $validate->errors();
                return reponse()->json($data, $data['code']);
            }


            unset($params_array['id']);
            unset($params_array['created_at']);

            $color = Color::find($id);

            if(!empty($color) && is_object($color)){

                $color->update($params_array);

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'color' => $color,
                    'change' => $params_array
                ];
            }
   
        }
        return response()->json($data, $data['code']);

    }

    public function destroy($id){

        
        $color = Color::find($id);

        if(!empty($color)){
            //Borrarlo
            $color->delete();

            //Devolver data
            $data = [
                'code' => 200,
                'status' => 'success',
                'color' => $color
            ];
        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se encontro registro'
            ];
        }

        

        return response()->json($data, $data['code']);
    }
}
