<?php

/**
 * Acción para actualizar un integrante
 *
 * @author Marcos
 * @since 31-10-2013
 *
 */
class UpdateIntegranteAction extends UpdateEntityAction{

	protected function getEntity() {
	
		$entity =  parent::getEntity();
		
		$error = '';
		$dir = CYT_PATH_PDFS.'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		$unidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $unidadManager->getObjectByCode($entity->getUnidad()->getOid());
		$dir .= $oUnidad->getSigla().'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		$dir .= CYT_PATH_PDFS_INTEGRANTES.'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		
		if(isset($_SESSION['archivos'])){
			$archivos = unserialize( $_SESSION['archivos'] );
			
			foreach ($archivos as $key => $archivo) {
				//CdtUtils::log("FILE: "   . $key.' - '.$archivo['name']);
				switch ($key) {
            		case 'curriculum':
            		$nombre = CYT_LBL_INTEGRANTE_CURRICULUM;
            		$sigla = CYT_LBL_INTEGRANTE_CURRICULUM_SIGLA;
            		break;
	            }
	            $sigla .= '_'.CYTSecureUtils::stripAccents(stripslashes(str_replace("'","_",$entity->getApellido())));
				$explode_name = explode('.', $archivo['name']);
	            //Se valida así y no con el mime type porque este no funciona par algunos programas
	            $pos_ext = count($explode_name) - 1;
	            if (in_array(strtolower($explode_name[$pos_ext]), explode(",",CYT_EXTENSIONES_PERMITIDAS))) {
	            	CdtUtils::log("FILE: "   . $key.' - '.$archivo['name']);
	            	//$siglaRemp = (($key=='ds_aceptacion')&&($entity->getBl_congreso()==CYT_CD_CONFERENCIA))?CYT_LBL_SOLICITUD_A_INVITACION_SIGLA:$sigla;
	            	if (is_file($dir.$archivo['nuevo'])){

	            		rename ($dir.$archivo['nuevo'],$dir.str_replace('TMP_'.$sigla, $sigla, $archivo['nuevo'])); 
	            		
	            	}
	            	CdtReflectionUtils::doSetter( $entity, $key, str_replace('TMP_'.$sigla, $sigla, $archivo['nuevo']) );
	            }
	            else {
	            	
	            	$error .=CYT_MSG_FORMATO_INVALIDO.$nombre.'<br />';
	            }
			}
		}
		unset($_SESSION['archivos']);
		$handle=opendir($dir);
		while ($archivo = readdir($handle)){
	        if ((is_file($dir.$archivo))&&(strchr($archivo,'TMP_'))){
	         	unlink($dir.$archivo);
			}
		}
		closedir($handle);
		if ($error) {
			throw new GenericException( $error );
		}
	
		
		
		
	
		return $entity;
	}
	
	public function getNewFormInstance(){
		return new CMPIntegranteUpDateForm();
	}

	public function getNewEntityInstance(){
		$oIntegrante = new Integrante();
		$oUser = CdtSecureUtils::getUserLogged();
		$oIntegrante->setUser($oUser);
		$oIntegrante->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));
		return $oIntegrante;
	}

	protected function getEntityManager(){
		return ManagerFactory::getIntegranteManager();
	}



	



}
