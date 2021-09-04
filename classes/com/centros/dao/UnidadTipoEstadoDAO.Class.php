<?php

/**
 * DAO para Unidad Estado
 *
 * @author Marcos
 * @since 04-10-2013
 */
class UnidadTipoEstadoDAO extends EntityDAO {

	public function getTableName(){
		return CYT_TABLE_UNIDAD_TIPO_ESTADO;
	}

	public function getEntityFactory(){
		return new UnidadTipoEstadoFactory();
	}
	
	public function getFieldsToAdd($entity){

		$fieldsValues = array();

		
		$fieldsValues["unidad_oid"] = $this->formatIfNull( $entity->getUnidad()->getOid(), 'null' );
		$fieldsValues["tipoEstado_oid"] = $this->formatIfNull( $entity->getTipoEstado()->getOid(), 'null' );
		
		
		$fieldsValues["fechaDesde"] = $this->formatDate( $entity->getFechaDesde() );
		$fieldsValues["fechaHasta"] = $this->formatDate( $entity->getFechaHasta() );
		$fieldsValues["motivo"] = $this->formatString( $entity->getMotivo() );
		$fieldsValues["user_oid"] = $this->formatIfNull( $entity->getUser()->getOid(), 'null' );
		$fieldsValues["fechaUltModificacion"] = $this->formatString($entity->getFechaUltModificacion());

		return $fieldsValues;
	}
	
	public function getFromToSelect(){
		
		$tUnidadTipoEstado = $this->getTableName();
		
		$tUnidad = DAOFactory::getUnidadDAO()->getTableName();
		$tTipoEstado = DAOFactory::getTipoEstadoDAO()->getTableName();
		$tUser = CYT_TABLE_CDT_USER;
		
        $sql  = parent::getFromToSelect();
        
        $sql .= " LEFT JOIN " . $tUnidad . " ON($tUnidadTipoEstado.unidad_oid = $tUnidad.oid)";
       	$sql .= " LEFT JOIN " . $tTipoEstado . " ON($tUnidadTipoEstado.tipoEstado_oid = $tTipoEstado.oid)";
        
        $sql .= " LEFT JOIN " . $tUser . " ON($tUnidadTipoEstado.user_oid = $tUser.oid)";
        
        return $sql;
	}
	
	public function getFieldsToSelect(){
		
		$tTipoEstado = DAOFactory::getTipoEstadoDAO()->getTableName();
		
		$fields = parent::getFieldsToSelect();
		
                
        $tUnidad = DAOFactory::getUnidadDAO()->getTableName();
		$fields[] = "$tUnidad.oid as " . $tUnidad . "_oid ";
        $fields[] = "$tUnidad.denominacion as " . $tUnidad . "_denominacion ";
       
        
        $tTipoEstado = DAOFactory::getTipoEstadoDAO()->getTableName();
		$fields[] = "$tTipoEstado.oid as " . $tTipoEstado . "_oid ";
        $fields[] = "$tTipoEstado.nombre as " . $tTipoEstado . "_nombre ";
        
        $tUser = CYT_TABLE_CDT_USER;
		$fields[] = "$tUser.oid AS ".$tUser."_oid";
        $fields[] = "CASE $tUser.ds_name WHEN '' THEN $tUser.ds_username ELSE $tUser.ds_name END AS ds_username";
        
        return $fields;
	}	
	
	public function deleteUnidadTipoEstadoPorUnidad($unidad_oid, $idConn=0) {
    	
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