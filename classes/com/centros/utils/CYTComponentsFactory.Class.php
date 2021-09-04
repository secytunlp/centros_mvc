<?php

/**
 * Factory para componentes
 *
 * @author Marcos
 * @since 21-10-2013
 */

class CYTComponentsFactory {


	/**
	 * componente para buscar un tipo de unidad
	 * @param TipoUnidad $tipo
	 * @param unknown_type $required_msg
	 * @param unknown_type $inputId
	 * @param unknown_type $inputName
	 * @param unknown_type $fCallback
	 */
	public static function getFindTipoUnidad(TipoUnidad $tipoUnidad, $label, $required_msg="", $inputId='tipoUnidad_oid', $inputName='tipoUnidad.oid', $fCallback="tipoUnidad_change") {

		$findEntityInput = FieldBuilder::buildFieldFindEntity ($tipoUnidad->getOid(), $label, $inputId, $inputName, self::getAutocompleteTipoUnidad($tipoUnidad), get_class(ManagerFactory::getTipoUnidadManager()), "CMPTipoUnidadPopupGrid" , $required_msg );
		$findEntityInput->getInput()->setFunctionCallback($fCallback);		
		$findEntityInput->getInput()->setItemAttributesCallback('oid,nombre');

		$findEntityInput->getInput()->setInputSize(5,25);
		
		return $findEntityInput;
		
	}

	public static function getFindTipoUnidadWithAdd(TipoUnidad $tipoUnidad, $required_msg="", $inputId='tipoUnidad_oid', $inputName='tipoUnidad.oid', $fCallback="tipoUnidad_change") {

		$oFindEntity = self::getFindTipoUnidad($tipoUnidad, $required_msg, $inputId, $inputName, $fCallback);
		$oFindEntity->getInput()->setAddEntityAction("add_tipoUnidad_popup_init");
		
		return $oFindEntity;
	}
	
	public static function getAutocompleteTipoUnidad(TipoUnidad $tipoUnidad, $required_msg="", $inputId='autocomplete_tipoUnidad', $inputName='autocomplete_tipoUnidad', $fCallback="autocomplete_tipoUnidad_change") {

		$autocomplete = new CMPTipoUnidadAutocomplete();

		$autocomplete->setFunctionCallback( $fCallback );
		$autocomplete->setInputSize( $inputSize );
		$autocomplete->setInputName( $inputName );
		$autocomplete->setInputId(  $inputId );
			
		return $autocomplete;
	}
	
	public static function getFindUnidad(Unidad $unidad, $label, $required_msg="", $inputId='unidad_oid', $inputName='unidad.oid', $fCallback="unidad_change") {

		$findEntityInput = FieldBuilder::buildFieldFindEntity ($unidad->getOid(), $label, $inputId, $inputName, self::getAutocompleteUnidad($unidad), get_class(ManagerFactory::getUnidadManager()), "CMPUnidadPopupGrid" , $required_msg );
		$findEntityInput->getInput()->setFunctionCallback($fCallback);		
		$findEntityInput->getInput()->setItemAttributesCallback('oid,denominacion,sigla');

		$findEntityInput->getInput()->setInputSize(5,25);
		
		return $findEntityInput;
		
	}

	
	
	public static function getAutocompleteUnidad(Unidad $unidad, $required_msg="", $inputId='autocomplete_unidad', $inputName='autocomplete_unidad', $fCallback="autocomplete_unidad_change") {

		$autocomplete = new CMPUnidadAutocomplete();

		$autocomplete->setFunctionCallback( $fCallback );
		$autocomplete->setInputSize( $inputSize );
		$autocomplete->setInputName( $inputName );
		$autocomplete->setInputId(  $inputId );
			
		return $autocomplete;
	}
	
	
	
}
?>