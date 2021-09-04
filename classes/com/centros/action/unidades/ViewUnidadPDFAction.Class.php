<?php

/**
 * Acción para exportar a pdf una unidad.
 *
 * @author Marcos
 * @since 05-11-203
 *
 */
class ViewUnidadPDFAction extends CdtAction{

	
	/**
	 * (non-PHPdoc)
	 * @see CdtAction::execute()
	 */
	public function execute(){

		//armamos el pdf con la data necesaria.
		$pdf = new ViewUnidadPDF();
		
		$oid = CdtUtils::getParam('id');
		
		$pdf->setOid($oid);
		
		$oUnidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $oUnidadManager->getObjectByCode($oid);
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $oUnidad->getOid(), '=');
		$oCriteria->addNull('fechaHasta');
		$managerUnidadTipoEstado =  ManagerFactory::getUnidadTipoEstadoManager();
		$unidadTipoEstado = $managerUnidadTipoEstado->getEntity($oCriteria);
		$pdf->setTipoEstado_oid($unidadTipoEstado->getTipoEstado()->getOid());
		$pdf->setTipo($oUnidad->getTipoUnidad()->getNombre());
		$pdf->setEspecialidad($oUnidad->getEspecialidad());
		$pdf->setDenominacion($oUnidad->getDenominacion());
		$pdf->setSigla($oUnidad->getSigla());
		$pdf->setObjetivos($oUnidad->getObjetivos());
		$pdf->setLineas($oUnidad->getLineas());
		$pdf->setJustificacion($oUnidad->getJustificacion());
		$pdf->setProduccion($oUnidad->getProduccion());
		$pdf->setProyectos($oUnidad->getProyectos());
		$pdf->setRrhh($oUnidad->getRrhh());
		$pdf->setFunciones($oUnidad->getFunciones());
		$pdf->setInfraestructura($oUnidad->getInfraestructura());
		$pdf->setEquipamiento($oUnidad->getEquipamiento());
		
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $oUnidad->getOid(), '=');
		//facultades.
		$facultadesManager = new UnidadFacultadManager();
		$pdf->setFacultades( $facultadesManager->getEntities($oCriteria) );
		
		$pdf->title = CYT_MSG_UNIDAD_PDF_TITLE;
		$pdf->SetFont('Arial','', 10);
		
		// establecemos los márgenes
		$pdf->SetMargins(10, 20 , 10);
		$pdf->SetAutoPageBreak(true,90);
		$pdf->AddPage();
		$pdf->AliasNbPages();
		//imprimimos el certificado.
		$pdf->printUnidad();
		
		
		$pdf->AddPage();
		$pdf->tablaIntegrantes();
		
		$pdf->Output();

		//para que no haga el forward.
		$forward = null;

		return $forward;
	}


}