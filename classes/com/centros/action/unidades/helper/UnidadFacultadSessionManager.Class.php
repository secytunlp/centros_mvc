<?php

/**
 * Helper manager para administrar en sesión las facultades de una unidad
 *  
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadFacultadSessionManager extends EntityManager{

	public function getDAO(){
		return new UnidadFacultadSessionDAO();
	}
	
	public function deleteAll() {
    	$this->getDAO()->deleteAll();
    }
    
    public function setEntities( $entities ) {
    	$this->getDAO()->setEntities($entities);
    }
    
    protected function validateOnAdd(Entity $entity){
    	
    	//TODO validaciones	
    }
    
	protected function validateOnUpdate(Entity $entity){
		//TODO validaciones
	}

	protected function validateOnDelete($id){
		//TODO validaciones
	}	
}

?>
