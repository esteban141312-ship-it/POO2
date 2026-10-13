<?php

class consultabus
{
    public function consultar()
    {
        echo '
        <form method="post">

            <label for="placa">Ingrese la placa</label>
            <input type="text" name="placa" id="placa" required>
            <br><br>

            <label>Seleccione el tipo de bus</label><br>
            <input type="radio" name="tam" value="pequeño" required> Pequeño
            <input type="radio" name="tam" value="mediano"> Mediano
            <input type="radio" name="tam" value="grande"> Grande
            <input  type="submit" name="subir">

        </form>';
    }
}