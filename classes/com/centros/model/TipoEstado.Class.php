<?php

/**
 * Tipo de estado 
 *  
 * @author Marcos
 * @since 21-10-2013
 */


class TipoEstado extends Entity{

    //variables de instancia.

    private $nombre;
    

    public function __construct(){
    	
    	$this->nombre = "";
    }
    
    
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}
?>