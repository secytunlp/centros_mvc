<?php

/**
 * se definen los mensajes del sistema en español.
 *
 * @author modelBuilder
 *
 */


include_once('messages_labels_es.php');


//PDF
define('CYT_MSG_UNIDAD_PDF_TITLE', 'VISUALIZAR UNIDAD', true);
define('CYT_MSG_UNIDAD_PDF_HEADER_TITLE', 'CENTROS, LABORATORIOS E INSTITUTOS', true);
define('CYT_MSG_UNIDAD_PDF_PAGINA', 'Página', true);
define('CYT_MSG_UNIDAD_PDF_PAGINA_DE', 'de', true);

/* TIPOS DE UNIDAD */

define('CYT_MSG_TIPO_UNIDAD_TITLE_LIST', 'Tipos de unidad', true);
define('CYT_MSG_TIPO_UNIDAD_TITLE_ADD', 'Agregar ' . CYT_LBL_TIPO_UNIDAD, true);
define('CYT_MSG_TIPO_UNIDAD_TITLE_UPDATE', 'Modificar ' . CYT_LBL_TIPO_UNIDAD , true);
define('CYT_MSG_TIPO_UNIDAD_TITLE_VIEW', 'Visualizar ' . CYT_LBL_TIPO_UNIDAD , true);
define('CYT_MSG_TIPO_UNIDAD_TITLE_DELETE', 'Borrar ' . CYT_LBL_TIPO_UNIDAD , true);

define('CYT_MSG_TIPO_UNIDAD_NOMBRE_REQUIRED', CYT_LBL_TIPO_UNIDAD_NOMBRE . ' es requerido', true);

/* UNIDADES */

define('CYT_MSG_UNIDAD_TITLE_LIST', 'Unidades', true);
define('CYT_MSG_UNIDAD_TITLE_ADD', 'Agregar ' . CYT_LBL_UNIDAD, true);
define('CYT_MSG_UNIDAD_TITLE_UPDATE', 'Modificar ' . CYT_LBL_UNIDAD , true);
define('CYT_MSG_UNIDAD_TITLE_VIEW', 'Visualizar ' . CYT_LBL_UNIDAD , true);
define('CYT_MSG_UNIDAD_TITLE_DELETE', 'Borrar ' . CYT_LBL_UNIDAD , true);

define('CYT_MSG_UNIDAD_FINALIDAD', "Finalidad", true);
define('CYT_MSG_UNIDAD_ANTECEDENTES', "Antecedentes", true);
define('CYT_MSG_UNIDAD_FUNCIONES', "Funciones", true);

define('CYT_MSG_UNIDAD_DENOMINACION_REQUIRED', CYT_LBL_UNIDAD_DENOMINACION . ' es requerido', true);
define('CYT_MSG_UNIDAD_TIPO_UNIDAD_REQUIRED', CYT_LBL_UNIDAD_TIPO_UNIDAD . ' es requerido', true);
define('CYT_MSG_UNIDAD_SIGLA_REQUIRED', 'Para poder subir archivos debe ingresar la SIGLA de la Unidad', true);
define('CYT_MSG_UNIDAD_ESPECIALIDAD_REQUIRED', CYT_LBL_UNIDAD_ESPECIALIDAD . ' es requerido', true);
define('CYT_MSG_UNIDAD_OBJETIVOS_REQUIRED', CYT_LBL_UNIDAD_OBJETIVOS . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_FINALIDAD, true);
define('CYT_MSG_UNIDAD_LINEAS_REQUIRED', CYT_LBL_UNIDAD_LINEAS . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_FINALIDAD, true);
define('CYT_MSG_UNIDAD_JUSTIFICACION_REQUIRED', CYT_LBL_UNIDAD_JUSTIFICACION . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_FINALIDAD, true);
define('CYT_MSG_UNIDAD_FUNCIONES_REQUIRED', CYT_LBL_UNIDAD_FUNCIONES . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_FUNCIONES, true);
define('CYT_MSG_UNIDAD_PRODUCCION_REQUIRED', CYT_LBL_UNIDAD_PRODUCCION . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_ANTECEDENTES, true);
define('CYT_MSG_UNIDAD_PROYECTOS_REQUIRED', CYT_LBL_UNIDAD_PROYECTOS . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_ANTECEDENTES, true);
define('CYT_MSG_UNIDAD_RRHH_REQUIRED', CYT_LBL_UNIDAD_RRHH . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_ANTECEDENTES, true);
define('CYT_MSG_UNIDAD_REGLAMENTO_REQUIRED', CYT_LBL_UNIDAD_REGLAMENTO . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_FUNCIONES, true);
define('CYT_MSG_UNIDAD_INFRAESTRUCTURA_REQUIRED', CYT_LBL_UNIDAD_INFRAESTRUCTURA . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_FUNCIONES, true);
define('CYT_MSG_UNIDAD_EQUIPAMIENTO_REQUIRED', CYT_LBL_UNIDAD_EQUIPAMIENTO . ' es requerido, ubicado en menú '.CYT_MSG_UNIDAD_FUNCIONES, true);
define('CYT_MSG_UNIDAD_OBSERVACIONES_REQUIRED', CYT_LBL_UNIDAD_OBSERVACIONES . ' es requerido', true);

define('CYT_MSG_UNIDAD_ELIMINAR_PROHIBIDO', 'Sólo se pueden eliminar las unidades con estado CREADA', true);
define('CYT_MSG_UNIDAD_MODIFICAR_PROHIBIDO', 'Sólo se pueden modificar las unidades con estado CREADA', true);
define('CYT_MSG_UNIDAD_ENVIAR_PROHIBIDO', 'Sólo se pueden enviar las unidades con estado CREADA', true);

define('CYT_MSG_UNIDAD_ENVIAR_PREGUNTA', 'Luego de enviar la solicitud no podrá realizar modificaciones ¿Continua?', true);
define('CYT_MSG_UNIDAD_ADMITIR_PREGUNTA', '¿Está seguro de admitir?', true);
define('CYT_MSG_UNIDAD_ARCHIVO_NOMBRE', 'SOLICITUD_', true);
define('CYT_MSG_UNIDAD_ADMITIR_PROHIBIDO', 'Sólo se pueden admitir/rechazar las solicitudes con estado RECIBIDA', true);

define('CYT_MSG_FIN_PERIODO', 'El período para presentar la Solicitud ha Finalizado', true);


/* UNIDADES FACULTADES*/
define('CYT_MSG_UNIDAD_FACULTAD_FACULTAD_REQUIRED', CYT_LBL_UNIDAD_FACULTADES_FACULTAD . ' es requerido', true);
define('CYT_MSG_UNIDAD_FACULTAD_REQUIRED', 'Debe asignar al menos una dependencia académica', true);

define('CYT_MSG_UNIDAD_FACULTAD_ASIGNAR', 'Asignar Dependencia', true);
define('CYT_MSG_UNIDAD_FACULTAD', "Indique las dependencias académicas para la unidad", true);

/* INTEGRANTES */

define('CYT_MSG_INTEGRANTE_TITLE_LIST', 'Miembros', true);
define('CYT_MSG_INTEGRANTE_TITLE_ADD', 'Agregar ' . CYT_LBL_INTEGRANTE, true);
define('CYT_MSG_INTEGRANTE_TITLE_UPDATE', 'Modificar ' . CYT_LBL_INTEGRANTE , true);
define('CYT_MSG_INTEGRANTE_TITLE_VIEW', 'Visualizar ' . CYT_LBL_INTEGRANTE , true);
define('CYT_MSG_INTEGRANTE_TITLE_DELETE', 'Borrar ' . CYT_LBL_INTEGRANTE , true);

define('CYT_MSG_INTEGRANTE_TIPO_INTEGRANTE_REQUIRED', CYT_LBL_TIPO_INTEGRANTE. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_APELLIDO_REQUIRED', CYT_LBL_INTEGRANTE_APELLIDO. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_APELLIDO_CV_REQUIRED', 'Para poder subir el CV debe ingresar el apellido del integrante', true);
define('CYT_MSG_INTEGRANTE_NOMBRE_REQUIRED', CYT_LBL_INTEGRANTE_NOMBRE. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_CUIL_REQUIRED', CYT_LBL_INTEGRANTE_CUIL. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_MAIL_REQUIRED', CYT_LBL_INTEGRANTE_MAIL. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_CARRERAINV_REQUIRED', CYT_LBL_INTEGRANTE_CARRERAINV. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_CATEGORIA_REQUIRED', CYT_LBL_INTEGRANTE_CATEGORIA. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_ORGANISMO_REQUIRED', CYT_LBL_INTEGRANTE_ORGANISMO. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_BECA_REQUIRED', CYT_LBL_INTEGRANTE_BECA. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_CARGO_REQUIRED', CYT_LBL_INTEGRANTE_CARGO. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_DEDDOC_REQUIRED', CYT_LBL_INTEGRANTE_DEDDOC. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_FACULTAD_REQUIRED', CYT_LBL_INTEGRANTE_FACULTAD. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_LUGAR_TRABAJO_REQUIRED', CYT_LBL_INTEGRANTE_LUGAR_TRABAJO. ' es requerido', true);
define('CYT_MSG_INTEGRANTE_HORAS_REQUIRED', CYT_LBL_INTEGRANTE_HORAS. ' es requerido', true);

define('CYT_MSG_INTEGRANTE_CUIL_FORMAT', 'El C.U.I.L. debe ser del formato xx-xxxxxxxx-xx', true);

define('CYT_MSG_INTEGRANTE_OTRA_UNIDAD', 'El investigador es miembro de ', true);

define('CYT_MSG_INTEGRANTE_MIN', 'El nro. de miembros debe ser al menos ', true);

define("CYT_MSG_DIRECTOR_ERROR_DEDICACION",  "No tiene Dedicación suficiente para ser director", true );
define("CYT_MSG_CD_INTEGRANTE_MIN",  "El nro. de miembros del Consejo Directivo debe ser al menos ", true );
define("CYT_MSG_CD_INTEGRANTE_MIN_CAT",  "El nro. de miembros del Consejo Directivo con categoría I, II o III debe ser al menos ", true );

define('CYT_MSG_DIRECTOR_ERROR_CANTIDAD', 'Ya existe un Director', true);
define('CYT_MSG_SUBDIRECTOR_ERROR_CANTIDAD', 'Ya existe un Subdirector', true);

/* UNIDADES TIPO ESTADO */
define('CYT_MSG_UNIDAD_TIPO_ESTADO_TITLE_LIST', 'Estados', true);
define('CYT_MSG_UNIDAD_TIPO_ESTADO_CAMBIAR', 'Cambiar-estado', true);

define('CYT_MSG_UNIDAD_TIPO_ESTADO_UNIDAD_REQUIRED', CYT_LBL_UNIDAD. ' es requerido', true);
define('CYT_MSG_UNIDAD_TIPO_ESTADO_TIPO_ESTADO_REQUIRED', CYT_LBL_TIPO_ESTADO. ' es requerido', true);
?>