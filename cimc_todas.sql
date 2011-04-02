-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 14, 2011 at 12:45 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `cimc`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `abono`
-- 

CREATE TABLE `abono` (
  `id_abono` int(11) unsigned NOT NULL auto_increment,
  `id_orden` int(11) NOT NULL,
  `q_abonado` int(11) NOT NULL,
  `d_fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_abono`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `abono`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `asistencia`
-- 

CREATE TABLE `asistencia` (
  `id_asistencia` int(10) unsigned NOT NULL auto_increment,
  `id_empleado` int(10) unsigned NOT NULL,
  `d_fecha` datetime NOT NULL,
  `b_asistio` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id_asistencia`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `asistencia`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `auditoria`
-- 

CREATE TABLE `auditoria` (
  `id_query` int(11) unsigned NOT NULL auto_increment,
  `query` varchar(255) collate utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `id_empleado` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id_query`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=355 ;

-- 
-- Dumping data for table `auditoria`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `campana`
-- 

CREATE TABLE `campana` (
  `id_campana` int(11) unsigned NOT NULL auto_increment,
  `n_nombre` varchar(200) collate utf8_unicode_ci NOT NULL,
  `a_direccion` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_campana`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `campana`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `consulta`
-- 

CREATE TABLE `consulta` (
  `id_consulta` int(11) unsigned NOT NULL auto_increment,
  `id_paciente` int(11) unsigned NOT NULL,
  `id_empleado` int(11) unsigned NOT NULL,
  `d_fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_consulta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `consulta`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `empleado`
-- 

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL auto_increment,
  `n_nombre` varchar(30) NOT NULL,
  `n_apellido` varchar(40) NOT NULL,
  `d_nacimiento` datetime NOT NULL,
  `a_telefono` text NOT NULL,
  `b_activo` tinyint(1) NOT NULL,
  `pw_password` varchar(32) NOT NULL,
  `t_nivel` int(11) NOT NULL,
  `a_direccion` varchar(100) NOT NULL,
  `t_puesto` varchar(30) NOT NULL,
  `a_email` varchar(30) NOT NULL,
  `d_fecha_creacion` datetime NOT NULL,
  `d_fecha_modificacion` datetime NOT NULL,
  PRIMARY KEY  (`id_empleado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `empleado`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `nomina`
-- 

CREATE TABLE `nomina` (
  `id_nomina` int(11) unsigned NOT NULL auto_increment,
  `id_empleado` int(11) unsigned NOT NULL,
  `q_pago` decimal(12,2) NOT NULL,
  `d_fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_nomina`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `nomina`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `orden`
-- 

CREATE TABLE `orden` (
  `id_orden` int(11) unsigned NOT NULL auto_increment,
  `id_consulta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `q_costo` decimal(8,2) NOT NULL,
  `b_pagado` tinyint(1) NOT NULL,
  `d_fecha_creacion` datetime NOT NULL,
  `d_fecha_modificacion` datetime NOT NULL,
  `e_nota` longtext collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_orden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `orden`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `paciente`
-- 

CREATE TABLE `paciente` (
  `id_paciente` int(11) unsigned NOT NULL auto_increment,
  `n_nombre` varchar(50) collate utf8_unicode_ci NOT NULL,
  `n_apellido` varchar(50) collate utf8_unicode_ci default NULL,
  `d_nacimiento` datetime NOT NULL,
  `b_sexo` tinyint(1) NOT NULL,
  `e_nota` longtext collate utf8_unicode_ci,
  `d_fecha_creacion` datetime NOT NULL,
  `d_fecha_modificacion` datetime NOT NULL,
  `a_direccion` varchar(200) collate utf8_unicode_ci NOT NULL,
  `a_email` varchar(200) collate utf8_unicode_ci NOT NULL,
  `a_telefono` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_paciente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `paciente`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pago_a_proveedor`
-- 

CREATE TABLE `pago_a_proveedor` (
  `id_pago_a_proveedor` int(11) unsigned NOT NULL auto_increment,
  `id_proveedor` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `e_descripcion_producto` longtext collate utf8_unicode_ci NOT NULL,
  `q_costo` decimal(8,2) NOT NULL,
  `q_cantidad_de_producto` int(11) NOT NULL,
  `d_fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_pago_a_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `pago_a_proveedor`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `producto`
-- 

CREATE TABLE `producto` (
  `id_producto` int(11) unsigned NOT NULL auto_increment,
  `n_nombre` varchar(100) collate utf8_unicode_ci NOT NULL,
  `q_costo` decimal(12,2) unsigned NOT NULL,
  `b_activo` tinyint(1) unsigned NOT NULL,
  `d_fecha_creacion` datetime NOT NULL,
  PRIMARY KEY  (`id_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `producto`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `producto_campana`
-- 

CREATE TABLE `producto_campana` (
  `id_campana` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `q_cantidad` int(11) NOT NULL,
  UNIQUE KEY `id_producto` (`id_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `producto_campana`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `proveedor`
-- 

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) unsigned NOT NULL auto_increment,
  `n_nombre` varchar(100) collate utf8_unicode_ci NOT NULL,
  `t_tipo` int(11) NOT NULL,
  PRIMARY KEY  (`id_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `proveedor`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `sueldo`
-- 

CREATE TABLE `sueldo` (
  `id_sueldo` int(11) unsigned NOT NULL auto_increment,
  `id_empleado` int(11) unsigned NOT NULL,
  `q_sueldo` decimal(12,2) unsigned NOT NULL,
  `d_fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_sueldo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `sueldo`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `sueldo`
-- 

CREATE TABLE `empleado_campana` (
  `id_empleado` int(11) NOT NULL,
  `id_campana` int(11) NOT NULL,
  UNIQUE KEY `index_empleado_campana` (`id_empleado`,`id_campana`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

-- 
-- Dumping data for table `sueldo`
-- 
