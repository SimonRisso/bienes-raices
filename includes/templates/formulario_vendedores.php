<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre:</label>
    <input type="tex" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="tex" id="apellido" name="vendedor[apellido]" placeholder="Apellido vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Información extra</legend>

    <label for="telefono">Teléfono:</label>
    <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Telefono vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>