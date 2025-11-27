<?php
// app/Models/Entities/Postulante.php

namespace App\Models\Entities;

/**
 * Interfaz común para todos los tipos de postulantes (Persona, Empresa, etc.)
 */
interface Postulante
{
    public function getIdPostulante(): ?int;
    public function setIdPostulante(int $id): self;
    
    public function getIdUsuario(): int;
    public function setIdUsuario(int $id_usuario): self;
    
    public function getTipo(): int; 
}