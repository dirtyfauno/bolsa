<?php

/**
 * @param $present_bool
 * @param $texto
 *
 * @return string
 */
function p_checkbox($present_bool, $texto)
{
    if ($present_bool)
    {
        return "<p class='checkbox'>{$texto}</p>";
    }
    return "";
}

/**
 *
 * helper para vistas
 * verifica si existe un QUERY en la URI si no retorna null
 *
 * @param array $parameter
 * @param       $key
 *
 * @return null
 */
function verify(array $parameter, $key)
{
    return isset($parameter[$key]) ? $parameter[$key] : null;
}

/**
 * @param        $route
 * @param string $class
 *
 * @return string
 */
function isActive($route, $class = 'active')
{
    return (Route::currentRouteName() == $route) ? $class : '';
}

/**
 * @param                                $atributo
 * @param \Illuminate\Support\MessageBag $errores
 * @param string                         $color
 * @param null                           $class
 * @param null                           $id
 *
 * @return string
 * @throws Exception
 */
function mostrar_errores($atributo, Illuminate\Support\MessageBag $errores, $color = "brown", $class = null, $id = null)
{
    if (! is_string($atributo))
    {
        throw new Exception("atributo: {$atributo}, debe ser de tipo \"string\"");
    }

    return $errores->first($atributo, "<span id='{$atributo} {$id}' class='{$class}' style='font-size: 14px; color: {$color};'>:message</span>");
}

/**
 * @return string
 */
function empresa_images_path()
{
    $path = public_path() . '/images/empresa_logo/';

    File::exists($path) or File::makeDirectory($path);

    return $path;
}

/**
 * @return string
 */
function cv_path()
{
    $path = app_path() . '/Bolsa/curriculums/';

    File::exists($path) or File::makeDirectory($path);

    return $path;
}
