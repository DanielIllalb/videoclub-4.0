<?php
abstract class Soporte implements Resumible
{
    private const iva = 0.21;
    public bool $alquilado = false;
    public function __construct(
        public string $titulo,
        protected int $numero,
        private float $precio,
    ) {
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getPrecioConIva()
    {
        return $this->precio + ($this->precio * self::iva);
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getTitulo(){
        return $this->titulo;
    }
    public abstract function muestraResumen();
}
?>