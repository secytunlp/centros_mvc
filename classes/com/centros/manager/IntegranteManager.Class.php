<?php

/**
 * Manager para Integrante
 *
 * @author Marcos
 * @since 30-10-2013
 */
class IntegranteManager extends EntityManager{

	public function getDAO(){
		return DAOFactory::getIntegranteDAO();
	}

	public function add(Entity $entity) {
		parent::add($entity);
		$oIntegranteEstado = new IntegranteEstado();
		$oIntegranteEstado->setIntegrante($entity);
		$oIntegranteEstado->setFechaDesde(date(DB_DEFAULT_DATETIME_FORMAT));
		$oIntegranteEstado->setEstado($entity->getEstado());
		$oIntegranteEstado->setTipoIntegrante($entity->getTipoIntegrante());
		$oIntegranteEstado->setCargo($entity->getCargo());
		$oIntegranteEstado->setDeddoc($entity->getDeddoc());
		$oIntegranteEstado->setCategoria($entity->getCategoria());
		$oIntegranteEstado->setFacultad($entity->getFacultad());

		$oIntegranteEstado->setCarreraInv($entity->getCarreraInv());
		$oIntegranteEstado->setOrganismo($entity->getOrganismo());

		$oIntegranteEstado->setBeca($entity->getBeca());

		$oIntegranteEstado->setHoras($entity->getHoras());
		$oIntegranteEstado->setActivo($entity->getActivo());

		$oIntegranteEstado->setObservaciones($entity->getObservaciones());

		$oIntegranteEstado->setMotivo('Alta creada');

		$oUser = CdtSecureUtils::getUserLogged();
		$oIntegranteEstado->setUser($oUser);
		$oIntegranteEstado->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));
		$managerIntegranteEstado = ManagerFactory::getIntegranteEstadoManager();
		$managerIntegranteEstado->add($oIntegranteEstado);
	}


	public function update(Entity $entity) {

		parent::update($entity);

		$oIntegranteEstado = new IntegranteEstado();
		$oIntegranteEstado->setIntegrante($entity);
		$oIntegranteEstado->setFechaDesde(date(DB_DEFAULT_DATETIME_FORMAT));
		$oIntegranteEstado->setEstado($entity->getEstado());
		$oIntegranteEstado->setTipoIntegrante($entity->getTipoIntegrante());
		$oIntegranteEstado->setCargo($entity->getCargo());
		$oIntegranteEstado->setDeddoc($entity->getDeddoc());
		$oIntegranteEstado->setCategoria($entity->getCategoria());
		$oIntegranteEstado->setFacultad($entity->getFacultad());

		$oIntegranteEstado->setCarreraInv($entity->getCarreraInv());
		$oIntegranteEstado->setOrganismo($entity->getOrganismo());

		$oIntegranteEstado->setBeca($entity->getBeca());

		$oIntegranteEstado->setHoras($entity->getHoras());
		$oIntegranteEstado->setActivo($entity->getActivo());
		$oIntegranteEstado->setObservaciones($entity->getObservaciones());


		$oIntegranteEstado->setMotivo('Modificacion de integrante');
		$oUser = CdtSecureUtils::getUserLogged();
		$oIntegranteEstado->setUser($oUser);
		$oIntegranteEstado->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));

		$this->cambiarEstado($entity, $oIntegranteEstado);
		unset($_SESSION['archivos']);
	}

	/**
	 * se elimina la entity
	 * @param int identificador de la entity a eliminar.
	 */
	public function delete($id) {
		$integranteManager = ManagerFactory::getintegranteManager();
		$oIntegrante = $integranteManager->getObjectByCode($id);

		$dir = CYT_PATH_PDFS.'/';

		$unidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $unidadManager->getObjectByCode($oIntegrante->getUnidad()->getOid());
		$dir .= $oUnidad->getSigla().'/';
		$dir .= CYT_PATH_PDFS_INTEGRANTES.'/';




		$handle=opendir($dir);
		while ($archivo = readdir($handle)){
			if ((is_file($dir.$archivo))&&(strchr($archivo,CYTSecureUtils::stripAccents(stripslashes(str_replace("'","_",$oIntegrante->getApellido())))))){
				unlink($dir.$archivo);
			}
		}
		closedir($handle);


		parent::delete( $id );





	}


	/**
	 * (non-PHPdoc)
	 * @see classes/com/entities/manager/EntityManager::validateOnAdd()
	 */
	protected function validateOnAdd(Entity $entity){

		parent::validateOnAdd($entity);
		$error='';
		$separarCUIL = explode('-',trim($entity->getCuil()));

		$preCuil = $separarCUIL[0];
		$documento = $separarCUIL[1];
		$posCuil = $separarCUIL[2];

		if ((strlen($preCuil)!=2)||(strlen($posCuil)!=1)) {
			$error .=CYT_MSG_INTEGRANTE_CUIL_FORMAT.'<br />';
		}
		/*if ((in_array($entity->getTipoIntegrante()->getOid(),  explode(",",CYT_TIPO_INTEGRANTE_DIRECTOR)))&&(!in_array($entity->getCategoria()->getOid(),  explode(",",CYT_CATEGORIA_DIRECTOR)))) {
            $error .=CYT_SECURE_MSG_ACTIVATION_DIRECTOR_ERROR_CATEGORIA;
        }*/
		if (in_array($entity->getTipoIntegrante()->getOid(),  explode(",",CYT_TIPO_INTEGRANTE_DIRECTOR))){
			$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter('unidad_oid', $entity->getUnidad()->getOid(), '=');
			$oCriteria->addFilter('activo', 1, '=');
			$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
			$filter = new CdtSimpleExpression( "(".$tTipoIntegrante.".oid IN(".CYT_TIPO_INTEGRANTE_DIRECTOR."))");
			$oCriteria->setExpresion($filter);
			$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
			$managerIntegrante = ManagerFactory::getIntegranteManager();
			$oDirector = $managerIntegrante->getEntity($oCriteria);
			if (!empty($oDirector)) {
				$error .=CYT_MSG_DIRECTOR_ERROR_CANTIDAD.'<br />';
			}
		}
		if (in_array($entity->getTipoIntegrante()->getOid(),  explode(",",CYT_TIPO_INTEGRANTE_SUBDIRECTOR))){
			$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter('unidad_oid', $entity->getUnidad()->getOid(), '=');
			$oCriteria->addFilter('activo', 1, '=');
			$tTipoIntegrante = DAOFactory::getTipoIntegranteDAO()->getTableName();
			$filter = new CdtSimpleExpression( "(".$tTipoIntegrante.".oid IN(".CYT_TIPO_INTEGRANTE_SUBDIRECTOR."))");
			$oCriteria->setExpresion($filter);
			$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
			$managerIntegrante = ManagerFactory::getIntegranteManager();
			$oDirector = $managerIntegrante->getEntity($oCriteria);
			if (!empty($oDirector)) {
				$error .=CYT_MSG_SUBDIRECTOR_ERROR_CANTIDAD.'<br />';
			}
		}
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('unidad_oid', $entity->getUnidad()->getOid(), '!=');
		$oCriteria->addFilter('cuil', $entity->getCuil(), '=', new CdtCriteriaFormatStringValue());
		$oCriteria->addFilter('activo', 1, '=');
		$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
		$managerIntegrante = ManagerFactory::getIntegranteManager();
		$integrantes = $managerIntegrante->getEntities($oCriteria);
		foreach ($integrantes as $integrante) {
			$error .=CYT_MSG_INTEGRANTE_OTRA_UNIDAD.$integrante->getUnidad()->getDenominacion().'<br />';
		}

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
		$separarCUIL = explode('-',trim($entity->getCuil()));

		$preCuil = $separarCUIL[0];
		$documento = $separarCUIL[1];
		$posCuil = $separarCUIL[2];

		if ((strlen($preCuil)!=2)||(strlen($posCuil)!=1)) {
			$error .=CYT_MSG_INTEGRANTE_CUIL_FORMAT.'<br />';
		}


		if ($error) {
			throw new GenericException( $error );
		}

	}

	public function updatesinvalidar(Entity $entity) {

		$this->getDAO()->updateEntity($entity);

	}

	public function cambiarEstado(Integrante $oIntegrante, IntegranteEstado $oIntegranteEstado, $actualizarDocente = 0){

		//print_r($oIntegranteEstado);

		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('integrante_oid', $oIntegrante->getOid(), '=');
		$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
		$managerIntegranteEstado =  ManagerFactory::getIntegranteEstadoManager();
		$integranteEstado = $managerIntegranteEstado->getEntity($oCriteria);
		if (!empty($integranteEstado)) {
			if (($oIntegranteEstado->getEstado()->getOid()==CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO)&&($integranteEstado->getMotivo()!='Iniciar cambio')){
				$oIntegranteEstado->setMotivo('Iniciar cambio');
			}
			//print_r($integranteEstado->getUser());
			$integranteEstado->setFechaHasta(date(DB_DEFAULT_DATETIME_FORMAT));
			/*$oUser = CdtSecureUtils::getUserLogged();
            $integranteEstado->setUser($oUser);*/
			$integranteEstado->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));
			$integranteEstado->setIntegrante($oIntegrante);
			$managerIntegranteEstado->update($integranteEstado);
			$managerIntegranteEstado->add($oIntegranteEstado);
			$oIntegrante->setEstado($oIntegranteEstado->getEstado());
			$oIntegrante->setTipoIntegrante($oIntegranteEstado->getTipoIntegrante());
			$oIntegrante->setCargo($oIntegranteEstado->getCargo());
			$oIntegrante->setDeddoc($oIntegranteEstado->getDeddoc());
			$oIntegrante->setCategoria($oIntegranteEstado->getCategoria());
			$oIntegrante->setFacultad($oIntegranteEstado->getFacultad());


			$oIntegrante->setCarreraInv($oIntegranteEstado->getCarreraInv());

			$oIntegrante->setOrganismo($oIntegranteEstado->getOrganismo());

			$oIntegrante->setBeca($oIntegranteEstado->getBeca());

			$oIntegrante->setHoras($oIntegranteEstado->getHoras());
			$oIntegrante->setActivo($oIntegranteEstado->getActivo());

			$managerIntegrante =  ManagerFactory::getIntegranteManager();
			$managerIntegrante->updatesinvalidar($oIntegrante);



		}
		else{
			if (($oIntegranteEstado->getEstado()->getOid()==CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO)){
				$oIntegranteEstado->setMotivo('Iniciar cambio');
			}
			$managerIntegranteEstado->add($oIntegranteEstado);
		}

	}

	protected function validateOnSend(Entity $entity, $estado_oid){
		//print_r($entity);

		$error='';

		if (($estado_oid==CYT_ESTADO_INTEGRANTE_ALTA_CREADA)||($estado_oid==CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO)) {
			if (!$entity->getCurriculum()){
				$error .=CYT_MSG_INTEGRANTE_CV_REQUERIDO.'<br />';
			}

			$oid = $entity->getOid();
			$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter('oid', $oid, '=');
			$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
			$oIntegranteManager = ManagerFactory::getIntegranteManager();
			$oIntegrante = $oIntegranteManager->getEntity($oCriteria);
			$dir = CYT_PATH_PDFS.'/'.$oIntegrante->getUnidad()->getSigla().'/'.CYT_PATH_PDFS_INTEGRANTES.'/';
			//$dirDoc = $dir.$oIntegrante->getDocente()->getNu_documento().'/';


			$okCv=0;

			$handle=opendir($dir);
			while ($archivo = readdir($handle))
			{
				if ((is_file($dir.$archivo))&&(strchr($archivo,'CV_'.CYTSecureUtils::stripAccents(stripslashes(str_replace("'","_",$oIntegrante->getApellido()))))))
				{
					$okCv=1;
				}


			}

			if (!$okCv){
				$error .=CYT_MSG_INTEGRANTE_CV_PROBLEMA.'<br />';
			}

		}





		if ($error) {
			throw new GenericException( $error );
		}
	}

	public function send(Entity $entity) {

		//armamos el pdf con la data necesaria.
		$pdf = new ViewSolicitudPDF();



		$oid = $entity->getOid();
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('oid', $oid, '=');
		$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
		$oIntegranteManager = ManagerFactory::getIntegranteManager();
		$oIntegrante = $oIntegranteManager->getEntity($oCriteria);

		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('integrante_oid', $oIntegrante->getOid(), '=');
		$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
		$managerIntegranteEstado =  ManagerFactory::getIntegranteEstadoManager();
		$oIntegranteEstado = $managerIntegranteEstado->getEntity($oCriteria);

		$this->validateOnSend($entity, $oIntegranteEstado->getEstado()->getOid());

		switch ($oIntegranteEstado->getEstado()->getOid()) {
			case CYT_ESTADO_INTEGRANTE_ALTA_CREADA:
				$recibida = CYT_ESTADO_INTEGRANTE_ALTA_RECIBIDA;
				$motivo = 'Envio de alta';
				break;

			case CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO:
				$recibida = CYT_ESTADO_INTEGRANTE_CAMBIO_RECIBIDO;
				$motivo = 'Envio de cambio';
				break;

		}
		//echo $recibida;
		$oEstado = new Estado();
		$oEstado->setOid($recibida);

		$oIntegranteEstado = new IntegranteEstado();
		$oIntegranteEstado->setIntegrante($entity);
		$oIntegranteEstado->setFechaDesde(date(DB_DEFAULT_DATETIME_FORMAT));
		$oIntegranteEstado->setEstado($oEstado);
		$oIntegranteEstado->setTipoIntegrante($entity->getTipoIntegrante());
		$oIntegranteEstado->setCargo($entity->getCargo());
		$oIntegranteEstado->setDeddoc($entity->getDeddoc());
		$oIntegranteEstado->setCategoria($entity->getCategoria());
		$oIntegranteEstado->setFacultad($entity->getFacultad());

		$oIntegranteEstado->setCarreraInv($entity->getCarreraInv());
		$oIntegranteEstado->setOrganismo($entity->getOrganismo());

		$oIntegranteEstado->setBeca($entity->getBeca());

		$oIntegranteEstado->setHoras($entity->getHoras());
		$oIntegranteEstado->setActivo($entity->getActivo());

		$oIntegranteEstado->setObservaciones($entity->getObservaciones());


		$oIntegranteEstado->setMotivo($motivo);
		$oUser = CdtSecureUtils::getUserLogged();
		$oIntegranteEstado->setUser($oUser);
		$oIntegranteEstado->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));

		$this->cambiarEstado($entity, $oIntegranteEstado);



		//armamos el pdf con la data necesaria.
		$pdf->setYear(CYT_YEAR);
		$pdf->setEstadoOid($oIntegranteEstado->getEstado()->getOid());


		$pdf->setTipointegrante($oIntegrante->getTipoIntegrante()->getNombre());

		$oUnidadManager = ManagerFactory::getUnidadManager();
		$oUnidad = $oUnidadManager->getObjectByCode($oIntegrante->getUnidad()->getOid());

		//$pdf->setDs_facultad($oProyecto->getFacultad()->getDs_facultad());

		$pdf->setDenominacion($oUnidad->getDenominacion());



		$pdf->setSigla($oUnidad->getSigla());

		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('tipoUnidad_oid', $oUnidad->getTipoUnidad()->getOid(), '=');
		$oCriteria->addFilter('nombre', 'Director', '=', new CdtCriteriaFormatStringValue());
		$managerTipoIntegrante =  ManagerFactory::getTipoIntegranteManager();
		$oTipoIntegrante = $managerTipoIntegrante->getEntity($oCriteria);

		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('tipoIntegrante_oid', $oTipoIntegrante->getOid(), '=');


		$pdf->setTipoUnidad( $oUnidad->getTipoUnidad()->getNombre());

		$managerIntegrante =  ManagerFactory::getIntegranteManager();
		$oDirector = $managerIntegrante->getEntity($oCriteria);


		$pdf->setDirector($oDirector->getApellido().', '.$oDirector->getNombre());

		switch ($oEstado->getOid()) {
			case CYT_ESTADO_INTEGRANTE_ALTA_CREADA:
				$ds_tipo = 'ALTA';
				break;
			case CYT_ESTADO_INTEGRANTE_ALTA_RECIBIDA:
				$ds_tipo = 'ALTA';
				break;

			case CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO:
				$ds_tipo = 'CAMBIO';
				break;
			case CYT_ESTADO_INTEGRANTE_CAMBIO_RECIBIDO:
				$ds_tipo = 'CAMBIO';
				break;


		}

		$pdf->setTipo($ds_tipo);

		$pdf->setInvestigador($oIntegrante->getApellido().', '.$oIntegrante->getNombre());

		$pdf->setCuil($oIntegrante->getCuil());

		$pdf->setCategoria($oIntegrante->getCategoria()->getDs_categoria());



		$pdf->setCargo($oIntegrante->getCargo()->getDs_cargo());



		$pdf->setDeddoc($oIntegrante->getDeddoc()->getDs_deddoc());

		$pdf->setFacultadintegrante($oIntegrante->getFacultad()->getDs_facultad());



		$pdf->setCarrinv($oIntegrante->getCarreraInv()->getDs_carrerainv());

		$pdf->setOrganismo($oIntegrante->getOrganismo()->getDs_codigo());

		$pdf->setBeca($oIntegrante->getBeca());



		$pdf->setHoras($oIntegrante->getHoras());

		$pdf->title = CYT_MSG_SOLICITUD_PDF_TITLE;
		$pdf->SetFont('Arial','', 13);

		// establecemos los mÃƒÆ’Ã‚Â¡rgenes
		$pdf->SetMargins(10, 20 , 10);
		$pdf->setMaxWidth($pdf->w - $pdf->lMargin - $pdf->rMargin);
		//$pdf->SetAutoPageBreak(true,90);
		$pdf->AddPage();
		$pdf->AliasNbPages();

		//imprimimos la solicitud.
		$pdf->printSolicitud();

		$dir = CYT_PATH_PDFS.'/';
		if (!file_exists($dir)) mkdir($dir, 0777);
		$dir .= $oUnidad->getSigla().'/';
		if (!file_exists($dir)) mkdir($dir, 0777);
		$dir .= CYT_PATH_PDFS_INTEGRANTES.'/';







		$fileName = $dir.$ds_tipo.'_'.CYTSecureUtils::stripAccents($oIntegrante->getApellido()).'.pdf';;
		/*$pdf->Output($fileName,'F');
		$pdf->Output();*/

		$attachs = array();
		$handle=opendir($dir);
		while ($archivo = readdir($handle))
		{
			if ((is_file($dir.$archivo))&&(($ds_tipo=='ALTA')&&(!strchr($archivo,'CAMBIO_'))||($ds_tipo=='CAMBIO')&&(!strchr($archivo,'ALTA_'))))
			{
				$attachs[]=$dir.$archivo;
			}
		}





		/*$integranteMail = ($oIntegrante->getTipoIntegrante()->getOid()==6)?'Colaborador':'Integrante';
		if ($ds_tipo == 'CAMBIO') {
			$integranteMail = 'Colaborador';
		}

		switch ($ds_tipo) {
			case 'ALTA':
				$fecha = $oIntegrante->getDt_alta();
				break;
			case 'BAJA':
				$fecha = $oIntegrante->getDt_baja();
				break;
			case 'CAMBIO':
				$fecha = $oIntegrante->getDt_alta();
				break;
			case 'CAMBIODEDHS':
				$fecha = $oIntegrante->getDt_cambioHS();
				break;
			case 'CAMBIOTIPO':
				$fecha = $oIntegrante->getDt_cambioHS();
				break;

		}*/
		$integranteMail = $oIntegrante->getTipoIntegrante();
		$asunto = $ds_tipo." de ".$oIntegrante->getTipoIntegrante()->getNombre();
		$tipo = $ds_tipo;
		$asunto = CYT_LBL_INTEGRANTE_SOLICITUD.$asunto;
		$xtpl = new XTemplate( CYT_TEMPLATE_SOLICITUD_MAIL_ENVIAR );
		$xtpl->assign ( 'img_logo', WEB_PATH.'css/images/image002.gif' );
		$xtpl->assign('asunto', $asunto);
		$xtpl->assign('ds_codigo', $oIntegrante->getUnidad()->getDenominacion().' - '.$oIntegrante->getUnidad()->getSigla());
		$xtpl->assign('integranteMail', $integranteMail);
		$xtpl->assign('integrante', $oIntegrante->getApellido().', '.$oIntegrante->getNombre().' ('.$oIntegrante->getCuil().')');
		$xtpl->assign('tipo', $tipo);

		$xtpl->parse('main');
		$bodyMail = $xtpl->text('main');



		$oUser = CdtSecureUtils::getUserLogged();
		$userManager = CYTSecureManagerFactory::getUserManager();
		$oUsuario = $userManager->getObjectByCode($oUser->getCd_user());

		if ($oUsuario->getDs_email() != "") {

			CYTSecureUtils::sendMail($oUsuario->getDs_name(), $oUsuario->getDs_email(), $asunto, $bodyMail, $attachs);


		}


		/*$oCriteriaGroup = new CdtSearchCriteria();
		$oCriteriaGroup->addFilter('usergroup_oid', CYT_CD_GROUP_ADMIN_FACULTAD_PROYECTOS, '=');
		$oUserUserGroupManager = CYTSecureManagerFactory::getUserUserGroupManager();
		$oUserUserGroups = $oUserUserGroupManager->getEntities($oCriteriaGroup);
		foreach ($oUserUserGroups as $oUserUserGroup) {
			$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter('facultad_oid', $oProyecto->getFacultad()->getOid(), '=');
			$oCriteria->addFilter('oid', $oUserUserGroup->getUser()->getOid(), '=');
			$managerUsuario =  CYTSecureManagerFactory::getUserManager();
			$oUsuarios = $managerUsuario->getEntities($oCriteria);
			foreach ($oUsuarios as $usuario) {
				if ($usuario->getDs_email() != "") {

					CYTSecureUtils::sendMail($usuario->getDs_name(), $usuario->getDs_email(), $asunto, $bodyMail, $attachs);

				}
			}


		}*/

		CYTSecureUtils::sendMail(CDT_POP_MAIL_FROM_NAME, CDT_POP_MAIL_FROM, $asunto, $bodyMail, $attachs,$oUsuario->getDs_name(), $oUsuario->getDs_email());

	}

	public function confirm(Entity $entity, $admitir=1, $motivo='') {

		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('integrante_oid', $entity->getOid(), '=');
		$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
		$managerIntegranteEstado =  ManagerFactory::getIntegranteEstadoManager();
		$oIntegranteEstado = $managerIntegranteEstado->getEntity($oCriteria);
		$procesar=1;
		switch ($oIntegranteEstado->getEstado()->getOid()) {
			case CYT_ESTADO_INTEGRANTE_ALTA_RECIBIDA:
				//$dt_baja = ($admitir!=1)?$oIntegranteEstado->getDt_alta():$oIntegranteEstado->getDt_baja();
				$ds_tipo = 'ALTA';
				//$fecha = ($oIntegranteEstado->getDt_alta());
				$ds_funcion = 'Alta integrante';

				$entity->setActivo(($admitir!=1)?0:1);
				break;
			/*case CYT_ESTADO_INTEGRANTE_BAJA_RECIBIDA:
				//$dt_baja = $oIntegranteEstado->getDt_baja();
				$dt_baja = ($admitir!=1)?null:$oIntegranteEstado->getDt_baja();
				$ds_tipo = 'BAJA';
				$fecha = ($oIntegranteEstado->getDt_baja());
				$ds_funcion = 'Baja integrante';
				break;*/
			case CYT_ESTADO_INTEGRANTE_CAMBIO_RECIBIDO:
				//$dt_baja = $oIntegranteEstado->getDt_baja();
				$ds_tipo = 'CAMBIO';
				//$fecha = ($oIntegranteEstado->getDt_alta());
				$ds_funcion = 'Cambio integrante';
                if ($admitir!=1) {
                    $oCriteria = new CdtSearchCriteria();
                    $oCriteria->addFilter('integrante_oid', $entity->getOid(), '=');
                    $oCriteria->addOrder('oid','DESC');

                    $oIntegranteEstados = $managerIntegranteEstado->getEntities($oCriteria);
                    $siguiente=0;
                    foreach ($oIntegranteEstados as $integranteEstado) {
                        if ($siguiente){
                            $entity->setTipoIntegrante($integranteEstado->getTipoIntegrante());
                            $entity->setHoras($integranteEstado->getHoras());
                            $entity->setCargo($integranteEstado->getCargo());
                            $entity->setDeddoc($oIntegranteEstado->getDeddoc());
                            $entity->setCategoria($integranteEstado->getCategoria());
                            $entity->setFacultad($integranteEstado->getFacultad());

                            $entity->setCarreraInv($integranteEstado->getCarreraInv());
                            $entity->setOrganismo($integranteEstado->getOrganismo());

                            $entity->setBeca($integranteEstado->getBeca());


                            break;
                        }
                        if ($integranteEstado->getMotivo()=='Iniciar cambio') {

                            $siguiente=1;
                        }
                    }
                }
				break;
			/*case CYT_ESTADO_INTEGRANTE_CAMBIO_HS_RECIBIDO:
				$dt_baja = $oIntegranteEstado->getDt_baja();
				$ds_tipo = 'CAMBIODEDHS';
				$fecha = ($oIntegranteEstado->getDt_cambio());
				$ds_funcion = 'Cambio Dedicacion Horaria';
				if ($admitir!=1) {
					$entity->setDt_cambioHS(null);
					$entity->setDs_reduccionHS(null);
					$entity->setNu_horasinv($entity->getNu_horasinvAnt());


				}
				$entity->setNu_horasinvAnt(null);
				break;
			case CYT_ESTADO_INTEGRANTE_CAMBIO_TIPO_RECIBIDO:
				$dt_baja = $oIntegranteEstado->getDt_baja();
				$ds_tipo = 'CAMBIOTIPO';
				$fecha = ($oIntegranteEstado->getDt_cambio());
				$ds_funcion = 'Cambio tipo de integrate';
				if ($admitir!=1) {
					$oCriteria = new CdtSearchCriteria();
					$oCriteria->addFilter('integrante_oid', $entity->getOid(), '=');
					$oCriteria->addOrder('oid','DESC');

					$oIntegranteEstados = $managerIntegranteEstado->getEntities($oCriteria);
					$siguiente=0;
					foreach ($oIntegranteEstados as $integranteEstado) {
						if ($siguiente){
							$entity->setTipointegrante($integranteEstado->getTipointegrante());
							$entity->setNu_horasinv($integranteEstado->getNu_horasinv());
							//$entity->setDt_alta($integranteEstado->getDt_alta());
							break;
						}
						if ($integranteEstado->getMotivo()=='Iniciar cambio de tipo') {

							$siguiente=1;
						}
					}
				}
				break;*/
			default:
				$procesar=0;
				break;
		}


		if ($procesar) {
			$ds_funcionMail = $ds_funcion;
			if ($oIntegranteEstado->getTipoIntegrante()->getOid()==6) $ds_funcionMail = str_replace('integrante','colaborador',$ds_funcionMail);
			$integranteMail = ($oIntegranteEstado->getTipoIntegrante()->getOid()==6)?'Colaborador':'Integrante';


			$confirmacion = ($admitir==1)?'Confirmacion de ':'Rechazo de ';

			$asunto = $confirmacion.$ds_funcionMail;
			$tipo = $ds_tipo;

			$oEstado = new Estado();
			$oEstado->setOid(CYT_ESTADO_INTEGRANTE_ADMITIDO);



			$oIntegranteEstadoNuevo = new IntegranteEstado();

            $oIntegranteEstadoNuevo->setIntegrante($entity);
            $oIntegranteEstadoNuevo->setFechaDesde(date(DB_DEFAULT_DATETIME_FORMAT));
            $oIntegranteEstadoNuevo->setEstado($oEstado);
            $oIntegranteEstadoNuevo->setTipoIntegrante($entity->getTipoIntegrante());
            $oIntegranteEstadoNuevo->setCargo($entity->getCargo());
            $oIntegranteEstadoNuevo->setDeddoc($entity->getDeddoc());
            $oIntegranteEstadoNuevo->setCategoria($entity->getCategoria());
            $oIntegranteEstadoNuevo->setFacultad($entity->getFacultad());

            $oIntegranteEstadoNuevo->setCarreraInv($entity->getCarreraInv());
            $oIntegranteEstadoNuevo->setOrganismo($entity->getOrganismo());

            $oIntegranteEstadoNuevo->setBeca($entity->getBeca());

            $oIntegranteEstadoNuevo->setHoras($entity->getHoras());
			$oIntegranteEstadoNuevo->setActivo($entity->getActivo());

            $oIntegranteEstadoNuevo->setObservaciones($entity->getObservaciones());

            $oIntegranteEstadoNuevo->setMotivo(($motivo)?$motivo:$asunto);

            $oUser = CdtSecureUtils::getUserLogged();
            $oIntegranteEstadoNuevo->setUser($oUser);
            $oIntegranteEstadoNuevo->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));






			$this->cambiarEstado($entity, $oIntegranteEstadoNuevo);




			/*$proyectoManager = ManagerFactory::getProyectoManager();
			$oProyecto = $proyectoManager->getObjectByCode($entity->getProyecto()->getOid());

			$xtpl = new XTemplate( CYT_TEMPLATE_SOLICITUD_MAIL_ENVIAR );
			$xtpl->assign ( 'img_logo', WEB_PATH.'css/images/image002.gif' );
			$xtpl->assign('asunto', $asunto);
			$xtpl->assign('ds_codigo', $oProyecto->getDs_codigo());
			$xtpl->assign('integranteMail', $integranteMail);
			$xtpl->assign('integrante', $entity->getDocente()->getDs_apellido().', '.$entity->getDocente()->getDs_nombre().' ('.$entity->getDocente()->getNu_precuil().'-'.$entity->getDocente()->getNu_documento().'-'.$entity->getDocente()->getNu_postcuil().')');
			$xtpl->assign('tipo', $tipo);
			$xtpl->assign('fecha', CYTSecureUtils::formatDateToView($fecha));
			$xtpl->assign('comment', $motivo);
			$xtpl->parse('main');
			$bodyMail = $xtpl->text('main');




			$oDirector = $docentesManager->getObjectByCode($oProyecto->getDirector()->getOid());

			if ($oDirector->getDs_mail() != "") {

				CYTSecureUtils::sendMail($oDirector->getDs_apellido().', '.$oDirector->getDs_nombre(), $oDirector->getDs_mail(), $asunto, $bodyMail);


			}
			$oCriteriaGroup = new CdtSearchCriteria();
			$oCriteriaGroup->addFilter('usergroup_oid', CYT_CD_GROUP_ADMIN_FACULTAD_PROYECTOS, '=');
			$oUserUserGroupManager = CYTSecureManagerFactory::getUserUserGroupManager();
			$oUserUserGroups = $oUserUserGroupManager->getEntities($oCriteriaGroup);
			foreach ($oUserUserGroups as $oUserUserGroup) {
				$oCriteria = new CdtSearchCriteria();
				$oCriteria->addFilter('facultad_oid', $oProyecto->getFacultad()->getOid(), '=');
				$oCriteria->addFilter('oid', $oUserUserGroup->getUser()->getOid(), '=');
				$managerUsuario =  CYTSecureManagerFactory::getUserManager();
				$oUsuarios = $managerUsuario->getEntities($oCriteria);
				foreach ($oUsuarios as $usuario) {
					if ($usuario->getDs_email() != "") {

						CYTSecureUtils::sendMail($usuario->getDs_name(), $usuario->getDs_email(), $asunto, $bodyMail, $attachs);

					}
				}


			}
			//CYTSecureUtils::sendMail(CDT_POP_MAIL_FROM_NAME, CDT_POP_MAIL_FROM, $asunto, $bodyMail, $attachs,$oUsuario->getDs_name(), $oUsuario->getDs_email());*/

		}



	}


	public function anular(Entity $entity) {

		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('integrante_oid', $entity->getOid(), '=');
		$oCriteria->addNull('cyt_unidad_integrante_estado.fechaHasta');
		$managerIntegranteEstado =  ManagerFactory::getIntegranteEstadoManager();
		$oIntegranteEstado = $managerIntegranteEstado->getEntity($oCriteria);

		switch ($oIntegranteEstado->getEstado()->getOid()) {

			/*case CYT_ESTADO_INTEGRANTE_BAJA_CREADA:
				$entity->setDt_baja(null);
				$entity->setDs_consecuencias(null);
				$entity->setDs_motivos(null);
				$motivo = 'Anular baja';

				break;*/
			case CYT_ESTADO_INTEGRANTE_CAMBIO_CREADO:

                $oCriteria = new CdtSearchCriteria();
                $oCriteria->addFilter('integrante_oid', $entity->getOid(), '=');
                $oCriteria->addOrder('oid','DESC');

                $oIntegranteEstados = $managerIntegranteEstado->getEntities($oCriteria);
                $siguiente=0;
                foreach ($oIntegranteEstados as $integranteEstado) {
                    if ($siguiente){
                        $entity->setTipoIntegrante($integranteEstado->getTipoIntegrante());
                        $entity->setHoras($integranteEstado->getHoras());
                        $entity->setCargo($integranteEstado->getCargo());
                        $entity->setDeddoc($oIntegranteEstado->getDeddoc());
                        $entity->setCategoria($integranteEstado->getCategoria());
                        $entity->setFacultad($integranteEstado->getFacultad());

                        $entity->setCarreraInv($integranteEstado->getCarreraInv());
                        $entity->setOrganismo($integranteEstado->getOrganismo());

                        $entity->setBeca($integranteEstado->getBeca());
						$entity->setActivo($integranteEstado->getActivo());
                        break;
                    }
                    if ($integranteEstado->getMotivo()=='Iniciar cambio') {

                        $siguiente=1;
                    }
                }
				$motivo = 'Anular cambio de integrante';
				break;
			/*case CYT_ESTADO_INTEGRANTE_CAMBIO_HS_CREADO:

				$entity->setDt_cambioHS(null);
				$entity->setDs_reduccionHS(null);
				$entity->setNu_horasinv($entity->getNu_horasinvAnt());
				$entity->setNu_horasinvAnt(null);
				$motivo = 'Anular cambio de dedicacion horaria';
				break;
			case CYT_ESTADO_INTEGRANTE_CAMBIO_TIPO_CREADO:

				$oCriteria = new CdtSearchCriteria();
				$oCriteria->addFilter('integrante_oid', $entity->getOid(), '=');
				$oCriteria->addOrder('oid','DESC');

				$oIntegranteEstados = $managerIntegranteEstado->getEntities($oCriteria);
				$siguiente=0;
				foreach ($oIntegranteEstados as $integranteEstado) {
					if ($siguiente){
						$entity->setTipointegrante($integranteEstado->getTipointegrante());
						$entity->setNu_horasinv($integranteEstado->getNu_horasinv());
						//$entity->setDt_alta($integranteEstado->getDt_alta());
						break;
					}
					if ($integranteEstado->getMotivo()=='Iniciar cambio de tipo') {

						$siguiente=1;
					}
				}
				$motivo = 'Anular cambio de tipo';
				break;*/


		}






		$oEstado = new Estado();
		$oEstado->setOid(CYT_ESTADO_INTEGRANTE_ADMITIDO);

		$oIntegranteEstadoNuevo = new IntegranteEstado();
		$oIntegranteEstadoNuevo->setIntegrante($entity);
		$oIntegranteEstadoNuevo->setFechaDesde(date(DB_DEFAULT_DATETIME_FORMAT));
		$oIntegranteEstadoNuevo->setEstado($oEstado);
        $oIntegranteEstadoNuevo->setTipoIntegrante($entity->getTipoIntegrante());
        $oIntegranteEstadoNuevo->setCargo($entity->getCargo());
        $oIntegranteEstadoNuevo->setDeddoc($entity->getDeddoc());
        $oIntegranteEstadoNuevo->setCategoria($entity->getCategoria());
        $oIntegranteEstadoNuevo->setFacultad($entity->getFacultad());

        $oIntegranteEstadoNuevo->setCarreraInv($entity->getCarreraInv());
        $oIntegranteEstadoNuevo->setOrganismo($entity->getOrganismo());

        $oIntegranteEstadoNuevo->setBeca($entity->getBeca());

        $oIntegranteEstadoNuevo->setHoras($entity->getHoras());
		$oIntegranteEstadoNuevo->setActivo($entity->getActivo());

        $oIntegranteEstadoNuevo->setObservaciones($entity->getObservaciones());

        $oIntegranteEstadoNuevo->setMotivo(($motivo)?$motivo:'');

        $oUser = CdtSecureUtils::getUserLogged();
        $oIntegranteEstadoNuevo->setUser($oUser);
        $oIntegranteEstadoNuevo->setFechaUltModificacion(date(DB_DEFAULT_DATETIME_FORMAT));

		$this->cambiarEstado($entity, $oIntegranteEstadoNuevo);


	}



}
?>
