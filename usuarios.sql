-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/06/2025 às 04:54
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `usuarios`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastros`
--

CREATE TABLE `cadastros` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `notificacoes` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastros`
--

INSERT INTO `cadastros` (`id`, `nome`, `email`, `senha`, `notificacoes`) VALUES
(9, 'Kewin Matheus Carmo de Vilar', 'matheusvilar249@gmail.com', '$2y$10$ozHSCCSeo.Skt0THbvJwLeITvZGKeVyE6MPM5iXQDYDcLhwGDlGRW', 1),
(13, 'Kewin Matheus Carmo de Vilar', 'lordehadescok3@gmail.com', '$2y$10$HCmpvygW3VZVi1xGYpdD3unZwrAYTHUa82aQ5iD4Jj/pbWPnaOeCa', NULL),
(14, 'Kewin Matheus Carmo de Vilar', 'lordehadescok3@gmail.com', '$2y$10$ghlT3qO/rim1EFDm1jZnD.c/3j1//gQi9LA2Iz3TOrFNqMWcjjcVa', NULL),
(15, 'Kewin Matheus Carmo de Vilar', 'lucasoliveiradias8@gmail.com', '$2y$10$nJc1Wiii5mswG9AUA9v77eefcs7oQUUfN8us7bqMQGmPEDTC9cuyG', NULL),
(16, 'Kewin Matheus Carmo de Vilar', 'lucasoliveiradias8@gmail.com', '$2y$10$xyPy0lhJg/P1RAHHzMK7vuQSHIdXKOiEQasNmALEKntJ0caL6120G', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastros`
--
ALTER TABLE `cadastros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastros`
--
ALTER TABLE `cadastros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
