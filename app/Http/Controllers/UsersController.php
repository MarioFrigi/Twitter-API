<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;

class UsersController extends Controller
{

    public function register(Request $req)
    {
        # code...
    }

    public function login()
    {
        //Comprobación si están los parametros necesarios
        if (empty($_POST['email']) || empty($_POST['password']) )
        {
            return response()->json([400, 'Faltan paramentros']);
        }

        //Se asignan en variables los campos obtenidos
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Comprobación de si el usuario existe mediante el email
        $user = User::where('email', $email)->get()->first();
        if(is_null($user)) {
            return response()->json([400, 'No existe este  usuario']);
        }


        //Comprobación de si las contraseñas coinciden para hacer el login
        if(Hash::check($password, $user->password)){

            $array = $arrayName = array
                (
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'password' => Hash::make($password),
                );

            //tmp
            $token = JWT::encode($array, 123);

            return response()->json([200, 'Login Correcto', ['token'=>$token]]);
        }else{
            return response()->json([400, 'Contraseña erronea']);
        }

    }

}
