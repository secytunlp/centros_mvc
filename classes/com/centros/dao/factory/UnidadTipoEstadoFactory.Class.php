<?php

/**
 * Factory para UnidadTipoEstado
 *  
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadTipoEstadoFactory extends CdtGenericFactory {

    public function build($next) {

        $this->setClassName('UnidadTipoEstado');
        $unidadTipoEstado = parent::build($next);
        
    	$factory = new TipoEstadoFactory();
        $factory->setAlias( CYT_TABLE_TIPO_ESTADO. "_" );
        $unidadTipoEstado->setTipoEstado( $factory->build($next) );
        
        $factory = new UnidadFactory();
        $factory->setAlias( CYT_TABLE_UNIDAD. "_" );
        $unidadTipoEstado->setUnidad( $factory->build($next) );
        
        
    	if(array_key_exists('ds_username',$next)){
			
			$factory = new CdtUserFactory();
        	//$factory->setAlias( CYT_TABLE_CDT_USER . "_" );
        	$unidadTipoEstado->setUser( $factory->build($next) );
		}

        return $unidadTipoEstado;
    }

}
?>
