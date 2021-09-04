<?php

/**
 * Factory para TipoUnidad
 *  
 * @author Marcos
 * @since 17-10-2013
 */
class TipoUnidadFactory extends CdtGenericFactory {

    public function build($next) {

        $this->setClassName('TipoUnidad');
        $tipoUnidad = parent::build($next);

        return $tipoUnidad;
    }

}
?>
