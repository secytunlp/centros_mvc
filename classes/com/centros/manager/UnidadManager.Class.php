<?php

/**
 * Manager para Encomienda
 *  
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadManager extends EntityManager{

	public function getDAO(){
		return DAOFactory::getUnidadDAO();
	}

	public function add(Entity $entity) {
		$oUser = CdtSecureUtils::getUserLogged();
		$entity->setUser($oUser);
		parent::add($entity);
		$managerTipoEstado = ManagerFactory::getTipoEstadoManager();
		$oTipoEstado = $managerTipoEstado->getObjectByCode(CYT_ESTADO_UNIDAD_CREADA);
		$oUnidadTipoEstado = new UnidadTipoEstado();
		$oUnidadTipoEstado->setUnidad($entity);
		$oUnidadTipoEstado->setFechaDesde(date(DB_DEFAULT_DATETIME_FORMAT));
		$oUnidadTipoEstado->setTipoEstado($oTipoEstado);
		$oUser = CdtSecureUtils::getUserLogged();
		$oUnidadTipoEstado->setUser($oUser);
		$oUnidadTipoEstado->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));
		$managerUnidadTipoEstado = ManagerFactory::getUnidadTipoEstadoManager();
		$managerUnidadTipoEstado->add($oUnidadTipoEstado);
		//agregamos las entidades relacionadas.
		
		//facultades
		$facultades = $entity->getFacultades();
		foreach ($facultades as $unidadFacultad) {
			$unidadFacultad->setUnidad( $entity );
			
			$managerUnidadFacultad = ManagerFactory::getUnidadFacultadManager();
			$managerUnidadFacultad->add($unidadFacultad);
			
		}
		
		if ($oUser->getCd_usergroup()==CDT_SECURE_USERGROUP_DEFAULT_ID) {
            $separarCUIL = explode('-',trim($oUser->getDs_username()));
			
            $oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter('nu_documento', $separarCUIL[1], '=');
            
            $managerDocente =  CYTSecureManagerFactory::getDocenteManager();
			$oDocente = $managerDocente->getEntity($oCriteria);
			if (!empty($oDocente)) { 
				$oCriteria = new CdtSearchCriteria();
				$oCriteria->addFilter('tipoUnidad_oid', $entity->getTipoUnidad()->getOid(), '=');
	            $oCriteria->addFilter('orden', 1, '=');
	            $managerTipoIntegrante =  ManagerFactory::getTipoIntegranteManager();
				$oTipoIntegrante = $managerTipoIntegrante->getEntity($oCriteria);
				$oIntegrante = new Integrante();
				$oIntegrante->setApellido($oDocente->getDs_apellido());
				$oIntegrante->setBeca(($oDocente->getBl_becario())?$oDocente->getDs_tipobeca().' '.$oDocente->getDs_orgbeca():'');
				$oIntegrante->setNombre($oDocente->getDs_nombre());
				$oIntegrante->setCuil($oUser->getDs_username());
				if (in_array($oDocente->getCategoria()->getOid(),  explode(",",CYT_CATEGORIA_MOSTRADAS))) {
					$oIntegrante->setCategoria($oDocente->getCategoria());
				}
				if (in_array($oDocente->getCarreraInv()->getOid(),  explode(",",CYT_CARRERAINV_MOSTRADAS))) {
					$oIntegrante->setCarreraInv($oDocente->getCarreraInv());
				}
				if (in_array($oDocente->getOrganismo()->getOid(),  explode(",",CYT_ORGANISMO_MOSTRADAS))) {
					$oIntegrante->setOrganismo($oDocente->getOrganismo());
				}
				$oIntegrante->setCargo($oDocente->getCargo());
				if (in_array($oDocente->getDeddoc()->getOid(),  explode(",",CYT_DEDDOC_MOSTRADAS))) {
					$oIntegrante->setDeddoc($oDocente->getDeddoc());
				}
				$oIntegrante->setFacultad($oDocente->getFacultad());
				//$oIntegrante->setLugarTrabajo($oDocente->getLugarTrabajo());
				$oIntegrante->setLugarTrabajo($entity->getDenominacion().'-'.$entity->getSigla());
				$oIntegrante->setUser($oUser);
				$oIntegrante->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));
				$oIntegrante->setFechaDesde(date(DB_DEFAULT_DATETIME_FORMAT));
				$oIntegrante->setTipoIntegrante($oTipoIntegrante);
				$oIntegrante->setUnidad($entity);
				$managerIntegrante =  ManagerFactory::getIntegranteManager();
				$managerIntegrante->add($oIntegrante);
			}
			 
				
            
        }
		
    }	
    
    
	/**
     * se modifica la entity
     * @param (Entity $entity) entity a modificar.
     */
    public function update(Entity $entity) {
    	parent::update($entity);
    	$unidadFacultadDAO =  DAOFactory::getUnidadFacultadDAO();
        $unidadFacultadDAO->deleteUnidadFacultadPorUnidad($entity->getOid());
        
    //facultades
		$facultades = $entity->getFacultades();
		foreach ($facultades as $unidadFacultad) {
			$unidadFacultad->setUnidad( $entity );
			
			$managerUnidadFacultad = ManagerFactory::getUnidadFacultadManager();
			$managerUnidadFacultad->add($unidadFacultad);
			
		}
        
    }
    
	/**
     * se elimina la entity
     * @param int identificador de la entity a eliminar.
     */
    public function delete($id) {
    	$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $id, '=');
		$oCriteria->addNull('fechaHasta');
		$managerUnidadTipoEstadoManager =  ManagerFactory::getUnidadTipoEstadoManager();
		$oUnidadTipoEstado = $managerUnidadTipoEstadoManager->getEntity($oCriteria);
    	if (($oUnidadTipoEstado->getTipoEstado()->getOid()!=CYT_ESTADO_UNIDAD_CREADA)) {
			
			throw new GenericException( CYT_MSG_UNIDAD_ELIMINAR_PROHIBIDO);
		}
		else{
		
	    	$oUnidadTipoEstadoDAO =  DAOFactory::getUnidadTipoEstadoDAO();
	        $oUnidadTipoEstadoDAO->deleteUnidadTipoEstadoPorUnidad($id);
	        
	        $oUnidadFacultad =  DAOFactory::getUnidadFacultadDAO();
	        $oUnidadFacultad->deleteUnidadFacultadPorUnidad($id);
	        
	        $oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter('unidad_oid', $id, '=');
		
			$managerIntegrante = ManagerFactory::getIntegranteManager();
	        
	        $integrantes = $managerIntegrante->getEntities($oCriteria);
	        foreach ($integrantes as $integrante) {
	        	$managerIntegrante->delete($integrante->getOid());
	        }
	        /*$oIntegranteDAO =  DAOFactory::getIntegranteDAO();
	        $oIntegranteDAO->deleteIntegrantePorUnidad($id);*/
	        
	        $dir = CYT_PATH_PDFS.'/';
		
			$unidadManager = ManagerFactory::getUnidadManager();
			$oUnidad = $unidadManager->getObjectByCode($id);
			$dir .= $oUnidad->getSigla().'/';
	    	
	    	$handle=opendir($dir);
			while ($archivo = readdir($handle)){
		        if ((is_file($dir.$archivo))){
		         	unlink($dir.$archivo);
				}
			}
			closedir($handle);
	        
	    	parent::delete( $id );
	    	
	    	
	    	
		}
		
    }
    
    /**
	 * (non-PHPdoc)
	 * @see classes/com/entities/manager/EntityManager::validateOnAdd()
	 */
    protected function validateOnAdd(Entity $entity){
    	
    	parent::validateOnAdd($entity);
    	$error='';
    	/*if (($entity->getObjetivos()=="")) {
    		$error .=CYT_MSG_UNIDAD_OBJETIVOS_REQUIRED.'<br />';
    	}
    	if (($entity->getLineas()=="")) {
    		$error .=CYT_MSG_UNIDAD_LINEAS_REQUIRED.'<br />';
    	}
    	if (($entity->getJustificacion()=="")) {
    		$error .=CYT_MSG_UNIDAD_JUSTIFICACION_REQUIRED.'<br />';
    	}
    	if (($entity->getProduccion()=="")) {
    		$error .=CYT_MSG_UNIDAD_PRODUCCION_REQUIRED.'<br />';
    	}
    	if (($entity->getProyectos()=="")) {
    		$error .=CYT_MSG_UNIDAD_PROYECTOS_REQUIRED.'<br />';
    	}
    	if (($entity->getRrhh()=="")) {
    		$error .=CYT_MSG_UNIDAD_RRHH_REQUIRED.'<br />';
    	}	
    	if (($entity->getFunciones()=="")) {
    		$error .=CYT_MSG_UNIDAD_FUNCIONES_REQUIRED.'<br />';
    	}
    	if (($entity->getReglamento()=="")) {
    		$error .=CYT_MSG_UNIDAD_REGLAMENTO_REQUIRED.'<br />';
    	}
    	if (($entity->getInfraestructura()=="")) {
    		$error .=CYT_MSG_UNIDAD_INFRAESTRUCTURA_REQUIRED.'<br />';
    	}
    	if (($entity->getEquipamiento()=="")) {
    		$error .=CYT_MSG_UNIDAD_EQUIPAMIENTO_REQUIRED.'<br />';
    	}	
    	
		
    	
    	$facultades = $entity->getFacultades();
    	if ($facultades->isEmpty()) {
    		$error .=CYT_MSG_UNIDAD_FACULTAD_REQUIRED.'<br />';
    	}*/
    	
    	if ($error) {
    		throw new GenericException( $error );
    	}
    }
    
    /**
     * (non-PHPdoc)
     * @see classes/com/entities/manager/EntityManager::validateOnUpdate()
     */
	protected function validateOnUpdate(Entity $entity){
	
		parent::validateOnUpdate($entity);

		$error='';
    	/*if (($entity->getObjetivos()=="")) {
    		$error .=CYT_MSG_UNIDAD_OBJETIVOS_REQUIRED.'<br />';
    	}
    	if (($entity->getLineas()=="")) {
    		$error .=CYT_MSG_UNIDAD_LINEAS_REQUIRED.'<br />';
    	}
    	if (($entity->getJustificacion()=="")) {
    		$error .=CYT_MSG_UNIDAD_JUSTIFICACION_REQUIRED.'<br />';
    	}
    	if (($entity->getProduccion()=="")) {
    		$error .=CYT_MSG_UNIDAD_PRODUCCION_REQUIRED.'<br />';
    	}
    	if (($entity->getProyectos()=="")) {
    		$error .=CYT_MSG_UNIDAD_PROYECTOS_REQUIRED.'<br />';
    	}
    	if (($entity->getRrhh()=="")) {
    		$error .=CYT_MSG_UNIDAD_RRHH_REQUIRED.'<br />';
    	}	
    	if (($entity->getFunciones()=="")) {
    		$error .=CYT_MSG_UNIDAD_FUNCIONES_REQUIRED.'<br />';
    	}
    	if (($entity->getReglamento()=="")) {
    		$error .=CYT_MSG_UNIDAD_REGLAMENTO_REQUIRED.'<br />';
    	}
    	if (($entity->getInfraestructura()=="")) {
    		$error .=CYT_MSG_UNIDAD_INFRAESTRUCTURA_REQUIRED.'<br />';
    	}
    	if (($entity->getEquipamiento()=="")) {
    		$error .=CYT_MSG_UNIDAD_EQUIPAMIENTO_REQUIRED.'<br />';
    	}	
    	
		
    	
    	$facultades = $entity->getFacultades();
    	if ($facultades->isEmpty()) {
    		$error .=CYT_MSG_UNIDAD_FACULTAD_REQUIRED.'<br />';
    	}*/
    	
    	if ($error) {
    		throw new GenericException( $error );
    	}
		
		
	}

	
	/**
	 * (non-PHPdoc)
	 * @see classes/com/entities/manager/EntityManager::validateOnDelete()
	 */
	protected function validateOnDelete($id){

		parent::validateOnDelete($id);

		
	}	
	
	
	public function send(Entity $entity) {
		$this->validateOnSend($entity);
		//armamos el pdf con la data necesaria.
		$pdf = new ViewUnidadPDF();
		
		
		
		$oid = $entity->getOid();
		$pdf->setOid($oid);
		
		$oUnidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $oUnidadManager->getObjectByCode($oid);
		$oEstado = new TipoEstado();
		$oEstado->setOid(CYT_ESTADO_UNIDAD_ENVIADA);
		$this->cambiarEstado($oUnidad, $oEstado, '');
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $oUnidad->getOid(), '=');
		$oCriteria->addNull('fechaHasta');
		$managerUnidadTipoEstado =  ManagerFactory::getUnidadTipoEstadoManager();
		$unidadTipoEstado = $managerUnidadTipoEstado->getEntity($oCriteria);
		$pdf->setTipoEstado_oid($unidadTipoEstado->getTipoEstado()->getOid());
		$pdf->setTipo($oUnidad->getTipoUnidad()->getNombre());
		$pdf->setEspecialidad($oUnidad->getEspecialidad());
		$pdf->setDenominacion($oUnidad->getDenominacion());
		$pdf->setSigla($oUnidad->getSigla());
		$pdf->setObjetivos($oUnidad->getObjetivos());
		$pdf->setLineas($oUnidad->getLineas());
		$pdf->setJustificacion($oUnidad->getJustificacion());
		$pdf->setProduccion($oUnidad->getProduccion());
		$pdf->setProyectos($oUnidad->getProyectos());
		$pdf->setRrhh($oUnidad->getRrhh());
		$pdf->setFunciones($oUnidad->getFunciones());
		$pdf->setInfraestructura($oUnidad->getInfraestructura());
		$pdf->setEquipamiento($oUnidad->getEquipamiento());
		
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $oUnidad->getOid(), '=');
		//facultades.
		$facultadesManager = new UnidadFacultadManager();
		$pdf->setFacultades( $facultadesManager->getEntities($oCriteria) );
    	
		$pdf->title = CYT_MSG_UNIDAD_PDF_TITLE;
		$pdf->SetFont('Arial','', 10);
		
		// establecemos los mÃ¡rgenes
		$pdf->SetMargins(10, 20 , 10);
		$pdf->SetAutoPageBreak(true,90);
		$pdf->AddPage();
		$pdf->AliasNbPages();
		
		$pdf->printUnidad();
		
		
		$pdf->AddPage();
		$pdf->tablaIntegrantes();
		
		$dir = CYT_PATH_PDFS.'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		$dir .= $oUnidad->getSigla().'/';
		if (!file_exists($dir)) mkdir($dir, 0777); 
		
		
		
		$fileName = $dir.CYT_MSG_UNIDAD_ARCHIVO_NOMBRE.CYTSecureUtils::stripAccents($oUnidad->getSigla()).'.pdf';;
		$pdf->Output($fileName,'F');
        //$pdf->Output(); 	
	        
		$attachs = array();
		$handle=opendir($dir);
		while ($archivo = readdir($handle)){
			CDTUtils::log($dir.' - '.$archivo);
	        if (is_file($dir.$archivo)){	         
	         	$attachs[]=$dir.$archivo;
	         }
	         elseif (is_dir($dir.$archivo) && $archivo!="." && $archivo!="..") {
	         	
	         	$handle2=opendir($dir.$archivo.'/');
	         	while ($archivo2 = readdir($handle2)){
					CDTUtils::log($dir.$archivo.' - '.$archivo2);
	        		if (is_file($dir.$archivo.'/'.$archivo2)){
	         			$attachs[]=$dir.$archivo.'/'.$archivo2;
	         		}
	         	} 
	         }
		}
        
		
		//$year = $oPeriodo->getDs_periodo();
			
		$oCriteria = new CdtSearchCriteria();
		
		$oCriteria->addFilter("unidad_oid", $oUnidad->getOid(), '=');
		$oCriteria->addFilter("activo", 1, '=');
		
		$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
		$filter = new CdtSimpleExpression( "(".$tTipoIntegrante.".oid IN(".CYT_TIPO_INTEGRANTE_DIRECTOR."))");
		$oCriteria->setExpresion($filter);
		$managerIntegrante = ManagerFactory::getIntegranteManager();
		$oDirector = $managerIntegrante->getEntity($oCriteria);
		
		$subjectMail = htmlspecialchars(CYT_LBL_UNIDAD_MAIL_SUBJECT, ENT_QUOTES, "UTF-8");
			
		$xtpl = new XTemplate( CYT_TEMPLATE_UNIDAD_MAIL_ENVIAR );
		$xtpl->assign ( 'img_logo', WEB_PATH.'css/images/image002.gif' );
		$xtpl->assign('solicitud_titulo', $subjectMail);
		$xtpl->assign('tipo_label', CYT_LBL_TIPO_UNIDAD);
		$xtpl->assign('tipo', $oUnidad->getTipoUnidad()->getNombre());
		$xtpl->assign('denominacion_label', CYT_LBL_UNIDAD_DENOMINACION);
		$xtpl->assign('denominacion', htmlspecialchars($oUnidad->getDenominacion(), ENT_QUOTES, "UTF-8"));
		$xtpl->assign('director_label', CYT_LBL_TIPO_INTEGRANTE_DIRECTOR);
		$xtpl->assign('director', htmlspecialchars($oDirector->getApellido().', '.$oDirector->getNombre(), ENT_QUOTES, "UTF-8"));
		$xtpl->parse('main');		
		$bodyMail = $xtpl->text('main');
		
		
		
		
		
		
        if ($oDirector->getMail() != "") {
				
         		CYTSecureUtils::sendMail($oDirector->getNombre().' '.$oDirector->getApellido(), $oDirector->getMail(), $subjectMail, $bodyMail, $attachs);
        }
        CYTSecureUtils::sendMail(CDT_POP_MAIL_FROM_NAME, CDT_POP_MAIL_FROM, $subjectMail, $bodyMail, $attachs,$oDirector->getNombre().' '.$oDirector->getApellido(),$oDirector->getMail());
	}
	
	protected function validateOnSend(Entity $entity){
	
		$error='';
		
		if ((!$entity->getObjetivos())||(!$entity->getLineas())||(!$entity->getJustificacion())) {
			$error .= CYT_MSG_CAMPOS_REQUERIDOS.' '.CYT_MSG_UNIDAD_FINALIDAD.'<br>';
		}
		if ((!$entity->getProduccion())||(!$entity->getProyectos())||(!$entity->getRrhh())||(!$entity->getMemorias())) {
			$error .= CYT_MSG_CAMPOS_REQUERIDOS.' '.CYT_MSG_UNIDAD_ANTECEDENTES.'<br>';
		}
		if ((!$entity->getFunciones())||(!$entity->getInfraestructura())||(!$entity->getEquipamiento())||(!$entity->getReglamento())) {
			$error .= CYT_MSG_CAMPOS_REQUERIDOS.' '.CYT_MSG_UNIDAD_FUNCIONES.'<br>';
		}
		
		
		$facultades = $entity->getFacultades();
    	if ($facultades->isEmpty()) {
    		$error .=CYT_MSG_UNIDAD_FACULTAD_REQUIRED.'<br />';
    	}
		
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getOid(), '=');
		$oCriteria->addFilter("activo", 1, '=');
		
		$managerIntegrante = ManagerFactory::getIntegranteManager();
	        
	    $integrantes = $managerIntegrante->getEntities($oCriteria);
	    $cantCD = 0;
	    $cantCDCat = 0;
	    $managerTipoUnidad = ManagerFactory::getTipoUnidadManager();
	        
	    $tipoUnidad = $managerTipoUnidad->getObjectByCode($entity->getTipoUnidad()->getOid());
	    $catdedCD = explode('_',trim($tipoUnidad->getMinCD()));
	    foreach ($integrantes as $integrante) {
	    	
	    	if (in_array($integrante->getTipoIntegrante()->getOid(),  explode(",",CYT_TIPO_INTEGRANTE_DIRECTOR))) {
	    		$deddocDirector = ($integrante->getDeddoc())?$integrante->getDeddoc()->getOid():'';
	    		$catDirector = ($integrante->getCategoria())?$integrante->getCategoria()->getOid():'';
	    		$carrerainvDirector = ($integrante->getCarrerainv())?$integrante->getCarrerainv()->getOid():'';
	    	}
	    	if ($integrante->getTipoIntegrante()->getGobierno()) {
	    		$cantCD++;
	    		if ($integrante->getCategoria()) {
		    		if (in_array($integrante->getCategoria()->getOid(),  explode(",",$catdedCD[2]))) {
						$cantCDCat++;					
		    		}
	    		}
	    		
	    	}
		    if ((!$integrante->getTipoIntegrante()->getOid())||(!$integrante->getApellido())||(!$integrante->getNombre())||(!$integrante->getCuil())||(!$integrante->getMail())||(!$integrante->getLugarTrabajo())||(!$integrante->getHoras())||(!$integrante->getCurriculum())) {
				$error .= CYT_MSG_CAMPOS_INTEGRANTE_REQUERIDOS.' '.$integrante->getOid().'<br>';
			}
	    }
		
		
		
		
		
		
		if ($integrantes->size()<$tipoUnidad->getMinMiembros()) {
			$error .= CYT_MSG_INTEGRANTE_MIN.$tipoUnidad->getMinMiembros().'<br>';
		}
		
		$catdedDirector = explode('_',trim($tipoUnidad->getCatDirector()));
    	
		if (!in_array($catDirector,  explode(",",$catdedDirector[0]))) {
			$error .= CYT_SECURE_MSG_ACTIVATION_DIRECTOR_ERROR_CATEGORIA.'<br>';
			
		}
		//echo $catDirector.' - '.$catdedDirector[1];
		if ($catdedDirector[1]) {
			if (($deddocDirector!=$catdedDirector[1])&&(!$carrerainvDirector)) {
				$error .= CYT_MSG_DIRECTOR_ERROR_DEDICACION.'<br>';
				
			}
		}
    	
		if ($cantCD<$catdedCD[0]) {
			$error .= CYT_MSG_CD_INTEGRANTE_MIN.$catdedCD[0].'<br>';
		}
		
		if ($cantCDCat<$catdedCD[1]) {
			$error .= CYT_MSG_CD_INTEGRANTE_MIN_CAT.$catdedCD[1].'<br>';
		}
		
		
		if ($error) {
    		throw new GenericException( $error );
    	}
	}
	
	public function confirm(Entity $entity, $estado_oid, $motivo='') {
		
		$oid = $entity->getOid();
		
		
		$oSolicitudManager = ManagerFactory::getSolicitudManager();
		$oSolicitud = $oSolicitudManager->getObjectByCode($oid);
		$oEstado = new Estado();
		$oEstado->setOid($estado_oid);
		$this->cambiarEstado($oSolicitud, $oEstado, $motivo);
		
		switch ($estado_oid) {
			case CYT_ESTADO_SOLICITUD_ADMITIDA:
				$ds_subjet = CYT_LBL_SOLICITUD_ADMISION;
				$ds_comment = CYT_LBL_SOLICITUD_ADMISION_COMMENT;
			break;
			case CYT_ESTADO_SOLICITUD_OTORGADA:
				$ds_subjet = CYT_LBL_SOLICITUD_OTORGAMIENTO;
				$ds_comment = '';
			break;
			case CYT_ESTADO_SOLICITUD_NO_ADMITIDA:
				$ds_subjet = '';
				$ds_comment = '<strong>'.htmlspecialchars(CYT_LBL_SOLICITUD_NO_ADMISION_COMMENT).'</strong>: '.htmlspecialchars($motivo);
			break;
			
		}
		
        
		$msg = $ds_subjet.CYT_LBL_SOLICITUD_MAIL_SUBJECT;
		
		$oPeriodoManager =  CYTSecureManagerFactory::getPeriodoManager();
		$oPeriodo = $oPeriodoManager->getObjectByCode($oSolicitud->getPeriodo()->getOid());
		
		$year = $oPeriodo->getDs_periodo();
		$yearP = $year+1;
    	$params = array ($year,$yearP );		
		
		$subjectMail = htmlspecialchars(CdtFormatUtils::formatMessage( $msg, $params ), ENT_QUOTES, "UTF-8");
		
		
		$xtpl = new XTemplate( CYT_TEMPLATE_SOLICITUD_MAIL_ENVIAR );
		$xtpl->assign ( 'img_logo', WEB_PATH.'css/images/image002.gif' );
		$xtpl->assign('solicitud_titulo', $subjectMail);
		$xtpl->assign('year_label', CYT_LBL_SOLICITUD_MAIL_YEAR);
		$xtpl->assign('year', $oPeriodo->getDs_periodo());
		$xtpl->assign('investigador_label', CYT_LBL_SOLICITUD_MAIL_INVESTIGADOR);
		$xtpl->assign('investigador', htmlspecialchars($oSolicitud->getDocente()->getDs_apellido().', '.$oSolicitud->getDocente()->getDs_nombre(), ENT_QUOTES, "UTF-8"));
		$xtpl->assign('comment', $ds_comment);
		$xtpl->parse('main');		
		$bodyMail = $xtpl->text('main');
		
		
		
		
		
		
        if ($oSolicitud->getDs_mail() != "") {
				
         		CYTSecureUtils::sendMail($oSolicitud->getDocente()->getDs_nombre().' '.$oSolicitud->getDocente()->getDs_apellido(), $oSolicitud->getDs_mail(), $subjectMail, $bodyMail, $attachs);
        }
        
	}
	
	public function cambiarEstado(Unidad $oUnidad, TipoEstado $oTipoEstado, $motivo){
		
	 	$oUnidadTipoEstado = new UnidadTipoEstado();
		$oUnidadTipoEstado->setUnidad($oUnidad);
		$oUnidadTipoEstado->setFechaDesde(date(DB_DEFAULT_DATETIME_FORMAT));
		$oUnidadTipoEstado->setTipoEstado($oTipoEstado);
		$oUnidadTipoEstado->setMotivo($motivo);
		$oUser = CdtSecureUtils::getUserLogged();
		$oUnidadTipoEstado->setUser($oUser);
		$oUnidadTipoEstado->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));
	 	
	 	$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $oUnidad->getOid(), '=');
		$oCriteria->addNull('fechaHasta');
		$managerUnidadTipoEstado =  ManagerFactory::getUnidadTipoEstadoManager();
		$unidadTipoEstado = $managerUnidadTipoEstado->getEntity($oCriteria);
		if (!empty($unidadTipoEstado)) {
			if ($unidadTipoEstado->getTipoEstado()->getOid()!=$oTipoEstado->getOid()) {// si el estado anterior es el mismo que el nuevo no hago nada
				$unidadTipoEstado->setFechaHasta(date(DB_DEFAULT_DATETIME_FORMAT));
				$unidadTipoEstado->setUser($oUser);
				$unidadTipoEstado->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));
				$unidadTipoEstado->setUnidad($oUnidad);
				$managerUnidadTipoEstado->update($unidadTipoEstado);
				$managerUnidadTipoEstado->add($oUnidadTipoEstado);
			}
		}
		else
			$managerUnidadTipoEstado->add($oUnidadTipoEstado);
	 }
    
   
	
    
}
?>
