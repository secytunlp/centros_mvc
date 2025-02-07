<?php

/**
 * Factory para Integrante
 *  
 * @author Marcos
 * @since 30-10-2013
 */
class IntegranteFactory extends CdtGenericFactory {

    public function build($next) {

        $this->setClassName('Integrante');
        $integrante = parent::build($next);
        
        $factory = new UnidadFactory();
        $factory->setAlias( CYT_TABLE_UNIDAD . "_" );
        $integrante->setUnidad( $factory->build($next) );
        
        $factory = new TipoIntegranteFactory();
        $factory->setAlias( CYT_TABLE_TIPO_INTEGRANTE . "_" );
        $integrante->setTipoIntegrante( $factory->build($next) );
        
        $factory = new CategoriaFactory();
        $factory->setAlias( CYT_TABLE_CATEGORIA . "_" );
        $integrante->setCategoria( $factory->build($next) );

        $factory = new CategoriasicadiFactory();
        $factory->setAlias( CYT_TABLE_CATEGORIA_SICADI . "_" );
        $integrante->setCategoriasicadi( $factory->build($next) );
        
        $factory = new CarrerainvFactory();
        $factory->setAlias( CYT_TABLE_CARRERAINV . "_" );
        $integrante->setCarrerainv( $factory->build($next) );
        
        $factory = new OrganismoFactory();
        $factory->setAlias( CYT_TABLE_ORGANISMO . "_" );
        $integrante->setOrganismo( $factory->build($next) );
        
        $factory = new CargoFactory();
        $factory->setAlias( CYT_TABLE_CARGO . "_" );
        $integrante->setCargo( $factory->build($next) );
        
        $factory = new DeddocFactory();
        $factory->setAlias( CYT_TABLE_DEDDOC . "_" );
        $integrante->setDeddoc( $factory->build($next) );
        
        $factory = new FacultadFactory();
        $factory->setAlias( CYT_TABLE_FACULTAD . "_" );
        $integrante->setFacultad( $factory->build($next) );

        $factory = new EstadoFactory();
        $factory->setAlias( CYT_TABLE_ESTADOINTEGRANTE . "_" );
        $integrante->setEstado( $factory->build($next) );
        
        /*$factory = new LugarTrabajoFactory();
        $factory->setAlias( "LugarTrabajo_" );
        $integrante->setLugarTrabajo( $factory->build($next) );*/
        
    	if(array_key_exists('ds_username',$next)){
			
			$factory = new CdtUserFactory();
        	//$factory->setAlias( CYT_TABLE_CDT_USER . "_" );
        	$integrante->setUser( $factory->build($next) );
		}

        return $integrante;
    }

}
?>
