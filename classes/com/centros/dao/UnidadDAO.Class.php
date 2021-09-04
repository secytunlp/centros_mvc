<?php

/**
 * DAO para Unidad
 *
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadDAO extends EntityDAO {

	public function getTableName(){
		return CYT_TABLE_UNIDAD;
	}

	public function getEntityFactory(){
		return new UnidadFactory();
	}
	
	public function getFieldsToAdd($entity){

		$fieldsValues = array();

		$fieldsValues["user_oid"] = $this->formatIfNull( $entity->getUser()->getCd_user(), 'null' );
		$fieldsValues["tipoUnidad_oid"] = $this->formatIfNull( $entity->getTipoUnidad()->getOid(), 'null' );
		$fieldsValues["denominacion"] = $this->formatString( $entity->getDenominacion() );
		$fieldsValues["sigla"] = $this->formatString( $entity->getSigla() );
		$fieldsValues["especialidad"] = $this->formatString( $entity->getEspecialidad() );
		$fieldsValues["objetivos"] = $this->formatString( $entity->getObjetivos() );
		$fieldsValues["lineas"] = $this->formatString( $entity->getLineas() );
		$fieldsValues["justificacion"] = $this->formatString( $entity->getJustificacion() );
		$fieldsValues["funciones"] = $this->formatString( $entity->getFunciones() );
		$fieldsValues["produccion"] = $this->formatString( $entity->getProduccion() );
		$fieldsValues["proyectos"] = $this->formatString( $entity->getProyectos() );
		$fieldsValues["rrhh"] = $this->formatString( $entity->getRrhh() );
		$fieldsValues["reglamento"] = $this->formatString( $entity->getReglamento() );
		$fieldsValues["infraestructura"] = $this->formatString( $entity->getInfraestructura() );
		$fieldsValues["equipamiento"] = $this->formatString( $entity->getEquipamiento() );
		$fieldsValues["observaciones"] = $this->formatString( $entity->getObservaciones() );
		$fieldsValues["memorias"] = $this->formatString( $entity->getMemorias() );
		$fieldsValues["dt_disposicion"] = $this->formatDate( $entity->getDt_disposicion() );
		$fieldsValues["nu_disposicion"] = $this->formatString( $entity->getNu_disposicion() );
		$fieldsValues["fechaUltModificacion"] = $this->formatString($entity->getFechaUltModificacion());
		$fieldsValues["userUlt_oid"] = $this->formatIfNull( $entity->getUserUlt()->getCd_user(), 'null' );

		return $fieldsValues;
	}
	
	public function getFieldsToUpdate($entity){

		$fieldsValues = array();

		$fieldsValues["tipoUnidad_oid"] = $this->formatIfNull( $entity->getTipoUnidad()->getOid(), 'null' );
		$fieldsValues["denominacion"] = $this->formatString( $entity->getDenominacion() );
		$fieldsValues["sigla"] = $this->formatString( $entity->getSigla() );
		$fieldsValues["especialidad"] = $this->formatString( $entity->getEspecialidad() );
		$fieldsValues["objetivos"] = $this->formatString( $entity->getObjetivos() );
		$fieldsValues["lineas"] = $this->formatString( $entity->getLineas() );
		$fieldsValues["justificacion"] = $this->formatString( $entity->getJustificacion() );
		$fieldsValues["funciones"] = $this->formatString( $entity->getFunciones() );
		$fieldsValues["produccion"] = $this->formatString( $entity->getProduccion() );
		$fieldsValues["proyectos"] = $this->formatString( $entity->getProyectos() );
		$fieldsValues["rrhh"] = $this->formatString( $entity->getRrhh() );
		$fieldsValues["reglamento"] = $this->formatString( $entity->getReglamento() );
		$fieldsValues["infraestructura"] = $this->formatString( $entity->getInfraestructura() );
		$fieldsValues["equipamiento"] = $this->formatString( $entity->getEquipamiento() );
		$fieldsValues["observaciones"] = $this->formatString( $entity->getObservaciones() );
		$fieldsValues["memorias"] = $this->formatString( $entity->getMemorias() );
		$fieldsValues["dt_disposicion"] = $this->formatDate( $entity->getDt_disposicion() );
		$fieldsValues["nu_disposicion"] = $this->formatString( $entity->getNu_disposicion() );
		$fieldsValues["fechaUltModificacion"] = $this->formatString($entity->getFechaUltModificacion());
		$fieldsValues["userUlt_oid"] = $this->formatIfNull( $entity->getUserUlt()->getCd_user(), 'null' );
		
		

		return $fieldsValues;
	}
	
	public function getFromToSelect(){
		
		$tUnidad = $this->getTableName();
		$tTipoUnidad = DAOFactory::getTipoUnidadDAO()->getTableName();
		$tTipoEstado = DAOFactory::getTipoEstadoDAO()->getTableName();
		$tUnidadTipoEstado = DAOFactory::getUnidadTipoEstadoDAO()->getTableName();
		$tUnidadFacultad = DAOFactory::getUnidadFacultadDAO()->getTableName();
		$tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
		$tUser = CYT_TABLE_CDT_USER;
		$tCdtUser = CYT_TABLE_CDT_USER;
		$tDirector = DAOFactory::getIntegranteDAO()->getTableName();
		
        $sql  = parent::getFromToSelect();
        $sql .= " LEFT JOIN " . $tTipoUnidad . " ON($tUnidad.tipoUnidad_oid = $tTipoUnidad.oid)";
        $sql .= " LEFT JOIN " . $tUnidadTipoEstado . " ON($tUnidadTipoEstado.unidad_oid = $tUnidad.oid)";
        $sql .= " LEFT JOIN " . $tTipoEstado . " ON($tUnidadTipoEstado.tipoEstado_oid = $tTipoEstado.oid)";
        $sql .= " LEFT JOIN " . $tUser . " ON($tUnidad.user_oid = $tUser.oid)";
        $sql .= " LEFT JOIN " . $tCdtUser . " U ON($tUnidad.userUlt_oid = U.oid)";
        $sql .= " LEFT JOIN " . $tUnidadFacultad . " ON($tUnidadFacultad.unidad_oid = $tUnidad.oid)";
        $sql .= " LEFT JOIN " . $tFacultad . " ON($tUnidadFacultad.facultad_oid = $tFacultad.cd_facultad)";
        $sql .= " LEFT JOIN " . $tDirector . " ON($tDirector.unidad_oid = $tUnidad.oid AND $tDirector.tipoIntegrante_oid IN(".CYT_TIPO_INTEGRANTE_DIRECTOR."))";
        
        return $sql;
	}
	
	public function getFieldsToSelect(){
		
		$tTipoUnidad = DAOFactory::getTipoUnidadDAO()->getTableName();
		
		$fields = parent::getFieldsToSelect();
		
        $fields[] = "$tTipoUnidad.oid as " . $tTipoUnidad . "_oid ";
        $fields[] = "$tTipoUnidad.nombre as " . $tTipoUnidad . "_nombre ";
        
       	$tTipoEstado = DAOFactory::getTipoEstadoDAO()->getTableName();
		$fields[] = "$tTipoEstado.oid as " . $tTipoEstado . "_oid ";
        $fields[] = "$tTipoEstado.nombre as " . $tTipoEstado . "_nombre ";
        
        $tUnidadTipoEstado = DAOFactory::getUnidadTipoEstadoDAO()->getTableName();
		$fields[] = "$tUnidadTipoEstado.oid as " . $tUnidadTipoEstado . "_oid ";
        $fields[] = "$tUnidadTipoEstado.fechaDesde as " . $tUnidadTipoEstado . "_fechaDesde ";
        $fields[] = "$tUnidadTipoEstado.fechaHasta as " . $tUnidadTipoEstado . "_fechaHasta ";
        
        $tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
        $fields[] = "GROUP_CONCAT($tFacultad.ds_facultad) as facultad ";
        
        $tUser = CYT_TABLE_CDT_USER;
		$fields[] = "$tUser.oid as ".$tUser."_oid";
        $fields[] = "$tUser.ds_username";
        
        $tCdtUser = 'U';
		$fields[] = "$tCdtUser.oid as " . $tCdtUser . "_oid ";
        //$fields[] = "$tCdtUser.ds_username as " . $tCdtUser . "_user_name ";
        $fields[] = "CASE $tCdtUser.ds_name WHEN '' THEN $tCdtUser.ds_username ELSE $tCdtUser.ds_name END AS ".$tCdtUser . "_ds_username";
        		
        return $fields;
	}	

}
?>