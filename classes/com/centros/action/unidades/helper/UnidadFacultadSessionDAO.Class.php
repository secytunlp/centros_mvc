<?php

/**
 * Helper DAO para administrar en sesión las facultades de una 
 * unidad.
 *  
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadFacultadSessionDAO extends EntityDAO {

	public function getFieldsToAdd($entity){}
	
	public function getFieldsToUpdate($entity){}
	
	public function getId($entity){}
		
	public function getIdFieldName(){}
	
	public function setId($entity, $id){}
	
	public function getTableName(){}
	
	public function getEntityFactory(){}
	
	public function getVariableSessionName(){
		return "unidad_facultades";
	}
	
    /**
     * se persiste la nueva entity
     * @param $entity entity a persistir.
     */
    public function addEntity( $entity, $idConn=0 ) {
    	
    	$facultades = unserialize( $_SESSION[ $this->getVariableSessionName() ] );
    	
    	if( empty($facultades) )
    		$facultades = new ItemCollection();
    	if (!$facultades->existObjectComparator($entity, new FacultadComparator())) {	
        	$facultades->addItem($entity);
    	}
        
        $_SESSION[$this->getVariableSessionName()] = serialize($facultades);
        
    }
    
    /**
     */
    public function setEntities( $entities, $idConn=0 ) {
    	
        $_SESSION[$this->getVariableSessionName()] = serialize($entities);
        
    }
    
    /**
     * se modifica la entity
     * @param $entity entity a modificar.
     */
    public function updateEntity($entity, $idConn=0) {
        //TODO
    }

    /**
     * se elimina la entity
     * @param $id identificador de la entity a eliminar.
     */
    public function deleteEntity($oid, $idConn=0) {
    	
    	$oid = urldecode($oid);
    	
    	$unidadesFacultades = unserialize( $_SESSION[$this->getVariableSessionName()] );
    	
    	//el oid representaría la facultad??
    	$nuevasUnidadesFacultades = new ItemCollection();
    	foreach ($unidadesFacultades as $unidadFacultad) {
    		
    		if( $unidadFacultad->getFacultad()->getOid() != $oid ){
    			$nuevasUnidadesFacultades->addItem($unidadFacultad);
    		}
    	}
    	
        $_SESSION[$this->getVariableSessionName()] = serialize($nuevasUnidadesFacultades);
    	
    }

    /**
     * quitamos todos los facultades de sesión
     */
    public function deleteAll() {
    	unset( $_SESSION[$this->getVariableSessionName()] ) ;
    	
    }
    /**
     * se obtiene una colección de entities dado el filtro de búsqueda
     * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
     * @return ItemCollection
     */
    public function getEntities(CdtSearchCriteria $oCriteria, $idConn=0) {

    	if(isset($_SESSION[$this->getVariableSessionName()]))
			$facultades = unserialize( $_SESSION[$this->getVariableSessionName()] );
		else 
			$facultades = new ItemCollection();	

		return $facultades;
    }

    /**
     * se obtiene la cantidad de entities dado el filtro de búsqueda
     * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
     * @return int
     */
    public function getEntitiesCount(CdtSearchCriteria $oCriteria, $idConn=0) {
        
    	$facultades = unserialize($this->getVariableSessionName() );

        return $facultades->size();
    }

    /**
     * se obtiene un entity dado el filtro de búsqueda
     * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
     * @return Entity
     */
    public function getEntity(CdtSearchCriteria $oCriteria, $idConn=0) {
		//TODO
    }
	
	public function getEntityById($id) {
		//TODO
    }
		
}
?>