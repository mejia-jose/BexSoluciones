<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


/**************************************************************************************************************************************************************
                        Clase que define el modelo para la entidad correspondiente a la tabla 'visits' en Laravel.
***************************************************************************************************************************************************************/
class Visits extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'visits'; // Nombre de la tabla asociada a este modelo

    protected $fillable = 
    [
        'name',
        'email',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
    ];
}