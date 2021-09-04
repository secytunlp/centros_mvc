<?php

/**
 * Factory para Unidad Facultad
 *  
 * @author Marcos
 * @since 21-10-2013
 */
class UnidadFacultadFactory extends CdtGenericFactory {

    public function build($next) {

        $this->setClassName('UnidadFacultad');
        $unidadFacultad = parent::build($next);

        $factory = new UnidadFactory();
        $factory->setAlias( CYT_TABLE_UNIDAD . "_" );
        $unidadFacultad->setUnidad( $factory->build($next) );
        
   		$factory = new FacultadFactory();
        $factory->setAlias( CYT_TABLE_FACULTAD . "_" );
        $unidadFacultad->setFacultad( $factory->build($next) );
        
        
        
   		
        
        return $unidadFacultad;
    }
}
?>
