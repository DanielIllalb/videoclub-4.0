<?php
class Videoclub
{
    private $nombre;
    private $productos = array();
    private $numProductos = 1;
    private $socios = array();
    private $numSocios = 1;
    private $numProductosAlquilados = 0;
    private $numTotalAlquileres = 0;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNumProductosAlquilados() {
        return $this->numProductosAlquilados;
    }

    public function getNumTotalAlquileres() {
        return $this->numTotalAlquileres;
    }

    private function incluirProducto(Soporte $producto)
    {
        $this->productos[] = $producto;
        $this->numProductos++;
    }

    public function incluirCintaVideo($titulo, $precio, $duracion)
    {
        $cintaVideo = new CintaVideo($duracion, $titulo, $this->numProductos, $precio);
        $this->incluirProducto($cintaVideo);
    }

    public function incluirDvd($titulo, $precio, $idiomas, $pantalla)
    {
        $dvd = new Dvd($idiomas, $pantalla, $titulo, $this->numProductos, $precio);
        $this->incluirProducto($dvd);
    }

    public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ)
    {
        $juego = new Juego($consola, $minJ, $maxJ, $titulo, $this->numProductos, $precio);
        $this->incluirProducto($juego);
    }

    public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3)
    {
        $socio = new Cliente($nombre, $this->numSocios, $maxAlquileresConcurrentes);
        $this->numSocios++;
        $this->socios[] = $socio;
    }

    public function listarProductos()
    {
        foreach ($this->productos as $producto) {
            $producto->muestraResumen();
        }
    }

    public function listarSocios()
    {
        foreach ($this->socios as $socio) {
            echo $socio->muestraResumen() . '</br>';
        }
    }

    public function alquilarSocioProducto($numeroCliente, $numeroSoporte)
    {
        $socioAlquilar = null;
        $productoAlquilar = null;

        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numeroCliente) {
                $socioAlquilar = $socio;
                break;
            }
        }

        foreach ($this->productos as $producto) {
            if ($producto->getNumero() == $numeroSoporte) {
                $productoAlquilar = $producto;
                break;
            }
        }

        if ($socioAlquilar && $productoAlquilar) {
            $socioAlquilar->alquilar($productoAlquilar);
        }
        return $this;
    }

    public function alquilarSocioProductos($numSocio, $numerosProductos){  // alquilarSocioProductos( int numSocio, array numerosProductos)
        $alquilado = false;
        $arrayCorrecta = true;
        
        foreach ($this->productos as $productoVideoclub) {
            foreach ($numerosProductos as $productoAlquilar) {
                if ($productoVideoclub->getNumero() == $productoAlquilar) {
                    if ($productoVideoclub->alquilado == true) {
                        $alquilado = true;
                        echo "Alquilado";
                    }
                }
            }
        }

        if ($alquilado == false && $arrayCorrecta == true) {
            foreach($numerosProductos as $productoAlquilar) {
                $this->alquilarSocioProducto($numSocio, $productoAlquilar);
                echo "<p>Se ha alquilado exitosamente.</p>";
            }
        } else {
            echo "<p>Al menos uno de los soportes no está disponible";
        }
    }

    public function devolverSocioProducto(int $numSocio, int $numeroProducto) {
        $encontradoSocio = false;
        $encontradoProducto = false;
    
        // Buscar el socio
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numSocio) {
                $encontradoSocio = true;
                break;
            }
        }
    
        if (!$encontradoSocio) {
            echo "No existe ningún socio con ese número";
        }
    
        // Buscar y eliminar el producto
        foreach ($this->productos as $key => $producto) {
            if ($producto->getNumero() == $numeroProducto) {
                $encontradoProducto = true;
                unset($this->productos[$key]);
                echo "Producto devuelto exitosamente";
            }
        }
    
        if (!$encontradoProducto) {
            echo "No existe ningún producto con ese número";
        }
    }
    

    public function devolverSocioProductos(int $numSocio, array $numerosProductos) {
        $encontradoSocio = false;
    
        // Buscar el socio
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numSocio) {
                $encontradoSocio = true;
                break;
            }
        }
    
        if (!$encontradoSocio) {
            echo "No existe ningún socio con ese número";
            return;
        }
    
        // Verificar si el array de números de productos está vacío
        if (empty($numerosProductos)) {
            echo "El socio no tiene productos para devolver.";
            return;
        }
    
        $productosAEliminar = [];
    
        // Recorrer los números de productos y buscar los productos correspondientes
        foreach ($numerosProductos as $numeroProducto) {
            $productoEncontrado = false;
            foreach ($this->productos as $key => $producto) {
                if ($producto->getNumero() == $numeroProducto) {
                    $productosAEliminar[] = $key;
                    $productoEncontrado = true;
                    break;
                }
            }
            if (!$productoEncontrado) {
                echo "Alguno de los productos a devolver no existe";
                return;
            }
        }
    
        // Eliminar los productos encontrados
        foreach ($productosAEliminar as $index) {
            unset($this->productos[$index]);
        }
    
        echo "Productos devueltos exitosamente";
    }
    
}

?>
