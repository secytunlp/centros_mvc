<?php
/**
 * 
 * Componente para autocomplete integrantes.
 * 
 * @author Marcos
 * @since 17/11/2016
 */

class CMPIntegranteAutocomplete extends CMPEntityAutocomplete{

	protected function getEntityClazz(){
		return "Integrante";
	}

	protected function getFieldCode(){
		return "oid";
	}

	protected function getFieldSearch(){
		return "sigla,apellido";
	}

	protected function getEntityManager(){
		return ManagerFactory::getIntegranteManager();
	}


	public function __construct(){
		$properties = array();
		$properties[] = "sigla";
		$properties[] = "apellido";
		
		$this->setPropertiesList($properties);
	}

	protected function getCriteria($text, $parent=null){
		
		$criterio = new CdtSearchCriteria();

		$tIntegrante = DAOFactory::getIntegranteDAO()->getTableName();
		
		$tUnidad = DAOFactory::getUnidadDAO()->getTableName();
		$filter = new CdtSimpleExpression( "($tIntegrante.apellido like '$text%') OR ($tIntegrante.nombre like '$text%') OR ($tUnidad.sigla like '$text%')");

		$criterio->setExpresion($filter);

		return $criterio;
	}

	protected function getItemDropDown( $entity ){
		$dropdownItem = "<div id='autocomplete_item_desc'><table><tr>";
		$dropdownItem .= "<td>".  $entity->getSigla()  . "</td>";
		$dropdownItem .= "<td>".  $entity->getApellido()  . "</td>";
		
		$dropdownItem .= "</tr></table></div>";
		return $dropdownItem;
	}


}
?>