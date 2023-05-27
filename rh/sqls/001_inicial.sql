CREATE DATABASE rh COLLATE 'utf8_unicode_ci';

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('programador','chefe','RH') NOT NULL,
  `situacao` enum('disponivel','convidado','aceite','contratado') DEFAULT 'disponivel'
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `situacao`) VALUES
(1, 'teste', 'teste@teste', '$2y$10$6LPRhbH4ktkhb32rtOh1GO4e0y4aQkmPeetrA4DM1/ug/ZiItDpOW', 'chefe', ''),
(2, 'rh', 'rh@rh', '$2y$10$nXzrEX2pEa35TV/CJlIxlelHwCtSGrDMJ6.tQe.1axvCippIeMSpq', 'RH', '');

