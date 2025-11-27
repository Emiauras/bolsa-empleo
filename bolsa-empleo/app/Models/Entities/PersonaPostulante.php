<?php
// app/Models/Entities/PersonaPostulante.php

namespace App\Models\Entities;

use App\Models\Entities\Persona;

/**
 * Implementación concreta de un Postulante de tipo "Persona".
 * Vincula la cuenta de usuario con los datos personales.
 */
class PersonaPostulante implements Postulante
{
    private ?int $id_postulante = null;
    private int $id_usuario;
    private int $id_tipo_postulante = 1; // 1 = Persona General
    private int $id_estado_postulante = 1; // 1 = Activo

    // Relación con la entidad Persona (Datos personales)
    private Persona $persona;

    public function __construct(Persona $persona)
    {
        $this->persona = $persona;
    }

    // --- IMPLEMENTACIÓN DE LA INTERFAZ POSTULANTE ---

    public function getIdPostulante(): ?int 
    { 
        return $this->id_postulante; 
    }

    public function setIdPostulante(int $id): self
    {
        $this->id_postulante = $id;
        return $this;
    }

    public function getIdUsuario(): int 
    { 
        return $this->id_usuario; 
    }

    public function setIdUsuario(int $id_usuario): self
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }
    
    public function getTipo(): int 
    { 
        return $this->id_tipo_postulante; 
    }

    // --- MÉTODOS ESPECÍFICOS (Usados por el Repositorio) ---

    /**
     * Obtiene el ID de la persona asociada.
     * Necesario para que MySQLPostulanteRepository guarde la FK id_persona.
     */
    public function getIdPersona(): ?int
    {
        return $this->persona->getIdPersona();
    }

    public function getPersona(): Persona
    {
        return $this->persona;
    }

    public function setIdEstadoPostulante(int $id_estado): self
    {
        $this->id_estado_postulante = $id_estado;
        return $this;
    }
}