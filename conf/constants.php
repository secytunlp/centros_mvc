<?php




//envío de emails.


//desarrollo.
define('CDT_POP_MAIL_FROM', 'marcosp@codnet.com.ar');
define('CDT_POP_MAIL_FROM_NAME', 'Centros, Laboratorios e Institutos');
define('CDT_POP_MAIL_HOST', 'cyt.presi.unlp.edu.ar');
//define('CDT_POP_MAIL_PORT', '465');
define('CDT_POP_MAIL_MAILER', 'smtp');
define('CDT_POP_MAIL_USERNAME', 'marcosp@presi.unlp.edu.ar');
define('CDT_POP_MAIL_PASSWORD', 'elMaster1');
define('CDT_MAIL_ENVIO_POP', true);

define("CDT_DEBUG_LOG", true);
define("CDT_ERROR_LOG", true);
define("CDT_MESSAGE_LOG", true);



define('CYT_ESTADO_UNIDAD_CREADA', 1);
define('CYT_ESTADO_UNIDAD_ENVIADA', 2);
define('CYT_ESTADO_UNIDAD_RECIBIDA', 3);
define('CYT_ESTADO_UNIDAD_APROBADA', 4);

define('CYT_TIPO_INTEGRANTE_DIRECTOR', '1,4,8,12');
define('CYT_TIPO_INTEGRANTE_SUBDIRECTOR', '5,9');

define('CYT_FECHA_CIERRE', '2016-10-30');

define('CYT_CD_GROUPS_MOSTRAR', '2,16,17');

?>