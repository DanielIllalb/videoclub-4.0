<?php
class CintaVideo extends Soporte
{

    public function __construct(
        private int $duracion,
        string $titulo,
        int $numero,
        float $precio
    ) {
        parent::__construct($titulo, $numero, $precio);
        $this->duracion = $duracion;
    }

    public function muestraResumen()
    {
        echo '<h1> ' . $this->titulo . '</h1><br>
        <p>
            Precio: ' . parent::getPrecio() . ' euros <br>
            Precio IVA inlucido: ' . parent::getPrecioConIva() . ' euros <br>
            Pelicula en VHS: <br>' .
            parent::getPrecio() . '€ (IVA no incluido) <br>
            Duración ' . $this->duracion . ' minutos <br>
        </p>';
    }
}
?>