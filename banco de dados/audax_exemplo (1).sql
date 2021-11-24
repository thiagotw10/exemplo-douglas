-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Nov-2021 às 15:51
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `audax_exemplo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigo`
--

CREATE TABLE `artigo` (
  `id` int(11) NOT NULL,
  `resumo` varchar(200) NOT NULL,
  `texto` text NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `artigo`
--

INSERT INTO `artigo` (`id`, `resumo`, `texto`, `usuario_id`, `deleted`) VALUES
(1, 'o passarinhos perdidoss', 'era uma vez o passarinho perdido no nada', 10, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cargo`
--

INSERT INTO `cargo` (`id`, `nome`, `deleted`) VALUES
(1, 'admistrador', NULL),
(2, 'gerente', NULL),
(3, 'adm', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `nome`, `deleted`) VALUES
(1, 'Grupos Audax', NULL),
(2, 'Audax 2', NULL),
(3, 'toolbit', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_usuario`
--

CREATE TABLE `grupo_usuario` (
  `usuario_id` bigint(20) DEFAULT NULL,
  `grupos_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `grupo_usuario`
--

INSERT INTO `grupo_usuario` (`usuario_id`, `grupos_id`, `deleted`) VALUES
(16, 3, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` char(11) NOT NULL,
  `senha` char(96) NOT NULL,
  `ultimo_acesso` datetime DEFAULT NULL,
  `hash` varchar(200) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `grupo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `cargo_id`, `email`, `nome`, `cpf`, `senha`, `ultimo_acesso`, `hash`, `deleted`, `grupo_id`) VALUES
(1, 2, 'douglaswillamis@hotmail.com', 'Douglas Willamis', '70603833446', '$argon2i$v=19$m=65536,t=4,p=1$RkVJRHQ0c0REbEViVlZGVw$znQY8gRXd7v6UAROmx+1qFHjCjLucLWeCg5FFz6zcuw', '2021-11-23 19:38:36', '4650577886d1731f87a532e92bac52c67cc2dacb', 0, 2),
(10, 1, 'thiagotw10@hotmail.com', 'thiago oliveira', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$ekhSMGdET1NiSDJDQVNvcQ$sOyoG0+XrmRNXv6rf/7xPAJfeP2qvlHhFmMjrhNRbTA', '2021-11-23 13:53:54', 'b92938631263f6dc88aa3ec8666a7ee6b5e15321', 1, 1),
(12, 2, 'thiago@thiago.com', 'lionel messi', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$bWxjQ05tSzgyOWh0N1ZsRg$5DYpeMZDdnLixJEABXRR+Ojx/GgfPkjb1PBGkhJ+MYc', NULL, '', 0, 2),
(13, 2, 'tw10@tw10.com', 'rafael silva', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$NjA0WG95SG9MRC8xLlBiTQ$eRCWpggJm835c9rbKMMvWwnB1bBS/TvMghEBhJ2Tf/s', NULL, '', 0, 1),
(14, 2, 'tw@hotmail.com', 'rafael gomes', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$amhrLjF2TFhyamNhd0hqcQ$/tl7x68IUEicrzRZ5ZJ4JZN5Smxa+h5O6DInfNZWk1w', NULL, '', 0, 2),
(16, 2, 'danilo@hotmail.com', 'danilo', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$ZU4xV3JRd3JqL2llcDlQSQ$t3upBUtPO8T0xSinmlDgtcbrRvamYU8SbqHleQZ9bl4', '2021-11-24 13:27:54', '8356fd1a1ed08f83d29b84b338daaad35c70d9e8', 0, 2),
(17, 2, 'marcos@hotmail.com', 'marcos', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$VU5qdExXZGVEWlZqNkw0dA$k5JZDjlUTpWDxBSRXBN0ExvVntqqwd1OJGv5I1/GH8E', NULL, '', 0, 1),
(18, 1, 'alex@hotmail.com', 'alex', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$T3hTWjJubEtoV2tLLzFvcg$4KKlK8iOosE4V0YIIPl+TT+0iIbt692EmTJeza7+Dyk', NULL, '', 0, 2),
(19, 1, 'weliton@hotmail.com', 'weliton', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$dHlmLkZKRkZtTS9Yc3ZjSw$LX+Od2Q48PsQoV1DOlxWE9R+G5rMsCcg/f/eRm05mbk', NULL, '', 0, 1),
(20, 1, 'matheus@hotmail.com', 'Matheus Gomes', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$UHVXcURPQjQ3cUszMWtDUw$Zv8ID8nIjVwB5HXd8BvYIYNmPkmGQiK3uBS/nnUo3dY', NULL, '', 0, 3),
(21, 3, 'edvania@hotmail.com', 'edivania', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$ekd0c3puT3JYeVRiUWNSTg$EiehQ6UOkosdVHTQMAADRo/bBVCLiVptwSgwtk1vFks', NULL, '', 0, 3),
(22, 2, 'max@hotmail.com', 'max', '06210223494', '$argon2i$v=19$m=65536,t=4,p=1$RHJWUG9ST2N0VWhOaTQudA$1Ogzh/RXB0SlhHdLyA81E/Z+GJfzGahuCbXKGGvU9QA', NULL, '', 0, 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `artigo`
--
ALTER TABLE `artigo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `grupo_usuario`
--
ALTER TABLE `grupo_usuario`
  ADD KEY `grupos_id` (`grupos_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo_id` (`cargo_id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `artigo`
--
ALTER TABLE `artigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `artigo`
--
ALTER TABLE `artigo`
  ADD CONSTRAINT `artigo_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `grupo_usuario`
--
ALTER TABLE `grupo_usuario`
  ADD CONSTRAINT `grupo_usuario_ibfk_1` FOREIGN KEY (`grupos_id`) REFERENCES `grupo` (`id`),
  ADD CONSTRAINT `grupo_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
