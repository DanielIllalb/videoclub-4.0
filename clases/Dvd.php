<?php
class Dvd extends Soporte
{
    public array $idiomas;
    public function __construct(
        array $idiomas,
        private string $formatoPantalla,
        string $titulo,
        int $numero,
        float $precio
    ) {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    public function muestraResumen()
    {
        echo '<h1> ' . $this->titulo . '</h1><br>
        <p>
            Precio: ' . parent::getPrecio() . ' euros <br>
            Precio IVA inlucido: ' . parent::getPrecioConIva() . ' euros <br>
            Pelicula en DVD: <br>' . parent::getPrecio() . '€ (IVA no incluido) <br>
            Idiomas: ' . implode(",", $this->idiomas) . '  <br>
            Formato Pantlla: ' . $this->formatoPantalla . '<br>
        </p>';
    }
}
?>