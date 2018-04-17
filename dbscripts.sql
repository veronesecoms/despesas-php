CREATE DATABASE 'despesas'

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Mar-2018 às 21:40
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `despesas`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `mov_estoque_e` (IN `p_quantidade` INT, IN `p_codprod` INT)  BEGIN
UPDATE produtos
SET estoque = estoque + p_quantidade
WHERE id = p_codprod;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mov_estoque_insere` (IN `p_quantidade` INT, IN `dataemissao` VARCHAR(30), IN `tipo_mov` INT, IN `p_id_fornecedor` INT, IN `descricao` VARCHAR(30), IN `p_id` INT)  BEGIN
INSERT INTO mov_estoque (id_mov,id_forn,observacao, quantidade, tipo_mov, dataemissao) VALUES(p_id, p_id_fornecedor, descricao, p_quantidade, tipo_mov, dataemissao);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mov_estoque_s` (`p_quantidade` INT, `p_codprod` INT)  BEGIN
UPDATE produtos set estoque = estoque - p_quantidade
WHERE id = p_codprod;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE `contas` (
  `id` int(11) NOT NULL,
  `dataemissao` varchar(33) DEFAULT NULL,
  `datavencimento` varchar(33) DEFAULT NULL,
  `valor` float(7,2) DEFAULT NULL,
  `observacao` varchar(60) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`id`, `dataemissao`, `datavencimento`, `valor`, `observacao`, `id_fornecedor`, `id_especie`) VALUES
(52, '28/02/2018', '28/02/2018', 750.00, 'Faculdade FACEF', 26, 4),
(53, '01/02/2018', '22/02/2018', 350.00, 'Celular', 26, 1),
(54, '07/03/2018', '07/03/2018', 33.33, 'teste', 26, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_receber`
--

CREATE TABLE `contas_receber` (
  `id` int(11) NOT NULL,
  `dataemissao` varchar(33) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `valor` float(7,2) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `observacao` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contas_receber`
--

INSERT INTO `contas_receber` (`id`, `dataemissao`, `id_especie`, `valor`, `id_cliente`, `observacao`) VALUES
(17, '06/02/2018', 1, 500.00, 26, 'estÃ¡gio'),
(18, '15/02/2018', 1, 1200.00, 27, 'trabalho');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controla_estoque`
--

CREATE TABLE `controla_estoque` (
  `id_mov` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `especies`
--

CREATE TABLE `especies` (
  `id` int(11) NOT NULL,
  `nome_especie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `especies`
--

INSERT INTO `especies` (`id`, `nome_especie`) VALUES
(1, 'Dinheiro'),
(2, 'Cartao A Vista'),
(3, 'Cartao A Prazo'),
(4, 'Boleto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `sigla` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mov_estoque`
--

CREATE TABLE `mov_estoque` (
  `id_mov` int(11) NOT NULL,
  `id_forn` int(11) NOT NULL,
  `observacao` varchar(130) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `tipo_mov` int(11) DEFAULT NULL,
  `dataemissao` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mov_estoque`
--

INSERT INTO `mov_estoque` (`id_mov`, `id_forn`, `observacao`, `quantidade`, `tipo_mov`, `dataemissao`) VALUES
(3, 26, 'teste', 2, 1, '15/02/2018'),
(4, 26, 'teste', 4, 1, '15/02/2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `nascimento` date NOT NULL,
  `endereco` varchar(25) NOT NULL,
  `telefone` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `nascimento`, `endereco`, `telefone`) VALUES
(26, 'Teste 2', '2018-02-07', 'teste 2', '(16) 88888-8888'),
(27, 'Renato', '2018-02-09', 'teste', '(16) 99999-9999');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `custo` float(7,2) NOT NULL,
  `preco_venda` float(7,2) NOT NULL,
  `fg_ativo` int(11) NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `descricao`, `custo`, `preco_venda`, `fg_ativo`, `estoque`) VALUES
(15, 'produto', 10.00, 25.00, 1, 156),
(16, 'teste', 333.33, 350.00, 1, 115);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `senha`) VALUES
(17, 'renato', 'tst@teste.com', 'fddc218f78fa9506a290d6d24ccf184e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_especie` (`id_especie`) USING BTREE;

--
-- Indexes for table `contas_receber`
--
ALTER TABLE `contas_receber`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_especie` (`id_especie`),
  ADD KEY `fk_id_clientes` (`id_cliente`);

--
-- Indexes for table `controla_estoque`
--
ALTER TABLE `controla_estoque`
  ADD PRIMARY KEY (`id_mov`,`id_prod`),
  ADD KEY `id_prod` (`id_prod`);

--
-- Indexes for table `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`,`sigla`),
  ADD UNIQUE KEY `sigla_UNIQUE` (`sigla`);

--
-- Indexes for table `mov_estoque`
--
ALTER TABLE `mov_estoque`
  ADD PRIMARY KEY (`id_mov`),
  ADD KEY `fk_id_forn_pessoa_id` (`id_forn`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `contas_receber`
--
ALTER TABLE `contas_receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `especies`
--
ALTER TABLE `especies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mov_estoque`
--
ALTER TABLE `mov_estoque`
  MODIFY `id_mov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `contas`
--
ALTER TABLE `contas`
  ADD CONSTRAINT `contas_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `pessoa` (`id`),
  ADD CONSTRAINT `fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id`);

--
-- Limitadores para a tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  ADD CONSTRAINT `fk_id_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `pessoa` (`id`),
  ADD CONSTRAINT `fk_id_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id`);

--
-- Limitadores para a tabela `controla_estoque`
--
ALTER TABLE `controla_estoque`
  ADD CONSTRAINT `controla_estoque_ibfk_1` FOREIGN KEY (`id_mov`) REFERENCES `mov_estoque` (`id_mov`),
  ADD CONSTRAINT `controla_estoque_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `mov_estoque`
--
ALTER TABLE `mov_estoque`
  ADD CONSTRAINT `fk_id_forn_pessoa_id` FOREIGN KEY (`id_forn`) REFERENCES `pessoa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;