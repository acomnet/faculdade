-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.34-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando dados para a tabela faculdade.aluno: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` (`id`, `nome`, `cpf`, `data_nasc`, `matricula`, `curso`, `responsavel`, `cpf_responsavel`, `email`) VALUES
	(6, 'Kaio Henrique dos Santos Silva', '098.385.274-08', '06021994', '111111', 1, 'Kaio Henrique', '098.385.274-08', 'kaio.webdesigner@gmail.com'),
	(10, 'Josefa maria dos Santos', '123.154.787-54', '02/09/19', '133444', 1, 'Kaio Henrique', '098.385.274-08', 'suporte2@acomnet.com.br'),
	(13, 'Anderson Melo', '02036165156', '02/14/20', '1321313', 1, 'Kalleb', '51545887878789', 'anderson2@gmail.com'),
	(15, 'Elias silva', '546464646', '01/08/20', '5165166', 1, 'Mario', '54989797897', 'eliel2@acomnet.com.br'),
	(20, 'Marcela Muller da Silva', '84675055087', '06/05/17', '133444', 3, 'alzira', '101.145.478-08', 'eliel@acomnet.com.br'),
	(21, 'Allef Coimbra de Andrade', '123.154.787-54', '321312', '123123', 1, 'Antonio', '5785757575', 'eliel@acomnet.com.br'),
	(22, 'ademar da silva', '1232132313131', '03/04/20', '1231313213', 1, 'alzira', '888.555.888-54', 'ademar@acomnet.com.br');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando dados para a tabela faculdade.curso: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`id`, `nome`, `valor`) VALUES
	(1, 'ADS', 1900.00),
	(2, 'Direito', 2800.00),
	(3, 'Psicologia', 3000.00),
	(4, 'Ed. Física', 1450.00),
	(5, 'Filosofia', 1200.00),
	(6, 'Administração', 1200.00),
	(7, 'Contabilidade', 1750.00),
	(8, 'Nutrição', 2160.00),
	(9, 'Redes de Computadores', 2300.00),
	(10, 'Pedagogia', 2.00),
	(11, 'Psicologia', 250.00),
	(12, 'Teologia', 500.00);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando dados para a tabela faculdade.usuario: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `email`, `senha`, `tipo`) VALUES
	(12, 'kaio@acom.com.br', '1212', 0),
	(13, 'kaio.webdesigner@gmail.com', '1', 1),
	(14, 'maria@fulana.com', '222222', 1),
	(15, 'suporte2@acomnet.com.br', '444444', 1),
	(17, 'suporte2@acomnet.com.br', '133444', 1),
	(20, 'teste@gmail.com', '1321313', 1),
	(21, 'kaio.webdesigner@gmail.com', '22 2', 1),
	(22, 'eliel@acomnet.com.br', 'ete', 1),
	(24, 'suporte2@acomnet.com.br', 'dasdasd', 1),
	(28, 'eliel@acomnet.com.br', '133444', 1),
	(29, 'eliel@acomnet.com.br', '123123', 1),
	(30, 'sidney@acomnet.com.br', '123131321313', 1),
	(31, 'kaio.webdesigner@gmail.com', '123123', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
