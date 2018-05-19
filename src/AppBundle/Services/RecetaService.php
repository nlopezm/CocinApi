<?php

namespace AppBundle\Services;

class RecetaService {

    function __construct($container) {
        $this->container = $container;
    }

    const directorio = "images/recetas/";

    public function guardarImagen($base64) {
        $imagen = $this->getDecodificada($base64);
        $f = finfo_open();

        $mime_type = finfo_buffer($f, $imagen, FILEINFO_MIME_TYPE);
        $nombre = SELF::directorio . uniqid() . "." . explode('/', $mime_type)[1];

        if (!file_exists(SELF::directorio))
            mkdir(SELF::directorio, 0777, true);

        file_put_contents($nombre, $imagen);

        return "http://" . $_SERVER["HTTP_HOST"] . "/CocinApi/web/" . $nombre;
    }

    private function getDecodificada($base64) {
        $base64 = str_replace("data:image/jpeg;base64,", "", $base64);
        $base64 = str_replace("data:image/png;base64,", "", $base64);
        $base64 = str_replace(" ", "+", $base64);
        $imagen = base64_decode($base64);

        return $imagen;
    }

}
