--
-- Database: `vistasoft`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

DROP TABLE IF EXISTS `tarefas`;
CREATE TABLE IF NOT EXISTS `tarefas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id`, `data`, `horario`, `nome`) VALUES
(3, '2018-02-05', '11:00:00', 'preparar almoço'),
(4, '2018-02-05', '12:00:00', 'comer almoço'),
(5, '2018-02-05', '13:00:00', 'limpar cozinha'),
(6, '2018-02-05', '15:00:00', 'entrevista de emprego');
COMMIT;

