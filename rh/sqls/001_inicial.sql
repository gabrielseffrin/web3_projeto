CREATE DATABASE rh COLLATE 'utf8_unicode_ci';

CREATE TABLE `empregado` (
  `id_empregado` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `status` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `empregado`
--
ALTER TABLE `empregado`
  ADD PRIMARY KEY (`id_empregado`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empregado`
--
ALTER TABLE `empregado`
  MODIFY `id_empregado` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;