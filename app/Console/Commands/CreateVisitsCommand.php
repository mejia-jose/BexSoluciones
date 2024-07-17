<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\VisitsController;

/************************************************************************************************************************************************************
                Esta clase permite definir y crear un comando de PHP Artisan Utilizando PROMTS para registrar visistas en la BD
***********************************************************************************************************************************************************/
class CreateVisitsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:visits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite crear un nuevo registro de visita por el usuario:';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Obtiene la informacion de la consola y la alamcena en las varibales
        $name = $this->ask('Ingrese el nombre del visitante:');
        $email = $this->ask('Ingrese el correo electrónico del visitante:');
        $latitude = $this->ask('Ingrese la latitud:');
        $longitude = $this->ask('Ingrese la longitud:');
        $created_at = now();
        $updated_at = now();

        $controller = new VisitsController();//Se instancia el objeto del controllador de visitas para reutizar función de registro de visitas
        $request = new Request([
            'name' => $name, 
            'email' => $email,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
        
        $resp =  $controller->createAndUpdateVisits($request);
        $content = $resp->getContent();//Se obtiene el contenido de la respuestas
        $data = json_decode($content, true); //Se decodifica la respuestas obtenida
        $this->info($data['message']);   //Se muestra el mensaje en la consola.    
    }
}
