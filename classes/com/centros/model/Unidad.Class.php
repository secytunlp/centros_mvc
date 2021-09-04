<?php

/**
 * Unidad
 *
 * @author Marcos
 * @since 19-10-2013
 */

class Unidad extends Entity{

	//variables de instancia.

	private $user;
		
	private $denominacion;
	
	private $sigla;
	  
	private $tipoUnidad;
	  	
	private $especialidad;
	  
	private $objetivos;
	  
	private $lineas;
	  
	private $justificacion;
	
	
	  
	private $funciones;
	  
	private $produccion;
	  
	private $proyectos;
	  
	
	
	private $rrhh;
	
	private $reglamento;
	
	private $memorias;
	
	private $infraestructura;
	
	private $equipamiento;
	
	private $observaciones;
	
	private $tipoEstado;
	
	private $unidadTipoEstado;
	
	private $userUlt;
	private $fechaUltModificacion;
	
	//facultades de la unidad.
	private $facultades;
	
	private $facultad;
	
	private $dt_disposicion;
	
	private $nu_disposicion;
	
	public function __construct(){
		 
		$this->user = new CdtUser();
		
		$this->denominacion='';
		
		$this->sigla='';
		  
		$this->tipoUnidad = new TipoUnidad();
		  	
		$this->especialidad='';
		  
		$this->objetivos='';
		  
		$this->lineas='';
		  
		$this->justificacion='';
		  
		
		
		$this->funciones='';
		  
		$this->produccion='';
		  
		$this->proyectos='';
		  
		
		
		$this->rrhh='';
		
		$this->reglamento='';
		
		$this->memorias='';
		
		$this->infraestructura='';
		
		$this->equipamiento='';
		
		$this->observaciones='';
		
		$this->facultad='';
		
		$this->userUlt = new CdtUser();
		
		$this->fechaUltModificacion = "";

		
		$this->facultades = new ItemCollection();
		
		$this->dt_disposicion='';
		$this->nu_disposicion='';
	}




	

	

	

	public function getUser()
	{
	    return $this->user;
	}

	public function setUser($user)
	{
	    $this->user = $user;
	}

	public function getDenominacion()
	{
	    return $this->denominacion;
	}

	public function setDenominacion($denominacion)
	{
	    $this->denominacion = $denominacion;
	}

	public function getTipoUnidad()
	{
	    return $this->tipoUnidad;
	}

	public function setTipoUnidad($tipoUnidad)
	{
	    $this->tipoUnidad = $tipoUnidad;
	}

	public function getEspecialidad()
	{
	    return $this->especialidad;
	}

	public function setEspecialidad($especialidad)
	{
	    $this->especialidad = $especialidad;
	}

	public function getObjetivos()
	{
	    return $this->objetivos;
	}

	public function setObjetivos($objetivos)
	{
	    $this->objetivos = $objetivos;
	}

	public function getLineas()
	{
	    return $this->lineas;
	}

	public function setLineas($lineas)
	{
	    $this->lineas = $lineas;
	}

	public function getJustificacion()
	{
	    return $this->justificacion;
	}

	public function setJustificacion($justificacion)
	{
	    $this->justificacion = $justificacion;
	}

	public function getFunciones()
	{
	    return $this->funciones;
	}

	public function setFunciones($funciones)
	{
	    $this->funciones = $funciones;
	}

	public function getProduccion()
	{
	    return $this->produccion;
	}

	public function setProduccion($produccion)
	{
	    $this->produccion = $produccion;
	}

	public function getProyectos()
	{
	    return $this->proyectos;
	}

	public function setProyectos($proyectos)
	{
	    $this->proyectos = $proyectos;
	}

	

	public function getRrhh()
	{
	    return $this->rrhh;
	}

	public function setRrhh($rrhh)
	{
	    $this->rrhh = $rrhh;
	}

	public function getReglamento()
	{
	    return $this->reglamento;
	}

	public function setReglamento($reglamento)
	{
	    $this->reglamento = $reglamento;
	}

	public function getInfraestructura()
	{
	    return $this->infraestructura;
	}

	public function setInfraestructura($infraestructura)
	{
	    $this->infraestructura = $infraestructura;
	}

	public function getEquipamiento()
	{
	    return $this->equipamiento;
	}

	public function setEquipamiento($equipamiento)
	{
	    $this->equipamiento = $equipamiento;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}

	public function getUserUlt()
	{
	    return $this->userUlt;
	}

	public function setUserUlt($userUlt)
	{
	    $this->userUlt = $userUlt;
	}

	public function getFechaUltModificacion()
	{
	    return $this->fechaUltModificacion;
	}

	public function setFechaUltModificacion($fechaUltModificacion)
	{
	    $this->fechaUltModificacion = $fechaUltModificacion;
	}

	public function getTipoEstado()
	{
	    return $this->tipoEstado;
	}

	public function setTipoEstado($tipoEstado)
	{
	    $this->tipoEstado = $tipoEstado;
	}

	public function getUnidadTipoEstado()
	{
	    return $this->unidadTipoEstado;
	}

	public function setUnidadTipoEstado($unidadTipoEstado)
	{
	    $this->unidadTipoEstado = $unidadTipoEstado;
	}

	public function getFacultades()
	{
	    return $this->facultades;
	}

	public function setFacultades($facultades)
	{
	    $this->facultades = $facultades;
	}
	
	public function __toString(){
		
		return $this->getDenominacion().' '.$this->getSigla();
	}

	public function getSigla()
	{
	    return $this->sigla;
	}

	public function setSigla($sigla)
	{
	    $this->sigla = $sigla;
	}

	public function getFacultad()
	{
	    return $this->facultad;
	}

	public function setFacultad($facultad)
	{
	    $this->facultad = $facultad;
	}

	public function getMemorias()
	{
	    return $this->memorias;
	}

	public function setMemorias($memorias)
	{
	    $this->memorias = $memorias;
	}

	public function getDt_disposicion()
	{
	    return $this->dt_disposicion;
	}

	public function setDt_disposicion($dt_disposicion)
	{
	    $this->dt_disposicion = $dt_disposicion;
	}

	public function getNu_disposicion()
	{
	    return $this->nu_disposicion;
	}

	public function setNu_disposicion($nu_disposicion)
	{
	    $this->nu_disposicion = $nu_disposicion;
	}
}
?>