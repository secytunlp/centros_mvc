<?php

/**
 * DAO para TipoUnidad
 *  
 * @author Marcos
 * @since 17-10-2013
 */
class TipoUnidadDAO extends EntityDAO {

	public function getTableName(){
		return CYT_TABLE_TIPO_UNIDAD;
	}
	
	public function getEntityFactory(){
		return new TipoUnidadFactory();
	}
	
	public function getFieldsToAdd($entity){
		
		$fieldsValues = array();
		
		$fieldsValues["nombre"] = $this->formatString( $entity->getNombre() ); 
		$fieldsValues["nombre"] = $this->formatString( $entity->getActivo() ); 
		
		return $fieldsValues;
	}
	
}
?>