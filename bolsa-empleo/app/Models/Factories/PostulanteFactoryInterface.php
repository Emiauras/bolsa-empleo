<?php
// app/Models/Factories/PostulanteFactoryInterface.php

namespace App\Models\Factories;

use App\Models\Entities\Postulante; // Se requiere la interfaz base Postulante

/**
 * Define el contrato para el Factory Method que crea objetos Postulante concretos.
 * [cite_start]Es parte del patrón Factory
 */
interface PostulanteFactoryInterface
{
    /**
     * Crea un objeto Postulante (polimórfico) a partir de una fila de la base de datos.
     */
    public function createFromDatabaseRow(array $data): Postulante;

    /**
     * Crea un objeto Postulante (polimórfico) a partir de datos de un formulario.
     */
    public function createFromFormData(array $data): Postulante;
}