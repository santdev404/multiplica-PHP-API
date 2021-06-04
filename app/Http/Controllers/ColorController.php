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

    public function store(){

    }

    public function update(){

    }

    public function destroy(){
        
    }
}
