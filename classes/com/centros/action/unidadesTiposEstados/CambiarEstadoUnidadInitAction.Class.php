<?php

/**
 * Acción para inicializar el contexto
 * para cambiar el estado de una unidad
 *
 * @author Marcos
 * @since 11-10-2013
 *
 */

class CambiarEstadoUnidadInitAction extends EditEntityInitAction {

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewFormInstance()
	 */
	public function getNewFormInstance($action){
		return new CMPCambiarEstadoUnidadForm($action);
		
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewEntityInstance()
	 */
	public function getNewEntityInstance(){
		$cambiarEstadoUnidad = new CambiarEstadoUnidad();
		
		$filter = new CMPUnidadTipoEstadoFilter();
		$filter->fillSavedProperties();
		$cambiarEstadoUnidad->setUnidad($filter->getUnidad());
	
		
		
		return $cambiarEstadoUnidad;
	}

	/**
	 * (non-PHPdoc)
	 * @see CdtEditAction::getOutputTitle();
	 */
	protected function getOutputTitle(){
		return CYT_MSG_UNIDAD_TIPO_ESTADO_CAMBIAR;
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getSubmitAction()
	 */
	protected function getSubmitAction(){
		return "cambiarEstadoUnidad";
	}


}
