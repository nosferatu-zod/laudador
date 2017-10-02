-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Out-2017 às 13:10
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
-- Estrutura da tabela `matrizes`
--

CREATE TABLE `matrizes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `texto` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `matrizes`
--

INSERT INTO `matrizes` (`id`, `titulo`, `texto`) VALUES
(1, 'RX DE ABDOME', '- Estruturas ósseas íntegras. - Linhas musculares preservadas. - Não há evidência de calcificações patológicas. - Distribuição gasosa normal. - Imagens renais em situação anatômica e dimensões normais. - Margens dos músculos psoas livres. - Ausência de evidência de hepatoesplenomegalia. - Gordura pré peritoneal preservada. '),
(2, 'RX ANTEBRACO', '-	Estruturas ósseas íntegras.\r\n-	Espaços articulares preservados.\r\n-	Tecidos moles preservados.\r\n-	Ausência de sinais de fratura.\r\n-	Ausência de evidências de lesões líticas ou blásticas.\r\n'),
(3, 'RX ARCOS COSTAIS', '- Arcos costais de morfologia e densidades habituais, sem evidências de fraturas.'),
(4, 'RX ARCOS ZIGOMATICOS', 'Estruturas ósseas íntegras.'),
(5, 'RX ARTICULACAO ACROMIOCLAVICULAR', '-	Estruturas ósseas íntegras.\r\n-	Tecidos moles sem alterações.\r\n-	Espaços articulares preservados.\r\n-	Ausência de lesões líticas ou blásticas.\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matrizes`
--
ALTER TABLE `matrizes`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `matrizes` ADD FULLTEXT KEY `titulo` (`titulo`,`texto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matrizes`
--
ALTER TABLE `matrizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
