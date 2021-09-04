<?php

/**
 * Implementación para renderizar un formulario de integrante 
 *
 * @author Marcos
 * @since 11-10-2016
 *
 */
class CMPIntegranteFormRenderer extends DefaultFormRenderer {

	 protected function getXTemplate() {
    	return new XTemplate( CYT_TEMPLATE_INTEGRANTE_FORM );
    }
	
	
	protected function renderFieldset(CMPForm $form, XTemplate $xtpl){
		$xtpl->assign("apellido_requerido", CYT_MSG_INTEGRANTE_APELLIDO_CV_REQUIRED);
		foreach ($form->getFieldsets() as $fieldset) {
			
			//legend
			$legend = $fieldset->getLegend();
			if(!empty($legend)){
				$xtpl->assign("value", $legend);
				$xtpl->parse("main.fieldset.legend");
			}
			
			//fields
			/*
			foreach ($fieldset->getFields() as $formField) {
				$input = $formField->getInput();
				$label = $formField->getLabel();
				
				if( $input->getIsVisible() ){
					$this->renderLabel( $label, $input, $xtpl );
					$this->renderInput( $input, $xtpl );
				
					$xtpl->parse("main.fieldset.column.field");
				}
				
			}
			$xtpl->parse("main.fieldset.column");
			 */
			
			foreach ($fieldset->getFieldsColumns() as $column => $fields) {
				
				foreach ($fields as $formField) {
					
					$input = $formField->getInput();
					$label = $formField->getLabel();
					
					$this->renderLabel( $label, $input, $xtpl );
					$this->renderInput( $input, $xtpl );
					$xtpl->assign("minWidth", $formField->getMinWidth());
					
					if( $input->getIsVisible() ){
						$xtpl->assign("display", 'block');
						
					}
					else $xtpl->assign("display", 'none');
					
					$xtpl->parse("main.fieldset.column.field");
				}
				$xtpl->parse("main.fieldset.column");
			}
			
			$xtpl->parse("main.fieldset");
			
			$xtpl->assign("value", CYT_LBL_INTEGRANTE_CURRICULUM );
			$xtpl->assign("required", "*" );
			$xtpl->parse("main.curriculum.label");
			$xtpl->assign("actionFile", "doAction?action=add_file_session" );
			$hiddens = $form->getHiddens();
			$hiddenDs_curriculum = $hiddens['curriculum'];	
			if (!$hiddenDs_curriculum->getInputValue()) {
				$xtpl->assign("curriculum_requerido", 'jval="{valid:function (val) { return required(val,\'Curriculum es requerido\'); }}"');
			}
			$xtpl->parse("main.curriculum.input");
			$xtpl->assign("display", 'block');
			$xtpl->assign("label_curriculum", CYT_LBL_INTEGRANTE_CURRICULUM_SIGEVA);
			
				
			if ($hiddenDs_curriculum->getInputValue()) {
				$xtpl->assign("curriculum_cargado", '<span style="color:#009900; font-weight:bold">'.CYT_MSG_FILE_UPLOAD_EXITO.$hiddenDs_curriculum->getInputValue().'</span>');
			}
			
			$xtpl->parse("main.curriculum");
				
			
		} 
	}
	
	
	
	


	
	
	
	
	
}