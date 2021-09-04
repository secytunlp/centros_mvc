<?php 

/**
 * Acción para quitar una facultad de unidad.
 * Es sólo en sesión para ir armando la unidad.
 * 
 * @author Marcos
 * @since 21-10-2013
 * 
 */
class DeleteUnidadFacultadSessionAction extends EditEntityAction{

	protected function edit( $entity ){
		
		$facultad = CdtUtils::getParam("item_oid");
		
		//el oid representa el dato "facultad" ya que no hay entity relacionada
		$this->getEntityManager()->delete( $facultad );

		
		//vamos a retornar por json las facultades de la unidad.
		
		//usamos el renderer para reutilizar lo que mostramos de las facultades.
		$renderer = new CMPUnidadFormRenderer();
		$facultades = array();
		foreach ($this->getEntityManager()->getEntities(new CdtSearchCriteria()) as $facultad) {
			
			$facultades[] = $renderer->buildArrayFacultad($facultad);
		}		
		
		return array("facultades" => $facultades, 
						"facultadColumns" => $renderer->getFacultadColumns(),
						"facultadColumnsAlign" => $renderer->getFacultadColumnsAlign(),
						"facultadColumnsLabels" => $renderer->getFacultadColumnsLabels());
	}


	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityAction::getNewFormInstance()
	 */
	public function getNewFormInstance(){
		return new CMPUnidadFacultadForm();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see classes/com/gestion/action/entities/EditEntityAction::getNewEntityInstance()
	 */
	public function getNewEntityInstance(){
		return new UnidadFacultad();
	}
	
	protected function getEntityManager(){
		return new UnidadFacultadSessionManager();
	}

}
