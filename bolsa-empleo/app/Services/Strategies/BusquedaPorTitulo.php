<?php
namespace App\Strategies;

use App\Models\Entities\OfertaLaboral;

class BusquedaPorTitulo implements BusquedaStrategyInterface
{
    public function buscar(array $ofertas, string $termino): array
    {
        // Filtra el array dejando solo los que coinciden en el título
        return array_filter($ofertas, function (OfertaLaboral $oferta) use ($termino) {
            return stripos($oferta->getTitulo(), $termino) !== false;
        });
    }
}