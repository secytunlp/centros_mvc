<?php

/**
 * Acción para cambiar el estado de la unidad
 *
 * @author Marcos
 * @since 07-11-2013
 *
 */
class CambiarEstadoUnidadAction extends AddEntityAction{

	/**
	 * (non-PHPdoc)
	 * @see CdtEditAction::edit();
	 */
	protected function edit( $entity ){
		
		$this->getEntityManager()->cambiarEstado($entity->getUnidad(),$entity->getTipoEstado(),$entity->getMotivo() );
		$result["oid"] = $entity->getOid();		
		return $result;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityAction::getNewFormInstance()
	 */
	public function getNewFormInstance(){
		return new CMPCambiarEstadoUnidadForm();
	}

	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityAction::getNewEntityInstance()
	 */
	public function getNewEntityInstance(){
		
		return new CambiarEstadoUnidad();
	}

	protected function getEntityManager(){
		return ManagerFactory::getUnidadManager();
	}



	


}
