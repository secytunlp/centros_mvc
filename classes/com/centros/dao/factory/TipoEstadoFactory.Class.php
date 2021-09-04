<?php

/**
 * Factory para TipoEstado
 *  
 * @author Marcos
 * @since 21-10-2013
 */
class TipoEstadoFactory extends CdtGenericFactory {

    public function build($next) {

        $this->setClassName('TipoEstado');
        $tipoEstado = parent::build($next);

        return $tipoEstado;
    }

}
?>
