<?php
namespace App\Strategies;

interface BusquedaStrategyInterface
{
    /**
     * Filtra un array de ofertas según el criterio.
     * @param array $ofertas Lista completa de ofertas.
     * @param string $termino Lo que el usuario escribió.
     * @return array Ofertas filtradas.
     */
    public function buscar(array $ofertas, string $termino): array;
}

//Open/Close, creaamos una Interfaz BusquedaStrategyInterface si queremos añadir un 
// filtro por ubicación, solo creamos una nueva clase BusquedaPorUbicación el código 
// principal OfertaController no se toca. 