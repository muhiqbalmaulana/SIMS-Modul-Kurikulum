-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2013 at 12:11 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chart-learn`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `produk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `produk`) VALUES
(1, 'Produk A'),
(2, 'Produk B'),
(3, 'Produk C');

-- --------------------------------------------------------

--
-- Table structure for table `jml_penjualan`
--

CREATE TABLE IF NOT EXISTS `jml_penjualan` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `id_produk` varchar(15) DEFAULT NULL,
  `item` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `jml_penjualan`
--

INSERT INTO `jml_penjualan` (`id`, `id_produk`, `item`) VALUES
(125, '1', '1'),
(126, '1', '1'),
(127, '1', '1'),
(128, '1', '1'),
(129, '1', '1'),
(130, '1', '1'),
(131, '1', '1'),
(132, '1', '1'),
(133, '1', '1'),
(134, '1', '1'),
(135, '2', '1'),
(136, '2', '1'),
(137, '2', '1'),
(138, '2', '1'),
(139, '2', '1'),
(140, '2', '1'),
(141, '2', '1'),
(142, '2', '1'),
(143, '2', '1'),
(144, '2', '1'),
(145, '3', '1'),
(146, '3', '1'),
(147, '3', '1'),
(148, '3', '1'),
(149, '3', '1'),
(150, '3', '1'),
(151, '3', '1'),
(152, '3', '1'),
(153, '3', '1'),
(154, '3', '1'),
(155, '3', '1'),
(156, '3', '1'),
(157, '3', '1'),
(158, '3', '1'),
(159, '3', '1');
