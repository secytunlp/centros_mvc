<?php

/**
 * Acción para actualizar una unidad
 *
 * @author Marcos
 * @since 25-10-2013
 *
 */
class UpdateUnidadAction extends UpdateEntityAction{

	protected function getEntity() {
		
		$entity =  parent::getEntity();
		
		$error = '';
		$dir = CYT_PATH_PDFS.'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		$dir .= $entity->getSigla().'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		$dir = CYT_PATH_PDFS.'/';
		if ($entity->getSigla()!=$_POST['siglaAnt']) {
			//exec("mv ".$_POST['siglaAnt']."/ ".$dir.$entity->getSigla());
			$handle=opendir($dir.'/'.$_POST['siglaAnt'].'/');
			while ($archivo = readdir($handle)){
				if (is_file($dir.$_POST['siglaAnt'].'/'.$archivo)){
					copy ($dir.$_POST['siglaAnt'].'/'.$archivo, $dir.$entity->getSigla().'/'.$archivo);
					unlink($dir.$_POST['siglaAnt'].'/'.$archivo);
				}
			}
			rmdir($dir.$_POST['siglaAnt']);
			
		}
		
		$dir = CYT_PATH_PDFS.'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		$dir .= $entity->getSigla().'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		
		if(isset($_SESSION['archivos'])){
			$archivos = unserialize( $_SESSION['archivos'] );
			
			foreach ($archivos as $key => $archivo) {
				//CdtUtils::log("FILE: "   . $key.' - '.$archivo['name']);
				switch ($key) {
            		case 'ds_curriculum':
            		$nombre = CYT_LBL_INTEGRANTE_CURRICULUM;
            		$sigla = CYT_LBL_INTEGRANTE_CURRICULUM_SIGLA;
            		break;
            		case 'reglamento':
            		$nombre = CYT_LBL_UNIDAD_REGLAMENTO;
            		$sigla = CYT_LBL_UNIDAD_REGLAMENTO_SIGLA;
            		break;
            		case 'memorias':
            		$nombre = CYT_LBL_UNIDAD_MEMORIAS;
            		$sigla = CYT_LBL_UNIDAD_MEMORIAS_SIGLA;
            		break;
	            }
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
		
	
		//agregamos las facultades relacionadas a la unidad.
		
		//facultades.
		$facultadesManager = new UnidadFacultadSessionManager();
		$entity->setFacultades( $facultadesManager->getEntities(new CdtSearchCriteria()) );
		
		
	
		return $entity;
	}
	
	public function getNewFormInstance(){
		return new CMPUnidadForm();
	}

	public function getNewEntityInstance(){
		$oUnidad = new Unidad();
		$oUser = CdtSecureUtils::getUserLogged();
		$oUnidad->setUserUlt($oUser);
		$oUnidad->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));
		return $oUnidad;
	}

	protected function getEntityManager(){
		return ManagerFactory::getUnidadManager();
	}



	



}
