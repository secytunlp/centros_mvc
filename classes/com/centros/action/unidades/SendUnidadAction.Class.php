<?php

/**
 * Acción para enviar una unidad.
 *
 * @author Marcos
 * @since 18-10-2016
 *
 */
class SendUnidadAction extends CdtEditAsyncAction {

	
    protected function getEntity() {
    	if (date('Y-m-d')>CYT_FECHA_CIERRE) {
			throw new GenericException( CYT_MSG_FIN_PERIODO );
		}
        $entity = null;

		//recuperamos dado su identifidor.
		$oid = CdtUtils::getParam('id');
			
		if (!empty( $oid )) {
						
			$manager = $this->getEntityManager();
			$entity = $manager->getEntityById($oid);
		}else{
		
			$entity = parent::getEntity();
		
		}
		
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getOid(), '=');
		$oCriteria->addNull('fechaHasta');
		$managerUnidadTipoEstado =  ManagerFactory::getUnidadTipoEstadoManager();
		$oUnidadTipoEstado = $managerUnidadTipoEstado->getEntity($oCriteria);
		if (($oUnidadTipoEstado->getTipoEstado()->getOid()!=CYT_ESTADO_UNIDAD_CREADA)) {
			
			throw new GenericException( CYT_MSG_UNIDAD_ENVIAR_PROHIBIDO);
		}
		
    	
		
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getOid(), '=');
		
		//becas.
		$facultadesManager = ManagerFactory::getUnidadFacultadManager();
		$entity->setFacultades( $facultadesManager->getEntities($oCriteria) );
		
		
		
		return $entity;
    }

    /**
     * (non-PHPdoc)
     * @see CdtEditAsyncAction::edit();
     */
    protected function edit($entity) {
        $this->getEntityManager()->send($entity);
    }
    
	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/DeleteEntityAction::getEntityManager()
	 */
	protected function getEntityManager(){
		return ManagerFactory::getUnidadManager();
	}


}