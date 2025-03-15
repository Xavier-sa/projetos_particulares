-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/03/2025 às 08:52
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
-- Banco de dados: `aula_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `nome_aluno` varchar(100) DEFAULT NULL,
  `placa_veiculo` varchar(20) DEFAULT NULL,
  `matricula_saida` varchar(50) DEFAULT NULL,
  `km_saida` int(11) DEFAULT NULL,
  `hora_saida` time DEFAULT NULL,
  `matricula_entrada` varchar(50) DEFAULT NULL,
  `km_entrada` int(11) DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `data_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `registros`
--

INSERT INTO `registros` (`id`, `nome_aluno`, `placa_veiculo`, `matricula_saida`, `km_saida`, `hora_saida`, `matricula_entrada`, `km_entrada`, `hora_entrada`, `data_registro`) VALUES
(3, NULL, 'ooq-5402', NULL, NULL, '12:01:00', NULL, NULL, '12:00:00', '2025-03-12'),
(4, NULL, 'ooq-5402', NULL, NULL, '12:01:00', '998', 10, '13:01:00', '2025-03-12'),
(5, NULL, 'ooq-3201', '9091', 10, '12:00:00', '9091', 10, '13:01:00', '2025-03-10'),
(6, NULL, 'ici-7543', '50', 80, '17:00:00', '50', 100, '20:00:00', '2025-03-11');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
