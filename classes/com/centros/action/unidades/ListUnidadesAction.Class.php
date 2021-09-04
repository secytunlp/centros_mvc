<?php

/**
 * Acción para listar unidades.
 *
 * @author Marcos
 * @since 19-10-2013
 *
 */
class ListUnidadesAction extends CMPEntityGridAction{


	protected function getComponent() {
		return new CMPUnidadGrid();
	}



}
