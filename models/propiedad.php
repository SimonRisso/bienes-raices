<?php

namespace Model;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id']; // Columna que van a tener los datos (nos permite mapear el objeto que estamos creando y unir los atributos)

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function validar() {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título"; // Se agrega el string al array de $errores
        }
    
        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio"; // Se agrega el string al array de $errores
        }
    
        if (strlen($this->descripcion) < 50) { // .strlen sirve para conocer la extensión de un string
            self::$errores[] = "Debes añadir una descripción y debe tener al menos 50 caracteres"; // Se agrega el string al array de $errores
        }
    
        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir el número de habitaciones"; // Se agrega el string al array de $errores
        }
    
        if (!$this->wc) {
            self::$errores[] = "Debes añadir el número de baños"; // Se agrega el string al array de $errores
        }
    
        if (!$this->estacionamiento) {
            self::$errores[] = "Debes añadir el número de estacionamiento o garajes"; // Se agrega el string al array de $errores
        }
    
        if (!$this->vendedores_id) {
            self::$errores[] = "Debes seleccionar un vendedor"; // Se agrega el string al array de $errores
        }
    
        if (!$this->imagen) {
            self::$errores[] = "La imagen de la propiedad es obligatoria"; // Se agrega el string al array de errores
        }
        
        return self::$errores;
    }
}


