<?php

/**
 * Factory para TipoIntegrante
 *  
 * @author Marcos
 * @since 30-10-2013
 */
class TipoIntegranteFactory extends CdtGenericFactory {

    public function build($next) {

        $this->setClassName('TipoIntegrante');
        $tipoIntegrante = parent::build($next);
        
        $factory = new TipoUnidadFactory();
        $factory->setAlias( CYT_TABLE_TIPO_UNIDAD . "_" );
        $tipoIntegrante->setTipoUnidad( $factory->build($next) );

        return $tipoIntegrante;
    }

}
?>
