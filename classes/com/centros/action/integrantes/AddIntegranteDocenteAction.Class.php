<?php

/**
 * Se trae el docente
 * 
 * @author Marcos
 * @since 05-11-2013
 *
 */
class AddIntegranteDocenteAction extends CdtAction{


	/**
	 * (non-PHPdoc)
	 * @see CdtAction::execute();
	 */
	public function execute(){

		
		$result = "";
		
		try{
			
			$cd_docente = CdtUtils::getParam("cd_docente");
			
			
			$docente = array();
			
			$docenteManager = CYTSecureManagerFactory::getDocenteManager();
			$oDocente = $docenteManager->getObjectByCode($cd_docente);
			
			$result['apellido']=$oDocente->getDs_apellido();
			$result['nombre']=$oDocente->getDs_nombre();
			$result['cuil']=$oDocente->getNu_precuil().'-'.str_pad($oDocente->getNu_documento(), 8, "0", STR_PAD_LEFT).'-'.$oDocente->getNu_postcuil();
			$result['mail']=$oDocente->getDs_mail();
			$result['telefono']=$oDocente->getNu_telefono();
			$result['categoria_oid']=$oDocente->getCategoria()->getOid();
			$result['carrerainv_oid']=$oDocente->getCarreraInv()->getOid();
			$result['organismo_oid']=$oDocente->getOrganismo()->getOid();
			$result['cargo_oid']=$oDocente->getCargo()->getOid();
			$result['deddoc_oid']=$oDocente->getDedDoc()->getOid();
			$result['facultad_oid']=$oDocente->getFacultad()->getOid();
			//$result['lugarTrabajo_oid']=$oDocente->getLugarTrabajo()->getOid();
			
			$result['beca']=($oDocente->getBl_becario())?$oDocente->getDs_tipobeca().' '.$oDocente->getDs_orgbeca():'';
	
	
			
			
		}catch(Exception $ex){
			
			$result['error'] = $ex->getMessage();
			
		}

		echo json_encode( $result ); 
		return null;
	}
	
	
	
}