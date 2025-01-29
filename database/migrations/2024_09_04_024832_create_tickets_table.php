<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      
            Schema::create('tickets', function (Blueprint $table) {
                $table->id(); // ID del ticket (clave primaria)
                $table->string('title'); // Título del ticket
                $table->text('description'); // Descripción detallada del problema o solicitud
                $table->enum('status', ['open', 'in_progress', 'closed'])->default('open'); // Estado del ticket
                $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Prioridad del ticket
                $table->foreignId('category_id')->constrained('categories'); // ID de la categoría (relación con tabla categories)
                $table->foreignId('user_id')->constrained('users'); // ID del usuario que creó el ticket (relación con tabla users)
                $table->foreignId('assigned_to')->nullable()->constrained('users'); // ID del usuario asignado (relación con tabla users)
                $table->timestamp('closed_at')->nullable(); // Fecha y hora de cierre del ticket
                $table->text('resolution')->nullable(); // Descripción de la resolución (opcional)
                $table->json('attachments')->nullable(); // Archivos adjuntos (opcional)
                $table->json('tags')->nullable(); // Etiquetas asociadas al ticket (opcional)
                $table->date('due_date')->nullable(); // Fecha límite para resolver el ticket (opcional)
                $table->timestamps(); // Campos created_at y updated_at
    
        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

