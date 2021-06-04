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

    public function show(){

    }

    public function store(){

    }

    public function update(){

    }

    public function destroy(){
        
    }
}
