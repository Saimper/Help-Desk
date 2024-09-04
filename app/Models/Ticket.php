<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Especifica la tabla asociada con el modelo, si es diferente de la convención
    protected $table = 'tickets';

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'category_id',
        'user_id',
        'assigned_to',
        'closed_at',
        'resolution',
        'attachments',
        'tags',
        'due_date',
    ];

    // Si el campo 'attachments' y 'tags' se almacenan como JSON, puedes configurar la conversión aquí
    protected $casts = [
        'attachments' => 'array',
        'tags' => 'array',
        'closed_at' => 'datetime',
        'due_date' => 'date',
    ];

    // Define las relaciones con otros modelos si es necesario
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
