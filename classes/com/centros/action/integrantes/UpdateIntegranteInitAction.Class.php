<?php

/**
 * Acción para inicializar el contexto
 * para editar un integrante.
 *
 * @author Marcos
 * @since 31-10-2013
 *
 */

class UpdateIntegranteInitAction extends UpdateEntityInitAction {

	
	protected function getEntity(){

		$entity = parent::getEntity();

		/*$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getUnidad()->getOid(), '=');
		$oCriteria->addNull('fechaHasta');
		$managerUnidadTipoEstado =  ManagerFactory::getUnidadTipoEstadoManager();
		$oUnidadTipoEstado = $managerUnidadTipoEstado->getEntity($oCriteria);
		if (($oUnidadTipoEstado->getTipoEstado()->getOid()!=CYT_ESTADO_UNIDAD_CREADA)) {
			
			throw new GenericException( CYT_MSG_UNIDAD_MODIFICAR_PROHIBIDO);
		}*/
			
		
		
			
		
		return $entity;
	}
	
	
	
	protected function getEntityManager(){
		return ManagerFactory::getIntegranteManager();
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewFormInstance()
	 */
	public function getNewFormInstance($action){
		
		return new CMPIntegranteUpDateForm($action);
	}
	
	protected function parseEntity($entity, XTemplate $xtpl) {

        $entity = CdtFormatUtils::ifEmpty($entity, $this->getNewEntityInstance());

        $this->getForm()->fillInputValues($entity);
        
     
		$oUnidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $oUnidadManager->getObjectByCode($entity->getUnidad()->getOid());
		

		$inputCombo =  $this->getForm()->getInput("tipoIntegrante.oid");
		$inputCombo->setOptions( CYTUtils::getTiposIntegranteItems($oUnidad->getTipoUnidad()->getOid()) );
		$oUser = CdtSecureUtils::getUserLogged();
		
		if ($oUser->getDs_username()==$entity->getCuil()) {
			$inputCombo->setIsEditable(false);
			$this->getForm()->addHidden(FieldBuilder::buildInputHidden ( "tipoIntegrante.oid", $entity->getTipoIntegrante()->getOid()));
		}
		
		//$this->getForm()->addHidden(FieldBuilder::buildInputHidden ( "hiddenApellido", ""));
        $xtpl->assign('formulario', $this->getForm()->show() );
        
    }

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewEntityInstance()
	 */
	public function getNewEntityInstance(){
		return new Integrante();
	}


	/**
	 * (non-PHPdoc)
	 * @see CdtEditAction::getOutputTitle();
	 */
	protected function getOutputTitle(){
		return CYT_MSG_INTEGRANTE_TITLE_UPDATE;
	}

	/**
	 * retorna el action para el submit.
	 * @return string
	 */
	protected function getSubmitAction(){
		return "update_integrante";
	}


}