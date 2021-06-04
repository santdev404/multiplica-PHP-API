<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function register(Request $request){

        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        $params_array = array_map('trim',$params_array);

        $validate = \Validator::make($params_array, [
            'email'    => 'required|email|unique:users', 
            'password' => 'required'
        ]);


        if(!empty($params) && !empty($params_array)){

            if($validate->fails()){
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El usuario no se ha creado',
                    'errors' => $validate->errors()
                );
            }else{

                $pwd = hash('sha256', $params->password);


                $user = new User();
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = 'ROLE_USER';

                $user->save();


                $data = array(
                    'status' => 'success',
                    'code'   => 200,
                    'message' => 'El usuario  se ha creado',
                    'user' => $user
                );
            }

        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Datos enviados no son correctos'
            );
        }
        


        return response()->json($data, $data['code']);

    }

    public function login(Request $request){
        $jwtAuth = new \App\Helpers\JwtAuth();


        $json = $request->input('json', null);

        $params = json_decode($json); 
        $params_array = json_decode($json, true); 


        $validate = \Validator::make($params_array, [
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if($validate->fails()){
            $signup = array(
                'status' => 'error',
                'code'   => 404,
                'message' => 'El usuario no se ha podido identificar',
                'errors' => $validate->errors()
            );
            
        }else{

 
            $pwd   = hash('sha256', $params->password);

            $signup = $jwtAuth->signup($params->email, $pwd);

            if(!empty($params->gettoken)){
                $signup = $jwtAuth->signup($params->email, $pwd, true);
            }

        }



        return response()->json($signup, 200);
    }



    public function detail($id){

        $user = User::find($id);

        if(is_object($user)){
            $data = array(
                'code' => 200,
                'status' => 'success',
                'user' => $user
            );
        }else{
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => 'usuario no existe'
            );
        }

        return response()->json($data, $data['code']);

    }


}
