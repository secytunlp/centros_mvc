<?php

/**
 * PDF de Unidad
 * 
 * @author Marcos
 * @since 05/11/2103
 */
class ViewUnidadPDF extends CdtPDFPrint{

	private $tipoEstado_oid = "";
	
	private $oid = "";
	
	private $tipo = "";
	
	private $denominacion = "";
	
	private $sigla = "";
	
	private $objetivos = "";
	
	private $especialidad;
	  
		  
	private $lineas;
	  
	private $justificacion;
	
	
	  
	private $funciones;
	  
	private $produccion;
	  
	private $proyectos;
	  
	private $rrhh;
	
	private $infraestructura;
	
	private $equipamiento;
	
	private $observaciones;
	
	
	private $facultades= ""; 
	
	public function __construct(){
		
		parent::__construct();
		
		$this->setFacultades(new ItemCollection());
		
	}
	
	function printUnidad(  ){
	
		
		$maxWidth = ($this->w) - $this->lMargin - $this->rMargin;		
			
		
		$this->initFontLabel();
		$this->Cell(30,5, $this->encodeCharacters(CYT_LBL_UNIDAD_TIPO_UNIDAD.': ') ,0,0,'L');
		$this->initFontValue();
		$this->Cell($maxWidth,5, $this->encodeCharacters($this->getTipo()) ,0,0,'L');
		$this->Ln(8);
		$this->initFontLabel();
		$this->Cell(30,5, $this->encodeCharacters(CYT_LBL_UNIDAD_DENOMINACION.': ') ,0,0,'L');
		$this->initFontValue();
		$this->MultiCell( $maxWidth, 4, $this->encodeCharacters($this->getDenominacion().' - '.$this->getSigla()),0, 'L');
		$this->Ln(4);
		$this->initFontLabel();
		$this->Cell(30,5, $this->encodeCharacters(CYT_LBL_UNIDAD_ESPECIALIDAD.': ') ,0,0,'L');
		$this->initFontValue();
		$this->Cell($maxWidth,5, $this->encodeCharacters($this->getEspecialidad()) ,0,0,'L');
		$this->Ln(8);
		$this->Cell ( $maxWidth, 2, '','B');
		$this->ln(2);
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_TIPO_INTEGRANTE_DIRECTOR) ,0,0,'L');
		$this->Ln(8);
		
		$oCriteria = new CdtSearchCriteria();
		
		$oCriteria->addFilter("unidad_oid", $this->getOid(), '=');
		$oCriteria->addFilter("activo", 1, '=');
		
		$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
		$filter = new CdtSimpleExpression( "(".$tTipoIntegrante.".oid IN(".CYT_TIPO_INTEGRANTE_DIRECTOR."))");
		$oCriteria->setExpresion($filter);
		$oCriteria->addNull('fechaHasta');
		$managerIntegrante = ManagerFactory::getIntegranteManager();
		$oDirector = $managerIntegrante->getEntity($oCriteria);
		
		$this->Director($oDirector);
		
		$oCriteria = new CdtSearchCriteria();
		
		$oCriteria->addFilter("unidad_oid", $this->getOid(), '=');
		$oCriteria->addFilter("activo", 1, '=');
		
		$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
		$filter = new CdtSimpleExpression( "(".$tTipoIntegrante.".oid IN(".CYT_TIPO_INTEGRANTE_SUBDIRECTOR."))");
		$oCriteria->setExpresion($filter);
		$oCriteria->addNull('fechaHasta');
		$managerIntegrante = ManagerFactory::getIntegranteManager();
		$oSubDirector = $managerIntegrante->getEntity($oCriteria);
		if ($oSubDirector) {
			$this->initFontLabel();
			$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_TIPO_INTEGRANTE_SUBDIRECTOR) ,0,0,'L');
			$this->Ln(8);
			$this->Director($oSubDirector);
		}
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_FACULTADES) ,0,0,'L');
		$this->Ln(8);
		$this->Facultades();
		$anchoColumna = $maxWidth/3;
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_OBJETIVOS) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getObjetivos());
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_LINEAS) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getLineas());
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_JUSTIFICACION) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getJustificacion());
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_PRODUCCION) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getProduccion());
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_PROYECTOS) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getProyectos());
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_RRHH) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getRrhh());
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_FUNCIONES) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getFunciones());
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_INFRAESTRUCTURA) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getInfraestructura());
		
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_LBL_UNIDAD_EQUIPAMIENTO) ,0,0,'L');
		$this->Ln(4);
		
		$this->objetivos($this->getEquipamiento());
	}
	
	/**
	 * (non-PHPdoc)
	 * @see CdtPDFPrint#Header()
	 */
	function Header(){
		
		$this->SetTextColor(222, 234, 247);
		$this->SetDrawColor(1,1,1);
		$this->SetLineWidth(.1);
		$this->SetFont('Arial','B',36);
		if ($this->getTipoEstado_oid()==CYT_ESTADO_UNIDAD_CREADA) {
			$this->RotatedText($this->lMargin, $this->h - 10, $this->encodeCharacters('      '.CYT_MSG_UNIDAD_PDF_PRELIMINAR_TEXT.'       '.CYT_MSG_UNIDAD_PDF_PRELIMINAR_TEXT), 60);
		}
		
		
		//$this->SetY(20);
		
		$this->Image(WEB_PATH . 'css/images/image002.gif', $this->rMargin+10, $this->y-15);//, 60, 20);
	
		//$this->y = $this->y + 20;
		$this->SetX($this->lMargin);
		$maxWidth = ($this->w) - $this->lMargin - $this->rMargin;
	
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_MSG_UNIDAD_PDF_HEADER_TITLE.' - '.$this->getSigla()) ,0,0,'C');
		
		/*$this->Cell(15,5, $this->encodeCharacters(CPIQ_MSG_CERTIFICADO_ENCOMIENDA_SUBTITLE) ,1,0,'C');
		$this->Cell($maxWidth-125,5, $this->encodeCharacters($this->codigoEncomienda) ,1,0,'C');*/
		
		//Line break
		$this->Ln(10);
	}
	

	
	function Director(Integrante $integrante) {

		
		$maxWidth = ($this->w) - $this->lMargin - $this->rMargin;	
		$this->initFontLabel();
		$this->Cell ( 35, 5, CYT_LBL_INTEGRANTE_APELLIDO.' '.CYT_LBL_INTEGRANTE_NOMBRE.": ");
		$this->initFontValue();
		$this->Cell ( 90, 5, stripslashes($integrante->getApellido().', '.$integrante->getNombre()));
		$this->initFontLabel();
		$this->Cell ( 17, 5, CYT_LBL_INTEGRANTE_CUIL.": ");
		$this->initFontValue();
		$this->Cell ( 35, 5, $integrante->getCuil());
		$this->ln(6);
		$this->initFontLabel();
		$this->Cell ( 15, 5, CYT_LBL_INTEGRANTE_MAIL.": ");
		$this->initFontValue();
		$this->Cell ( 110, 5, stripslashes($integrante->getMail()));
		$this->initFontLabel();
		$this->Cell ( 20, 5, $this->encodeCharacters(CYT_LBL_INTEGRANTE_TELEFONO).": ");
		$this->initFontValue();
		$this->Cell ( 35, 5, $integrante->getTelefono());
		$this->ln(6);
		$this->initFontLabel();
		$this->initFontLabel();
		$this->Cell ( 20, 5, $this->encodeCharacters(CYT_LBL_INTEGRANTE_CATEGORIA).": ");
		$this->initFontValue();
		$this->Cell ( 85, 5, stripslashes($integrante->getCategoria()->getDs_categoria()));
		$this->ln(6);
		$this->initFontLabel();
		$this->Cell ( 40, 5, CYT_LBL_INTEGRANTE_CARGO.": ");
		$this->initFontValue();
		$this->Cell ( 85, 5, stripslashes($integrante->getCargo()->getDs_cargo()));
		$this->initFontLabel();
		$this->Cell ( 22, 5, $this->encodeCharacters(CYT_LBL_INTEGRANTE_DEDDOC).": ");
		$this->initFontValue();
		$this->Cell ( 35, 5, $integrante->getDeddoc()->getDs_deddoc());
		$this->ln(6);
		$this->initFontLabel();
		$this->Cell ( 20, 5, CYT_LBL_INTEGRANTE_FACULTAD.": ");
		$this->initFontValue();
		$this->Cell ( $maxWidth, 5, stripslashes($integrante->getFacultad()->getDs_facultad()));
		$this->ln(6);
		$this->initFontLabel();
		$this->Cell ( 40, 5, $this->encodeCharacters(CYT_LBL_INTEGRANTE_CARRERAINV).": ");
		$this->initFontValue();
		$this->Cell ( 85, 5, stripslashes($integrante->getCarrerainv()->getDs_carrerainv()));
		$this->initFontLabel();
		$this->Cell ( 22, 5, $this->encodeCharacters(CYT_LBL_INTEGRANTE_ORGANISMO).": ");
		$this->initFontValue();
		$this->Cell ( 35, 5, $integrante->getOrganismo()->getDs_codigo());
		$this->ln(6);
		$this->initFontLabel();
		$this->Cell ( 32, 5, CYT_LBL_INTEGRANTE_LUGAR_TRABAJO.": ");
		$this->initFontValue();
		$this->MultiCell( $maxWidth, 4, stripslashes($integrante->getLugarTrabajo()),0, 'L');
		$this->Cell ( $maxWidth, 2, '','B');
		$this->ln(2);
	}
	
	function Facultades() {

		
		$maxWidth = ($this->w) - $this->lMargin - $this->rMargin;
		$this->initFontValue();	
		foreach ($this->getFacultades() as $unidadFacultad) {
			
			$this->Cell ( $maxWidth, 5, stripslashes($unidadFacultad->getFacultad()->getDs_facultad()));
			$this->ln(6);
		}
		
		
		
		$this->Cell ( $maxWidth, 2, '','B');
		$this->ln(2);
	}
	
	
	function Objetivos($value) {

		
		$maxWidth = ($this->w) - $this->lMargin - $this->rMargin;
		$this->initFontValue();	
		
			
		$this->WriteHTML(stripslashes(($value)));
		
		$this->ln(6);
		
		$this->Cell ( $maxWidth, 2, '','B');
		$this->ln(2);
	}
	
	function tablaIntegrantes() {
		$maxWidth = ($this->w) - $this->lMargin - $this->rMargin;
		$this->initFontLabel();
		$this->Cell($maxWidth,5, $this->encodeCharacters(CYT_MSG_INTEGRANTE_TITLE_LIST) ,0,0,'L');
		$this->Ln(4);
		$this->SetFont('Arial','',8);
		$tablaIntegrantes .= '<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr><td bgcolor="#CCCCCC">Funci&oacute;n</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_APELLIDO.', '.CYT_LBL_INTEGRANTE_NOMBRE).'</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_CUIL).'</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_CATEGORIA).'</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_CARRERAINV).'</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_BECA).'</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_CARGO).'</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_DEDDOC).'</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_FACULTAD).'</td>
                <td bgcolor="#CCCCCC">'.htmlentities(CYT_LBL_INTEGRANTE_LUGAR_TRABAJO).'</td>
                <td bgcolor="#CCCCCC">'.CYT_LBL_INTEGRANTE_HORAS.'</td></tr></thead><tbody>';
				

		$oCriteria = new CdtSearchCriteria();
		
		$oCriteria->addFilter("unidad_oid", $this->getOid(), '=');
		$oCriteria->addFilter("activo", 1, '=');
		$oCriteria->addNull('fechaHasta');
		$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
		$oCriteria->addOrder($tTipoIntegrante.'.orden', 'ASC');
		$managerIntegrante = ManagerFactory::getIntegranteManager();
		$oIntegrantes = $managerIntegrante->getEntities($oCriteria);
		
		foreach ($oIntegrantes as $oIntegrante) {
			$tablaIntegrantes .= '<tr><td>'.htmlentities($oIntegrante->getTipoIntegrante()->getNombre()).'</td>';
			$tablaIntegrantes .= '<td>'.htmlentities($oIntegrante->getApellido().', '.$oIntegrante->getNombre()).'</td>';
			$tablaIntegrantes .= '<td>'.$oIntegrante->getCuil().'</td>';
			$tablaIntegrantes .= '<td>'.$oIntegrante->getCategoria()->getDs_categoria().'</td>';
			$tablaIntegrantes .= '<td>'.htmlentities($oIntegrante->getCarrerainv()->getDs_carrerainv().' - '.$oIntegrante->getOrganismo()->getDs_codigo()).'</td>';
			$tablaIntegrantes .= '<td>'.htmlentities($oIntegrante->getBeca()).'</td>';
			$tablaIntegrantes .= '<td>'.htmlentities($oIntegrante->getCargo()->getDs_cargo()).'</td>';
			$tablaIntegrantes .= '<td>'.$oIntegrante->getDeddoc()->getDs_deddoc().'</td>';
			$tablaIntegrantes .= '<td>'.htmlentities($oIntegrante->getFacultad()->getDs_facultad()).'</td>';
			$tablaIntegrantes .= '<td>'.htmlentities($oIntegrante->getLugarTrabajo()).'</td>';
			$tablaIntegrantes .= '<td>'.$oIntegrante->getHoras().'</td></tr>';
		}
		
		
		$tablaIntegrantes .= '</tbody></table>';
		$this->WriteHTML($tablaIntegrantes);
		$this->ln(6);
		
		$this->Cell ( $maxWidth, 2, '','B');
		$this->ln(2);
	}

	/**
	 * (non-PHPdoc)
	 * @see CdtPDFPrint#Footer()
	 */
	function Footer(){
		
		$this->SetY(-15);
		
		
		$this->SetFont('Arial','I',8);

		$this->Cell(0,10,$this->encodeCharacters(CYT_MSG_UNIDAD_PDF_PAGINA).' '.$this->PageNo().' '.CYT_MSG_UNIDAD_PDF_PAGINA_DE.' {nb}',0,0,'C');
		
	}

	
	
	function initFontLabel(){
		$this->SetFillColor(218,218,218);
		$this->SetTextColor(0);
		$this->SetDrawColor(1,1,1);
		$this->SetLineWidth(.1);
		$this->SetFont('Arial','B',11);
	}
	
	function initFontValue(){
		$this->SetFillColor(245);
		$this->SetTextColor(0);
		$this->SetFont('Arial','',10);
		
	}

	function addLineaLabelValue( $label, $value, $label_align="R", $value_align="L" ){

		$this->initFontLabel();
		   
	    $this->Cell(50,5, $label . ": ",1,0, $label_align);
	    
		$this->initFontValue();				
		$this->Cell(50,5, $value,1,0,$value_align);
	    $this->Ln();
	    
		//$this->LabelValue(50,10, $label, $value, $border=0, $align="R");
		
	}


	

	public function getTipoEstado_oid()
	{
	    return $this->tipoEstado_oid;
	}

	public function setTipoEstado_oid($tipoEstado_oid)
	{
	    $this->tipoEstado_oid = $tipoEstado_oid;
	}

	public function getObjetivos()
	{
	    return $this->objetivos;
	}

	public function setObjetivos($objetivos)
	{
	    $this->objetivos = $objetivos;
	}

	public function getTipo()
	{
	    return $this->tipo;
	}

	public function setTipo($tipo)
	{
	    $this->tipo = $tipo;
	}

	public function getDenominacion()
	{
	    return $this->denominacion;
	}

	public function setDenominacion($denominacion)
	{
	    $this->denominacion = $denominacion;
	}

	public function getSigla()
	{
	    return $this->sigla;
	}

	public function setSigla($sigla)
	{
	    $this->sigla = $sigla;
	}

	public function getOid()
	{
	    return $this->oid;
	}

	public function setOid($oid)
	{
	    $this->oid = $oid;
	}

	public function getFacultades()
	{
	    return $this->facultades;
	}

	public function setFacultades($facultades)
	{
	    $this->facultades = $facultades;
	}

	public function getEspecialidad()
	{
	    return $this->especialidad;
	}

	public function setEspecialidad($especialidad)
	{
	    $this->especialidad = $especialidad;
	}

	public function getLineas()
	{
	    return $this->lineas;
	}

	public function setLineas($lineas)
	{
	    $this->lineas = $lineas;
	}

	public function getJustificacion()
	{
	    return $this->justificacion;
	}

	public function setJustificacion($justificacion)
	{
	    $this->justificacion = $justificacion;
	}

	public function getFunciones()
	{
	    return $this->funciones;
	}

	public function setFunciones($funciones)
	{
	    $this->funciones = $funciones;
	}

	public function getProduccion()
	{
	    return $this->produccion;
	}

	public function setProduccion($produccion)
	{
	    $this->produccion = $produccion;
	}

	public function getProyectos()
	{
	    return $this->proyectos;
	}

	public function setProyectos($proyectos)
	{
	    $this->proyectos = $proyectos;
	}

	public function getRrhh()
	{
	    return $this->rrhh;
	}

	public function setRrhh($rrhh)
	{
	    $this->rrhh = $rrhh;
	}

	public function getInfraestructura()
	{
	    return $this->infraestructura;
	}

	public function setInfraestructura($infraestructura)
	{
	    $this->infraestructura = $infraestructura;
	}

	public function getEquipamiento()
	{
	    return $this->equipamiento;
	}

	public function setEquipamiento($equipamiento)
	{
	    $this->equipamiento = $equipamiento;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}
}