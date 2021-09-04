<?php

/**
 * Formulario para CambiarEstadoUnidad
 *
 * @author Marcos
 * @since 07-11-2013
 */
class CMPCambiarEstadoUnidadForm extends CMPForm{

	/**
	 * se construye el formulario para editar el registro
	 */
	public function __construct($action="", $id="edit_cambiarEstadoUnidad") {

		parent::__construct($id);

		$fieldset = new FormFieldset( "" );
		//$fieldset->addField( FieldBuilder::buildFieldReadOnly ( CDT_ENTITIES_LBL_ENTITY_OID, "oid", ""  ) );
		
			
		$findUnidad = CYTComponentsFactory::getFindUnidad(new Unidad(), CYT_LBL_UNIDAD, CYT_MSG_UNIDAD_TIPO_ESTADO_UNIDAD_REQUIRED, "integrante_form_unidad_oid", "unidad.oid", "integrante_filter_unidad_change");
		$findUnidad->getInput()->setInputSize(5,80);
		$fieldset->addField( $findUnidad );
		
		$fieldTipoEstado = FieldBuilder::buildFieldSelect (CYT_LBL_TIPO_ESTADO, "tipoEstado.oid", CYTUtils::getTiposEstadoItems(), CYT_MSG_UNIDAD_TIPO_ESTADO_TIPO_ESTADO_REQUIRED, null, null, "--seleccionar--" );
		$fieldset->addField( $fieldTipoEstado );
		
		$fieldset->addField( FieldBuilder::buildFieldTextArea ( CYT_LBL_UNIDAD_TIPO_ESTADO_MOTIVO, "motivo"  ) );
		
		
		$this->addFieldset($fieldset);
		$this->addHidden( FieldBuilder::buildInputHidden ( "oid", "") );

		//properties del form.
		$this->addProperty("method", "POST");
		$this->setAction("doAction?action=$action");
		
		$cancel = 'doAction?action=list_unidadesTipoEstado';	
		
		$this->setOnCancel("window.location.href = '$cancel';");
		$this->setUseAjaxSubmit( true );
		//$this->setOnSuccessCallback("successTest");
		//$this->setUseAjaxCallback( true );
		//$this->setIdAjaxCallback( "content-left" );
	}

}
?>
