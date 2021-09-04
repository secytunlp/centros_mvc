<?php

/**
 * Formato para renderizar los archivos en las grillas
 *
 * @author Marcos
 * @since 20-10-2016
 *
 */
class GridCVValueFormat extends GridValueFormat {

	public function __construct() {

		parent::__construct();
	}

	public function format($value, $item=null) {

		$oManagerIntegrante = ManagerFactory::getIntegranteManager();
		$oIntegrante = $oManagerIntegrante->getObjectByCode($value);
		
		//CYTSecureUtils::logObject($oIntegrante->getUnidad());
		$adjuntos = '';
		
		$oManagerUnidad = ManagerFactory::getUnidadManager();
		$oUnidad = $oManagerUnidad->getObjectByCode($oIntegrante->getUnidad()->getOid());
		
		$dir = APP_PATH.CYT_PATH_PDFS.'/'.$oUnidad->getSigla().'/'.CYT_PATH_PDFS_INTEGRANTES.'/';
		$dirREL = WEB_PATH.CYT_PATH_PDFS.'/'.$oUnidad->getSigla().'/'.CYT_PATH_PDFS_INTEGRANTES.'/';
		if (file_exists($dir)){
				
		     
	     	$handle=opendir($dir);
			while ($archivo = readdir($handle))
			{
		        if (is_file($dir.$archivo)&&(strchr($archivo,CYTSecureUtils::stripAccents(stripslashes(str_replace("'","_",$oIntegrante->getApellido()))))))
		         {
		         	$adjuntos .='<a href="'.$dirREL.$archivo.'" target="_blank"><img class="hrefImg" src="'.WEB_PATH.'css/images/file.jpg" title="'.$archivo.'"  /></a>';
		         	
		         	}
			}
			closedir($handle);
		}		
				
		
		 
		return $adjuntos ;
	}

}