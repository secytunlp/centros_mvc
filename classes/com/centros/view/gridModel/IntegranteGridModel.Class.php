<?php

/**
 * GridModel para Integrante
 *
 * @author Marcos
 * @since 30-10-2013
 */
class IntegranteGridModel extends GridModel {

	public function __construct() {

		parent::__construct();
		$this->initModel();
	}

	protected function initModel() {

		
		
		$column = GridModelBuilder::buildColumn( "oid", CYT_LBL_ENTITY_OID, 20, CDT_CMP_GRID_TEXTALIGN_RIGHT );
		$this->addColumn( $column );
		$this->addFilter( GridModelBuilder::buildFilterModelFromColumn( $column ) );
		
		$tUnidad = DAOFactory::getUnidadDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "unidad.denominacion,unidad.sigla", CYT_LBL_UNIDAD, 60, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tUnidad.denominacion,$tUnidad.sigla" );
		$this->addColumn( $column );
		
		$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "tipoIntegrante.nombre", CYT_LBL_INTEGRANTE_TIPO_INTEGRANTE, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tTipoIntegrante.nombre" );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "apellido,nombre", CYT_LBL_DOCENTE, 50, CDT_CMP_GRID_TEXTALIGN_LEFT, "nombre,apellido" ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "cuil", CYT_LBL_INTEGRANTE_CUIL, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "cuil" );
		$this->addColumn( $column );
		
		$tCategoria = CYTSecureDAOFactory::getCategoriaDAO()->getTableName();
		$column = GridModelBuilder::buildColumn( "categoria.ds_categoria", CYT_LBL_INTEGRANTE_CATEGORIA, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "$tCategoria.ds_categoria" );
		$this->addColumn( $column );

        $tCategoriasicadi = CYTSecureDAOFactory::getCategoriasicadiDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "categoriasicadi.ds_categoriasicadi", CYT_LBL_INTEGRANTE_CATEGORIA_SICADI, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "$tCategoriasicadi.ds_categoriasicadi" );
        $this->addColumn( $column );
		
		$tCarrerainv = CYTSecureDAOFactory::getCarrerainvDAO()->getTableName();
		$tOrganismo = CYTSecureDAOFactory::getOrganismoDAO()->getTableName();
		$column = GridModelBuilder::buildColumn( "carrerainv.ds_carrerainv,organismo.ds_codigo", CYT_LBL_INTEGRANTE_CARRERAINV, 60, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tCarrerainv.ds_categoria,$tOrganismo.ds_codigo" );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "beca", CYT_LBL_INTEGRANTE_BECA, 20, CDT_CMP_GRID_TEXTALIGN_LEFT, "beca" );
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
		
		/*$tLugarTrabajo = CYTSecureDAOFactory::getLugarTrabajoDAO()->getTableName();
		$column = GridModelBuilder::buildColumn( "lugarTrabajo.ds_unidad,lugarTrabajo.ds_sigla", CYT_LBL_INTEGRANTE_LUGAR_TRABAJO, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tLugarTrabajo.ds_unidad,$tLugarTrabajo.ds_sigla" );
		$this->addColumn( $column );*/
		
		$column = GridModelBuilder::buildColumn( "estudiante", CYT_LBL_INTEGRANTE_ESTUDIANTE, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "estudiante",new GridBoolValueFormat() );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "horas", CYT_LBL_INTEGRANTE_HORAS, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "horas" );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "activo", CYT_LBL_INTEGRANTE_ACTIVO, 20, CDT_CMP_GRID_TEXTALIGN_CENTER, "activo",new GridBoolValueFormat() );
		$this->addColumn( $column );

        $tEstado = DAOFactory::getEstadoIntegranteDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "estado.ds_estado", CYT_LBL_TIPO_ESTADO, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tEstado.ds_estado" );
        $this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "oid", CYT_LBL_UNIDAD_ARCHIVOS, 60, CDT_CMP_GRID_TEXTALIGN_RIGHT,"",new GridCVValueFormat() ) ;
		$this->addColumn( $column );
		//acciones sobre la lista
		$this->buildAction("add_integrante_init", "add_integrante_init", CYT_MSG_INTEGRANTE_TITLE_ADD, "image", "add");
	}

	/**
	 * (non-PHPdoc)
	 * @see GridModel::getTitle();
	 */
	function getTitle() {
		return CYT_MSG_INTEGRANTE_TITLE_LIST;
	}

	/**
	 * (non-PHPdoc)
	 * @see GridModel::getEntityManager();
	 */
	public function getEntityManager() {
		return ManagerFactory::getIntegranteManager();
	}

	/**
	 * (non-PHPdoc)
	 * @see GridModel::getRowActionsModel( $item );
	 */
	public function getRowActionsModel($item) {
		//return $this->getDefaultRowActions($item, "integrante", CYT_LBL_INTEGRANTE, true, true, true, false, 500, 750);
        $actions = new ItemCollection();


        $action = $this->buildRowAction( "update_integrante_init", "update_integrante_init", CYT_LBL_EDITAR , CDT_UI_IMG_EDIT, "edit") ;
        $actions->addItem( $action );


        /*$action =  $this->buildDeleteAction( $item, "integrante", CYT_LBL_INTEGRANTE, $this->getMsgConfirmDelete( $item ), false ) ;
        $actions->addItem( $action );*/




        $oUser = CdtSecureUtils::getUserLogged();


        if (CdtSecureUtils::hasPermission ( $oUser, CYT_FUNCTION_ENVIAR_SOLICITUD )) {
            $action = $this->buildRowAction("send_solicitud_integrante", "send_solicitud_integrante", CYT_LBL_ENVIAR, CDT_UI_IMG_SEARCH, "view", "delete_items('send_solicitud_integrante')", false, $this->getMsgConfirmSend(CYT_MSG_SOLICITUD_ENVIAR_PREGUNTA));
            $actions->addItem($action);
            $action =  $this->buildRowAction( "anular_solicitud_integrante_init", "anular_solicitud_integrante_init", CYT_LBL_INTEGRANTE_ANULAR, CDT_UI_IMG_EDIT, "delete") ;
            $actions->addItem($action);
        }


        $action = $this->buildRowAction( "view_solicitud_integrante_pdf", "view_solicitud_integrante_pdf", CDT_UI_LBL_EXPORT_PDF, CDT_UI_IMG_SEARCH, "view") ;
        $action->setBl_targetblank(true);
        $actions->addItem( $action );

        if (CdtSecureUtils::hasPermission ( $oUser, CYT_FUNCTION_ADMITIR_SOLICITUD )) {
            $action =  $this->buildRowAction( "admit_solicitud_integrante", "admit_solicitud_integrante", CYT_LBL_ADMITIR, CDT_UI_IMG_SEARCH, "view", "delete_items('admit_solicitud_integrante')", true, $this->getMsgConfirmAdmit()) ;
            $actions->addItem( $action );
        }

        if (CdtSecureUtils::hasPermission ( $oUser, CYT_FUNCTION_RECHAZAR_SOLICITUD )) {
            $action =  $this->buildRowAction( "deny_solicitud_integrante_init", "deny_solicitud_integrante_init", CYT_LBL_RECHAZAR, CDT_UI_IMG_SEARCH, "view") ;
            $actions->addItem( $action );
        }

        if (CdtSecureUtils::hasPermission ( $oUser, CYT_FUNCTION_LISTAR_ESTADO )) {

            $action = $this->buildRowAction("list_integrantesEstado", "list_integrantesEstado", CYT_MSG_SOLICITUD_ESTADO_TITLE_LIST, CDT_CMP_GRID_MSG_VIEW, "attach" ) ;
            $actions->addItem( $action );

        }


        return $actions;
	}

    protected function getMsgConfirmSend( $msg ){

        return CdtFormatUtils::quitarEnters($msg);
    }

    protected function getMsgConfirmAdmit(  ){

        $msg = CYT_MSG_SOLICITUD_ADMITIR_PREGUNTA;
        return CdtFormatUtils::quitarEnters($msg);
    }


}
?>