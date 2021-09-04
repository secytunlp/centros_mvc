<?php

/**
 * GridModel para Unidad
 *
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadGridModel extends GridModel {

	public function __construct() {

		parent::__construct();
		$this->initModel();
	}

	protected function initModel() {

		
		
		$column = GridModelBuilder::buildColumn( "oid", CYT_LBL_ENTITY_OID, 20, CDT_CMP_GRID_TEXTALIGN_RIGHT );
		$this->addColumn( $column );
		$this->addFilter( GridModelBuilder::buildFilterModelFromColumn( $column ) );
		
		$tTipoUnidad = DAOFactory::getTipoUnidadDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "tipoUnidad.nombre", CYT_LBL_UNIDAD_TIPO_UNIDAD, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tTipoUnidad.nombre" );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "denominacion,sigla", CYT_LBL_UNIDAD_DENOMINACION, 80, CDT_CMP_GRID_TEXTALIGN_LEFT, "denominacion,sigla" );
		
		$this->addColumn( $column );
		$this->addFilter( GridModelBuilder::buildFilterModel( "denominacion", CYT_LBL_UNIDAD_DENOMINACION) );
		
		$column = GridModelBuilder::buildColumn( "especialidad", CYT_LBL_UNIDAD_ESPECIALIDAD, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "especialidad" );
		$this->addColumn( $column );

		//$tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "facultad", CYT_LBL_UNIDAD_FACULTADES, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "facultad" );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "dt_disposicion", CYT_LBL_UNIDAD_FECHA_DISPOSICION, 30, CDT_CMP_GRID_TEXTALIGN_CENTER, null, new GridDateValueFormat(CYT_DATE_FORMAT) ); 
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "nu_disposicion", CYT_LBL_UNIDAD_NRO_DISPOSICION, 20, CDT_CMP_GRID_TEXTALIGN_LEFT, "especialidad" );
		$this->addColumn( $column );
		
		
		$tTipoEstado = DAOFactory::getTipoEstadoDAO()->getTableName();
        $column = GridModelBuilder::buildColumn( "tipoEstado.nombre", CYT_LBL_TIPO_ESTADO, 40, CDT_CMP_GRID_TEXTALIGN_LEFT, "$tTipoEstado.nombre" );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "oid", CYT_LBL_UNIDAD_ARCHIVOS, 60, CDT_CMP_GRID_TEXTALIGN_RIGHT,"",new GridFilesValueFormat() ) ;
		$this->addColumn( $column );
		
		//acciones sobre la lista
		$this->buildAction("add_unidad_init", "add_unidad_init", CYT_MSG_UNIDAD_TITLE_ADD, "image", "add");
	}

	/**
	 * (non-PHPdoc)
	 * @see GridModel::getTitle();
	 */
	function getTitle() {
		return CYT_MSG_UNIDAD_TITLE_LIST;
	}

	/**
	 * (non-PHPdoc)
	 * @see GridModel::getEntityManager();
	 */
	public function getEntityManager() {
		return ManagerFactory::getUnidadManager();
	}

	/**
	 * (non-PHPdoc)
	 * @see GridModel::getRowActionsModel( $item );
	 */
	public function getRowActionsModel($item) {
		//return $this->getDefaultRowActions($item, "unidad", CYT_LBL_UNIDAD, true, true, true, false, 500, 750);
		$actions = new ItemCollection();
	
		$oUser = CdtSecureUtils::getUserLogged();
		if ($oUser->getCd_usergroup()!=CDT_SECURE_USERGROUP_DEFAULT_ID) {
			$action = $this->buildViewAction( $item, "unidad", CYT_LBL_UNIDAD) ;
			//$actions->addItem( $this->buildViewAction( "view_unidad", "view_unidad", CDT_CMP_GRID_MSG_VIEW . " ".CYT_LBL_UNIDAD) );
			$actions->addItem( $action );
		}
		
		$action = $this->buildRowAction( "update_unidad_init", "update_unidad_init", CDT_CMP_GRID_MSG_EDIT . " ".CYT_LBL_UNIDAD, CDT_UI_IMG_EDIT, "edit") ;
		$actions->addItem( $action );
		
		
		$action =  $this->buildDeleteAction( $item, "unidad", CYT_LBL_UNIDAD, $this->getMsgConfirmDelete( $item ), false ) ;
		$actions->addItem( $action );
		
		$action = $this->buildRowAction("list_integrantes", "list_integrantes", CYT_MSG_INTEGRANTE_TITLE_LIST, CDT_CMP_GRID_MSG_VIEWCDT_UI_IMG_SEARCH, "attach" ) ;
		$actions->addItem( $action );
		
		$action = $this->buildRowAction( "view_unidad_pdf", "view_unidad_pdf", CDT_UI_LBL_EXPORT_PDF . " ".CYT_LBL_UNIDAD, CDT_UI_IMG_SEARCH, "view") ;
		$action->setBl_targetblank(true);
		$actions->addItem( $action );
		
		
		if ($oUser->getCd_usergroup()==CDT_SECURE_USERGROUP_DEFAULT_ID) {
			$action =  $this->buildRowAction( "send_unidad", "send_unidad", CYT_LBL_ENVIAR, CDT_UI_IMG_SEARCH, "view", "delete_items('send_unidad')", false, $this->getMsgConfirmSend(CYT_MSG_UNIDAD_ENVIAR_PREGUNTA)) ;
			$actions->addItem( $action );
		}
		
		if ($oUser->getCd_usergroup()!=CDT_SECURE_USERGROUP_DEFAULT_ID) {
			
			$action = $this->buildRowAction("list_unidadesTipoEstado", "list_unidadesTipoEstado", CYT_MSG_UNIDAD_TIPO_ESTADO_TITLE_LIST, CDT_CMP_GRID_MSG_VIEWCDT_UI_IMG_SEARCH, "attach" ) ;
			$actions->addItem( $action );
			
		}
		
		return $actions;
	}

	
	protected function getMsgConfirmSend( $msg ){
		
		return CdtFormatUtils::quitarEnters($msg);
	}
	
	protected function getMsgConfirmAdmit(  ){
		
		$msg = CYT_MSG_UNIDAD_ADMITIR_PREGUNTA;
		return CdtFormatUtils::quitarEnters($msg);
	}	

}
?>