-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Out-2017 às 13:07
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pacsdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assinatura`
--

CREATE TABLE `assinatura` (
  `idAssinatura` int(11) NOT NULL,
  `CRM` int(11) NOT NULL,
  `caminho` varchar(40) NOT NULL,
  `medico` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `assinatura`
--

INSERT INTO `assinatura` (`idAssinatura`, `CRM`, `caminho`, `medico`) VALUES
(18, 112, 'imagens/112.jpg', ''),
(6, 45698, 'imagens/45698.png', ''),
(7, 666, 'imagens/666.png', ''),
(8, 5555, 'imagens/5555.jpg', ''),
(9, 56898, 'imagens/56898.jpg', ''),
(10, 1234569, 'imagens/1234569.png', ''),
(11, 555555, 'imagens/555555.jpg', ''),
(12, 5989797, 'imagens/5989797.jpg', ''),
(13, 66666, 'imagens/66666.jpg', ''),
(14, 1212166, 'imagens/1212166.png', ''),
(19, 36687, 'imagens/36687.jpg', 'Marcos AlcÃ¢ntara Soares');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assinatura`
--
ALTER TABLE `assinatura`
  ADD PRIMARY KEY (`idAssinatura`),
  ADD UNIQUE KEY `CRM` (`CRM`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assinatura`
--
ALTER TABLE `assinatura`
  MODIFY `idAssinatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
