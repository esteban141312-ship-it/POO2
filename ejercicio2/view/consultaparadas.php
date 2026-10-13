<?php
class consultaparadas{
public function mostrar($placa, $tam){
 echo '
        <form method="post">

            <input type="hidden" name="placa" value="' . htmlspecialchars($placa, ENT_QUOTES, 'UTF-8') . '">
            <input type="hidden" name="tam" value="' . htmlspecialchars($tam, ENT_QUOTES, 'UTF-8') . '">


            <h3>Parada 1</h3>
            Suben:
            <input type="number" name="suben1" min="0" required>

            <br><br>

            <h3>Parada 2</h3>
            Bajan:
            <input type="number" name="bajan2" min="0" required>

            Suben:
            <input type="number" name="suben2" min="0" required>

            <br><br>

            <h3>Parada 3</h3>
            Bajan:
            <input type="number" name="bajan3" min="0" required>

            Suben:
            <input type="number" name="suben3" min="0" required>

            <br><br>

            <h3>Parada 4</h3>
            Bajan:
            <input type="number" name="bajan4" min="0" required>

            Suben:
            <input type="number" name="suben4" min="0" required>

            <br><br>

            <input type="submit" name = "enviar" value="Procesar recorrido">

        </form>';
}
}
