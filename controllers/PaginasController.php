<?php

namespace  Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio 
        ]);
    }
    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router) {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router) {

        $id = validarOredireccionar('/propiedades');

        // Buscar la propiedad por su id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router) {
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router) {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $respuestas = $_POST['contacto'];

            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP (protocolo para envíos de emails)
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = $_ENV['SMTP_SECURE']; 
            $mail->Port = $_ENV['SMTP_PORT'];

            // Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com'); // Email de quien envía el correo
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); // Dirección de quien recibe el email o a quien le enviamos el email
            $mail->Subject = 'Tienes un nuevo mensaje'; // Lo primero que el usuario lee al recibir el email
            
            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido del email
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';

            // Enviar de forma condicional algunos campos de email o teléfono
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por teléfono</p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . ' </p>';
                $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . ' </p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
            } else {
                // Es email, entonces agregamos el campo de email 
                $contenido .= '<p>Eligió ser contactado por email</p>';  
                $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Vende o compra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio o presupuesto: $' . $respuestas['precio'] . ' </p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
            $contenido .= '</html>';
        
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';
            
            // Envíar el email
            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}