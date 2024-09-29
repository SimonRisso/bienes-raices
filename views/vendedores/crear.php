<h1>Desde la vista</h1>

<main class="contenedor seccion">
    <h1>Registrar vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>


    <?php foreach ($errores as $error) : ?> <!--.foreach se ejecuta al menos una vez por cada elemento q se encuentre en el array-->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/vendedores/crear">
        <?php include 'formulario.php' ?>
        <input type="submit" value="Registrar vendedor(a)" class="boton boton-verde">
    </form>
</main>