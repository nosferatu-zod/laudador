-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Out-2017 às 13:09
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
-- Estrutura da tabela `exame`
--

CREATE TABLE `exame` (
  `id_exame` int(11) NOT NULL,
  `fk_paciente` int(11) NOT NULL,
  `nomepaciente` varchar(40) NOT NULL,
  `medicosolicitante` varchar(40) NOT NULL,
  `descricaoexame` varchar(50) NOT NULL,
  `nascimentopaciente` date NOT NULL,
  `dataexame` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exame`
--

INSERT INTO `exame` (`id_exame`, `fk_paciente`, `nomepaciente`, `medicosolicitante`, `descricaoexame`, `nascimentopaciente`, `dataexame`) VALUES
(1, 123456, 'Marcos Almeida', 'Julio Cesar Heriquetta', 'RX Torax', '1991-08-08', NULL),
(2, 5588, 'Wesley Millan', 'Carlos Henrique Moraes', 'TC Cranio', '1994-02-18', NULL),
(3, 15447, 'Wanceslau Rodrigues Silva', 'Maria Henriquetta', 'TC Tórax', '1950-12-12', '2017-06-01'),
(4, 45879, 'Matheus Marquinhos', 'Diana Temicera', 'RM Barriga', '1982-01-24', '2017-06-20'),
(5, 33587, 'Marcos Almeida Shutz', 'Muricio Crazydog', 'RX Pé', '1994-02-02', '2017-09-10'),
(6, 15447, 'Wanceslau Rodrigues Silva', 'Carlota do Carmo', 'TC Tórax', '1950-12-12', '2017-03-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exame`
--
ALTER TABLE `exame`
  ADD PRIMARY KEY (`id_exame`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exame`
--
ALTER TABLE `exame`
  MODIFY `id_exame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
