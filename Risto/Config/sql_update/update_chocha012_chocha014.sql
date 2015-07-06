/** UPDATE FROM Chocha012 to Chocha014 **/


ALTER TABLE  account_egresos ADD  `media_id` INT NULL ;
ALTER TABLE  account_gastos ADD  `media_id` INT NULL ;
ALTER TABLE  categorias ADD  `media_id` INT NULL ;


ALTER TABLE  descuentos ADD  `deleted_date` timestamp NULL DEFAULT NULL;
ALTER TABLE  descuentos ADD  `deleted` tinyint(4) NOT NULL DEFAULT '0';




ALTER TABLE  iva_responsabilidades ADD  `tipo_factura_id` int(11) NOT NULL;



ALTER TABLE  `detalle_comandas` MODIFY  `cant` float NOT NULL;


ALTER TABLE  `mesas` MODIFY  `numero` VARCHAR( 64 ) NOT NULL ;
ALTER TABLE  `mesas` MODIFY  `total` decimal(10,2) DEFAULT '0.00';
ALTER TABLE  `mesas` MODIFY  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00';
ALTER TABLE  `mesas` ADD `descuento_id` int(11) DEFAULT NULL;

ALTER TABLE  `mesas` ADD `observation` text NULL;
ALTER TABLE  `mesas` ADD `checkin` timestamp NULL DEFAULT NULL;
ALTER TABLE  `mesas` ADD `checkout` timestamp NULL DEFAULT NULL;



ALTER TABLE  `mesas` MODIFY `numero` varchar(64) NOT NULL;


ALTER TABLE  `mozos` 
	ADD `nombre` varchar(64) DEFAULT NULL,
  	ADD `apellido` varchar(64) DEFAULT NULL,
  	ADD `media_id` int(10) unsigned DEFAULT NULL;



ALTER TABLE  `pagos` MODIFY  `tipo_de_pago_id` int(10) unsigned DEFAULT NULL;


ALTER TABLE  `clientes` CHANGE  `codigo`  `codigo` VARCHAR( 64 ) NULL DEFAULT NULL ;
ALTER TABLE  `clientes` MODIFY  `domicilio`   varchar(500) DEFAULT NULL;

ALTER TABLE `clientes` DROP `user_id`;
ALTER TABLE `clientes` DROP `tipofactura`;
ALTER TABLE `clientes` DROP `imprime_ticket`;
ALTER TABLE `clientes` DROP `tipodocumento`;
ALTER TABLE `clientes` DROP `responsabilidad_iva`;

ALTER TABLE  `clientes` ENGINE = INNODB;

ALTER TABLE  `productos` CHANGE `comandera_id`   `printer_id` int(11) DEFAULT NULL;



ALTER TABLE  `sabores` ADD  `grupo_sabor_id` int(11) DEFAULT NULL;


ALTER TABLE  `tipo_de_pagos` ADD `media_id` int(10) unsigned DEFAULT NULL;

ALTER TABLE  `tipo_facturas` ADD   `codename` varchar(1) DEFAULT NULL;



ALTER TABLE  `mozos` MODIFY `numero` varchar(64) NOT NULL;
ALTER TABLE  `mozos` DROP `user_id`;


ALTER TABLE  `tipo_de_pagos` MODIFY `name` varchar(110) NOT NULL;
ALTER TABLE  `tipo_de_pagos` DROP `description`, DROP `image_url`;



CREATE TABLE IF NOT EXISTS `productos_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `machin_name` varchar(64) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;


--
-- Table structure for table `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;




--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `machin_name`, `created`, `modified`) VALUES
(1, 'Administrador', 'administrador', NULL, NULL),
(2, 'Mozo', 'mozo', NULL, NULL),
(3, 'Adicionista', 'adicionista', NULL, NULL);



CREATE TABLE IF NOT EXISTS `grupo_sabores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seleccion_de_sabor_obligatorio` tinyint(1) NOT NULL,
  `tipo_de_seleccion` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE IF NOT EXISTS `grupo_sabores_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `grupo_sabor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(32) DEFAULT NULL,
  `type` varchar(48) NOT NULL,
  `size` smallint(6) NOT NULL,
  `name` varchar(48) NOT NULL,
  `file` longblob NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS `printers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `alias` varchar(128) NOT NULL,
  `driver` varchar(32) NOT NULL,
  `driver_model` varchar(32) DEFAULT NULL,
  `output` varchar(64) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;



--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `color` VARCHAR( 14 ) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE IF NOT EXISTS `afip_facturas` (
  `id` char(36) NOT NULL,
  `mesa_id` int(11) NOT NULL,
  `punto_de_venta` int(11) NOT NULL,
  `comprobante_nro` int(11) NOT NULL,
  `cae` varchar(64) NOT NULL,
  `importe_total` decimal(10,2) NOT NULL,
  `importe_neto` decimal(10,2) NOT NULL,
  `importe_iva` decimal(10,2) NOT NULL,
  `json_data` text NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mesa_id` (`mesa_id`,`cae`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE `acos`, `aros`, `aros_acos`, `cake_sessions`;



/**
*
* MODIFICACIONES PUNTUALES
*
*/


INSERT INTO `printers` (`id`, `name`, `alias`, `driver`, `driver_model`, `output`, `created`, `modified`) VALUES
(1, 'cocina', 'cocina', 'Receipt', 'Bematech', 'Cups', '2015-05-26 23:34:54', '2015-05-26 23:34:54'),
(2, 'fiscal', 'fiscal', 'Fiscal', 'Hasar441', 'Cups', '2015-05-26 23:35:09', '2015-05-26 23:59:52'),
(3, 'barra', 'Barra', 'Receipt', 'Bematech', 'Cups', '2015-05-26 23:35:25', '2015-05-27 00:00:18');




INSERT INTO `estados` (`id`, `name`, `color`) VALUES
(1, 'Abierta', 'btn-info'),
(2, 'Facturada', 'btn-warning'),
(3, 'Cobrada', 'btn-default');



UPDATE productos SET
printer_id = NULL 
WHERE printer_id NOT IN (1,2,3);


UPDATE mesas
set checkout = time_cobro
where 
time_cobro IS NOT NULL
AND checkout IS NULL;



UPDATE mesas
set checkin = created
where 
created IS NOT NULL
AND checkin IS NULL;

UPDATE mesas
SET checkout = modified
WHERE modified IS NOT NULL
AND modified <> "0000-00-00 00:00"
AND checkout = "0000-00-00 00:00"
AND deleted = 0
