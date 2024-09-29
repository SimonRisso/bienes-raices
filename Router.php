<?php

namespace MVC;

use GuzzleHttp\Psr7\Header;

Class Router {

    public $rutasGET = [];
    public $rutasPOST = [];
   
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() { 

        session_start();

        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; // Sabemos la URL actual
        $metodo = $_SERVER['REQUEST_METHOD']; // Nos imprime si es un método GET o POST. 

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }

        // Proteger las rutas 
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if($fn) {
            // La URL existe y hay una función asociada
            call_user_func($fn, $this); // Nos permite llamar una función cuando no sabemos como se llama esa función
        } else {
            echo "Página no encontrada";
        }
    }

    // Muestra una vista 
    public function render($view, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value; // Itera y genera variables con el nombre de los 'KEYS' del array asociativo que le pasamos previamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer para que el servidor no consuma memoria
        include __DIR__ . '/views/layout.php';
    }
}