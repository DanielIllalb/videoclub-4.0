<?php
class Juego extends Soporte
{
    public function __construct(
        public string $consola,
        private int $minNumJugadores,
        private int $maxNumJugadores,
        string $titulo,
        int $numero,
        float $precio
    ) {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function muestraResumen()
    {
        echo '<h1> ' . $this->titulo . '</h1><br>
        <p>
            Precio: ' . parent::getPrecio() . ' euros <br>
            Precio IVA inlucido: ' . parent::getPrecioConIva() . ' euros <br>
            Juego para: ' . $this->consola . ' <br>' .
            parent::getPrecio() . '€ (IVA no incluido) <br>' .
            $this->muestraJugadoresPosibles() . '<br>
        </p>';
    }

    public function muestraJugadoresPosibles()
    {
        if ($this->minNumJugadores == $this->maxNumJugadores) {
            if ($this->minNumJugadores && $this->maxNumJugadores == 1) {
                return 'Para un jugador.';
            } else {
                return 'Para ' . $this->minNumJugadores . ' jugadores.';
            }
        } else {
            return 'De ' . $this->minNumJugadores . ' a ' . $this->maxNumJugadores . ' jugadores.';
        }
    }
}
?>