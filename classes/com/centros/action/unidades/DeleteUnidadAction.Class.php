<?php

/**
 * Acción para eliminar unidades.
 *
 * @author Marcos
 * @since 29-10-2013
 *
 */
class DeleteUnidadAction extends DeleteEntityAction {

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/DeleteEntityAction::getEntityManager()
	 */
	protected function getEntityManager(){
		return ManagerFactory::getUnidadManager();
	}

	

}
