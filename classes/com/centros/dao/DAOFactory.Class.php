<?php

/**
 * Factory para DAOs
 *
 * @author Marcos
 * @since 16-10-2013
 */
class DAOFactory{

	public static function getTipoUnidadDAO(){
		return new TipoUnidadDAO();
	}
	
	public static function getUnidadTipoEstadoDAO(){
		return new UnidadTipoEstadoDAO();
	}
	
	public static function getTipoEstadoDAO(){
		return new TipoEstadoDAO();
	}

	public static function getUnidadDAO(){
		return new UnidadDAO();
	}
	
	
	
	public static function getUnidadFacultadDAO(){
		return new UnidadFacultadDAO();
	}
	
	public static function getTipoIntegranteDAO(){
		return new TipoIntegranteDAO();
	}
	
	public static function getIntegranteDAO(){
		return new IntegranteDAO();
	}
	
	
	
}
?>
