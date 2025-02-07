<?php

/**
 * Acción para exportar a pdf una solicitud.
 *
 * @author Marcos
 * @since 16-11-2016
 *
 */
class ViewSolicitudPDFAction extends CdtAction{

	
	/**
	 * (non-PHPdoc)
	 * @see CdtAction::execute()
	 */
	public function execute(){
		
		
		$oid = CdtUtils::getParam('id');
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('oid', $oid, '=');
		$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
		$oIntegranteManager = ManagerFactory::getIntegranteManager();
		$oIntegrante = $oIntegranteManager->getEntity($oCriteria);
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('integrante_oid', $oIntegrante->getOid(), '=');
		$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
		$managerIntegranteEstado =  ManagerFactory::getIntegranteEstadoManager();
		$oIntegranteEstado = $managerIntegranteEstado->getEntity($oCriteria);
		$pdf = new ViewSolicitudPDF();
		
		if ($oIntegranteEstado->getEstado()->getOid()==CYT_ESTADO_INTEGRANTE_ADMITIDO){
			throw new GenericException( CYT_MSG_INTEGRANTE_VER_PROHIBIDO);
		}
		
		//armamos el pdf con la data necesaria.
		$pdf->setYear(CYT_YEAR);
		$pdf->setEstadoOid($oIntegranteEstado->getEstado()->getOid());
		/*$pdf->setMes(CYT_PERIODO);
		$ds_tipointegrante = ($oIntegrante->getTipoIntegrante()->getOid()==CYT_INTEGRANTE_COLABORADOR)?'COLABORADOR':'INTEGRANTE';
		
		$pdf->setDs_tipointegrante($ds_tipointegrante);*/
		
		$pdf->setTipointegrante($oIntegrante->getTipoIntegrante()->getNombre());
		
		$oUnidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $oUnidadManager->getObjectByCode($oIntegrante->getUnidad()->getOid());
		
		//$pdf->setDs_facultad($oProyecto->getFacultad()->getDs_facultad());
		
		$pdf->setDenominacion($oUnidad->getDenominacion());
		

	
		$pdf->setSigla($oUnidad->getSigla());

        $oCriteria = new CdtSearchCriteria();
        $oCriteria->addFilter('tipoUnidad_oid', $oUnidad->getTipoUnidad()->getOid(), '=');
        $oCriteria->addFilter('nombre', 'Director', '=', new CdtCriteriaFormatStringValue());
        $managerTipoIntegrante =  ManagerFactory::getTipoIntegranteManager();
        $oTipoIntegrante = $managerTipoIntegrante->getEntity($oCriteria);

        $oCriteria = new CdtSearchCriteria();
        $oCriteria->addFilter('tipoIntegrante_oid', $oTipoIntegrante->getOid(), '=');


        $pdf->setTipoUnidad( $oUnidad->getTipoUnidad()->getNombre());

        $managerIntegrante =  ManagerFactory::getIntegranteManager();
        $oDirector = $managerIntegrante->getEntity($oCriteria);

	
		$pdf->setDirector($oDirector->getApellido().', '.$oDirector->getNombre());
		
		switch ($oIntegranteEstado->getEstado()->getOid()) {
			case CYT_ESTADO_INTEGRANTE_ALTA_CREADA:
				$ds_tipo = 'ALTA';
			break;
			case CYT_ESTADO_INTEGRANTE_ALTA_RECIBIDA:
				$ds_tipo = 'ALTA';
			break;

			case CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO:
				$ds_tipo = 'CAMBIO';
			break;
			case CYT_ESTADO_INTEGRANTE_CAMBIO_RECIBIDO:
				$ds_tipo = 'CAMBIO';
			break;

			
		}
		
		$pdf->setTipo($ds_tipo);
		
		//$pdf->setDocente_oid($oIntegrante->getDocente()->getOid());
		
		$pdf->setInvestigador($oIntegrante->getApellido().', '.$oIntegrante->getNombre());
		
		$pdf->setCuil($oIntegrante->getCuil());
        $pdf->setActivo($oIntegrante->getActivo());
	
		$pdf->setCategoria($oIntegrante->getCategoria()->getDs_categoria());
		

	
		$pdf->setCargo($oIntegrante->getCargo()->getDs_cargo());
		

		
		$pdf->setDeddoc($oIntegrante->getDeddoc()->getDs_deddoc());

		$pdf->setFacultadintegrante($oIntegrante->getFacultad()->getDs_facultad());
	

	
		$pdf->setCarrinv($oIntegrante->getCarreraInv()->getDs_carrerainv());

		$pdf->setOrganismo($oIntegrante->getOrganismo()->getDs_codigo());
		
		$pdf->setBeca($oIntegrante->getBeca());
		

		
		$pdf->setHoras($oIntegrante->getHoras());
	

	
	/*private $dt_baja = "";
	
	private $ds_consecuencias = "";
	
	private $ds_motivos = "";
	
	
	
	private $dt_cargo = "";
	
	private $dt_beca = "";
	
	private $nu_materias = "";
	
	private $nu_horasinvAnt = "";
	
	private $ds_reduccionHS = "";
	
	private $minhstotales = "";*/
		
    	
		$pdf->title = CYT_MSG_SOLICITUD_PDF_TITLE;
		$pdf->SetFont('Arial','', 13);
		
		// establecemos los márgenes
		$pdf->SetMargins(10, 20 , 10);
		$pdf->setMaxWidth($pdf->w - $pdf->lMargin - $pdf->rMargin);
		//$pdf->SetAutoPageBreak(true,90);
		$pdf->AddPage();
		$pdf->AliasNbPages();
		
		//imprimimos la solicitud.
		$pdf->printSolicitud();
		
		$pdf->Output();

		//para que no haga el forward.
		$forward = null;

		return $forward;
	}


}