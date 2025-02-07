<?php

/**
 * GridModel para Integrante Estado
 *
 * @author Marcos
 * @since 16-11-2013
 */
class IntegranteEstadoGridModel extends GridModel {

    public function __construct() {

        parent::__construct();
        $this->initModel();
    }

    protected function initModel() {



        $column = GridModelBuilder::buildColumn( "oid", CYT_LBL_ENTITY_OID, 20, CDT_CMP_GRID_TEXTALIGN_RIGHT );
        $this->addColumn( $column );


        $tEstado = CYTSecureDAOFactory::getEstadoDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "estado.ds_estado", CYT_LBL_ESTADO, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tEstado.ds_estado" );
        $this->addColumn( $column );

        $tUnidad = DAOFactory::getUnidadDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "unidad.denominacion,unidad.sigla", CYT_LBL_UNIDAD, 20, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tUnidad.denominacion,$tUnidad.sigla" );
        $this->addColumn( $column );

        $tIntegrante = DAOFactory::getIntegranteDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "integrante.apellido,integrante.nombre", CYT_LBL_DOCENTE, 50, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tIntegrante.apellido,$tIntegrante.nombre" ) ;
        $this->addColumn( $column );


        $tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "tipoIntegrante.nombre", CYT_LBL_TIPO_INTEGRANTE, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tTipoIntegrante.nombre" );
        $this->addColumn( $column );

        $tCategoria = CYTSecureDAOFactory::getCategoriaDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "categoria.ds_categoria", CYT_LBL_INTEGRANTE_CATEGORIA, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "$tCategoria.ds_categoria" );
        $this->addColumn( $column );

        $tCargo = CYTSecureDAOFactory::getCargoDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "cargo.ds_cargo", CYT_LBL_INTEGRANTE_CARGO, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tCargo.ds_cargo" );
        $this->addColumn( $column );

        $tDeddoc = CYTSecureDAOFactory::getDeddocDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "deddoc.ds_deddoc", CYT_LBL_INTEGRANTE_DEDDOC, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tDeddoc.ds_deddoc" );
        $this->addColumn( $column );

        $tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "facultad.ds_facultad", CYT_LBL_INTEGRANTE_FACULTAD, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tFacultad.ds_facultad" );
        $this->addColumn( $column );




        $tCarrerainv = CYTSecureDAOFactory::getCarrerainvDAO()->getTableName();
        $tOrganismo = CYTSecureDAOFactory::getOrganismoDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "carrerainv.ds_carrerainv,organismo.ds_codigo", CYT_LBL_INTEGRANTE_CARRERAINV, 60, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tCarrerainv.ds_categoria,$tOrganismo.ds_codigo" );
        $this->addColumn( $column );

        $column = GridModelBuilder::buildColumn( "beca", CYT_LBL_INTEGRANTE_BECA, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "beca" );
        $this->addColumn( $column );


        $column = GridModelBuilder::buildColumn( "horas", CYT_LBL_INTEGRANTE_HORAS, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "horas" );
        $this->addColumn( $column );

        $column = GridModelBuilder::buildColumn( "activo", CYT_LBL_INTEGRANTE_ACTIVO, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "activo",new GridBoolValueFormat() );
        $this->addColumn( $column );

        $column = GridModelBuilder::buildColumn( "fechaDesde", CYT_LBL_SOLICITUD_ESTADO_FECHA_DESDE, 30, CDT_CMP_GRID_TEXTALIGN_CENTER, null, new GridDateValueFormat(CYT_DATETIME_FORMAT) );
        $this->addColumn( $column );

        $column = GridModelBuilder::buildColumn( "fechaHasta", CYT_LBL_SOLICITUD_ESTADO_FECHA_HASTA, 30, CDT_CMP_GRID_TEXTALIGN_CENTER, null, new GridDateValueFormat(CYT_DATETIME_FORMAT) );
        $this->addColumn( $column );

        $column = GridModelBuilder::buildColumn( "motivo", CYT_LBL_SOLICITUD_ESTADO_MOTIVO, 40 );
        $this->addColumn( $column );

        $tUser = CYT_TABLE_CDT_USER;
        $column = GridModelBuilder::buildColumn( "user.ds_username", CYT_LBL_SOLICITUD_ESTADO_USUARIO_ULTIMA_MODIFICACION, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tUser.ds_username" );
        $this->addColumn( $column );

        $column = GridModelBuilder::buildColumn( "fechaUltModificacion", CYT_LBL_SOLICITUD_ESTADO_FECHA_ULTIMA_MODIFICACION, 30, CDT_CMP_GRID_TEXTALIGN_CENTER, null, new GridDateValueFormat(CYT_DATETIME_FORMAT) );
        $this->addColumn( $column );

        //acciones sobre la lista
        //$this->buildAction("cambiarEstadoIntegrante_init", "cambiarEstadoIntegrante_init", CYT_MSG_SOLICITUD_ESTADO_CAMBIAR, "image", "edit");

    }

    /**
     * (non-PHPdoc)
     * @see GridModel::getTitle();
     */
    function getTitle() {
        return CYT_MSG_SOLICITUD_ESTADO_TITLE_LIST;
    }

    /**
     * (non-PHPdoc)
     * @see GridModel::getEntityManager();
     */
    public function getEntityManager() {
        return ManagerFactory::getIntegranteEstadoManager();
    }

    /**
     * (non-PHPdoc)
     * @see GridModel::getRowActionsModel( $item );
     */
    public function getRowActionsModel($item) {



        //$actions = $this->getDefaultRowActions($item, "matriculado", CPIQ_LBL_MATRICULADO, false, true, true, false, 500, 750);

        $actions = new ItemCollection();



        return $actions;
    }


}
?>