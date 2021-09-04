<?php

/**
 * DAO para Unidad Facultad
 *
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadFacultadDAO extends EntityDAO {

	public function getTableName(){
		return CYT_TABLE_UNIDAD_FACULTAD;
	}

	public function getEntityFactory(){
		return new UnidadFacultadFactory();
	}
	
	public function getFieldsToAdd($entity){

		$fieldsValues = array();

		$fieldsValues["unidad_oid"] = $this->formatIfNull( $entity->getUnidad()->getOid(), 'null' );
		$fieldsValues["facultad_oid"] = $this->formatIfNull( $entity->getFacultad()->getOid(), 'null' );
		
		

		return $fieldsValues;
	}
	
	public function getFromToSelect(){
		
		$tUnidadFacultad = $this->getTableName();
		
		$tUnidad = DAOFactory::getUnidadDAO()->getTableName();
		
		$tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
		
		
		
        $sql  = parent::getFromToSelect();
        $sql .= " LEFT JOIN " . $tUnidad . " ON($tUnidadFacultad.unidad_oid = $tUnidad.oid)";
       
        $sql .= " LEFT JOIN " . $tFacultad . " ON($tUnidadFacultad.facultad_oid = $tFacultad.cd_facultad)";
       
        
        
       
        return $sql;
	}
	
	public function getFieldsToSelect(){
		
		
		
		$fields = parent::getFieldsToSelect();
		
        
        $tUnidad = DAOFactory::getUnidadDAO()->getTableName();
        $fields[] = "$tUnidad.oid as " . $tUnidad . "_oid ";
        $fields[] = "$tUnidad.denominacion as " . $tUnidad . "_denominacion ";
        
        
       
        
        $tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
		$fields[] = "$tFacultad.cd_facultad as " . $tFacultad . "_cd_facultad ";
       	$fields[] = "$tFacultad.ds_facultad as " . $tFacultad . "_ds_facultad ";
       
       
        return $fields;
	}	
	
	public function deleteUnidadFacultadPorUnidad($unidad_oid, $idConn=0) {
    	
        $db = CdtDbManager::getConnection( $idConn );

        
        
        $tableName = $this->getTableName();

        $sql = "DELETE FROM $tableName WHERE unidad_oid = $unidad_oid ";

        CdtUtils::log($sql, __CLASS__,LoggerLevel::getLevelDebug());
        
        $result = $db->sql_query($sql);
        if (!$result)//hubo un error en la bbdd.
            throw new DBException($db->sql_error());
    }

}
?>