<?php

/**
 * DAO para Integrante
 *  
 * @author Marcos
 * @since 30-10-2013
 */
class IntegranteDAO extends EntityDAO {

	public function getTableName(){
		return CYT_TABLE_UNIDAD_INTEGRANTE;
	}
	
	public function getEntityFactory(){
		return new IntegranteFactory();
	}
	
	public function getFieldsToAdd($entity){

		$fieldsValues = array();

		$fieldsValues["unidad_oid"] = $this->formatIfNull( $entity->getUnidad()->getOid(), 'null' );
		$fieldsValues["tipoIntegrante_oid"] = $this->formatIfNull( $entity->getTipoIntegrante()->getOid(), 'null' );
        $fieldsValues["estado_oid"] = $this->formatIfNull( $entity->getEstado()->getOid(), 'null' );
		$fieldsValues["apellido"] = $this->formatString( $entity->getApellido() );
		$fieldsValues["nombre"] = $this->formatString( $entity->getNombre() );
		$fieldsValues["cuil"] = $this->formatString( $entity->getCuil() );
		$fieldsValues["mail"] = $this->formatString( $entity->getMail() );
		$fieldsValues["telefono"] = $this->formatString( $entity->getTelefono() );
		$fieldsValues["categoria_oid"] = $this->formatIfNull( $entity->getCategoria()->getOid(), 'null' );
        $fieldsValues["categoriasicadi_oid"] = $this->formatIfNull( $entity->getCategoriasicadi()->getOid(), 'null' );
		$fieldsValues["carrerainv_oid"] = $this->formatIfNull( $entity->getCarrerainv()->getOid(), 'null' );
		$fieldsValues["organismo_oid"] = $this->formatIfNull( $entity->getOrganismo()->getOid(), 'null' );
		$fieldsValues["beca"] = $this->formatString( $entity->getBeca() );
		$fieldsValues["cargo_oid"] = $this->formatIfNull( $entity->getCargo()->getOid(), 'null' );
		$fieldsValues["deddoc_oid"] = $this->formatIfNull( $entity->getDeddoc()->getOid(), 'null' );
		$fieldsValues["facultad_oid"] = $this->formatIfNull( $entity->getFacultad()->getOid(), 'null' );
		//$fieldsValues["lugarTrabajo_oid"] = $this->formatIfNull( $entity->getLugarTrabajo()->getOid(), 'null' );
		$fieldsValues["lugarTrabajo"] = $this->formatString( $entity->getLugarTrabajo() );
		$fieldsValues["curriculum"] = $this->formatString( $entity->getCurriculum() );
		$fieldsValues["horas"] = $this->formatIfNull( $entity->getHoras(), 'null' );
		$fieldsValues["activo"] = $this->formatIfNull( $entity->getActivo(), 'null' );
		$fieldsValues["estudiante"] = $this->formatIfNull( $entity->getEstudiante(), 'null' );
        $fieldsValues["observaciones"] = $this->formatString( $entity->getObservaciones() );
		
		$fieldsValues["fechaDesde"] = $this->formatDate( $entity->getFechaDesde() );
		$fieldsValues["fechaHasta"] = $this->formatDate( $entity->getFechaHasta() );
		
		$fieldsValues["fechaUltModificacion"] = $this->formatString($entity->getFechaUltModificacion());
        $fieldsValues["user_oid"] = $this->formatIfNull( $entity->getUser()->getCd_user(), 'null' );

		return $fieldsValues;
	}
	
	public function getFieldsToUpdate($entity){

		$fieldsValues = array();

		$fieldsValues["tipoIntegrante_oid"] = $this->formatIfNull( $entity->getTipoIntegrante()->getOid(), 'null' );
        $fieldsValues["estado_oid"] = $this->formatIfNull( $entity->getEstado()->getOid(), 'null' );
		$fieldsValues["apellido"] = $this->formatString( $entity->getApellido() );
		$fieldsValues["nombre"] = $this->formatString( $entity->getNombre() );
		$fieldsValues["cuil"] = $this->formatString( $entity->getCuil() );
		$fieldsValues["mail"] = $this->formatString( $entity->getMail() );
		$fieldsValues["telefono"] = $this->formatString( $entity->getTelefono() );
		$fieldsValues["categoria_oid"] = $this->formatIfNull( $entity->getCategoria()->getOid(), 'null' );
        $fieldsValues["categoriasicadi_oid"] = $this->formatIfNull( $entity->getCategoriasicadi()->getOid(), 'null' );
		$fieldsValues["carrerainv_oid"] = $this->formatIfNull( $entity->getCarrerainv()->getOid(), 'null' );
		$fieldsValues["organismo_oid"] = $this->formatIfNull( $entity->getOrganismo()->getOid(), 'null' );
		$fieldsValues["beca"] = $this->formatString( $entity->getBeca() );
		$fieldsValues["cargo_oid"] = $this->formatIfNull( $entity->getCargo()->getOid(), 'null' );
		$fieldsValues["deddoc_oid"] = $this->formatIfNull( $entity->getDeddoc()->getOid(), 'null' );
		$fieldsValues["facultad_oid"] = $this->formatIfNull( $entity->getFacultad()->getOid(), 'null' );
		//$fieldsValues["lugarTrabajo_oid"] = $this->formatIfNull( $entity->getLugarTrabajo()->getOid(), 'null' );
		$fieldsValues["lugarTrabajo"] = $this->formatString( $entity->getLugarTrabajo() );
		$fieldsValues["curriculum"] = $this->formatString( $entity->getCurriculum() );
		$fieldsValues["horas"] = $this->formatIfNull( $entity->getHoras(), 'null' );
		
		$fieldsValues["activo"] = $this->formatIfNull( $entity->getActivo(), 'null' );
		$fieldsValues["estudiante"] = $this->formatIfNull( $entity->getEstudiante(), 'null' );
        $fieldsValues["observaciones"] = $this->formatString( $entity->getObservaciones() );
		
		$fieldsValues["fechaUltModificacion"] = $this->formatString($entity->getFechaUltModificacion());
        $fieldsValues["user_oid"] = $this->formatIfNull( $entity->getUser()->getCd_user(), 'null' );
		
		

		return $fieldsValues;
	}
	
	
	public function getFromToSelect(){
		
		$tIntegrante = $this->getTableName();
		$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
		$tUnidad = DAOFactory::getUnidadDAO()->getTableName();
		$tCategoria = CYTSecureDAOFactory::getCategoriaDAO()->getTableName();
        $tCategoriasicadi = CYTSecureDAOFactory::getCategoriasicadiDAO()->getTableName();
		$tCarrerainv = CYTSecureDAOFactory::getCarrerainvDAO()->getTableName();
		$tOrganismo = CYTSecureDAOFactory::getOrganismoDAO()->getTableName();
		$tCargo = CYTSecureDAOFactory::getCargoDAO()->getTableName();
		$tDeddoc = CYTSecureDAOFactory::getDeddocDAO()->getTableName();
		$tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
        $tEstado = DAOFactory::getEstadoIntegranteDAO()->getTableName();
        $tIntegranteEstado = DAOFactory::getIntegranteEstadoDAO()->getTableName();
		//$tLugarTrabajo = CYTSecureDAOFactory::getLugarTrabajoDAO()->getTableName();
		
		$tUser = CYT_TABLE_CDT_USER;
		
		
        $sql  = parent::getFromToSelect();
        $sql .= " LEFT JOIN " . $tTipoIntegrante . " ON($tIntegrante.tipoIntegrante_oid = $tTipoIntegrante.oid)";
        $sql .= " LEFT JOIN " . $tUnidad . " ON($tIntegrante.unidad_oid = $tUnidad.oid)";
        $sql .= " LEFT JOIN " . $tCategoria . " ON($tIntegrante.categoria_oid = $tCategoria.cd_categoria)";
        $sql .= " LEFT JOIN " . $tCategoriasicadi . " ON($tIntegrante.categoriasicadi_oid = $tCategoriasicadi.cd_categoriasicadi)";
        $sql .= " LEFT JOIN " . $tCarrerainv . " ON($tIntegrante.carrerainv_oid = $tCarrerainv.cd_carrerainv)";
        $sql .= " LEFT JOIN " . $tOrganismo . " ON($tIntegrante.organismo_oid = $tOrganismo.cd_organismo)";
        $sql .= " LEFT JOIN " . $tCargo . " ON($tIntegrante.cargo_oid = $tCargo.cd_cargo)";
        $sql .= " LEFT JOIN " . $tDeddoc . " ON($tIntegrante.deddoc_oid = $tDeddoc.cd_deddoc)";
        $sql .= " LEFT JOIN " . $tFacultad . " ON($tIntegrante.facultad_oid = $tFacultad.cd_facultad)";
        $sql .= " INNER JOIN " . $tIntegranteEstado . " ON($tIntegranteEstado.integrante_oid = $tIntegrante.oid)";
        $sql .= " LEFT JOIN " . $tEstado . " ON($tIntegranteEstado.estado_oid = $tEstado.cd_estado)";
        //$sql .= " LEFT JOIN " . $tLugarTrabajo . " LugarTrabajo ON($tIntegrante.lugarTrabajo_oid = LugarTrabajo.cd_unidad)";
        
        $sql .= " LEFT JOIN " . $tUser . " ON($tIntegrante.user_oid = $tUser.oid)";
        
        
        return $sql;
	}
	
	public function getFieldsToSelect(){
		
		$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
		$tUnidad = DAOFactory::getUnidadDAO()->getTableName();
		$tCategoria = CYTSecureDAOFactory::getCategoriaDAO()->getTableName();
        $tCategoriasicadi = CYTSecureDAOFactory::getCategoriasicadiDAO()->getTableName();
		$tCarrerainv = CYTSecureDAOFactory::getCarrerainvDAO()->getTableName();
		$tOrganismo = CYTSecureDAOFactory::getOrganismoDAO()->getTableName();
		$tCargo = CYTSecureDAOFactory::getCargoDAO()->getTableName();
		$tDeddoc = CYTSecureDAOFactory::getDeddocDAO()->getTableName();
		$tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
		//$tLugarTrabajo = "LugarTrabajo";
		
		$fields = parent::getFieldsToSelect();
		
        $fields[] = "$tTipoIntegrante.oid as " . $tTipoIntegrante . "_oid ";
        $fields[] = "$tTipoIntegrante.nombre as " . $tTipoIntegrante . "_nombre ";
        $fields[] = "$tTipoIntegrante.gobierno as " . $tTipoIntegrante . "_gobierno ";
        
        $fields[] = "$tUnidad.oid as " . $tUnidad . "_oid ";
        $fields[] = "$tUnidad.denominacion as " . $tUnidad . "_denominacion ";
        $fields[] = "$tUnidad.sigla as " . $tUnidad . "_sigla ";
        
        $fields[] = "$tCategoria.cd_categoria as " . $tCategoria . "_oid ";
        $fields[] = "$tCategoria.ds_categoria as " . $tCategoria . "_ds_categoria ";

        $fields[] = "$tCategoriasicadi.cd_categoriasicadi as " . $tCategoriasicadi . "_oid ";
        $fields[] = "$tCategoriasicadi.ds_categoriasicadi as " . $tCategoriasicadi . "_ds_categoriasicadi ";
        
        $fields[] = "$tCarrerainv.cd_carrerainv as " . $tCarrerainv . "_oid ";
        $fields[] = "$tCarrerainv.ds_carrerainv as " . $tCarrerainv . "_ds_carrerainv ";
        
        $fields[] = "$tOrganismo.cd_organismo as " . $tOrganismo . "_oid ";
        $fields[] = "$tOrganismo.ds_codigo as " . $tOrganismo . "_ds_codigo ";
        
        $fields[] = "$tCargo.cd_cargo as " . $tCargo . "_oid ";
        $fields[] = "$tCargo.ds_cargo as " . $tCargo . "_ds_cargo ";
        
        $fields[] = "$tDeddoc.cd_deddoc as " . $tDeddoc . "_oid ";
        $fields[] = "$tDeddoc.ds_deddoc as " . $tDeddoc . "_ds_deddoc ";
        
        $fields[] = "$tFacultad.cd_facultad as " . $tFacultad . "_oid ";
        $fields[] = "$tFacultad.ds_facultad as " . $tFacultad . "_ds_facultad ";


        $tEstado = DAOFactory::getEstadoIntegranteDAO()->getTableName();
        $fields[] = "$tEstado.cd_estado as " . $tEstado . "_oid ";
        $fields[] = "$tEstado.ds_estado as " . $tEstado . "_ds_estado ";

        $tIntegranteEstado = DAOFactory::getIntegranteEstadoDAO()->getTableName();
        $fields[] = "$tIntegranteEstado.oid as " . $tIntegranteEstado . "_oid ";
        $fields[] = "$tIntegranteEstado.fechaDesde as " . $tIntegranteEstado . "_fechaDesde ";
        $fields[] = "$tIntegranteEstado.fechaHasta as " . $tIntegranteEstado . "_fechaHasta ";


        /*$fields[] = "$tLugarTrabajo.cd_unidad as " . $tLugarTrabajo . "_oid ";
        $fields[] = "$tLugarTrabajo.ds_unidad as " . $tLugarTrabajo . "_ds_unidad ";
        $fields[] = "$tLugarTrabajo.ds_sigla as " . $tLugarTrabajo . "_ds_sigla ";*/
        
       	
        
        $tUser = CYT_TABLE_CDT_USER;
		$fields[] = "$tUser.oid AS ".$tUser."_oid";
        $fields[] = "CASE $tUser.ds_name WHEN '' THEN $tUser.ds_username ELSE $tUser.ds_name END AS ds_username";
        
       
        
        return $fields;
	}	
	
	
	
	public function deleteIntegrantePorUnidad($unidad_oid, $idConn=0) {
    	
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