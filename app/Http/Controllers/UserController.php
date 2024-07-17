<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{

    /**
    * @OA\Post(
    *     path="/api/register-user",
    *     summary="Registrar usuarios",
    *     tags={"Usuarios"},
    *       @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *            required={"name", "email", "password"},
    *             @OA\Property(property="name", type="string", maxLength=255, description="Nombre del usuario"),
    *             @OA\Property(property="email", type="string", format="email", maxLength=255, description="Email del usuario"),
    *             @OA\Property(property="password", type="password", format="string",maxLength=255, description="Contraseña"),
    *             @OA\Property(property="password_confirmation", type="password", format="string",maxLength=255, description="Confirmar"),
     *         )
     *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Permite registrar usuarios."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    //Función que permite registrar usuarios
    public function registerUsers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Usuario registrado exitosamente.', 'user' => $user], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/all-users",
     *     summary="Obtiene todos los usuarios registrados.",
     *     description="Permite obtener todos los usuarios registrados en la base de datos",
     *     operationId="allUsers",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa, muestra el listado de todos los usuarios regisgtrados.",
     *         
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No se encontraron usuarios registrados, por favor ingresa una nueva."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ocurrido un error al obtener los usuarios registrados."
     *     )
     * )
    */

    public function allUsers()
    {
        try 
        {
            $users = user::all();
            $count = $users->count();
            return ($count > 0) ? response()->json(['users' => $users], 200) :
            response()->json(['message' => "No se encontraron registros de usuarios, por favor ingresa una nuevo."], 400);
            
        } catch (\Exception $e)
        {
            return response()->json(['message' => 'Ha ocurrido un error al obtener los usuarios registrados.', 'error' => $e->getMessage()], 500);
        }
    }

    public function loginUsers(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Las credenciales ingresadas son incorrectas.'], 401);
        }
    
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Guarda el token en la sesión
        session(['auth_token' => $token]);
    
        return response()->json(['message' => 'Usuario logueado', 'access_token' => $token, 'token_type' => 'Bearer']);
    }
    
}
