<?php

/**
 * DAO para Integrante Estado
 *
 * @author Marcos
 * @since 03-11-2016
 */
class IntegranteEstadoDAO extends EntityDAO {

    public function getTableName(){
        return CYT_TABLE_INTEGRANTE_ESTADO;
    }

    public function getEntityFactory(){
        return new IntegranteEstadoFactory();
    }

    public function getFieldsToAdd($entity){

        $fieldsValues = array();


        $fieldsValues["integrante_oid"] = $this->formatIfNull( $entity->getIntegrante()->getOid(), 'null' );
        $fieldsValues["estado_oid"] = $this->formatIfNull( $entity->getEstado()->getOid(), 'null' );
        $fieldsValues["tipoIntegrante_oid"] = $this->formatIfNull( $entity->getTipoIntegrante()->getOid(), 'null' );
        $fieldsValues["categoria_oid"] = $this->formatIfNull( $entity->getCategoria()->getOid(), 'null' );
        $fieldsValues["cargo_oid"] = $this->formatIfNull( $entity->getCargo()->getOid(), 'null' );
        $fieldsValues["deddoc_oid"] = $this->formatIfNull( $entity->getDeddoc()->getOid(), 'null' );
        $fieldsValues["facultad_oid"] = $this->formatIfNull( $entity->getFacultad()->getOid(), 'null' );

        $fieldsValues["horas"] = $this->formatIfNull( $entity->getHoras(), 'null' );
        $fieldsValues["observaciones"] = $this->formatString( $entity->getObservaciones() );
        $fieldsValues["motivo"] = $this->formatString( $entity->getMotivo() );


        $fieldsValues["fechaDesde"] = $this->formatDate( $entity->getFechaDesde() );
        $fieldsValues["fechaHasta"] = $this->formatDate( $entity->getFechaHasta() );

        $fieldsValues["user_oid"] = $this->formatIfNull( $entity->getUser()->getCd_user(), 'null' );
        $fieldsValues["fechaUltModificacion"] = $this->formatString($entity->getFechaUltModificacion());
        $fieldsValues["activo"] = $this->formatIfNull( $entity->getActivo(), 'null' );

        $fieldsValues["carrerainv_oid"] = $this->formatIfNull( $entity->getCarrerainv()->getOid(), 'null' );

        $fieldsValues["organismo_oid"] = $this->formatIfNull( $entity->getOrganismo()->getOid(), 'null' );
        $fieldsValues["beca"] = $this->formatString( $entity->getBeca() );



        return $fieldsValues;
    }

    public function getFieldsToUpdate($entity){

        $fieldsValues = array();


        $fieldsValues["integrante_oid"] = $this->formatIfNull( $entity->getIntegrante()->getOid(), 'null' );
        $fieldsValues["estado_oid"] = $this->formatIfNull( $entity->getEstado()->getOid(), 'null' );
        $fieldsValues["tipoIntegrante_oid"] = $this->formatIfNull( $entity->getTipoIntegrante()->getOid(), 'null' );
        $fieldsValues["categoria_oid"] = $this->formatIfNull( $entity->getCategoria()->getOid(), 'null' );
        $fieldsValues["cargo_oid"] = $this->formatIfNull( $entity->getCargo()->getOid(), 'null' );
        $fieldsValues["deddoc_oid"] = $this->formatIfNull( $entity->getDeddoc()->getOid(), 'null' );
        $fieldsValues["facultad_oid"] = $this->formatIfNull( $entity->getFacultad()->getOid(), 'null' );

        $fieldsValues["horas"] = $this->formatIfNull( $entity->getHoras(), 'null' );
        $fieldsValues["observaciones"] = $this->formatString( $entity->getObservaciones() );

        $fieldsValues["motivo"] = $this->formatString( $entity->getMotivo() );
        $fieldsValues["fechaDesde"] = $this->formatDate( $entity->getFechaDesde() );
        $fieldsValues["fechaHasta"] = $this->formatDate( $entity->getFechaHasta() );

        $fieldsValues["user_oid"] = $this->formatIfNull( $entity->getUser()->getCd_user(), 'null' );
        $fieldsValues["fechaUltModificacion"] = $this->formatString($entity->getFechaUltModificacion());
        $fieldsValues["activo"] = $this->formatIfNull( $entity->getActivo(), 'null' );

        $fieldsValues["carrerainv_oid"] = $this->formatIfNull( $entity->getCarrerainv()->getOid(), 'null' );

        $fieldsValues["organismo_oid"] = $this->formatIfNull( $entity->getOrganismo()->getOid(), 'null' );
        $fieldsValues["beca"] = $this->formatString( $entity->getBeca() );

        return $fieldsValues;
    }

    public function getFromToSelect(){

        $tIntegranteEstado = $this->getTableName();

        $tIntegrante = DAOFactory::getIntegranteDAO()->getTableName();
        $tEstado = DAOFactory::getEstadoIntegranteDAO()->getTableName();
        $tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
        $tCategoria = CYTSecureDAOFactory::getCategoriaDAO()->getTableName();
        $tCargo = CYTSecureDAOFactory::getCargoDAO()->getTableName();
        $tDeddoc = CYTSecureDAOFactory::getDeddocDAO()->getTableName();
        $tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
        $tUnidad = DAOFactory::getUnidadDAO()->getTableName();
        $tUser = CYTSecureDAOFactory::getUserDAO()->getTableName();
        $tCarrerainv = CYTSecureDAOFactory::getCarrerainvDAO()->getTableName();
        $tOrganismo = CYTSecureDAOFactory::getOrganismoDAO()->getTableName();



        $sql  = parent::getFromToSelect();

        $sql .= " LEFT JOIN " . $tIntegrante . " ON($tIntegranteEstado.integrante_oid = $tIntegrante.oid)";
        $sql .= " LEFT JOIN " . $tEstado . " ON($tIntegranteEstado.estado_oid = $tEstado.cd_estado)";
        $sql .= " LEFT JOIN " . $tTipoIntegrante . " ON($tIntegranteEstado.tipoIntegrante_oid = $tTipoIntegrante.oid)";

        $sql .= " LEFT JOIN " . $tCategoria . " ON($tIntegranteEstado.categoria_oid = $tCategoria.cd_categoria)";
        $sql .= " LEFT JOIN " . $tCargo . " ON($tIntegranteEstado.cargo_oid = $tCargo.cd_cargo)";
        $sql .= " LEFT JOIN " . $tDeddoc . " ON($tIntegranteEstado.deddoc_oid = $tDeddoc.cd_deddoc)";
        $sql .= " LEFT JOIN " . $tFacultad . " ON($tIntegranteEstado.facultad_oid = $tFacultad.cd_facultad)";
        $sql .= " LEFT JOIN " . $tUnidad . " ON($tIntegrante.unidad_oid = $tUnidad.oid)";
        $sql .= " LEFT JOIN " . $tUser . " ON($tIntegranteEstado.user_oid = $tUser.oid)";
        $sql .= " LEFT JOIN " . $tCarrerainv . " ON($tIntegranteEstado.carrerainv_oid = $tCarrerainv.cd_carrerainv)";
        $sql .= " LEFT JOIN " . $tOrganismo . " ON($tIntegranteEstado.organismo_oid = $tOrganismo.cd_organismo)";


        return $sql;
    }

    public function getFieldsToSelect(){


        $fields = parent::getFieldsToSelect();


        $tIntegrante = DAOFactory::getIntegranteDAO()->getTableName();
        $fields[] = "$tIntegrante.oid as " . $tIntegrante . "_oid ";
        $fields[] = "$tIntegrante.apellido as " . $tIntegrante . "_apellido ";
        $fields[] = "$tIntegrante.nombre as " . $tIntegrante . "_nombre ";


        $tUnidad = DAOFactory::getUnidadDAO()->getTableName();
        $fields[] = "$tUnidad.oid as " . $tUnidad . "_oid ";
        $fields[] = "$tUnidad.sigla as " . $tUnidad . "_sigla ";
        $fields[] = "$tUnidad.denominacion as " . $tUnidad . "_denominacion ";


        $tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
        $fields[] = "$tTipoIntegrante.oid as " . $tTipoIntegrante . "_oid ";
        $fields[] = "$tTipoIntegrante.nombre as " . $tTipoIntegrante . "_nombre ";

        $tEstado = DAOFactory::getEstadoIntegranteDAO()->getTableName();
        $fields[] = "$tEstado.cd_estado as " . $tEstado . "_oid ";
        $fields[] = "$tEstado.ds_estado as " . $tEstado . "_ds_estado ";

        $tCategoria = CYTSecureDAOFactory::getCategoriaDAO()->getTableName();
        $tCargo = CYTSecureDAOFactory::getCargoDAO()->getTableName();
        $tDeddoc = CYTSecureDAOFactory::getDeddocDAO()->getTableName();
        $tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();

        $fields[] = "$tCategoria.cd_categoria as " . $tCategoria . "_oid ";
        $fields[] = "$tCategoria.ds_categoria as " . $tCategoria . "_ds_categoria ";

        $fields[] = "$tCargo.cd_cargo as " . $tCargo . "_oid ";
        $fields[] = "$tCargo.ds_cargo as " . $tCargo . "_ds_cargo ";

        $fields[] = "$tDeddoc.cd_deddoc as " . $tDeddoc . "_oid ";
        $fields[] = "$tDeddoc.ds_deddoc as " . $tDeddoc . "_ds_deddoc ";

        $fields[] = "$tFacultad.cd_facultad as " . $tFacultad . "_oid ";
        $fields[] = "$tFacultad.ds_facultad as " . $tFacultad . "_ds_facultad ";

        /*$tUser = CYT_TABLE_CDT_USER;
		$fields[] = "$tUser.oid";
        $fields[] = "CASE $tUser.ds_name WHEN '' THEN $tUser.ds_username ELSE $tUser.ds_name END AS ds_username";*/

        $tUser = CYTSecureDAOFactory::getUserDAO()->getTableName();
        $fields[] = "$tUser.oid AS ".$tUser."_oid";
        $fields[] = "CASE $tUser.ds_name WHEN '' THEN $tUser.ds_username ELSE $tUser.ds_name END AS ds_username";

        $tCarrerainv = CYTSecureDAOFactory::getCarrerainvDAO()->getTableName();
        $fields[] = "$tCarrerainv.cd_carrerainv as " . $tCarrerainv . "_oid ";
        $fields[] = "$tCarrerainv.ds_carrerainv as " . $tCarrerainv . "_ds_carrerainv ";

        $tOrganismo = CYTSecureDAOFactory::getOrganismoDAO()->getTableName();
        $fields[] = "$tOrganismo.cd_organismo as " . $tOrganismo . "_oid ";
        $fields[] = "$tOrganismo.ds_codigo as " . $tOrganismo . "_ds_codigo ";



        return $fields;
    }

    public function deleteIntegranteEstadoPorIntegrante($integrante_oid, $idConn=0) {

        $db = CdtDbManager::getConnection( $idConn );



        $tableName = $this->getTableName();

        $sql = "DELETE FROM $tableName WHERE integrante_oid = $integrante_oid ";

        // CdtUtils::log($sql, __CLASS__,LoggerLevel::getLevelDebug());

        $result = $db->sql_query($sql);
        if (!$result)//hubo un error en la bbdd.
            throw new DBException($db->sql_error());
    }

}
?>