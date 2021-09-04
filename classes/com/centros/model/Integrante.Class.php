<?php

/**
 * Integrante
 *
 * @author Marcos
 * @since 29-10-2013
 */

class Integrante extends Entity{

	//variables de instancia.

	private $unidad;

	private $tipoIntegrante;
	 
	private $apellido;
	
	private $nombre;
	
	private $cuil;
	
	private $mail;
	
	private $telefono;
	
	private $categoria;
	  
	private $carreraInv;  
	
	private $organismo;
	  
	private $beca;  
	  
	private $cargo;  
	
	private $deddoc;
	
	private $facultad;
	  
	private $lugarTrabajo;  
	
	private $curriculum;  
	
	private $horas;
	  
	private $fechaDesde; 
	
	private $fechaHasta;
	 
	private $user;
	private $fechaUltModificacion;
	
	private $observaciones;
	
	private $activo;
	
	private $estudiante;
	
	public function __construct(){
		 
		$this->unidad = new Unidad();

		$this->tipoIntegrante = new TipoIntegrante();
		 
		$this->apellido = "";
		
		$this->nombre = "";
		
		$this->cuil = "";
		
		$this->mail = "";
		
		$this->telefono = "";
		
		$this->categoria = new Categoria();
		  
		$this->carreraInv = new CarreraInv();  
		
		$this->organismo = new Organismo();
		  
		$this->beca = "";  
		  
		$this->cargo = new Cargo();  
		
		$this->deddoc = new DedDoc();
		
		$this->facultad = new Facultad();
		  
		$this->lugarTrabajo = '';  
		
		$this->curriculum ="";
		
		$this->horas = "";
		  
		$this->fechaDesde = ""; 
		
		$this->fechaHasta = "";
		 
		$this->observaciones='';
		
		$this->activo='1';
		
		$this->estudiante='0';
		
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

	public function getTipoIntegrante()
	{
	    return $this->tipoIntegrante;
	}

	public function setTipoIntegrante($tipoIntegrante)
	{
	    $this->tipoIntegrante = $tipoIntegrante;
	}

	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	    $this->categoria = $categoria;
	}

	public function getCarreraInv()
	{
	    return $this->carreraInv;
	}

	public function setCarreraInv($carreraInv)
	{
	    $this->carreraInv = $carreraInv;
	}

	public function getOrganismo()
	{
	    return $this->organismo;
	}

	public function setOrganismo($organismo)
	{
	    $this->organismo = $organismo;
	}

	public function getBeca()
	{
	    return $this->beca;
	}

	public function setBeca($beca)
	{
	    $this->beca = $beca;
	}

	public function getCargo()
	{
	    return $this->cargo;
	}

	public function setCargo($cargo)
	{
	    $this->cargo = $cargo;
	}

	public function getDeddoc()
	{
	    return $this->deddoc;
	}

	public function setDeddoc($deddoc)
	{
	    $this->deddoc = $deddoc;
	}

	public function getFacultad()
	{
	    return $this->facultad;
	}

	public function setFacultad($facultad)
	{
	    $this->facultad = $facultad;
	}

	public function getLugarTrabajo()
	{
	    return $this->lugarTrabajo;
	}

	public function setLugarTrabajo($lugarTrabajo)
	{
	    $this->lugarTrabajo = $lugarTrabajo;
	}

	public function getHoras()
	{
	    return $this->horas;
	}

	public function setHoras($horas)
	{
	    $this->horas = $horas;
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

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}

	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getCuil()
	{
	    return $this->cuil;
	}

	public function setCuil($cuil)
	{
	    $this->cuil = $cuil;
	}

	public function getActivo()
	{
	    return $this->activo;
	}

	public function setActivo($activo)
	{
	    $this->activo = $activo;
	}

	public function getEstudiante()
	{
	    return $this->estudiante;
	}

	public function setEstudiante($estudiante)
	{
	    $this->estudiante = $estudiante;
	}

	public function getCurriculum()
	{
	    return $this->curriculum;
	}

	public function setCurriculum($curriculum)
	{
	    $this->curriculum = $curriculum;
	}

	public function getMail()
	{
	    return $this->mail;
	}

	public function setMail($mail)
	{
	    $this->mail = $mail;
	}

	public function getTelefono()
	{
	    return $this->telefono;
	}

	public function setTelefono($telefono)
	{
	    $this->telefono = $telefono;
	}
}
?>