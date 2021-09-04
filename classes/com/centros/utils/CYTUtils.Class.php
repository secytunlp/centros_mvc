<?php

/**
 * Utilidades para el sistema.
 *
 * @author Marcos
 * @since 19-10-2013
 */
class CYTUtils {
	

	


	public static function getFilterOptionItems($oManager, $valueProperty, $labelProperty, $ds_field="", $labelFilter="", $valueFilter="", $order="", $criteria="") {

		$oCriteria = ($criteria)?$criteria:new CdtSearchCriteria();
		$order = ($order)?$order:$labelProperty;
		$oCriteria->addOrder($order, "ASC");
		if ($labelFilter!="") {
			$oCriteria->addFilter($labelFilter, $valueFilter, '=');
		}
		$entities = $oManager->getEntities($oCriteria);
		
		$items = array();
		foreach ($entities as $oEntity) {
			$value = CdtReflectionUtils::doGetter($oEntity, $valueProperty);
			if ($ds_field!="") {
				$labelProperty = $ds_field;
			}
			$label = CdtReflectionUtils::doGetter($oEntity, $labelProperty);
			$items[$value] = $label;
		}
		return $items;
	}
	
	

	
	
	public static function getTiposUnidadItems($activo="") {
		if ($activo) {
			$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter("activo", 1, "=" );
		}
		
		return self::getFilterOptionItems( ManagerFactory::getTipoUnidadManager(), "oid", "nombre","","","","nombre",$oCriteria);

	}
	
	public static function getTiposEstadoItems() {

		return self::getFilterOptionItems( ManagerFactory::getTipoEstadoManager(), "oid", "nombre");

	}
	
	public static function getTiposIntegranteItems($tipoUnidad_oid=null) {
		if ($tipoUnidad_oid) {
			$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter("tipoUnidad_oid", $tipoUnidad_oid, "=" );
		}
				
		return self::getFilterOptionItems( ManagerFactory::getTipoIntegranteManager(), "oid", "nombre","","","","orden",$oCriteria);

	}
	
	
	
	
	
}
