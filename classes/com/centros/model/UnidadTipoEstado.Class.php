<?php

/**
 * UnidadTipoEstado
 *
 * @author Marcos
 * @since 21-10-2013
 */

class UnidadTipoEstado extends Entity{

	//variables de instancia.
	
	private $unidad;

	private $tipoEstado;
	
	
	
	private $fechaDesde;
	
	private $fechaHasta;
	
	private $motivo;
	
	
	
	private $user;
	private $fechaUltModificacion;
	
	


	public function __construct(){
		 
		$this->unidad = new Unidad();
		
		$this->tipoEstado = new TipoEstado();
		
		
			
		$this->fechaDesde = "";
		
		$this->fechaHasta = "";
		
		$this->motivo = "";
		
		
		
		$this->user = new CdtUser();
		
		$this->fechaUltModificacion = "";
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

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getMotivo()
	{
	    return $this->motivo;
	}

	public function setMotivo($motivo)
	{
	    $this->motivo = $motivo;
	}

	public function getUser()
	{
	    return $this->user;
	}

	public function setUser($user)
	{
	    $this->user = $user;
	}

	public function getFechaUltModificacion()
	{
	    return $this->fechaUltModificacion;
	}

	public function setFechaUltModificacion($fechaUltModificacion)
	{
	    $this->fechaUltModificacion = $fechaUltModificacion;
	}
}
?>