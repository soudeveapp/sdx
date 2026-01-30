-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30-Jan-2026 às 23:46
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sdx`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `evkz`
--

CREATE TABLE `evkz` (
  `id` int(11) NOT NULL,
  `idi` text NOT NULL,
  `idu` text NOT NULL,
  `kzi` text NOT NULL,
  `kzg` text NOT NULL,
  `win` text NOT NULL,
  `dat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rdkz`
--

CREATE TABLE `rdkz` (
  `id` int(11) NOT NULL,
  `usu` text NOT NULL,
  `dia` text NOT NULL,
  `kzp` text NOT NULL,
  `kzg` text NOT NULL,
  `tot` text NOT NULL,
  `dsc` text NOT NULL,
  `win` text NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `uskz`
--

CREATE TABLE `uskz` (
  `id` int(11) NOT NULL,
  `nm` text NOT NULL,
  `py` text NOT NULL,
  `dm` text NOT NULL,
  `gh` text NOT NULL,
  `dt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `evkz`
--
ALTER TABLE `evkz`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `rdkz`
--
ALTER TABLE `rdkz`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `uskz`
--
ALTER TABLE `uskz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `evkz`
--
ALTER TABLE `evkz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rdkz`
--
ALTER TABLE `rdkz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `uskz`
--
ALTER TABLE `uskz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
