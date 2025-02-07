<?php

/**
 * Formulario para Integrante
 *
 * @author Marcos
 * @since 30-10-2013
 */
class CMPIntegranteUpDateForm extends CMPForm{
	
	public function getRenderer(){
		return new CMPIntegranteFormRenderer();
	}

	/**
	 * se construye el formulario para editar el matriculado
	 */
	public function __construct($action="", $id="edit_matriculado") {

		parent::__construct($id);

		$fieldset = new FormFieldset( "" );
		$fieldset->addField( FieldBuilder::buildFieldReadOnly ( CDT_ENTITIES_LBL_ENTITY_OID, "oid", ""  ) );
		
		$findUnidad = CYTComponentsFactory::getFindUnidad(new Unidad(), CYT_LBL_UNIDAD, "", "integrante_form_unidad_oid", "unidad.oid", "integrante_filter_unidad_change");
		$findUnidad->getInput()->setInputSize(5,80);
		$findUnidad->getInput()->setIsEditable(false);
		
		
		$fieldset->addField( $findUnidad );
		
		$fieldTipoIntegrante = FieldBuilder::buildFieldSelect (CYT_LBL_TIPO_INTEGRANTE, "tipoIntegrante.oid", CYTUtils::getTiposIntegranteItems(), CYT_MSG_INTEGRANTE_TIPO_INTEGRANTE_REQUIRED, null, null, "--seleccionar--", "tipoIntegrante_oid" );
		
		$fieldset->addField( $fieldTipoIntegrante );
		
		$fieldApellido = FieldBuilder::buildFieldText ( CYT_LBL_INTEGRANTE_APELLIDO, "apellido", CYT_MSG_INTEGRANTE_APELLIDO_REQUIRED  );
		//$fieldApellido = FieldBuilder::buildFieldEntityAutocomplete(CYT_LBL_INTEGRANTE_APELLIDO, new CMPDocenteAutocomplete(),"apellido",CYT_MSG_INTEGRANTE_APELLIDO_REQUIRED);
		
		$fieldset->addField( $fieldApellido );
		
		
		
		
		$fieldNombre = FieldBuilder::buildFieldText ( CYT_LBL_INTEGRANTE_NOMBRE, "nombre", CYT_MSG_INTEGRANTE_NOMBRE_REQUIRED  );
		//$fieldNombre->getInput()->addProperty("maxlength", 100);
		$fieldset->addField( $fieldNombre );
		
		$fieldCUIL = FieldBuilder::buildFieldText ( CYT_LBL_INTEGRANTE_CUIL, "cuil", CYT_MSG_INTEGRANTE_CUIL_REQUIRED  );
		$fieldCUIL->getInput()->addProperty("maxlength", 13);
		$fieldCUIL->getInput()->addProperty("size", 13);
		$fieldset->addField( $fieldCUIL );
		
		$fieldset->addField( FieldBuilder::buildFieldEmail ( CYT_LBL_INTEGRANTE_MAIL, "mail", CYT_MSG_INTEGRANTE_MAIL_REQUIRED,"",40) );
		
		$fieldNombre = FieldBuilder::buildFieldText ( CYT_LBL_INTEGRANTE_TELEFONO, "telefono"  );
		//$fieldNombre->getInput()->addProperty("maxlength", 100);
		$fieldset->addField( $fieldNombre );
		
		$fieldCategoria = FieldBuilder::buildFieldSelect (CYT_LBL_INTEGRANTE_CATEGORIA, "categoria.oid", CYTSecureUtils::getCategoriasItems(CYT_CATEGORIA_MOSTRADAS), "", null, null, "--seleccionar--", "categoria_oid" );
		$fieldCategoria->getInput()->setIsEditable(false);
		$fieldset->addField( $fieldCategoria );

		$fieldCategoriasicadi = FieldBuilder::buildFieldSelect (CYT_LBL_INTEGRANTE_CATEGORIA_SICADI, "categoriasicadi.oid", CYTSecureUtils::getCategoriassicadiItems(), "", null, null, "--seleccionar--", "categoriasicadi_oid" );
		$fieldCategoriasicadi->getInput()->setIsEditable(false);
		$fieldset->addField( $fieldCategoriasicadi );
		
		$fieldCarrerainv = FieldBuilder::buildFieldSelect (CYT_LBL_INTEGRANTE_CARRERAINV, "carrerainv.oid", CYTSecureUtils::getCarrerainvsItems(CYT_CARRERAINV_MOSTRADAS), "", null, null, "--seleccionar--", "carrerainv_oid" );
		$fieldset->addField( $fieldCarrerainv );
		
		$fieldOrganismo = FieldBuilder::buildFieldSelect (CYT_LBL_INTEGRANTE_ORGANISMO, "organismo.oid", CYTSecureUtils::getOrganismosItems(CYT_ORGANISMO_MOSTRADAS), "", null, null, "--seleccionar--", "organismo_oid" );
		$fieldset->addField( $fieldOrganismo );
		
		$fieldBeca = FieldBuilder::buildFieldText ( CYT_LBL_INTEGRANTE_BECA, "beca", ""  );
		//$fieldBeca->getInput()->addProperty("maxlength", 13);
		$fieldset->addField( $fieldBeca );
		
		$fieldCargo = FieldBuilder::buildFieldSelect (CYT_LBL_INTEGRANTE_CARGO, "cargo.oid", CYTSecureUtils::getCargosItems(), "", null, null, "--seleccionar--", "cargo_oid" );
		$fieldset->addField( $fieldCargo );
	
	  	$fieldDeddoc = FieldBuilder::buildFieldSelect (CYT_LBL_INTEGRANTE_DEDDOC, "deddoc.oid", CYTSecureUtils::getDeddocsItems(CYT_DEDDOC_MOSTRADAS), "", null, null, "--seleccionar--", "deddoc_oid" );
		$fieldset->addField( $fieldDeddoc );
	
	  	$fieldFacultad = FieldBuilder::buildFieldSelect (CYT_LBL_INTEGRANTE_FACULTAD, "facultad.oid", CYTSecureUtils::getFacultadesItems(), "", null, null, "--seleccionar--", "facultad_oid" );
		$fieldset->addField( $fieldFacultad );
	
		/*$findLugarTrabajo = CYTSecureComponentsFactory::getFindLugarTrabajo(new LugarTrabajo(), CYT_LBL_INTEGRANTE_LUGAR_TRABAJO, "", "integrante_filter_lugarTrabajo_oid", "lugarTrabajo.oid","integrante_filter_lugarTrabajo_change");
		$findLugarTrabajo->getInput()->setInputSize(5,80);
		$fieldset->addField( $findLugarTrabajo );*/
		
		$fieldCUIL = FieldBuilder::buildFieldText ( CYT_LBL_INTEGRANTE_LUGAR_TRABAJO, "lugarTrabajo", CYT_MSG_INTEGRANTE_LUGAR_TRABAJO_REQUIRED  );
		//$fieldCUIL->getInput()->addProperty("maxlength", 13);
		$fieldCUIL->getInput()->addProperty("size", 90);
		$fieldset->addField( $fieldCUIL );
		
		$fieldActivo = FieldBuilder::buildFieldCheckbox ( CYT_LBL_INTEGRANTE_ESTUDIANTE, "estudiante", "estudiante");
		$fieldset->addField( $fieldActivo );
	
	  	$fieldBeca = FieldBuilder::buildFieldNumber ( CYT_LBL_INTEGRANTE_HORAS, "horas", CYT_MSG_INTEGRANTE_HORAS_REQUIRED  );
		$fieldBeca->getInput()->addProperty("size", 5);
		$fieldset->addField( $fieldBeca );
		
		$fieldActivo = FieldBuilder::buildFieldCheckbox ( CYT_LBL_INTEGRANTE_ACTIVO, "activo", "activo");
		$fieldset->addField( $fieldActivo );
	
		$fieldset->addField( FieldBuilder::buildFieldTextArea ( CYT_LBL_UNIDAD_OBSERVACIONES, "observaciones","","",4,90) );
		
		$this->addFieldset($fieldset);

		$this->addHidden( FieldBuilder::buildInputHidden ( "categoria.oid", "") );
		$this->addHidden( FieldBuilder::buildInputHidden ( "categoriasicadi.oid", "") );
		$this->addHidden( FieldBuilder::buildInputHidden ( "unidad.oid", "") );
		$this->addHidden( FieldBuilder::buildInputHidden ( "estado.oid", "") );
		$this->addHidden( FieldBuilder::buildInputHidden ( "oid", "") );
		$this->addHidden( FieldBuilder::buildInputHidden ( "curriculum", "") );
		

		//properties del form.
		$this->addProperty("method", "POST");
		$this->setAction("doAction?action=$action");
		$this->setOnCancel("window.location.href = 'doAction?action=list_integrantes';");
		$this->setUseAjaxSubmit( true );
		//$this->setOnSuccessCallback("successTest");
		//$this->setUseAjaxCallback( true );
		//$this->setIdAjaxCallback( "content-left" );
	}

}
?>
