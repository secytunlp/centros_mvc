<?php

/**
 * Acción para inicializar el contexto
 * para editar una unidad.
 *
 * @author Marcos
 * @since 10-10-2013
 *
 */

class UpdateUnidadInitAction extends UpdateEntityInitAction {

	
	protected function getEntity(){

		$entity = parent::getEntity();

		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getOid(), '=');
		$oCriteria->addNull('fechaHasta');
		$managerUnidadTipoEstado =  ManagerFactory::getUnidadTipoEstadoManager();
		$oUnidadTipoEstado = $managerUnidadTipoEstado->getEntity($oCriteria);
		if (($oUnidadTipoEstado->getTipoEstado()->getOid()!=CYT_ESTADO_UNIDAD_CREADA)) {
			
			throw new GenericException( CYT_MSG_UNIDAD_MODIFICAR_PROHIBIDO);
		}
			
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getOid(), '=');
		//facultades.
		$facultadesManager = new UnidadFacultadManager();
		$entity->setFacultades( $facultadesManager->getEntities($oCriteria) );
		
		
			
		
		return $entity;
	}
	
	protected function parseEntity($entity, XTemplate $xtpl) {

		$manager = new UnidadFacultadSessionManager();
		$manager->setEntities( $entity->getFacultades() );
		
		
		
		parent::parseEntity($entity, $xtpl);
		
	}
	
	protected function getEntityManager(){
		return ManagerFactory::getUnidadManager();
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewFormInstance()
	 */
	public function getNewFormInstance($action){
		$form = new CMPUnidadForm($action);
		$findTipUnidad = $form->getInput("tipoUnidad.oid");
		//$findTipUnidad->setIsEditable(false);
		return $form;
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
	 * @see CdtEditAction::getOutputTitle();
	 */
	protected function getOutputTitle(){
		return CYT_MSG_UNIDAD_TITLE_UPDATE;
	}

	/**
	 * retorna el action para el submit.
	 * @return string
	 */
	protected function getSubmitAction(){
		return "update_unidad";
	}


}