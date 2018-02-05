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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id`, `data`, `horario`, `nome`) VALUES
(1, '2018-02-02', '17:00:00', 'Inicio do desenvolvimento do Gerenciado de Tarefas'),
(3, '2018-02-05', '10:30:00', 'Realizar verificação do código fonte'),
(8, '2018-02-05', '15:00:00', 'Entrevista de emprego na VistaSoft'),
(9, '2018-02-05', '17:00:00', 'Contrato de trabalho com a VistaSoft'),
(10, '2019-01-12', '19:00:00', 'Churrasco no apartamento do Ricardo');
COMMIT;

