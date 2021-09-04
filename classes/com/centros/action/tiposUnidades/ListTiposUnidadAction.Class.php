<?php

/**
 * Acción para listar tipos de Unidad.
 *
 * @author Marcos
 * @since 17-10-2013
 *
 */
class ListTiposUnidadAction extends CMPEntityGridAction{


	protected function getComponent() {
		return new CMPTipoUnidadGrid();
	}



}
