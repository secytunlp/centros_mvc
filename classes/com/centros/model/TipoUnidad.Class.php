<?php

/**
 * Tipo de Unidad 
 *  
 * @author Marcos
 * @since 17-10-2013
 */


class TipoUnidad  extends Entity{

    //variables de instancia.

    private $nombre;
    private $activo;
    private $minMiembros;
    private $catDirector;
    private $minCD;
    

    

    public function __construct(){
    	
    	$this->nombre = "";
    	$this->activo = "1";
    	$this->minMiembros = "0";
    	$this->catDirector = "";
    	$this->minCD = "";
    }
    
    
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    public function getMinMiembros()
    {
        return $this->minMiembros;
    }

    public function setMinMiembros($minMiembros)
    {
        $this->minMiembros = $minMiembros;
    }

    public function getCatDirector()
    {
        return $this->catDirector;
    }

    public function setCatDirector($catDirector)
    {
        $this->catDirector = $catDirector;
    }

    public function getMinCD()
    {
        return $this->minCD;
    }

    public function setMinCD($minCD)
    {
        $this->minCD = $minCD;
    }
}
?>