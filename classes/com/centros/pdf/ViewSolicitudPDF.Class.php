<?php

/**
 * PDF de Alta de Integrante
 *
 * @author Marcos
 * @since 16/11/2106
 */
class ViewSolicitudPDF extends CdtPDFPrint{

    private $maxWidth = "";

    private $year = "";

    private $estado_oid = "";

    private $tipoUnidad = "";

    private $activo = "";

    /**
     * @return string
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param string $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return string
     */
    public function getTipoUnidad()
    {
        return $this->tipoUnidad;
    }

    /**
     * @param string $tipoUnidad
     */
    public function setTipoUnidad($tipoUnidad)
    {
        $this->tipoUnidad = $tipoUnidad;
    }

    private $tipo = "";

    private $sigla = "";

    private $denominacion = "";

    /**
     * @return string
     */
    public function getDenominacion()
    {
        return $this->denominacion;
    }

    /**
     * @param string $denominacion
     */
    public function setDenominacion($denominacion)
    {
        $this->denominacion = $denominacion;
    }

    /**
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param string $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    private $facultad = "";


    private $director = "";



    private $investigador = "";

    private $cuil = "";

    private $categoria = "";

    private $cargo = "";

    private $deddoc = "";

    private $facultadintegrante = "";

    private $carrinv = "";

    private $organismo = "";

    private $beca = "";


    private $horas = "";



    private $Tipointegrante = "";

    private $unidades;



    private $motivos = "";

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getEstadoOid()
    {
        return $this->estado_oid;
    }

    /**
     * @param string $estado_oid
     */
    public function setEstadoOid($estado_oid)
    {
        $this->estado_oid = $estado_oid;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getFacultad()
    {
        return $this->facultad;
    }

    /**
     * @param string $facultad
     */
    public function setFacultad($facultad)
    {
        $this->facultad = $facultad;
    }

    /**
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param string $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return string
     */
    public function getInvestigador()
    {
        return $this->investigador;
    }

    /**
     * @param string $investigador
     */
    public function setInvestigador($investigador)
    {
        $this->investigador = $investigador;
    }

    /**
     * @return string
     */
    public function getCuil()
    {
        return $this->cuil;
    }

    /**
     * @param string $cuil
     */
    public function setCuil($cuil)
    {
        $this->cuil = $cuil;
    }

    /**
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param string $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param string $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * @return string
     */
    public function getDeddoc()
    {
        return $this->deddoc;
    }

    /**
     * @param string $deddoc
     */
    public function setDeddoc($deddoc)
    {
        $this->deddoc = $deddoc;
    }

    /**
     * @return string
     */
    public function getFacultadintegrante()
    {
        return $this->facultadintegrante;
    }

    /**
     * @param string $facultadintegrante
     */
    public function setFacultadintegrante($facultadintegrante)
    {
        $this->facultadintegrante = $facultadintegrante;
    }

    /**
     * @return string
     */
    public function getCarrinv()
    {
        return $this->carrinv;
    }

    /**
     * @param string $carrinv
     */
    public function setCarrinv($carrinv)
    {
        $this->carrinv = $carrinv;
    }

    /**
     * @return string
     */
    public function getOrganismo()
    {
        return $this->organismo;
    }

    /**
     * @param string $organismo
     */
    public function setOrganismo($organismo)
    {
        $this->organismo = $organismo;
    }

    /**
     * @return string
     */
    public function getBeca()
    {
        return $this->beca;
    }

    /**
     * @param string $beca
     */
    public function setBeca($beca)
    {
        $this->beca = $beca;
    }

    /**
     * @return string
     */
    public function getHoras()
    {
        return $this->horas;
    }

    /**
     * @param string $horas
     */
    public function setHoras($horas)
    {
        $this->horas = $horas;
    }

    /**
     * @return string
     */
    public function getTipointegrante()
    {
        return $this->Tipointegrante;
    }

    /**
     * @param string $Tipointegrante
     */
    public function setTipointegrante($Tipointegrante)
    {
        $this->Tipointegrante = $Tipointegrante;
    }

    /**
     * @return mixed
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * @param mixed $unidades
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }

    /**
     * @return string
     */
    public function getMotivos()
    {
        return $this->motivos;
    }

    /**
     * @param string $motivos
     */
    public function setMotivos($motivos)
    {
        $this->motivos = $motivos;
    }




    public function __construct(){

        parent::__construct();
        $this->setUnidades(new ItemCollection());


    }

    /**
     * @return string
     */
    public function getMaxWidth()
    {
        return $this->maxWidth;
    }

    /**
     * @param string $maxWidth
     */
    public function setMaxWidth($maxWidth)
    {
        $this->maxWidth = $maxWidth;
    }

    function printSolicitud(  ){

        //$this->facultad();
        $this->identificacion();
        $this->director();
        $this->integrante();
        $this->firma();
    }

    function facultad() {
        $this->SetFillColor(255,255,255);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 40, 6, "TIPO");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 145, 6, $this->encodeCharacters($this->getTipoUnidad()), 'LTBR',0,'L',1);

        $this->ln(8);

    }


    function identificacion() {
        $this->SetFillColor(200,200,200);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 185, 6, "IDENTIFICACION DE LA UNIDAD",0,0,'',1);
        $this->ln(8);
        $this->SetFillColor(255,255,255);
        $this->Cell ( 20, 6, "SIGLA:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 20, 6, $this->encodeCharacters($this->getSigla()), 'LTBR',0,'L',1);
        $this->Cell ( 30, 6, "");
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 15, 6, "TIPO:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 100, 6, $this->encodeCharacters($this->getTipoUnidad()), 'LTBR',0,'L',1);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->ln(8);
        $this->Cell ( 35, 6, "DENOMINACION:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->MultiCell ( 150, 4, $this->encodeCharacters($this->getDenominacion()), 'LTBR','L',1);
        $this->ln(3);
        /*
        $this->ln(3);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 35, 6, "FECHA DE INICIO:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 30, 6, CYTSecureUtils::formatDateToView($this->getDt_ini()), 'LTBR',0,'L',1);
        $this->Cell ( 30, 6, "");
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 35, 6, "FECHA DE FIN:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 30, 6, CYTSecureUtils::formatDateToView($this->getDt_fin()), 'LTBR',0,'L',1);

        $this->ln(8);*/
    }

    function director() {
        $this->SetFillColor(200,200,200);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 185, 6, "DIRECTOR",0,0,'',1);
        $this->ln(8);
        $this->SetFillColor(255,255,255);
        $this->Cell ( 40, 6, "Apellido y Nombres:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 145, 6, $this->encodeCharacters($this->getDirector()), 'LTBR',0,'L',1);
        $this->ln(8);
    }

    function integrante() {
        $ds_tipoSTR = $this->getTipo();
        $this->SetFillColor(200,200,200);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 185, 6, $ds_tipoSTR." - IDENTIFICACION DEL INTEGRANTE",0,0,'',1);
        $this->ln(8);
        $this->SetFillColor(255,255,255);
        $this->Cell ( 40, 6, "Apellido y Nombres:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 145, 6, $this->encodeCharacters($this->getInvestigador()), 'LTBR',0,'L',1);
        $this->ln(8);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 20, 6, "C.U.I.L.:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 30, 6, $this->getCuil(), 'LTBR',0,'L',1);
        $this->Cell ( 30, 6, "");
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 65, 6, $this->encodeCharacters("Categoría de Docente Investigador:"));
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 40, 6, $this->encodeCharacters($this->getCategoria()), 'LTBR',0,'L',1);
        $this->ln(8);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 40, 6, "Cargo docente:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 80, 6, $this->encodeCharacters($this->getCargo()), 'LTBR',0,'L',1);
        $this->Cell ( 20, 6, "");
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 25, 6, $this->encodeCharacters("Dedicación:"));
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 20, 6, $this->encodeCharacters($this->getDeddoc()), 'LTBR',0,'L',1);

        $this->ln(8);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 40, 6, "Carrera del Inv.:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 60, 6, $this->encodeCharacters($this->getCarrinv()), 'LTBR',0,'L',1);

        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 22, 6, "Organismo:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 63, 6, $this->encodeCharacters($this->getOrganismo()), 'LTBR',0,'L',1);

        $this->ln(8);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 40, 6, "Beca:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 145, 6, $this->encodeCharacters($this->getBeca()), 'LTBR',0,'L',1);
        $this->ln(8);




        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 40, 6, "Horas dedicadas:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 10, 6, $this->getHoras(), 'LTBR',0,'L',1);


        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 29, 6, "");
        $this->Cell ( 12, 6, "Tipo:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 40, 6, $this->encodeCharacters($this->getTipointegrante()), 'LTBR',0,'L',1);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 29, 6, "");
        $this->Cell ( 15, 6, "Activo:");
        $this->SetFont ( 'Arial', '', 10 );
        $this->Cell ( 10, 6, $this->getActivo()?'SI':'NO', 'LTBR',0,'L',1);

        $this->ln(8);


    }



    function firma() {
        $this->SetFillColor(200,200,200);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 185, 6, "CONSENTIMIENTO DEL INTERESADO",0,0,'',1);
        $this->SetFillColor(255,255,255);
        $this->ln(8);
        $ds_baja=($this->getTipo()=='BAJA')?'a la presente baja':'';
        $this->Cell ( 185, 6, "Dejo constancia que otorgo mi conformidad ".$ds_baja,0,0,'',1);
        $this->SetFont ( 'Arial', '', 10 );
        $this->ln(10);
        $this->Cell ( 10, 8);
        $this->Cell ( 60, 8, '', 'B');
        $this->Cell ( 30, 8);
        $this->Cell ( 60, 8, '', 'B');
        $this->ln(8);
        $this->Cell ( 10, 8);
        $this->Cell ( 60, 8, 'Lugar y Fecha', '', 0, 'C');
        $this->Cell ( 30, 8);
        $this->Cell ( 60, 8, $this->encodeCharacters('Firma y Aclaración'), '', 0, 'C');
        $this->ln(1);
        $this->Cell ( 185, 8, '', 'B');
        $this->ln(10);
        $this->Cell ( 10, 8);
        $this->Cell ( 60, 8, '', 'B');
        $this->Cell ( 30, 8);
        $this->Cell ( 60, 8, '', 'B');
        $this->ln(8);
        $this->Cell ( 10, 8);
        $this->Cell ( 60, 8, 'Lugar y Fecha', '', 0, 'C');
        $this->Cell ( 30, 8);
        $this->Cell ( 60, 8, 'Firma del Director de la Unidad', '', 0, 'C');
        $this->ln(1);
        $this->Cell ( 185, 8, '', 'B');
        $this->ln(10);
        $this->SetFont ( 'Arial', 'B', 10 );
        $this->Cell ( 185, 6, $this->encodeCharacters("La información detallada en esta solicitud tiene carácter de DECLARACION JURADA."),0,0,'',1);

    }
    /**
     * (non-PHPdoc)
     * @see CdtPDFPrint#Header()
     */
    function Header(){

        $this->SetTextColor(100, 100, 100);
        $this->SetDrawColor(1,1,1);
        $this->SetLineWidth(.1);
        $this->SetFont('Arial','B',36);
        if (($this->getEstadoOid()==CYT_ESTADO_INTEGRANTE_ALTA_CREADA)||($this->getEstadoOid()==CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO)) {
            $this->RotatedText($this->lMargin, $this->h - 10, $this->encodeCharacters('      '.CYT_MSG_SOLICITUD_PDF_PRELIMINAR_TEXT.'       '.CYT_MSG_SOLICITUD_PDF_PRELIMINAR_TEXT), 60);
        }

        $this->SetY(13);

        $this->SetTextColor(0, 0, 0);
        $this->ln(15);




        $this->Image(APP_PATH . 'css/images/image002.gif', $this->rMargin+10, $this->y-15);//, 60, 20);



        $this->SetFont ( 'Arial', 'B', 13 );


        $webtitulo='WEB GESTION DE PROYECTOS ';

        switch ($this->getEstadoOid()) {
            case CYT_ESTADO_INTEGRANTE_ALTA_CREADA:
                $ds_titulo='ALTA DE INTEGRANTE';;
                break;
            case CYT_ESTADO_INTEGRANTE_ALTA_RECIBIDA:
                $ds_titulo='ALTA DE INTEGRANTE';;
                break;

            case CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO:
                $ds_titulo='CAMBIO DE INTEGRANTE';
                break;
            case CYT_ESTADO_INTEGRANTE_CAMBIO_RECIBIDO:
                $ds_titulo='CAMBIO DE INTEGRANTE';
                break;

        }



        $this->SetFillColor(0,0,0);
        $this->SetTextColor(255,255,255);
        $this->Cell ( 100, 6, $ds_titulo, '',0,'L',1);
        $this->Cell ( 85, 6, $this->getYear().' '.CYT_MSG_PROYECTO_PDF_HEADER_TITLE, '',0,'R',1);

        $this->SetTextColor(0,0,0);
        $this->SetFillColor(255,255,255);
        $this->ln(8);
    }




    /**
     * (non-PHPdoc)
     * @see CdtPDFPrint#Footer()
     */
    function Footer(){

        $this->SetY(-15);


        $this->SetFont('Arial','I',8);

        $this->Cell(0,10,$this->encodeCharacters(CYT_MSG_PROYECTO_PDF_PAGINA).' '.$this->PageNo().' '.CYT_MSG_PROYECTO_PDF_PAGINA_DE.' {nb}',0,0,'C');

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







}