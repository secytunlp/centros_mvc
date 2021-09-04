<?php

/**
 * Unidad Facultad
 *
 * @author Marcos
 * @since 21-10-2013
 */

class UnidadFacultad extends Entity{

	//variables de instancia.
	
	private $unidad;
	
	private $facultad;
	
	
	
	
	
	
	


	public function __construct(){
		 
		$this->unidad = new Unidad();
		
		$this->facultad = new Facultad();
		
		
		
		
	}




	

	 

	

	public function getUnidad()
	{
	    return $this->unidad;
	}

	public function setUnidad($unidad)
	{
	    $this->unidad = $unidad;
	}

	public function getFacultad()
	{
	    return $this->facultad;
	}

	public function setFacultad($facultad)
	{
	    $this->facultad = $facultad;
	}
}
?>