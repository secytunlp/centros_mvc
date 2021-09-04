<?php

/**
 * componente filter para unidades.
 *
 * @author Marcos
 * @since 21-10-2013
 *
 */
class CMPUnidadFilter extends CMPFilter{

	/**
	 * denominacion 
	 * @var string
	 */
	private $denominacion;
	
	/**
	 * sigla 
	 * @var string
	 */
	private $sigla;
	
	/**
	 * tipoUnidad
	 * @var TipoUnidad
	 */
	private $tipoUnidad;
	
	/**
	 * facultad
	 * @var TipoUnidad
	 */
	private $facultad;
	
	private $dt_disposicion;
	
	private $nu_disposicion;
	
	
	public function __construct( $id="filter_tiposUnidad"){

		parent::__construct($id);


		$this->setComponent("CMPUnidadGrid");

		$this->setTipoUnidad( new TipoUnidad() );
		
		$fieldTipoUnidad = FieldBuilder::buildFieldSelect (CYT_LBL_TIPO_UNIDAD, "tipoUnidad.oid", CYTUtils::getTiposUnidadItems(), '', null, null, "--seleccionar--", "tipoUnidad_oid" );
		
		$this->addField( $fieldTipoUnidad );
		
		
		
		
		//formamos el form de búsqueda.
		$fieldDenominacion = FieldBuilder::buildFieldText ( CYT_LBL_UNIDAD_DENOMINACION, "denominacion"  );
		$fieldDenominacion->getInput()->addProperty('style','width:180px;');
		$this->addField( $fieldDenominacion );
		
		$fieldDenominacion = FieldBuilder::buildFieldText ( CYT_LBL_UNIDAD_SIGLA, "sigla"  );
		$fieldDenominacion->getInput()->addProperty('style','width:80px;');
		$this->addField( $fieldDenominacion);
		
		$fieldDenominacion = FieldBuilder::buildFieldDate ( CYT_LBL_UNIDAD_FECHA_DISPOSICION, "dt_disposicion"  );
		$fieldDenominacion->getInput()->addProperty('style','width:80px;');
		$this->addField( $fieldDenominacion, 2);
		
		$fieldDenominacion = FieldBuilder::buildFieldText ( CYT_LBL_UNIDAD_NRO_DISPOSICION, "nu_disposicion"  );
		$fieldDenominacion->getInput()->addProperty('style','width:80px;');
		$this->addField( $fieldDenominacion,2);
		
		$this->setFacultad( new Facultad() );
		
		$fieldFacultad = FieldBuilder::buildFieldSelect (CYT_LBL_UNIDAD_FACULTADES_FACULTAD, "facultad.oid", CYTSecureUtils::getFacultadesItems(), '', null, null, "--seleccionar--", "facultad_oid" );
		$fieldFacultad->getInput()->addProperty('style','width:180px;');
		$this->addField( $fieldFacultad,2 );
	
		
		
		
		
		
		
		$this->fillForm();

	}


	protected function fillCriteria( $criteria ){

		parent::fillCriteria($criteria);
		
		$denominacion = $this->getDenominacion();

		if(!empty($denominacion)){
			$criteria->addFilter("denominacion", $denominacion, "like", new CdtCriteriaFormatLikeValue() );
		}
		
		$sigla = $this->getSigla();
		if(!empty($sigla)){
			$criteria->addFilter("sigla", $sigla, "like", new CdtCriteriaFormatLikeValue() );
		}
		
		
		$nro_disposicion = $this->getNu_disposicion();
		if(!empty($nro_disposicion)){
			$criteria->addFilter("nu_disposicion", $nro_disposicion, "like", new CdtCriteriaFormatLikeValue() );
		}
		
		//filtramos por rango de fechas.
		$dt_disposicion = $this->getDt_disposicion();
		if(!empty($dt_disposicion)){
			$criteria->addFilter("dt_disposicion", $dt_disposicion, "=", new CdtCriteriaFormatMysqlDateValue("d/m/y", DB_DEFAULT_DATETIME_FORMAT) );
		}
		
		
		//filtramos por tipo de unidad.
		$tipoUnidad = $this->getTipoUnidad();
		if($tipoUnidad!=null && $tipoUnidad->getOid()!=null){
			$criteria->addFilter("tipoUnidad_oid", $tipoUnidad->getOid(), "=" );
		}
		
		//filtramos por tipo de unidad.
		$facultad = $this->getFacultad();
		if($facultad!=null && $facultad->getOid()!=null){
			$tFacultad = CYTSecureDAOFactory::getFacultadDAO()->getTableName();
			$criteria->addFilter("$tFacultad.cd_facultad", $facultad->getOid(), "=" );
		}

		$oUser = CdtSecureUtils::getUserLogged();
		
		
		
		
		if ($oUser->getCd_usergroup()==CDT_SECURE_USERGROUP_DEFAULT_ID) {
            
            //$criteria->addFilter("user_oid", $oUser->getCd_user(), "=");
            $tDirector = DAOFactory::getIntegranteDAO()->getTableName();
            $criteria->addFilter($tDirector.".cuil", $oUser->getDs_username(), "=", new CdtCriteriaFormatStringValue());
        }
		$tUnidadTipoEstado = DAOFactory::getUnidadTipoEstadoDAO()->getTableName();
		$criteria->addNull($tUnidadTipoEstado.'.fechaHasta');
		$tUnidad = DAOFactory::getUnidadDAO()->getTableName();
		$criteria->addGroupBy($tUnidad.'.oid');
		
	}




	

	

	public function getDenominacion()
	{
	    return $this->denominacion;
	}

	public function setDenominacion($denominacion)
	{
	    $this->denominacion = $denominacion;
	}

	public function getTipoUnidad()
	{
	    return $this->tipoUnidad;
	}

	public function setTipoUnidad($tipoUnidad)
	{
	    $this->tipoUnidad = $tipoUnidad;
	}

	public function getSigla()
	{
	    return $this->sigla;
	}

	public function setSigla($sigla)
	{
	    $this->sigla = $sigla;
	}

	public function getFacultad()
	{
	    return $this->facultad;
	}

	public function setFacultad($facultad)
	{
	    $this->facultad = $facultad;
	}

	public function getDt_disposicion()
	{
	    return $this->dt_disposicion;
	}

	public function setDt_disposicion($dt_disposicion)
	{
	    $this->dt_disposicion = $dt_disposicion;
	}

	public function getNu_disposicion()
	{
	    return $this->nu_disposicion;
	}

	public function setNu_disposicion($nu_disposicion)
	{
	    $this->nu_disposicion = $nu_disposicion;
	}
}