ALTER TABLE `docente` ENGINE = InnoDB;
ALTER TABLE `facultad` ENGINE = InnoDB;

CREATE TABLE `cdt_action_function` (
  `cd_actionfunction` int(11) NOT NULL auto_increment,
  `cd_function` int(11) NOT NULL,
  `ds_action` varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`cd_actionfunction`),
  UNIQUE KEY `ds_action` (`ds_action`),
  KEY `fk_funtion` (`cd_function`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `cdt_action_function`
-- 

INSERT INTO `cdt_action_function` VALUES (1, 1, 'add_cdtactionfunction_init');
INSERT INTO `cdt_action_function` VALUES (2, 1, 'add_cdtactionfunction');
INSERT INTO `cdt_action_function` VALUES (3, 2, 'delete_cdtactionfunction');
INSERT INTO `cdt_action_function` VALUES (4, 3, 'view_cdtactionfunction');
INSERT INTO `cdt_action_function` VALUES (5, 4, 'update_cdtactionfunction');
INSERT INTO `cdt_action_function` VALUES (6, 4, 'update_cdtactionfunction_init');
INSERT INTO `cdt_action_function` VALUES (7, 5, 'list_cdtactionfunctions');
INSERT INTO `cdt_action_function` VALUES (8, 6, 'add_cdtfunction');
INSERT INTO `cdt_action_function` VALUES (9, 6, 'add_cdtfunction_init');
INSERT INTO `cdt_action_function` VALUES (10, 7, 'delete_cdtfunction');
INSERT INTO `cdt_action_function` VALUES (11, 8, 'view_cdtfunction');
INSERT INTO `cdt_action_function` VALUES (12, 9, 'update_cdtfunction');
INSERT INTO `cdt_action_function` VALUES (13, 9, 'update_cdtfunction_init');
INSERT INTO `cdt_action_function` VALUES (14, 10, 'list_cdtfunctions');
INSERT INTO `cdt_action_function` VALUES (15, 11, 'add_cdtmenugroup');
INSERT INTO `cdt_action_function` VALUES (16, 11, 'add_cdtmenugroup_init');
INSERT INTO `cdt_action_function` VALUES (17, 12, 'delete_cdtmenugroup');
INSERT INTO `cdt_action_function` VALUES (18, 13, 'view_cdtmenugroup');
INSERT INTO `cdt_action_function` VALUES (19, 14, 'update_cdtmenugroup');
INSERT INTO `cdt_action_function` VALUES (20, 14, 'update_cdtmenugroup_init');
INSERT INTO `cdt_action_function` VALUES (21, 15, 'list_cdtmenugroups');
INSERT INTO `cdt_action_function` VALUES (22, 16, 'add_cdtmenuoption');
INSERT INTO `cdt_action_function` VALUES (23, 16, 'add_cdtmenuoption_init');
INSERT INTO `cdt_action_function` VALUES (24, 17, 'delete_cdtmenuoption');
INSERT INTO `cdt_action_function` VALUES (25, 18, 'view_cdtmenuoption');
INSERT INTO `cdt_action_function` VALUES (26, 19, 'update_cdtmenuoption');
INSERT INTO `cdt_action_function` VALUES (27, 19, 'update_cdtmenuoption_init');
INSERT INTO `cdt_action_function` VALUES (28, 20, 'list_cdtmenuoptions');
INSERT INTO `cdt_action_function` VALUES (29, 21, 'add_cdtregistration');
INSERT INTO `cdt_action_function` VALUES (30, 21, 'add_cdtregistration_init');
INSERT INTO `cdt_action_function` VALUES (31, 22, 'delete _cdtregistration');
INSERT INTO `cdt_action_function` VALUES (32, 23, 'view_cdtregistration');
INSERT INTO `cdt_action_function` VALUES (33, 24, 'update_cdtregistration');
INSERT INTO `cdt_action_function` VALUES (34, 24, 'update_cdtregistration_init');
INSERT INTO `cdt_action_function` VALUES (35, 25, 'list_cdtregistrations');
INSERT INTO `cdt_action_function` VALUES (36, 26, 'add_cdtuser');
INSERT INTO `cdt_action_function` VALUES (37, 26, 'add_cdtuser_init');
INSERT INTO `cdt_action_function` VALUES (38, 27, 'delete _cdtuser');
INSERT INTO `cdt_action_function` VALUES (39, 28, 'view_cdtuser');
INSERT INTO `cdt_action_function` VALUES (40, 29, 'update_cdtuser');
INSERT INTO `cdt_action_function` VALUES (41, 29, 'update_cdtuser_init');


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_audit`
-- 

CREATE TABLE `cdt_audit` (
  `oid` bigint(20) NOT NULL auto_increment,
  `cd_user` int(11) NOT NULL,
  `ds_action` varchar(255) NOT NULL,
  `ds_host` varchar(50) NOT NULL,
  `dt_date` datetime NOT NULL,
  PRIMARY KEY  (`oid`),
  KEY `ds_action` (`ds_action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `cdt_audit`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_function`
-- 

CREATE TABLE `cdt_function` (
  `cd_function` int(11) NOT NULL auto_increment,
  `ds_function` varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`cd_function`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `cdt_function`
-- 

INSERT INTO `cdt_function` VALUES (1, 'Agregar Acción de la función');
INSERT INTO `cdt_function` VALUES (2, 'Eliminar Acción de la función');
INSERT INTO `cdt_function` VALUES (3, 'Ver Acción de la función');
INSERT INTO `cdt_function` VALUES (4, 'Modificar Acción de la función');
INSERT INTO `cdt_function` VALUES (5, 'Listar Acciones de la función');
INSERT INTO `cdt_function` VALUES (6, 'Agregar Función');
INSERT INTO `cdt_function` VALUES (7, 'Eliminar Función');
INSERT INTO `cdt_function` VALUES (8, 'Ver Función');
INSERT INTO `cdt_function` VALUES (9, 'Modificar Función');
INSERT INTO `cdt_function` VALUES (10, 'Listar Funciones');
INSERT INTO `cdt_function` VALUES (11, 'Agregar Grupo de menú');
INSERT INTO `cdt_function` VALUES (12, 'Eliminar Grupo de menú');
INSERT INTO `cdt_function` VALUES (13, 'Ver Grupo de menú');
INSERT INTO `cdt_function` VALUES (14, 'Modificar Grupo de menú');
INSERT INTO `cdt_function` VALUES (15, 'Listar Grupos de menú');
INSERT INTO `cdt_function` VALUES (16, 'Agregar Opción de menú');
INSERT INTO `cdt_function` VALUES (17, 'Eliminar Opción de menú');
INSERT INTO `cdt_function` VALUES (18, 'Ver Opción de menú');
INSERT INTO `cdt_function` VALUES (19, 'Modificar Opción de menú');
INSERT INTO `cdt_function` VALUES (20, 'Listar Opciones de menú');
INSERT INTO `cdt_function` VALUES (21, 'Agregar Registración');
INSERT INTO `cdt_function` VALUES (22, 'Eliminar Registración');
INSERT INTO `cdt_function` VALUES (23, 'Ver Registración');
INSERT INTO `cdt_function` VALUES (24, 'Modificar Registración');
INSERT INTO `cdt_function` VALUES (25, 'Listar Registraciones');
INSERT INTO `cdt_function` VALUES (26, 'Agregar Usuario');
INSERT INTO `cdt_function` VALUES (27, 'Eliminar Usuario');
INSERT INTO `cdt_function` VALUES (28, 'Ver Usuario');
INSERT INTO `cdt_function` VALUES (29, 'Modificar Usuario');
INSERT INTO `cdt_function` VALUES (30, 'Listar Usuarios');
INSERT INTO `cdt_function` VALUES (31, 'Agregar Grupo de usuario');
INSERT INTO `cdt_function` VALUES (32, 'Eliminar Grupo de usuario');
INSERT INTO `cdt_function` VALUES (33, 'Ver Grupo de usuario');
INSERT INTO `cdt_function` VALUES (34, 'Modificar Grupo de usuario');
INSERT INTO `cdt_function` VALUES (35, 'Listar Grupos de usuario');
INSERT INTO `cdt_function` VALUES (36, 'Agregar Función del grupo de usuario');
INSERT INTO `cdt_function` VALUES (37, 'Eliminar Función del grupo de usuario');
INSERT INTO `cdt_function` VALUES (38, 'Ver Función del grupo de usuario');
INSERT INTO `cdt_function` VALUES (39, 'Modificar Función del grupo de usuario');
INSERT INTO `cdt_function` VALUES (40, 'Listar Funciones del grupo de usuario');
INSERT INTO `cdt_function` VALUES (41, 'Editar Perfil');


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_menugroup`
-- 

CREATE TABLE `cdt_menugroup` (
  `cd_menugroup` int(11) NOT NULL auto_increment,
  `nu_order` int(11) NOT NULL,
  `nu_width` int(11) NOT NULL,
  `ds_name` varchar(100) character set latin1 NOT NULL,
  `ds_action` varchar(50) character set latin1 default NULL,
  `ds_cssclass` varchar(50) character set latin1 default NULL,
  PRIMARY KEY  (`cd_menugroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- 
-- Volcar la base de datos para la tabla `cdt_menugroup`
-- 

INSERT INTO `cdt_menugroup` VALUES (1, 1, 65, 'Acceso', 'panel_control&currentMenuGroup=1', 'accesos');
INSERT INTO `cdt_menugroup` VALUES (10, 2, 80, 'Administración', 'panel_control&currentMenuGroup=10', 'config');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_menuoption`
-- 

CREATE TABLE `cdt_menuoption` (
  `cd_menuoption` int(11) NOT NULL auto_increment,
  `ds_name` varchar(100) character set latin1 NOT NULL,
  `ds_href` varchar(255) character set latin1 NOT NULL,
  `cd_function` int(11) default NULL,
  `nu_order` int(11) default NULL,
  `cd_menugroup` int(11) default NULL,
  `ds_cssclass` varchar(50) character set latin1 default NULL,
  `ds_description` varchar(50) character set latin1 default NULL,
  PRIMARY KEY  (`cd_menuoption`),
  KEY `cd_function` (`cd_function`),
  KEY `fk_menuoption_menugroup1` (`cd_menugroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

-- 
-- Volcar la base de datos para la tabla `cdt_menuoption`
-- 

INSERT INTO `cdt_menuoption` VALUES (1, 'CdtActionFunctions', 'doAction?action=list_cdtactionfunctions', 5, 5, 1, 'cdtactionfunctions', 'Acciones de Función');
INSERT INTO `cdt_menuoption` VALUES (2, 'CdtFunctions', 'doAction?action=list_cdtfunctions', 10, 5, 1, 'cdtfunctions', 'Funciones');
INSERT INTO `cdt_menuoption` VALUES (3, 'CdtMenuGroups', 'doAction?action=list_cdtmenugroups', 15, 5, 1, 'cdtmenugroups', 'Grupos de Menú');
INSERT INTO `cdt_menuoption` VALUES (4, 'CdtMenuOptions', 'doAction?action=list_cdtmenuoptions', 20, 5, 1, 'cdtmenuoptions', 'Opciones de Menú');
INSERT INTO `cdt_menuoption` VALUES (5, 'Registrations', 'doAction?action=list_cdtregistrations', 25, 5, 1, 'cdtregistrations', 'Registraciones');
INSERT INTO `cdt_menuoption` VALUES (6, 'Users', 'doAction?action=list_cdtusers', 30, 5, 1, 'cdtusers', 'Usuarios');
INSERT INTO `cdt_menuoption` VALUES (7, 'Usergroups', 'doAction?action=list_cdtusergroups', 35, 5, 1, 'cdtusergroups', 'Grupos de usuario');
INSERT INTO `cdt_menuoption` VALUES (8, 'CdtUserGroupFunctions', 'doAction?action=list_cdtusergroupfunctions', 40, 5, 1, 'cdtusergroupfunctions', 'Funciones de Grupos de Usuario');


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_my_filter`
-- 

CREATE TABLE `cdt_my_filter` (
  `id` int(11) NOT NULL auto_increment,
  `cd_user` int(11) NOT NULL,
  `filter_name` varchar(255) NOT NULL,
  `filter_values` varchar(255) NOT NULL,
  `filter_id` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `cdt_my_filter`
-- 

INSERT INTO `cdt_my_filter` VALUES (1, 1, 'filter', 'nombre=''Bernar'',sexos=F,M', 'filter');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_registration`
-- 

CREATE TABLE `cdt_registration` (
  `cd_registration` int(11) NOT NULL auto_increment,
  `ds_activationcode` varchar(150) collate utf8_unicode_ci NOT NULL,
  `dt_date` varchar(8) collate utf8_unicode_ci NOT NULL,
  `ds_username` varchar(150) collate utf8_unicode_ci NOT NULL,
  `ds_name` varchar(150) collate utf8_unicode_ci default NULL,
  `ds_email` varchar(150) collate utf8_unicode_ci default NULL,
  `ds_password` varchar(150) collate utf8_unicode_ci NOT NULL,
  `ds_phone` varchar(50) collate utf8_unicode_ci default NULL,
  `ds_address` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`cd_registration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `cdt_registration`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_user`
-- 

CREATE TABLE `cdt_user` (
  `cd_user` int(11) NOT NULL auto_increment,
  `ds_username` varchar(150) collate utf8_unicode_ci NOT NULL,
  `ds_name` varchar(150) collate utf8_unicode_ci default NULL,
  `ds_email` varchar(150) collate utf8_unicode_ci default NULL,
  `ds_password` varchar(150) collate utf8_unicode_ci default NULL,
  `cd_usergroup` int(11) NOT NULL,
  `ds_phone` varchar(50) collate utf8_unicode_ci default NULL,
  `ds_address` varchar(255) collate utf8_unicode_ci default NULL,
  `ds_ips` varchar(25) collate utf8_unicode_ci NOT NULL,
  `nu_attemps` int(11) NOT NULL,
  PRIMARY KEY  (`cd_user`),
  KEY `fk_usergroup` (`cd_usergroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `cdt_user`
-- 

INSERT INTO `cdt_user` VALUES (1, '20-25174805-6', 'Marcos Piñero', 'marcosp@presi.unlp.edu.ar', 'aab87325369d132b5ccd67503d65e75c', 1, '', '', '', 0);


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_usergroup`
-- 

CREATE TABLE `cdt_usergroup` (
  `cd_usergroup` int(11) NOT NULL auto_increment,
  `ds_usergroup` varchar(150) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`cd_usergroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `cdt_usergroup`
-- 

INSERT INTO `cdt_usergroup` VALUES (1, 'Administrador');
INSERT INTO `cdt_usergroup` VALUES (2, 'Director');
INSERT INTO `cdt_usergroup` VALUES (3, 'SeCyT');


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cdt_usergroup_function`
-- 

CREATE TABLE `cdt_usergroup_function` (
  `cd_usergroup_function` int(11) NOT NULL auto_increment,
  `cd_usergroup` int(11) NOT NULL,
  `cd_function` int(11) NOT NULL,
  PRIMARY KEY  (`cd_usergroup_function`),
  KEY `fk_usergroup` (`cd_usergroup`),
  KEY `fk_function` (`cd_function`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2589 ;

-- 
-- Volcar la base de datos para la tabla `cdt_usergroup_function`
-- 


INSERT INTO `cdt_usergroup_function` VALUES (2432, 1, 1);
INSERT INTO `cdt_usergroup_function` VALUES (2433, 1, 2);
INSERT INTO `cdt_usergroup_function` VALUES (2434, 1, 3);
INSERT INTO `cdt_usergroup_function` VALUES (2435, 1, 4);
INSERT INTO `cdt_usergroup_function` VALUES (2436, 1, 5);
INSERT INTO `cdt_usergroup_function` VALUES (2437, 1, 6);
INSERT INTO `cdt_usergroup_function` VALUES (2438, 1, 7);
INSERT INTO `cdt_usergroup_function` VALUES (2439, 1, 8);
INSERT INTO `cdt_usergroup_function` VALUES (2440, 1, 9);
INSERT INTO `cdt_usergroup_function` VALUES (2441, 1, 10);
INSERT INTO `cdt_usergroup_function` VALUES (2442, 1, 11);
INSERT INTO `cdt_usergroup_function` VALUES (2443, 1, 12);
INSERT INTO `cdt_usergroup_function` VALUES (2444, 1, 13);
INSERT INTO `cdt_usergroup_function` VALUES (2445, 1, 14);
INSERT INTO `cdt_usergroup_function` VALUES (2446, 1, 15);
INSERT INTO `cdt_usergroup_function` VALUES (2447, 1, 16);
INSERT INTO `cdt_usergroup_function` VALUES (2448, 1, 17);
INSERT INTO `cdt_usergroup_function` VALUES (2449, 1, 18);
INSERT INTO `cdt_usergroup_function` VALUES (2450, 1, 19);
INSERT INTO `cdt_usergroup_function` VALUES (2451, 1, 20);
INSERT INTO `cdt_usergroup_function` VALUES (2452, 1, 21);
INSERT INTO `cdt_usergroup_function` VALUES (2453, 1, 22);
INSERT INTO `cdt_usergroup_function` VALUES (2454, 1, 23);
INSERT INTO `cdt_usergroup_function` VALUES (2455, 1, 24);
INSERT INTO `cdt_usergroup_function` VALUES (2456, 1, 25);
INSERT INTO `cdt_usergroup_function` VALUES (2457, 1, 26);
INSERT INTO `cdt_usergroup_function` VALUES (2458, 1, 27);
INSERT INTO `cdt_usergroup_function` VALUES (2459, 1, 28);
INSERT INTO `cdt_usergroup_function` VALUES (2460, 1, 29);
INSERT INTO `cdt_usergroup_function` VALUES (2461, 1, 30);
INSERT INTO `cdt_usergroup_function` VALUES (2462, 1, 31);
INSERT INTO `cdt_usergroup_function` VALUES (2463, 1, 32);
INSERT INTO `cdt_usergroup_function` VALUES (2464, 1, 33);
INSERT INTO `cdt_usergroup_function` VALUES (2465, 1, 34);
INSERT INTO `cdt_usergroup_function` VALUES (2466, 1, 35);
INSERT INTO `cdt_usergroup_function` VALUES (2467, 1, 36);
INSERT INTO `cdt_usergroup_function` VALUES (2468, 1, 37);
INSERT INTO `cdt_usergroup_function` VALUES (2469, 1, 38);
INSERT INTO `cdt_usergroup_function` VALUES (2470, 1, 39);
INSERT INTO `cdt_usergroup_function` VALUES (2471, 1, 40);
INSERT INTO `cdt_usergroup_function` VALUES (2472, 1, 41);


-- 
-- Filtros para las tablas descargadas (dump)
-- 

-- 
-- Filtros para la tabla `cdt_action_function`
-- 
ALTER TABLE `cdt_action_function`
  ADD CONSTRAINT `cdt_action_function_ibfk_1` FOREIGN KEY (`cd_function`) REFERENCES `cdt_function` (`cd_function`);

-- 
-- Filtros para la tabla `cdt_menuoption`
-- 
ALTER TABLE `cdt_menuoption`
  ADD CONSTRAINT `cdt_menuoption_ibfk_1` FOREIGN KEY (`cd_function`) REFERENCES `cdt_function` (`cd_function`),
  ADD CONSTRAINT `cdt_menuoption_ibfk_2` FOREIGN KEY (`cd_menugroup`) REFERENCES `cdt_menugroup` (`cd_menugroup`);

-- 
-- Filtros para la tabla `cdt_user`
-- 
ALTER TABLE `cdt_user`
  ADD CONSTRAINT `cdt_user_ibfk_1` FOREIGN KEY (`cd_usergroup`) REFERENCES `cdt_usergroup` (`cd_usergroup`);

-- 
-- Filtros para la tabla `cdt_usergroup_function`
-- 
ALTER TABLE `cdt_usergroup_function`
  ADD CONSTRAINT `cdt_usergroup_function_ibfk_1` FOREIGN KEY (`cd_usergroup`) REFERENCES `cdt_usergroup` (`cd_usergroup`),
  ADD CONSTRAINT `cdt_usergroup_function_ibfk_2` FOREIGN KEY (`cd_function`) REFERENCES `cdt_function` (`cd_function`);
  
CREATE TABLE cyt_tipo_unidad (
  oid int(20) NOT NULL auto_increment,
  nombre varchar(100) default NULL,
  PRIMARY KEY  (oid)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



INSERT INTO cyt_tipo_unidad VALUES (1, 'Centro');
INSERT INTO cyt_tipo_unidad VALUES (2, 'Laboratorio');
INSERT INTO cyt_tipo_unidad VALUES (3, 'Instituto');
INSERT INTO cyt_tipo_unidad VALUES (4, 'Unidad promocional de I/D');




CREATE TABLE cyt_unidad (
  oid bigint(20) NOT NULL auto_increment,
  user_oid int(11) NOT NULL,
  tipoUnidad_oid int(20) default NULL,	
  denominacion varchar(255) default NULL,
  sigla varchar(20) default NULL,
  especialidad varchar(255) default NULL,
  objetivos text default NULL,
  lineas text default NULL,
  justificacion text default NULL,
  funciones text default NULL,
  produccion text default NULL,
  proyectos text default NULL,
  rrhh text default NULL,
  reglamento text default NULL,
  infraestructura text default NULL,
  equipamiento text default NULL,
  observaciones text default NULL,
  userUlt_oid int(11) NOT NULL,
  fechaUltModificacion timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (oid),
  KEY user_oid (user_oid),
  KEY tipoUnidad_oid (tipoUnidad_oid),
  KEY userUlt_oid (userUlt_oid)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE cyt_unidad ADD FOREIGN KEY ( user_oid ) REFERENCES cdt_user (
cd_user
);

ALTER TABLE cyt_unidad ADD FOREIGN KEY ( tipoUnidad_oid ) REFERENCES cyt_tipo_unidad (
oid
);

ALTER TABLE cyt_unidad ADD FOREIGN KEY ( userUlt_oid ) REFERENCES cdt_user (
cd_user
);

CREATE TABLE cyt_unidad_facultad (
  oid bigint(20) NOT NULL auto_increment,
  
  unidad_oid bigint(20) default NULL,
  facultad_oid int(11) default NULL,	
  
  PRIMARY KEY  (oid),
  KEY unidad_oid (unidad_oid),
  KEY facultad_oid (facultad_oid)  
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
 
 ALTER TABLE cyt_unidad_facultad ADD FOREIGN KEY ( unidad_oid ) REFERENCES cyt_unidad (
oid
);

ALTER TABLE cyt_unidad_facultad ADD FOREIGN KEY ( facultad_oid ) REFERENCES facultad (
cd_facultad
);

ALTER TABLE cyt_unidad_facultad ADD UNIQUE (
unidad_oid ,
facultad_oid
); 

CREATE TABLE cyt_tipo_estado (
  oid bigint(20) NOT NULL auto_increment,
  nombre varchar(200) NOT NULL,
 
  PRIMARY KEY  (oid)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
 
 INSERT INTO cyt_tipo_estado VALUES (1, 'Creada');
INSERT INTO cyt_tipo_estado VALUES (2, 'Enviada');
INSERT INTO cyt_tipo_estado VALUES (3, 'Recibida');
INSERT INTO cyt_tipo_estado VALUES (4, 'Aprobada');
 

CREATE TABLE cyt_unidad_tipo_estado (
  oid bigint(20) NOT NULL auto_increment,
  unidad_oid bigint(20) default NULL,
  tipoEstado_oid bigint(20) default NULL,
  fechaDesde datetime default NULL,
  fechaHasta datetime default NULL,
  motivo varchar(200) NOT NULL,
  user_oid int(11) NOT NULL,
  fechaUltModificacion timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (oid),
  KEY unidad_oid (unidad_oid),
  KEY tipoEstado_oid (tipoEstado_oid),
  KEY user_oid (user_oid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

ALTER TABLE cyt_unidad_tipo_estado ADD FOREIGN KEY ( unidad_oid ) REFERENCES cyt_unidad (
oid
);

ALTER TABLE cyt_unidad_tipo_estado ADD FOREIGN KEY ( tipoEstado_oid ) REFERENCES cyt_tipo_estado (
oid
);

ALTER TABLE cyt_unidad_tipo_estado ADD FOREIGN KEY ( user_oid ) REFERENCES cdt_user (
cd_user
);

CREATE TABLE cyt_tipo_integrante (
  oid bigint(20) NOT NULL auto_increment,
  nombre varchar(200) NOT NULL,
  gobierno int(2) NOT NULL,		
  orden int(2) NOT NULL,	
  tipoUnidad_oid int(11) NOT NULL,
  PRIMARY KEY  (oid),
  KEY tipoUnidad_oid (tipoUnidad_oid)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
 
ALTER TABLE cyt_tipo_integrante ADD FOREIGN KEY ( tipoUnidad_oid ) REFERENCES cyt_tipo_unidad (
oid
);
 
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Director', 1,1,2);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Consejo asesor', 1,2,2);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Miembro',0,3,2);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Director', 1,1,1);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Sub-Director', 1,2,1);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Consejo directivo', 1,3,1);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Miembro',0,4,1);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Director', 1,1,3);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Sub-Director', 1,2,3);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Consejo directivo', 1,3,3);
INSERT INTO cyt_tipo_integrante VALUES (NULL, 'Miembro',0,4,3);



 
 CREATE TABLE cyt_unidad_integrante (
  oid bigint(20) NOT NULL auto_increment,
  unidad_oid bigint(20) default NULL,
  tipoIntegrante_oid bigint(20) default NULL,
  apellido varchar(255) NOT NULL,
  nombre varchar(255) NOT NULL,
  cuil varchar(15) NOT NULL,
  categoria_oid int(11) default NULL,
  carreraInv_oid int(11) default NULL,
  organismo_oid int(11) default NULL,
  beca varchar(255) NOT NULL,
  cargo_oid int(11) default NULL,
  dedDoc_oid int(11) default NULL,
  facultad_oid int(11) default NULL,
  lugarTrabajo_oid int(11) default NULL,
  horas int(11) default NULL,
  observaciones text default NULL,
  fechaDesde datetime default NULL,
  fechaHasta datetime default NULL,
  user_oid int(11) NOT NULL,
  fechaUltModificacion timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  activo int(2) NOT NULL default '1',
  estudiante int(2) NOT NULL default '0',
  PRIMARY KEY  (oid),
  KEY unidad_oid (unidad_oid),
  KEY tipoIntegrante_oid (tipoIntegrante_oid),
  KEY user_oid (user_oid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( unidad_oid ) REFERENCES cyt_unidad (
oid
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( tipoIntegrante_oid ) REFERENCES cyt_tipo_integrante (
oid
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( categoria_oid ) REFERENCES categoria (cd_categoria
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( carreraInv_oid ) REFERENCES carrerainv (cd_carrerainv
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( organismo_oid ) REFERENCES organismo (cd_organismo
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( cargo_oid ) REFERENCES cargo (cd_cargo
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( dedDoc_oid ) REFERENCES deddoc (cd_deddoc
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( facultad_oid ) REFERENCES facultad (cd_facultad
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( lugarTrabajo_oid ) REFERENCES unidad (cd_unidad
);

ALTER TABLE cyt_unidad_integrante ADD FOREIGN KEY ( user_oid ) REFERENCES cdt_user (
cd_user
);

INSERT INTO cdt_function VALUES (42, 'Listar unidades');
INSERT INTO cdt_function VALUES (43, 'Agregar unidad');
INSERT INTO cdt_function VALUES (44, 'Modificar unidad');
INSERT INTO cdt_function VALUES (45, 'Eliminar unidad');
INSERT INTO cdt_function VALUES (46, 'Ver unidad');

INSERT INTO cdt_menuoption VALUES (NULL, 'Unidades', 'doAction?action=list_unidades', 42, 1, 10, 'tiposTitulo', '');

INSERT INTO cdt_action_function VALUES (NULL, 42, 'list_unidades');
INSERT INTO cdt_action_function VALUES (NULL, 43, 'add_unidad_init');
INSERT INTO cdt_action_function VALUES (NULL, 43, 'add_unidad');
INSERT INTO cdt_action_function VALUES (NULL, 44, 'update_unidad_init');
INSERT INTO cdt_action_function VALUES (NULL, 44, 'update_unidad');
INSERT INTO cdt_action_function VALUES (NULL, 45, 'delete_unidad');
INSERT INTO cdt_action_function VALUES (NULL, 46, 'view_unidad');

INSERT INTO cdt_function VALUES (NULL, 'Listar integrantes');
INSERT INTO cdt_function VALUES (NULL, 'Agregar integrante');
INSERT INTO cdt_function VALUES (NULL, 'Modificar integrante');
INSERT INTO cdt_function VALUES (NULL, 'Eliminar integrante');
INSERT INTO cdt_function VALUES (NULL, 'Ver integrante');



INSERT INTO cdt_action_function VALUES (NULL, 47, 'list_integrantes');
INSERT INTO cdt_action_function VALUES (NULL, 48, 'add_integrante_init');
INSERT INTO cdt_action_function VALUES (NULL, 48, 'add_integrante');
INSERT INTO cdt_action_function VALUES (NULL, 49, 'update_integrante_init');
INSERT INTO cdt_action_function VALUES (NULL, 49, 'update_integrante');
INSERT INTO cdt_action_function VALUES (NULL, 50, 'delete_integrante');
INSERT INTO cdt_action_function VALUES (NULL, 51, 'view_integrante');

ALTER TABLE `cyt_unidad_integrante`
	ADD UNIQUE INDEX `unidad_oid_cuil` (`unidad_oid`, `cuil`);

INSERT INTO cdt_function VALUES (52, 'Listar estados');
INSERT INTO cdt_function VALUES (53, 'Cambiar estado');

INSERT INTO cdt_action_function VALUES (NULL, 52, 'list_unidadesTipoEstado');
INSERT INTO cdt_action_function VALUES (NULL, 53, 'cambiarEstadoUnidad_init');
INSERT INTO cdt_action_function VALUES (NULL, 53, 'cambiarEstadoUnidad');

#################################################### 06/10/2016 ##########################################################################

ALTER TABLE `cyt_unidad` CHANGE `reglamento` `reglamento` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `cyt_unidad` ADD `memorias` VARCHAR( 255 ) NULL; 

ALTER TABLE `cyt_unidad_integrante` ADD `lugarTrabajo` VARCHAR( 255 ) NULL; 

ALTER TABLE `cyt_unidad_integrante` ADD curriculum VARCHAR( 255 ) NULL; 

ALTER TABLE `cyt_unidad_integrante` ADD mail VARCHAR( 255 ) NULL; 

ALTER TABLE `cyt_unidad_integrante` ADD telefono VARCHAR( 255 ) NULL; 

ALTER TABLE `cyt_tipo_unidad`
	ADD COLUMN `activo` TINYINT(1) NOT NULL DEFAULT '1' AFTER `nombre`;

UPDATE `cyt_tipo_unidad` SET `activo`=0 WHERE  `oid`=2;
UPDATE `cyt_tipo_unidad` SET `activo`=0 WHERE  `oid`=4;

INSERT INTO `cyt_tipo_unidad` (`nombre`) VALUES ('Laboratorio');



INSERT INTO `cyt_tipo_integrante` ( `nombre`, `gobierno`, `orden`, `tipoUnidad_oid`) VALUES
('Director', 1, 1, 5),
('Consejo directivo', 1, 2, 5),
('Miembro', 0, 3, 5);


ALTER TABLE `cyt_tipo_unidad` ADD `minMiembros` INT NOT NULL ,
ADD `catDirector` VARCHAR( 20 ) NOT NULL ,
ADD `minCD` VARCHAR( 20 ) NOT NULL;

UPDATE `cyt_tipo_unidad` SET `minMiembros` = '6',
`catDirector` = '6,7',
`minCD` = '2_2_6,7,8' WHERE `cyt_tipo_unidad`.`oid` =5;

UPDATE `cyt_tipo_unidad` SET `minMiembros` = '12',
`catDirector` = '6,7_1',
`minCD` = '6_4_6,7,8' WHERE `cyt_tipo_unidad`.`oid` =1;

UPDATE `cyt_tipo_unidad` SET `minMiembros` = '18',
`catDirector` = '6,7_1',
`minCD` = '6_4_6,7,8' WHERE `cyt_tipo_unidad`.`oid` =3;

 #################################################### 27/12/2019 ##########################################################################
 
 ALTER TABLE `cyt_unidad` ADD `dt_disposicion` date NULL; 
 
 ALTER TABLE `cyt_unidad` ADD `nu_disposicion` VARCHAR( 255 ) NULL;

 #################################################### 13/05/2022 ##########################################################################

 ALTER TABLE `cyt_unidad_integrante`

	ADD COLUMN `estado_oid` INT(11) NULL;

ALTER TABLE `cyt_unidad_integrante` DROP INDEX `estado_oid`, ADD INDEX `estado_oid` (`estado_oid`) USING BTREE;


UPDATE cyt_unidad_integrante SET cyt_unidad_integrante.estado_oid = 3;

CREATE TABLE `cyt_unidad_integrante_estado` (
  `oid` bigint(20) NOT NULL,
  `integrante_oid` bigint(20) DEFAULT NULL,
  `unidad_oid` bigint(20) DEFAULT NULL,
  `tipoIntegrante_oid` bigint(20) DEFAULT NULL,
  `categoria_oid` int(11) DEFAULT NULL,
  `carreraInv_oid` int(11) DEFAULT NULL,
  `organismo_oid` int(11) DEFAULT NULL,
  `beca` varchar(255) NOT NULL,
  `cargo_oid` int(11) DEFAULT NULL,
  `dedDoc_oid` int(11) DEFAULT NULL,
  `facultad_oid` int(11) DEFAULT NULL,
  `lugarTrabajo_oid` int(11) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `observaciones` text,
  `motivo` text,
  `fechaDesde` datetime DEFAULT NULL,
  `fechaHasta` datetime DEFAULT NULL,
  `user_oid` int(11) NOT NULL,
  `fechaUltModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` int(2) NOT NULL DEFAULT '1',
  `estudiante` int(2) DEFAULT '0',
  `estado_oid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indices de la tabla `cyt_unidad_integrante`
--
ALTER TABLE `cyt_unidad_integrante_estado`
  ADD PRIMARY KEY (`oid`),

  ADD KEY `integrante_oid` (`integrante_oid`),
  ADD KEY `unidad_oid` (`unidad_oid`),
  ADD KEY `tipoIntegrante_oid` (`tipoIntegrante_oid`),
  ADD KEY `user_oid` (`user_oid`),
  ADD KEY `estado_oid` (`estado_oid`);

ALTER TABLE `cyt_unidad_integrante_estado`
  MODIFY `oid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cyt_unidad_integrante`
--
ALTER TABLE `cyt_unidad_integrante_estado`
  ADD CONSTRAINT `cyt_unidad_integrante_estado_ibfk_1` FOREIGN KEY (`unidad_oid`) REFERENCES `cyt_unidad` (`oid`),
  ADD CONSTRAINT `cyt_unidad_integrante_estado_ibfk_4` FOREIGN KEY (`integrante_oid`) REFERENCES `cyt_integrante_unidad` (`oid`),
  ADD CONSTRAINT `cyt_unidad_integrante_estado_ibfk_2` FOREIGN KEY (`tipoIntegrante_oid`) REFERENCES `cyt_tipo_integrante` (`oid`),
  ADD CONSTRAINT `cyt_unidad_integrante_estado_ibfk_3` FOREIGN KEY (`user_oid`) REFERENCES `cdt_user` (`cd_user`);
COMMIT;

INSERT INTO cyt_unidad_integrante_estado (integrante_oid, unidad_oid, tipoIntegrante_oid, categoria_oid, carreraInv_oid, organismo_oid, beca, cargo_oid, dedDoc_oid, facultad_oid, lugarTrabajo_oid, horas, observaciones, fechaDesde, fechaHasta, user_oid, fechaUltModificacion, activo, estudiante, estado_oid)
SELECT cyt_unidad_integrante.oid, cyt_unidad_integrante.unidad_oid, cyt_unidad_integrante.tipoIntegrante_oid, cyt_unidad_integrante.categoria_oid,
cyt_unidad_integrante.carreraInv_oid, cyt_unidad_integrante.organismo_oid, cyt_unidad_integrante.beca, cyt_unidad_integrante.cargo_oid,
cyt_unidad_integrante.dedDoc_oid, cyt_unidad_integrante.facultad_oid, cyt_unidad_integrante.lugarTrabajo_oid, cyt_unidad_integrante.horas, cyt_unidad_integrante.observaciones, cyt_unidad_integrante.fechaDesde, cyt_unidad_integrante.fechaHasta, cyt_unidad_integrante.user_oid, cyt_unidad_integrante.fechaUltModificacion, cyt_unidad_integrante.activo, cyt_unidad_integrante.estudiante, cyt_unidad_integrante.estado_oid
FROM cyt_unidad_integrante;

#################################################### 07/02/2025 ##########################################################################

ALTER TABLE `cyt_unidad_integrante`
    ADD COLUMN `categoriasicadi_oid` INT(11) NULL;

##############actualizar sicadis
UPDATE cyt_unidad_integrante cui
    JOIN docente d ON SUBSTRING_INDEX(SUBSTRING_INDEX(cui.cuil, '-', -2), '-', 1) = d.nu_documento
    SET cui.categoriasicadi_oid = d.cd_categoriasicadi;