<?php

/**
 * Formato para renderizar los archivos en las grillas
 *
 * @author Marcos
 * @since 18-11-2013
 *
 */
class GridFilesValueFormat extends GridValueFormat {

	public function __construct() {

		parent::__construct();
	}

	public function format($value, $item=null) {

		$oManagerUnidad = ManagerFactory::getUnidadManager();
		$oUnidad = $oManagerUnidad->getObjectByCode($value);
		$adjuntos = '';
		$dir = APP_PATH.CYT_PATH_PDFS.'/'.$oUnidad->getSigla().'/';
		$dirREL = WEB_PATH.CYT_PATH_PDFS.'/'.$oUnidad->getSigla().'/';
		if (file_exists($dir)){
				
		      
		     $handle=opendir($dir);
				while ($archivo = readdir($handle))
				{
			        if ((is_file($dir.$archivo))&&(!strchr($archivo,CYT_MSG_UNIDAD_ARCHIVO_NOMBRE)&&(!strchr($archivo,CYT_MSG_EVALUACION_ARCHIVO_NOMBRE))))
			         {
			         	$adjuntos .='<a href="'.$dirREL.$archivo.'" target="_blank"><img class="hrefImg" src="'.WEB_PATH.'css/images/file.jpg" title="'.$archivo.'" /></a>';
			         	
			         	}
						
				}
				closedir($handle);
			}
		
		
		
		 
		return $adjuntos ;
	}

}