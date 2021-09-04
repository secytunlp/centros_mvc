<?php

/**
 * Acción para inicializar el contexto
 * para editar un integrante.
 *
 * @author Marcos
 * @since 30-10-2013
 *
 */

class AddIntegranteInitAction extends EditEntityInitAction {

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewFormInstance()
	 */
	public function getNewFormInstance($action){
		
		
		

		return new CMPIntegranteForm($action);
		
	}
	
	/**
     * (non-PHPdoc)
     * @see CdtEditInitAction::parseEntity();
     */
    protected function parseEntity($entity, XTemplate $xtpl) {

        $entity = CdtFormatUtils::ifEmpty($entity, $this->getNewEntityInstance());

        $this->getForm()->fillInputValues($entity);
        
     
		$oUnidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $oUnidadManager->getObjectByCode($entity->getUnidad()->getOid());
		

		$inputCombo =  $this->getForm()->getInput("tipoIntegrante.oid");
		$inputCombo->setOptions( CYTUtils::getTiposIntegranteItems($oUnidad->getTipoUnidad()->getOid()) );
        
		
		$this->getForm()->addHidden(FieldBuilder::buildInputHidden ( "hiddenApellido", ""));
        $xtpl->assign('formulario', $this->getForm()->show() );
        
    }

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewEntityInstance()
	 */
	public function getNewEntityInstance(){
		$oIntegrante = new Integrante();
		
		$filter = new CMPIntegranteFilter();
		$filter->fillSavedProperties();
		$oIntegrante->setUnidad($filter->getUnidad());
		$unidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $unidadManager->getObjectByCode($filter->getUnidad()->getOid());
		$oIntegrante->setLugarTrabajo($oUnidad->getDenominacion().' - '.$oUnidad->getSigla());
		return $oIntegrante;
	}

	/**
	 * (non-PHPdoc)
	 * @see CdtEditAction::getOutputTitle();
	 */
	protected function getOutputTitle(){
		return CYT_MSG_INTEGRANTE_TITLE_ADD;
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getSubmitAction()
	 */
	protected function getSubmitAction(){
		return "add_integrante";
	}


}
