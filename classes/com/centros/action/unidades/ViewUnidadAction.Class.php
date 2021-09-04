<?php

/**
 * Acción para visualizar una unidad.
 *
 * @author Marcos
 * @since 08-11-2013
 *
 */
class ViewUnidadAction extends UpdateEntityInitAction {


	protected function getEntity(){

		$entity = parent::getEntity();

		
			
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getOid(), '=');
		//facultades.
		$facultadesManager = new UnidadFacultadManager();
		$entity->setFacultades( $facultadesManager->getEntities($oCriteria) );
		
		
			
		
		return $entity;
	}
	
	
	protected function parseEntity($entity, XTemplate $xtpl) {

		$this->getForm()->setIsEditable( false );

		parent::parseEntity($entity, $xtpl);
		
		$xtpl->assign('fechaUltModificacion_label', CYT_LBL_INTEGRANTE_FECHA_ULTIMA_MODIFICACION);
		$xtpl->assign('input_fechaUltModificacion', 'fechaUltModificacion');
		$xtpl->assign('fechaUltModificacion_value', CYTSecureUtils::formatDateTimeToView($entity->getFechaUltModificacion()));
		$xtpl->assign('usuario_label', CYT_LBL_INTEGRANTE_USUARIO_ULTIMA_MODIFICACION);
		$xtpl->assign('input_usuario', 'user_oid');
		$xtpl->assign('usuario_value', $entity->getUserUlt()->getDs_username());
		
	}

	/**
	 * (non-PHPdoc)
	 * @see CdtOutputAction::getLayout();
	 */
	protected function getLayout() {
		$oLayout = new CdtLayoutBasicAjax();
		return $oLayout;
	}

	protected function getEntityManager(){
		return ManagerFactory::getUnidadManager();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewFormInstance()
	 */
	public function getNewFormInstance($action){
		return new CMPUnidadForm($action);
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewEntityInstance()
	 */
	public function getNewEntityInstance(){
		return new Unidad();
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see CdtOutputAction::getOutputTitle();
	 */
	protected function getOutputTitle() {
		return CYT_MSG_UNIDAD_TITLE_VIEW;
	}

	/**
     * (non-PHPdoc)
     * @see CdtEditInitAction::getXTemplate();
     */
    protected function getXTemplate() {
        return new XTemplate(CYT_TEMPLATE_INTEGRANTE_VIEW);
    }	
    
	/**
	 * retorna el action para el submit.
	 * @return string
	 */
	protected function getSubmitAction(){
		return "update_unidad";
	}
}