<?php

/**
 * CambiarEstadoUnidad
 *
 * @author Marcos
 * @since 07-11-2013
 */

class CambiarEstadoUnidad extends Entity{

	//variables de instancia.
	
	

	private $unidad;
	
	private $tipoEstado;
	
	private $motivo;
	

	public function __construct(){
		
		$this->unidad = new Unidad();
		
		$this->tipoEstado = new TipoEstado();
		
		$this->motivo = "";
		
	}



	public function getUnidad()
	{
	    return $this->unidad;
	}

	public function setUnidad($unidad)
	{
	    $this->unidad = $unidad;
	}

	public function getTipoEstado()
	{
	    return $this->tipoEstado;
	}

	public function setTipoEstado($tipoEstado)
	{
	    $this->tipoEstado = $tipoEstado;
	}

	public function getMotivo()
	{
	    return $this->motivo;
	}

	public function setMotivo($motivo)
	{
	    $this->motivo = $motivo;
	}
}
?>