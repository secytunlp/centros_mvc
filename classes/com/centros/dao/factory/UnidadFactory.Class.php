<?php

/**
 * Factory para Unidad
 *  
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadFactory extends CdtGenericFactory {

    public function build($next) {
		//print_r($next);
        $this->setClassName('Unidad');
        $unidad = parent::build($next);

        $factory = new TipoUnidadFactory();
        $factory->setAlias( CYT_TABLE_TIPO_UNIDAD . "_" );
        $unidad->setTipoUnidad( $factory->build($next) );
        
        
        $factory = new TipoEstadoFactory();
        $factory->setAlias( CYT_TABLE_TIPO_ESTADO. "_" );
        $unidad->setTipoEstado( $factory->build($next) );
        
    	
			
			
        	//$unidad->setFacultad( $next['facultad_ds_facultad'] );
		
        
    	if(array_key_exists('ds_username',$next)){
			
			$factory = new CdtUserFactory();
        	//$factory->setAlias( CYT_TABLE_CDT_USER . "_" );
        	$unidad->setUser( $factory->build($next) );
		}
		
    	if(array_key_exists('U_ds_username',$next)){
			
			$factory = new CdtUserFactory();
        	$factory->setAliasUser( "U" );
        	$unidad->setUserUlt( $factory->build($next) );
		}
        
        
        
        return $unidad;
    }
}
?>
