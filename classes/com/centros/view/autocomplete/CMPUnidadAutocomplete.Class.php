<?php
/**
 * 
 * Componente para autocomplete unidades.
 * 
 * @author Marcos
 * @since 30/10/2013
 */

class CMPUnidadAutocomplete extends CMPEntityAutocomplete{

	protected function getEntityClazz(){
		return "Unidad";
	}

	protected function getFieldCode(){
		return "oid";
	}

	protected function getFieldSearch(){
		return "denominacion";
	}

	protected function getEntityManager(){
		return ManagerFactory::getUnidadManager();
	}


	public function __construct(){
		$properties = array();
		$properties[] = "denominacion";
		//$properties[] = "ds_nombre";
		$this->setPropertiesList($properties);
	}

	protected function getCriteria($text, $parent=null){
		
		$criterio = new CdtSearchCriteria();

		$tUnidad = DAOFactory::getUnidadDAO()->getTableName();
		
		
		$filter = new CdtSimpleExpression( "($tUnidad.denominacion like '$text%')");

		$criterio->setExpresion($filter);

		return $criterio;
	}

	protected function getItemDropDown( $entity ){
		$dropdownItem = "<div id='autocomplete_item_desc'><table><tr>";
		$dropdownItem .= "<td>".  $entity->getDenominacion()  . "</td>";
		//$dropdownItem .= "<td>".  $entity->getDs_nombre()  . "</td>";
		$dropdownItem .= "</tr></table></div>";
		return $dropdownItem;
	}


}
?>