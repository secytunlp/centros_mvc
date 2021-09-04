<?php

/**
 * componente grilla para integrantes
 *
 * @author Marcos
 * @since 29-10-2013
 *
 */
class CMPIntegranteGrid extends CMPEntityGrid{

	public function __construct(){

		parent::__construct();

		
		$filter = new CMPIntegranteFilter();
		
		$unidad_oid = CdtUtils::getParam('id');
			
		if (!empty( $unidad_oid )) {
			$unidad = new Unidad();
			$unidad->setOid($unidad_oid);
			$filter->setUnidad( $unidad );
			$filter->saveProperties();
		}
		
		
		$this->setFilter( $filter );
		$this->setLayout( new CdtLayoutBasicAjax() );
		$this->setModel( new IntegranteGridModel() );
		//$this->setRenderer( );
	}

}