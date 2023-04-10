-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/04/2023 às 15:34
-- Versão do servidor: 10.4.17-MariaDB
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `demandas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `demandas`
--

CREATE TABLE `demandas` (
  `id` int(11) NOT NULL,
  `nome_demanda` varchar(60) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `qtd` int(11) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `setor_id` int(11) NOT NULL,
  `motivo_demanda` varchar(60) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `demandas`
--

INSERT INTO `demandas` (`id`, `nome_demanda`, `descricao`, `qtd`, `tipo`, `usuario_id`, `status_id`, `setor_id`, `motivo_demanda`, `data`) VALUES
(1, 'computador', 'umcoputador com tela de lata resolução', 3, 'Dell', 3, 1, 1, 'teste maior', '2023-04-09 18:24:33'),
(2, 'teste postman', 'nao tem', 2, 'bom', 3, 1, 1, 'testtando ...', '2023-04-08 20:59:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `papel`
--

CREATE TABLE `papel` (
  `id` int(11) NOT NULL,
  `papel_nome` varchar(45) NOT NULL,
  `adm` varchar(3) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `papel`
--

INSERT INTO `papel` (`id`, `papel_nome`, `adm`, `usuario_id`) VALUES
(1, 'adminstrador', 'nao', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `id` int(11) NOT NULL,
  `nome_setor` varchar(45) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `setor`
--

INSERT INTO `setor` (`id`, `nome_setor`, `usuario_id`) VALUES
(1, 'compras', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nome_status` varchar(45) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id`, `nome_status`, `usuario_id`) VALUES
(1, 'em andamento', 3),
(2, 'teste postman', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` int(11) NOT NULL,
  `senha` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `papel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `telefone`, `senha`, `usuario_id`, `papel_id`) VALUES
(3, 'suporte', 'suporte@email.com', 12345678, 12345678, 3, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `demandas`
--
ALTER TABLE `demandas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id` (`usuario_id`),
  ADD KEY `setor_id` (`setor_id`),
  ADD KEY `fk_status_id` (`status_id`);

--
-- Índices de tabela `papel`
--
ALTER TABLE `papel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`usuario_id`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `papel_id` (`papel_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `demandas`
--
ALTER TABLE `demandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `papel`
--
ALTER TABLE `papel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `demandas`
--
ALTER TABLE `demandas`
  ADD CONSTRAINT `fk_status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `setor_id` FOREIGN KEY (`setor_id`) REFERENCES `setor` (`id`),
  ADD CONSTRAINT `usuarios_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `papel_id` FOREIGN KEY (`papel_id`) REFERENCES `papel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
