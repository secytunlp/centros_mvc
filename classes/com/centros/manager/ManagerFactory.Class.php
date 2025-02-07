<?php

/**
 * Factory para Managers
 *  
 * @author Marcos
 * @since 16-10-2013
 */
class ManagerFactory{

	public static function getTipoUnidadManager(){
		return new TipoUnidadManager();
	}
	
	public static function getUnidadManager(){
		return new UnidadManager();
	}
	
	
	
	public static function getTipoEstadoManager(){
		return new TipoEstadoManager();
	}
	
	public static function getUnidadTipoEstadoManager(){
		return new UnidadTipoEstadoManager();
	}
	
	public static function getUnidadFacultadManager(){
		return new UnidadFacultadManager();
	}
	
	public static function getIntegranteManager(){
		return new IntegranteManager();
	}
	
	public static function getTipoIntegranteManager(){
		return new TipoIntegranteManager();
	}

    public static function getEstadoIntegranteManager(){
        return new EstadoIntegranteManager();
    }

    public static function getIntegranteEstadoManager(){
        return new IntegranteEstadoManager();
    }
	
}

?>