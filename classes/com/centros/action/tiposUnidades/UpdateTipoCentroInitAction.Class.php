<?php

/**
 * Acción para inicializar el contexto
 * para editar un tipo de Unidad.
 *
 * @author Marcos
 * @since 17-10-2013
 *
 */

class UpdateTipoUnidadInitAction extends UpdateEntityInitAction {

	protected function getEntityManager(){
		return ManagerFactory::getTipoUnidadManager();
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewFormInstance()
	 */
	public function getNewFormInstance($action){
		return new CMPTipoUnidadForm($action);
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityInitAction::getNewEntityInstance()
	 */
	public function getNewEntityInstance(){
		return new TipoUnidad();
	}


	/**
	 * (non-PHPdoc)
	 * @see CdtEditAction::getOutputTitle();
	 */
	protected function getOutputTitle(){
		return CYT_MSG_TIPO_Unidad_TITLE_UPDATE;
	}

	/**
	 * retorna el action para el submit.
	 * @return string
	 */
	protected function getSubmitAction(){
		return "update_tipoUnidad";
	}


}
