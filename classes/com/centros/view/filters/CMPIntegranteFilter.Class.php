<?php

/**
 * componente filter para integrantes.
 *
 * @author Marcos
 * @since 29-10-2013
 *
 */
class CMPIntegranteFilter extends CMPFilter{

	
	/**
	 * unidad 
	 * @var string
	 */
	private $unidad;
	
	/**
	 * apellido 
	 * @var string
	 */
	private $apellido;
	
	/**
	 * tipoIntegrante
	 * @var TipoIntegrante
	 */
	private $tipoIntegrante;
	
	/**
	 * categoria 
	 * @var string
	 */
	private $categoria;
	
	
	
	/**
	 * facultad 
	 * @var string
	 */
	private $facultad;
	
	
	/**
	 * activo 
	 * @var string
	 */
	private $activo;
	
	
	public function __construct( $id="filter_tiposIntegrante"){

		$this->setId($id);
		
		$form = new CMPForm($id, CDT_UI_LBL_SEARCH );
		
		
		$fieldset = new FormFieldset( $legend );
		
		$form->addFieldset($fieldset);
		$form->addHidden( FieldBuilder::buildInputHidden ( "search","") );
		$form->addHidden( FieldBuilder::buildInputHidden ( "action","" ) );
		$form->addHidden( FieldBuilder::buildInputHidden ( "component","" ) );
		$form->addHidden( FieldBuilder::buildInputHidden ( "orderBy","" ) );
		$form->addHidden( FieldBuilder::buildInputHidden ( "orderType","" ) );
		$form->addHidden( FieldBuilder::buildInputHidden ( "page","" ) );
		$form->addHidden( FieldBuilder::buildInputHidden ( "rowPerPage",ROW_PER_PAGE ) );
		$form->addHidden( FieldBuilder::buildInputHidden ( "gridId","" ) );
		$form->addHidden( FieldBuilder::buildInputHidden ( "fCallback","" ) );
		
		//properties del form.
    	$form->addProperty("method", "POST");
    	
		$form->setAction("doAction?action=cmp_entitygrid");
		
		$form->addButton( CDT_UI_LBL_SEARCH_ALL, "clearForm( $('#$id') ); search_all_ajax( '$id', 'doAction?action=cmp_entitygrid' );" );
		$form->addButton( CDT_UI_LBL_SEARCH, "resetFilterPage_$id();search_ajax( '$id', 'doAction?action=cmp_entitygrid' );" );
		
		
    	$form->setSubmitLabel( "");
    	$form->setCancelLabel( "");
		
		
		$form->setUseAjaxSubmit( true );
		$form->setOnSuccessCallback("showResults");
		
		
		
		$this->setSearch(1);
		$this->setPage(1);
		$this->setRowPerPage( ROW_PER_PAGE );
		$this->setAction("cmp_entitygrid");
		
		
		$this->setForm($form);
		$this->setName("filter");
		
		$this->setCd_user(CdtSecureUtils::getUserLogged()->getCd_user());


		$this->setComponent("CMPIntegranteGrid");
		
		$this->setUnidad( new Unidad() );

		$this->setTipoIntegrante( new TipoIntegrante() );
		
		$this->setCategoria( new Categoria() );
		
		$this->setFacultad( new Facultad() );
		
		
		$findUnidad = CYTComponentsFactory::getFindUnidad(new Unidad(), CYT_LBL_UNIDAD, "", "integrante_filter_unidad_oid", "unidad.oid", "integrante_filter_unidad_change");
		$findUnidad->getInput()->setInputSize(2,25);
		        
        //$findUnidad->getInput()->setIsEditable(false);
        
		$this->addField( $findUnidad);
		
		
		$fieldDocente = FieldBuilder::buildFieldText ( CYT_LBL_DOCENTE, "apellido"  );
		$this->addField( $fieldDocente );
		
		$fieldTipoIntegrante = FieldBuilder::buildFieldSelect (CYT_LBL_TIPO_INTEGRANTE, "tipoIntegrante.oid", CYTUtils::getTiposIntegranteItems(), null, null, null, "--seleccionar--");
		$this->addField( $fieldTipoIntegrante);
		
		
		$fieldFacultad = FieldBuilder::buildFieldSelect (CYT_LBL_FACULTAD, "facultad.oid", CYTSecureUtils::getFacultadesItems(), null, null, null, "--seleccionar--");
		$fieldFacultad->getInput()->addProperty('style','width:180px;');
		$this->addField( $fieldFacultad,2);
		
		$fieldCategoria = FieldBuilder::buildFieldSelect (CYT_LBL_CATEGORIA, "categoria.oid", CYTSecureUtils::getCategoriasItems(), null, null, null, "--seleccionar--");
		$this->addField( $fieldCategoria,2);		
		
		$fieldCategoria = FieldBuilder::buildFieldSelect (CYT_LBL_INTEGRANTE_ACTIVO, "activo", CYTSecureUtils::getYesNoItems(), null, null, null, "--seleccionar--");
		$this->addField( $fieldCategoria,2);	
		
		$this->fillForm();

	}


	/**
	 * (non-PHPdoc)
	 * @see components/CMPComponent::show()
	 */
	public function show( ){
		
		//rellenamos los valores del formulario.
		$this->fillForm();
		
		if ($this->getUnidad()->getOid()) {
			$oUnidadManager = ManagerFactory::getUnidadManager();
			$oUnidad = $oUnidadManager->getObjectByCode($this->getUnidad()->getOid());
		}
		
		
		$inputCombo =  $this->getForm()->getInput("tipoIntegrante.oid");
		$inputCombo->setOptions( CYTUtils::getTiposIntegranteItems() );
		
		//mostramos el formulario.
		return $this->getForm()->show();
	}
	
	
	protected function fillCriteria( $criteria ){

		parent::fillCriteria($criteria);
		
		
		//filtramos por unidad.
		$unidad = $this->getUnidad();
		if($unidad!=null && $unidad->getOid()!=null){
			$criteria->addFilter("unidad_oid", $unidad->getOid(), "=" );
		}
		
		
		//filtramos por tipo de integrante.
		$tipoIntegrante = $this->getTipoIntegrante();
		if($tipoIntegrante!=null && $tipoIntegrante->getOid()!=null){
			$criteria->addFilter("tipoIntegrante_oid", $tipoIntegrante->getOid(), "=" );
		}

		$apellido = $this->getApellido();
		if(!empty($apellido)){
			$tIntegrante = DAOFactory::getIntegranteDAO()->getTableName();
			$filter = new CdtSimpleExpression("(apellido like '%".$apellido."%' OR $tIntegrante.nombre like '%".$apellido."%')");
			$criteria->setExpresion($filter);
			
			//$criteria->addFilter("apellido", $apellido, "like", new CdtCriteriaFormatLikeValue() );
		}
		
		//filtramos por facultad.
		$facultad = $this->getFacultad();
		if($facultad!=null && $facultad->getOid()!=null){
			$criteria->addFilter("facultad_oid", $facultad->getOid(), "=" );
		}
		
		//filtramos por categoria.
		$categoria = $this->getCategoria();
		if($categoria!=null && $categoria->getOid()!=null){
			$criteria->addFilter("categoria_oid", $categoria->getOid(), "=" );
		}

		//filtramos por activo.
		$activo = $this->getActivo();
		if($activo!=null){
			//$activo=($activo==false)?0:1;
			$criteria->addFilter("activo", $activo, "=" );
		}
		
		
		$oUser = CdtSecureUtils::getUserLogged();
		
		if ($oUser->getCd_usergroup()==CDT_SECURE_USERGROUP_DEFAULT_ID) {
			if($this->getUnidad()==null || $this->getUnidad()->getOid()==null){
				throw new FailureException( CDT_SECURE_ACCESS_DENIED_ACTION , CDT_SECURE_MSG_PERMISSION_DENIED );
			}
            
            //$criteria->addFilter("user_oid", $oUser->getCd_user(), "=");
        }
		
		$criteria->addNull('fechaHasta');
		
		
	}




	


	public function getTipoIntegrante()
	{
	    return $this->tipoIntegrante;
	}

	public function setTipoIntegrante($tipoIntegrante)
	{
	    $this->tipoIntegrante = $tipoIntegrante;
	}

	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	    $this->categoria = $categoria;
	}

	public function getFacultad()
	{
	    return $this->facultad;
	}

	public function setFacultad($facultad)
	{
	    $this->facultad = $facultad;
	}

	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	public function getUnidad()
	{
	    return $this->unidad;
	}

	public function setUnidad($unidad)
	{
	    $this->unidad = $unidad;
	}

	public function getActivo()
	{
	    return $this->activo;
	}

	public function setActivo($activo)
	{
	    $this->activo = $activo;
	}
}