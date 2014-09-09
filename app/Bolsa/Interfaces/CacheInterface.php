<?php namespace Bolsa\Cache;

/**
 * Interface CacheInterface
 * @package Bolsa\Cache
 */
interface CacheInterface {

    /**
     * Obtener datos del cache
     *
     * @param string    Clave de los datos
     * @return mixed    datos del cache
     */
    public function obtener($key);

    /**
     * Agregar datos al cache
     *
     * @param string    Clave de los datos
     * @param mixed     Datos que se agregan (al cache)
     * @param integer   Minutos que se guardarán (los datos) en cache
     * @return mixed
     */
    public function almacenar($key, $datos, $minutos = null);

    /**
     * Agregar datos paginados al cache
     *
     * @param integer   Página de los items que se almacena
     * @param integer   Número de resultados por página
     * @param integer   Número total de posibles resultados
     * @param mixed     Resultados actuales de la página almacenada
     * @param string    Clave de los datos
     * @param integer   Minutos que se almacenarán (los datos) en cache
     * @return mixed
     */
    public function almacenarPaginacion(
        $paginaActual,
        $itemsPorPagina,
        $itemsTotales,
        $items,
        $key,
        $minutos = null
    );

    /**
     * Verificar que los datos existen en cache
     *
     * @param string    Clave de los datos
     * @return bool     Si los datos existen
     */
    public function existe($key);
}