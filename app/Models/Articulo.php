<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    // Aquí se especifican los campos que pueden ser asignados de forma masiva.
    protected $fillable = [
        'titulo',
        'contenido',
        'user_id', // Asegúrate de que este campo coincide con tu columna en la base de datos.
    ];

    /**
     * Obtener el usuario que creó el artículo.
     */
    public function user()
    {
        // Asegúrate de que el namespace del modelo User es correcto y que exista la relación en la base de datos.
        return $this->belongsTo(User::class);
    }

    
}
