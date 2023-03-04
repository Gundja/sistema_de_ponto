-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Mar-2023 às 03:30
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `point_system`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaborador`
--

CREATE TABLE `colaborador` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `matricula` varchar(60) NOT NULL,
  `entrada` int(60) NOT NULL,
  `saida` int(60) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_atualizacao` date NOT NULL,
  `deletado_em` varchar(40) DEFAULT NULL,
  `senha` varchar(60) NOT NULL,
  `nivel_acesso` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colaborador`
--

INSERT INTO `colaborador` (`id`, `nome`, `matricula`, `entrada`, `saida`, `data_criacao`, `data_atualizacao`, `deletado_em`, `senha`, `nivel_acesso`) VALUES
(2, 'casimiro gundja', '485578', 800, 1800, '2023-02-27', '2023-02-27', NULL, '1234', '1'),
(3, 'Jose dos santos pison', '102030', 800, 1800, '2023-02-27', '2023-02-27', NULL, '1234', '0'),
(4, 'Marta Luamba', '102031', 800, 1800, '2023-02-27', '2023-02-27', NULL, '1234', '0'),
(7, 'José', '00180', 8, 18, '0000-00-00', '0000-00-00', NULL, '1234', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ponto`
--

CREATE TABLE `ponto` (
  `id` int(11) NOT NULL,
  `fk_colaborador` int(11) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `data_marcacao` date NOT NULL,
  `ponto` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ponto`
--

INSERT INTO `ponto` (`id`, `fk_colaborador`, `tipo`, `data_marcacao`, `ponto`) VALUES
(12, 102030, '0', '2023-03-04', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ponto`
--
ALTER TABLE `ponto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `ponto`
--
ALTER TABLE `ponto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
