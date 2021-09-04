<?php

/**
 * Acción para dar de alta un tipo de Unidad
 *
 * @author Marcos
 * @since 17-10-2013
 *
 */
class AddTipoUnidadAction extends AddEntityAction{

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityAction::getNewFormInstance()
	 */
	public function getNewFormInstance(){
		return new CMPTipoUnidadForm();
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityAction::getNewEntityInstance()
	 */
	public function getNewEntityInstance(){
		return new TipoUnidad();
	}

	protected function getEntityManager(){
		return ManagerFactory::getTipoUnidadManager();
	}



	


}
