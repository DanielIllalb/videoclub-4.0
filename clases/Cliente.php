<?php
class Cliente
{
    private $nombre;
    private $numero;
    private $soportesAlquilados = array();
    private $numSoportesAlquilados =  0;
    private $maxAlquilerConcurrente;

    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function tieneAlquilado(Soporte $s): bool
    {
        foreach ($this->soportesAlquilados as $soporte) {
            if ($soporte == $s) {
                return true;
            }
        }
        return false;
    }

    public function alquilar(Soporte $s)
    {
        if ($s->alquilado) {
            throw new SoporteYaAlquiladoException("El soporte ya está alquilado.</br>");
            return false;
        }

        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            throw new CupoSuperadoException("Ha superado el cupo de alquileres.</br>");
            return $this;
        }

        $this->soportesAlquilados[] = $s;
        $this->numSoportesAlquilados++;
        $s->alquilado = true;
        echo "El nuevo soporte ha sido añadido existosamente</br>";
        return $this;
    }

    public function devolver(int $numSoporte): bool
    {
        /*$soporteDevolver = null;

        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->getNumero() == $numSoporte) {
                $soporteDevolver = $soporte;
                if ($this->tieneAlquilado($soporteDevolver)) {
                    unset($this->soportesAlquilados[$key]);
                    $this->numSoportesAlquilados--;
                    echo "Se ha devuelto exitósamente el soporte</br>";
                    return true;
                }
            } else {
                echo "El soporte no está alquilado</br>";
            }
            return false;
            break;
        }*/

        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->getNumero() == $numSoporte) {
                if ($soporte->alquilado) {
                    unset($this->soportesAlquilados[$key]);
                    $this->numSoportesAlquilados--;
                    echo "Se ha devuelto exitósamente el soporte</br>";
                    $soporte->alquilado = false;
                    return true;
                } else {
                    throw new SoporteNoEncontradoException("El soporte no está alquilado.</br>");
                    return false;
                }
            }
        }
    
        throw new SoporteNoEncontradoException("El soporte no se encontró en los alquileres del cliente.</br>");
        return false;
    }
    

    public function listarAlquileres()
    {
        echo $this->numSoportesAlquilados;
    }

    public function muestraResumen()
    {
        echo "Nombre: " . $this->nombre . " Nº de alquileres: " . $this->numSoportesAlquilados;
    }
}
?>
