<?php

/**
 * Manager para TipoUnidad
 *  
 * @author Marcos
 * @since 17-10-2013
 */
class TipoUnidadManager extends EntityManager{

	public function getDAO(){
		return DAOFactory::getTipoUnidadDAO();
	}

}
?>
