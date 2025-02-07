<?php

/**
 * IntegranteEstado
 *
 * @author Marcos
 * @since 02-11-2016
 */

class IntegranteEstado extends Entity{

	//variables de instancia.
	
	private $integrante;

	private $estado;
	
	private $tipoIntegrante;
	

	
	private $horas;
	

	
	
	private $fechaDesde;
	
	private $fechaHasta;
	
	private $observaciones;

    private $motivo;

    private $unidad;

    private $activo;

    /**
     * @return mixed
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param mixed $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return mixed
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * @param mixed $unidad
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;
    }

    /**
     * @return mixed
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * @param mixed $motivo
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;
    }
	
	private $user;
	private $fechaUltModificacion;
	
	private $categoria;
	    
	private $cargo;

    /**
     * @return Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param Estado $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return TipoIntegrante
     */
    public function getTipoIntegrante()
    {
        return $this->tipoIntegrante;
    }

    /**
     * @param TipoIntegrante $tipoIntegrante
     */
    public function setTipoIntegrante($tipoIntegrante)
    {
        $this->tipoIntegrante = $tipoIntegrante;
    }

    /**
     * @return mixed
     */
    public function getHoras()
    {
        return $this->horas;
    }

    /**
     * @param mixed $horas
     */
    public function setHoras($horas)
    {
        $this->horas = $horas;
    }

    /**
     * @return string
     */
    public function getFechaDesde()
    {
        return $this->fechaDesde;
    }

    /**
     * @param string $fechaDesde
     */
    public function setFechaDesde($fechaDesde)
    {
        $this->fechaDesde = $fechaDesde;
    }

    /**
     * @return string
     */
    public function getFechaHasta()
    {
        return $this->fechaHasta;
    }

    /**
     * @param string $fechaHasta
     */
    public function setFechaHasta($fechaHasta)
    {
        $this->fechaHasta = $fechaHasta;
    }

    /**
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param string $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getFechaUltModificacion()
    {
        return $this->fechaUltModificacion;
    }

    /**
     * @param string $fechaUltModificacion
     */
    public function setFechaUltModificacion($fechaUltModificacion)
    {
        $this->fechaUltModificacion = $fechaUltModificacion;
    }

    /**
     * @return Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param Categoria $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return Cargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param Cargo $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * @return DedDoc
     */
    public function getDeddoc()
    {
        return $this->deddoc;
    }

    /**
     * @param DedDoc $deddoc
     */
    public function setDeddoc($deddoc)
    {
        $this->deddoc = $deddoc;
    }

    /**
     * @return Facultad
     */
    public function getFacultad()
    {
        return $this->facultad;
    }

    /**
     * @param Facultad $facultad
     */
    public function setFacultad($facultad)
    {
        $this->facultad = $facultad;
    }

    /**
     * @return CarreraInv
     */
    public function getCarreraInv()
    {
        return $this->carreraInv;
    }

    /**
     * @param CarreraInv $carreraInv
     */
    public function setCarreraInv($carreraInv)
    {
        $this->carreraInv = $carreraInv;
    }

    /**
     * @return Organismo
     */
    public function getOrganismo()
    {
        return $this->organismo;
    }

    /**
     * @param Organismo $organismo
     */
    public function setOrganismo($organismo)
    {
        $this->organismo = $organismo;
    }

    /**
     * @return string
     */
    public function getBeca()
    {
        return $this->beca;
    }

    /**
     * @param string $beca
     */
    public function setBeca($beca)
    {
        $this->beca = $beca;
    }
	
	private $deddoc;
	
	private $facultad;
	
	private $carreraInv;  
	

	
	private $organismo;
	  
	private $beca;

    /**
     * @return Integrante
     */
    public function getIntegrante()
    {
        return $this->integrante;
    }

    /**
     * @param Integrante $integrante
     */
    public function setIntegrante($integrante)
    {
        $this->integrante = $integrante;
    }



	public function __construct(){
		 
		$this->integrante = new Integrante();
		
		$this->estado = new Estado();
		
		$this->tipoIntegrante = new TipoIntegrante();
			
		$this->fechaDesde = "";
		
		$this->fechaHasta = "";
		
		$this->observaciones = "";
		
		$this->categoria = new Categoria();
		  
		$this->cargo = new Cargo();  
		
		$this->deddoc = new DedDoc();
		
		$this->facultad = new Facultad();
		
		$this->user = new User();		
		$this->fechaUltModificacion = "";
		
		$this->carreraInv = new CarreraInv();

        $this->activo='1';
		
		$this->organismo = new Organismo();
		  
		$this->beca = "";
		

		
	}




	

	 


}
?>