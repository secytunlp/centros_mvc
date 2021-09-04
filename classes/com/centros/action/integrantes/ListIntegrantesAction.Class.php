<?php

/**
 * Acción para listar integrantes.
 *
 * @author Marcos
 * @since 29-10-2013
 *
 */
class ListIntegrantesAction extends CMPEntityGridAction{


	protected function getComponent() {
		return new CMPIntegranteGrid();
	}



}
