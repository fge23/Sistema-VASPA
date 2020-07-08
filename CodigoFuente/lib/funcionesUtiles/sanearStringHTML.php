<?php

/**
 * Reemplaza todos los acentos por sus equivalentes sin ellos
 *
 * @param $string
 *  string la cadena a sanear
 *
 * @return $string
 *  string saneada
 */
function sanearStringHTML($string) {
    $string = str_replace(
            array("'"), array("&apos;"), $string
    );
    return $string;
}