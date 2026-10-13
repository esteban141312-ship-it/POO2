<?php
class consultausuario{

public function mostrar(){

echo  '<form  method="post">
        <label for="numero">Ingrese el numero de cita</label>
        <input type="number" name="numero" id="numero" required>
        <label  for="tipo">ingrese el tipo de cita (recuerde que los valores van de 1 hasta 5)</label>
        <input type="number" name="tipo" id="tipo" min="1" max="5" required>
        <label for="tarifa">ingrese la tarifa de la cita</label>
        <input type="number" name="tarifa" id="tarifa" min="0" required>
        <input type="submit" value="enviar">
    </form>';
}

}




