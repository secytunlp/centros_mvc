<?php

/**
 * Manager para Unidad Facultad
 *  
 * @author Marcos
 * @since 23-10-2013
 */
class UnidadFacultadManager extends EntityManager{

	public function getDAO(){
		return DAOFactory::getUnidadFacultadDAO();
	}

	public function add(Entity $entity) {
    	
		parent::add($entity);
		
    }	
    
     public function update(Entity $entity) {
     	
     	
		parent::update($entity);
     }

    
    
    
	/**
     * se elimina la entity
     * @param int identificador de la entity a eliminar.
     */
    public function delete($id) {
        
		parent::delete( $id );
		
    	
    }
	
	
	
	
}
?>
