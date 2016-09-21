-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Abr-2016 às 16:39
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viicobepi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricoes`
--

CREATE TABLE `inscricoes` (
  `id` int(11) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` varchar(60) NOT NULL,
  `tipo` enum('FDJ','DM','CONS','ABEL') NOT NULL,
  `local` varchar(30) NOT NULL,
  `numero` int(11) NOT NULL,
  `cargo` varchar(30) DEFAULT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` enum('AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MS','MT','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO') NOT NULL,
  `camisa` enum('PP','P','M','G','GG') DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `pagseguro` VARCHAR(50) NULL DEFAULT NULL,
  `statusPagSeguro` TINYINT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inscricoes`
--
ALTER TABLE `inscricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
