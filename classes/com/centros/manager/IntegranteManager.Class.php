<?php

/**
 * Manager para Integrante
 *  
 * @author Marcos
 * @since 30-10-2013
 */
class IntegranteManager extends EntityManager{

	public function getDAO(){
		return DAOFactory::getIntegranteDAO();
	}
	
	
	
	/**
     * se elimina la entity
     * @param int identificador de la entity a eliminar.
     */
    public function delete($id) {
    	$integranteManager = ManagerFactory::getintegranteManager();
		$oIntegrante = $integranteManager->getObjectByCode($id);

		$dir = CYT_PATH_PDFS.'/';
		
		$unidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $unidadManager->getObjectByCode($oIntegrante->getUnidad()->getOid());
		$dir .= $oUnidad->getSigla().'/';
		$dir .= CYT_PATH_PDFS_INTEGRANTES.'/';
		 
    	
    	
    	
	   $handle=opendir($dir);
		while ($archivo = readdir($handle)){
	        if ((is_file($dir.$archivo))&&(strchr($archivo,CYTSecureUtils::stripAccents(stripslashes(str_replace("'","_",$oIntegrante->getApellido())))))){
	         	unlink($dir.$archivo);
			}
		}
		closedir($handle);
    	
	        
    	parent::delete( $id );
    	
    	
		
		
		
    }
	
	
 /**
	 * (non-PHPdoc)
	 * @see classes/com/entities/manager/EntityManager::validateOnAdd()
	 */
    protected function validateOnAdd(Entity $entity){
    	
    	parent::validateOnAdd($entity);
    	$error='';
    	$separarCUIL = explode('-',trim($entity->getCuil()));

		$preCuil = $separarCUIL[0]; 
		$documento = $separarCUIL[1]; 
		$posCuil = $separarCUIL[2]; 
    	
    	if ((strlen($preCuil)!=2)||(strlen($posCuil)!=1)) {
    		$error .=CYT_MSG_INTEGRANTE_CUIL_FORMAT.'<br />';
    	}
    	/*if ((in_array($entity->getTipoIntegrante()->getOid(),  explode(",",CYT_TIPO_INTEGRANTE_DIRECTOR)))&&(!in_array($entity->getCategoria()->getOid(),  explode(",",CYT_CATEGORIA_DIRECTOR)))) {
    		$error .=CYT_SECURE_MSG_ACTIVATION_DIRECTOR_ERROR_CATEGORIA;
    	}*/
    	if (in_array($entity->getTipoIntegrante()->getOid(),  explode(",",CYT_TIPO_INTEGRANTE_DIRECTOR))){
    		$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter('unidad_oid', $entity->getUnidad()->getOid(), '=');
			$oCriteria->addFilter('activo', 1, '=');
			$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
			$filter = new CdtSimpleExpression( "(".$tTipoIntegrante.".oid IN(".CYT_TIPO_INTEGRANTE_DIRECTOR."))");
			$oCriteria->setExpresion($filter);
			$oCriteria->addNull('fechaHasta');
			$managerIntegrante = ManagerFactory::getIntegranteManager();
			$oDirector = $managerIntegrante->getEntity($oCriteria);
			if (!empty($oDirector)) {
				$error .=CYT_MSG_DIRECTOR_ERROR_CANTIDAD.'<br />';
			}
    	}
    	if (in_array($entity->getTipoIntegrante()->getOid(),  explode(",",CYT_TIPO_INTEGRANTE_SUBDIRECTOR))){
    		$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter('unidad_oid', $entity->getUnidad()->getOid(), '=');
			$oCriteria->addFilter('activo', 1, '=');
			$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
			$filter = new CdtSimpleExpression( "(".$tTipoIntegrante.".oid IN(".CYT_TIPO_INTEGRANTE_SUBDIRECTOR."))");
			$oCriteria->setExpresion($filter);
			$oCriteria->addNull('fechaHasta');
			$managerIntegrante = ManagerFactory::getIntegranteManager();
			$oDirector = $managerIntegrante->getEntity($oCriteria);
			if (!empty($oDirector)) {
				$error .=CYT_MSG_SUBDIRECTOR_ERROR_CANTIDAD.'<br />';
			}
    	}
    	$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getUnidad()->getOid(), '!=');
		$oCriteria->addFilter('cuil', $entity->getCuil(), '=', new CdtCriteriaFormatStringValue());
		$oCriteria->addFilter('activo', 1, '=');
		$oCriteria->addNull('fechaHasta');
		$managerIntegrante = ManagerFactory::getIntegranteManager();
		$integrantes = $managerIntegrante->getEntities($oCriteria);
		foreach ($integrantes as $integrante) {
			$error .=CYT_MSG_INTEGRANTE_OTRA_UNIDAD.$integrante->getUnidad()->getDenominacion().'<br />';
		}
    	
    	if ($error) {
    		throw new GenericException( $error );
    	}
    }
    
    /**
     * (non-PHPdoc)
     * @see classes/com/entities/manager/EntityManager::validateOnUpdate()
     */
	protected function validateOnUpdate(Entity $entity){
	
		parent::validateOnUpdate($entity);

	$error='';
    	$separarCUIL = explode('-',trim($entity->getCuil()));

		$preCuil = $separarCUIL[0]; 
		$documento = $separarCUIL[1]; 
		$posCuil = $separarCUIL[2]; 
    	
    	if ((strlen($preCuil)!=2)||(strlen($posCuil)!=1)) {
    		$error .=CYT_MSG_INTEGRANTE_CUIL_FORMAT.'<br />';
    	}
    	
    	
    	if ($error) {
    		throw new GenericException( $error );
    	}
		
	}
	
	

}
?>
