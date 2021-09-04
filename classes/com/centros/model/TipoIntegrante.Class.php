<?php

/**
 * Tipo de Integrantes 
 *  
 * @author Marcos
 * @since 29-10-2013
 */


class TipoIntegrante  extends Entity{

    //variables de instancia.

    private $nombre;
    
    private $gobierno;
    
    private $orden;
    
	private $tipoUnidad;
	
    public function __construct(){
    	
    	$this->nombre = "";
    	
    	$this->gobierno = "";
    	
    	$this->orden = "";
    	
    	$this->tipoUnidad = new TipoUnidad();
    }
    
    
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


	public function getGobierno()
	{
	    return $this->gobierno;
	}

	public function setGobierno($gobierno)
	{
	    $this->gobierno = $gobierno;
	}

    public function getOrden()
    {
        return $this->orden;
    }

    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    public function getTipoUnidad()
    {
        return $this->tipoUnidad;
    }

    public function setTipoUnidad($tipoUnidad)
    {
        $this->tipoUnidad = $tipoUnidad;
    }
}
?>