<main class="contenedor seccion">
    <h1>Actualizar vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>


    <?php foreach ($errores as $error) : ?> <!--.foreach se ejecuta al menos una vez por cada elemento q se encuentre en el array-->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <!--.POST (envía datos de forma segura a un servidor) se utiliza para enviar información muy sensible o que no se requiera colocarla en una URL -->
        <!--.GET (expone datos a la URL, se utiliza para obt. datos de un servidor, para visitar paginas)se utiliza cuando queremos que cierta información se agg a la URL para compartir en enlace-->
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Guardar cambios" class="boton boton-verde">
    </form>
</main>