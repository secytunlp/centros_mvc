<?php

/**
 * Acción para visualizar un tipo de Unidad.
 *
 * @author Marcos
 * @since 17-10-2013
 *
 */
class ViewTipoUnidadAction extends UpdateTipoUnidadInitAction {



	protected function parseEntity($entity, XTemplate $xtpl) {

		$this->getForm()->setIsEditable( false );

		parent::parseEntity($entity, $xtpl);


	}

	/**
	 * (non-PHPdoc)
	 * @see CdtOutputAction::getLayout();
	 */
	protected function getLayout() {
		$oLayout = new CdtLayoutBasicAjax();
		return $oLayout;
	}


	/**
	 * (non-PHPdoc)
	 * @see CdtOutputAction::getOutputTitle();
	 */
	protected function getOutputTitle() {
		return CYT_MSG_TIPO_Unidad_TITLE_VIEW;
	}

}
