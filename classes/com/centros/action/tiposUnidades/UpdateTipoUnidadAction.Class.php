<?php

/**
 * Acción para actualizar un tipo de Unidad
 *
 * @author Marcos
 * @since 17-10-2013
 *
 */
class UpdateTipoUnidadAction extends UpdateEntityAction{

	public function getNewFormInstance(){
		return new CMPTipoUnidadForm();
	}

	public function getNewEntityInstance(){
		return new TipoUnidad();
	}

	protected function getEntityManager(){
		return ManagerFactory::getTipoUnidadManager();
	}

	/*
	 protected function getInfoMessage( $entity, $result ){
		$msg = "El cliente " . $entity->getNombre() . " fue actualizado satisfactoriamente";
		CdtUtils::setRequestInfo(1, $msg);
		return $msg;
		}*/

	/**
	 * (non-PHPdoc)
	 * @see CdtEditAction::getForwardSuccess();
	 */
	protected function getForwardSuccess(){
		return 'update_tipoUnidad_success';
	}

	/**
	 * (non-PHPdoc)
	 * @see CdtEditAction::getForwardError();
	 */
	protected function getForwardError(){
		return 'update_tipoUnidad_error';
	}



}
