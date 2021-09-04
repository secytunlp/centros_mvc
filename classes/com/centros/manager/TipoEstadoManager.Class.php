<?php

/**
 * Manager para TipoEstado
 *  
 * @author Marcos
 * @since 23-10-2013
 */
class TipoEstadoManager extends EntityManager{

	public function getDAO(){
		return DAOFactory::getTipoEstadoDAO();
	}

}
?>
