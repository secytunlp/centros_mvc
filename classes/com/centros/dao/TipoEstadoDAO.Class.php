<?php

/**
 * DAO para TipoEstado
 *  
 * @author Marcos
 * @since 21-10-2013
 */
class TipoEstadoDAO extends EntityDAO {

	public function getTableName(){
		return CYT_TABLE_TIPO_ESTADO;
	}
	
	public function getEntityFactory(){
		return new TipoEstadoFactory();
	}
	
	public function getFieldsToAdd($entity){
		
		$fieldsValues = array();
		
		$fieldsValues["nombre"] = $this->formatString( $entity->getNombre() ); 
		
		return $fieldsValues;
	}
	
}
?>