<?php
namespace App\Strategies;

use App\Models\Entities\OfertaLaboral;

class BusquedaPorRubro implements BusquedaStrategyInterface
{
    public function buscar(array $ofertas, string $termino): array
    {
        // En un caso real, compararías el nombre del rubro. 
        // Aquí comparamos si el ID del rubro coincide con el término numérico.
        return array_filter($ofertas, function (OfertaLaboral $oferta) use ($termino) {
            return (string)$oferta->getIdRubro() === $termino;
        });
    }
}