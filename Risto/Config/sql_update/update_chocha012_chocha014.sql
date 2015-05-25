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

ALTER TABLE  `mesas` ADD `observation` text NOT NULL;
ALTER TABLE  `mesas` ADD `checkin` timestamp NULL DEFAULT NULL;
ALTER TABLE  `mesas` ADD `checkout` timestamp NULL DEFAULT NULL;



ALTER TABLE  `mesas` MODIFY `numero` varchar(64) NOT NULL;


ALTER TABLE  `mozos` 
	ADD `nombre` varchar(64) DEFAULT NULL,
  	ADD `apellido` varchar(64) DEFAULT NULL,
  	ADD `media_id` int(10) unsigned DEFAULT NULL;



ALTER TABLE  `pagos` MODIFY    `tipo_de_pago_id` int(10) unsigned DEFAULT NULL;


ALTER TABLE  `productos` ADD   `printer_id` int(11) DEFAULT NULL;


ALTER TABLE  `sabores` ADD  `grupo_sabor_id` int(11) DEFAULT NULL;


ALTER TABLE  `tipo_de_pagos` ADD `media_id` int(10) unsigned DEFAULT NULL;

ALTER TABLE  `tipo_facturas` ADD   `codename` varchar(1) DEFAULT NULL;


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