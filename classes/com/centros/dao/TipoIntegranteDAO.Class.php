<?php

/**
 * DAO para TipoIntegrante
 *  
 * @author Marcos
 * @since 30-10-2013
 */
class TipoIntegranteDAO extends EntityDAO {

	public function getTableName(){
		return CYT_TABLE_TIPO_INTEGRANTE;
	}
	
	public function getEntityFactory(){
		return new TipoIntegranteFactory();
	}
	
	public function getFieldsToAdd($entity){
		
		$fieldsValues = array();
		
		$fieldsValues["nombre"] = $this->formatString( $entity->getNombre() ); 
		$fieldsValues["gobierno"] = $this->formatIfNull( $entity->getGobierno(), 'null' );
		
		return $fieldsValues;
	}
	
	public function getFromToSelect(){
		
		$tIntegrantes = $this->getTableName();
		$tTipoUnidad = DAOFactory::getTipoUnidadDAO()->getTableName();
		
		
        $sql  = parent::getFromToSelect();
        $sql .= " LEFT JOIN " . $tTipoUnidad . " ON($tIntegrantes.tipoUnidad_oid = $tTipoUnidad.oid)";
        
        
        return $sql;
	}
	
	public function getFieldsToSelect(){
		
		$tTipoUnidad = DAOFactory::getTipoUnidadDAO()->getTableName();
		
		$fields = parent::getFieldsToSelect();
		
        $fields[] = "$tTipoUnidad.oid as " . $tTipoUnidad . "_oid ";
        $fields[] = "$tTipoUnidad.nombre as " . $tTipoUnidad . "_nombre ";
        
        
        return $fields;
	}	
	
}
?>