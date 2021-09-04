<?php

/**
 * Acción para eliminar tipo de Unidad.
 *
 * @author Marcos
 * @since 17-10-2013
 *
 */
class DeleteTipoUnidadAction extends DeleteEntityAction {

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/DeleteEntityAction::getEntityManager()
	 */
	protected function getEntityManager(){
		return ManagerFactory::getTipoUnidadManager();
	}

	

}
