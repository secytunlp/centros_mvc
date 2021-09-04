<?php

/**
 * Acción para listar históricos estados.
 *
 * @author Marcos
 * @since 07-11-2013
 *
 */
class ListUnidadesTipoEstadoAction extends CMPEntityGridAction{


	protected function getComponent() {
		return new CMPUnidadTipoEstadoGrid();
	}



}
