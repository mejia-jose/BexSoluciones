<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visits;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API Documentation",
 *     description="Documentación de la API",
 *     @OA\Contact(
 *         email="jmejia.jm449@gmail.com"
 *     ),
 * ),
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Servidor de la API"
 * )
 */

/************************************************************************************************************************************************************
 Clase que permite definir el controlador de VISITS
 */
class VisitsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/all-visits",
     *     summary="Obtener todos los registros de visitas",
     *     description="Permite obtener todas las visitas registradas en la base de datos",
     *     operationId="getAllVisits",
     *     tags={"Visits"},
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa, muestra el listado de los registros de visitas",
     *         
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No se encontraron visitas, por favor ingresa una nueva."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ocurrido un error al obtener los registros de visitas"
     *     )
     * )
     * @OA\Get(
     *     path="/api/one-visits/{id}",
     *     summary="Obtener un registro de visita por ID",
     *     description="Permite obtener un registro de visita específico por ID",
     *     tags={"Visits"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID de la visita a obtener"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa, muestra el registro de la visita cosultada.",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron registros de visitas que coincidan con el ID proporcionado."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ocurrido un error al obtener los registros de visitas."
     *     )
     * )
     */
    //Función que permite obtener todas las visitas registradas o obtener un registro especifico por el ID
    public function getVisits($idVisits = 0)
    {
        try 
        {
            if($idVisits > 0)
            {
                $visits = Visits::find($idVisits);
                return (!$visits) ? response()->json(['message' => "No se encontraron registros de visitas que coincidan con el ID proporcionado."], 404):
                response()->json(['visits' => $visits], 200);
                
            } else {
                $visits = Visits::all();
                $count = $visits->count();
                return ($count > 0) ? response()->json(['visits' => $visits], 200) :
                response()->json(['message' => "No se encontraron visitas, por favor ingresa una nueva."], 400);
            }
            
        } catch (\Exception $e)
        {
            return response()->json(['message' => 'Ha ocurrido un error al obtener los registros de visitas', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/create-visits",
     *     summary="Crear una nueva visita",
     *     description="Crea una nueva visita en la base de datos",
     *     tags={"Visits"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "latitude", "longitude"},
     *             @OA\Property(property="name", type="string", maxLength=255, description="Nombre del visitante"),
     *             @OA\Property(property="email", type="string", format="email", maxLength=255, description="Email del visitante"),
     *             @OA\Property(property="latitude", type="number", format="float", minimum=-90.0000000, maximum=90.0000000, description="Latitud de la visita"),
     *             @OA\Property(property="longitude", type="number", format="float", minimum=-180.0000000, maximum=180.0000000, description="Longitud de la visita")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="La visita ha sido creada correctamente.",
     *        
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Solicitud inválida"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ocurrido un error al registrar la visita."
     *     )
     * )
     * @OA\Put(
     *     path="/api/update-visits",
     *     summary="Permite actualizar un registro de visitas",
     *     description="Actualiza por medio del ID un registro de  visitas en la base de datos",
     *     tags={"Visits"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id", "name", "email", "latitude", "longitude"},
     *             @OA\Property(property="id", type="number", maxLength=255, description="ID del registro"),
     *             @OA\Property(property="name", type="string", maxLength=255, description="Nombre del visitante"),
     *             @OA\Property(property="email", type="string", format="email", maxLength=255, description="Email del visitante"),
     *             @OA\Property(property="latitude", type="number", format="float", minimum=-90.0000000, maximum=90.0000000, description="Latitud de la visita"),
     *             @OA\Property(property="longitude", type="number", format="float", minimum=-180.0000000, maximum=180.0000000, description="Longitud de la visita")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="El registro con ID  fue actualizado correctamente.",
     *        
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Solicitud inválida"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ocurrido un error al actualizar este registro."
     *     )
     * )
     */

    //Función que permite registrar o actualizar los registros de visitas
    public function createAndUpdateVisits(Request $request)
    {
        try
        {
            // Validar los datos de entrada
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'latitude' => 'required|numeric|between:-90.0000000,90.0000000',
                'longitude' => 'required|numeric|between:-180.0000000,180.0000000',
            ],[
                'name.required' => 'Por favor debe ingresar un nombre.',
                'email.required' => 'Por favor ingrese la dirección de correo electrónico del visitante.',
                'latitude.required' => 'Por favor ingrese la latitud de la ubicación de la visita.',
                'longitude.required' => 'Por favor ingrese la longitud de la ubicación de la visita.',
            ]);

            
            // Crear un nuevo producto
            $values = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'created_at' => now(),
                'updated_at' => now()
            ];
            $id = $request->input('id');
            $conditions = ['id' => $id];
            Visits::updateOrInsert($conditions, $values);

            $msj = (!$request->input('id')) ? 'La visita ha sido creada correctamente ' : 'El registro con ID '.$id. ' fue actualizado correctamente.';

            return response()->json(['message' => $msj], 201);

        } catch (\Exception $e)
        {
            $msj = (!$request->input('id')) ? 'Ha ocurrido un error al registrar la visita ' : 'Ha ocurrido un error al actualizar este registro ';
            return response()->json(['message' => $msj. ':'. $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/delete-visits/{id}",
     *     summary="Eliminar un registro de visitas por medio del ID.",
     *     description="Permite eliminar registros en la base de datos por medio del ID.",
     *     operationId="deleteVisits",
     *     tags={"Visits"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID de la visita a eliminar."
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="El registro asociado al ID ('.$id.') ha sido elimanado de forma exitosa.",
     *         
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="El registro que intenta eliminar no fue encontrado."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Se ha producido un error al intentar eliminar el registro de la visita asociada al ID ('.$id.')."
     *     )
     * )
    */
    //Función que permite la eliminación de categorias por medio del ID
    public function deleteVisits($id)
    {
        try
        {
            //Permite buscar el registro de la visita por su ID
            $visits = Visits::find($id);

            //Validación que permite identificar si el registro de la visita existe o no
            if (!$visits)
            {
                return response()->json(['message' => 'El registro que intenta eliminar no fue encontrado.'], 404);
            }

            $visits->delete();

            // Devolver una respuesta de éxito
            return response()->json(['message' => 'El registro asociado al ID ('.$id.') ha sido elimanado de forma exitosa.'], 200);

        } catch (\Exception $e)
        {
            return response()->json(['message' => 'Se ha producido un error al intentar eliminar el registro de la visita asociada al ID ('.$id.').', 'error' => $e->getMessage()], 200);
        }
    }

}
