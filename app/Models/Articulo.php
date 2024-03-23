<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Articulo extends Model
{
    use HasFactory; 

    protected $fillable = [ //Define los atributos que son asignables en masa.
        'titulo',
        'contenido',
        'user_id', 
    ];

    public function user() 
    {
     
        return $this->belongsTo(User::class); //Un artículo pertenece a un usuario.
    }

    
}
