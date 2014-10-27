DROP TABLE IF EXISTS `#__quiz`;

CREATE TABLE `#__quiz` (
  `quiztaker` varchar(50) NOT NULL,
  `question1` varchar(50) NOT NULL,
  `question2` varchar(50) NOT NULL,
  `question3` varchar(50) NOT NULL,
  `question4` varchar(50) NOT NULL,
  `question5` varchar(50) NOT NULL,
  `question6` varchar(50) NOT NULL,
  `question7` varchar(50) NOT NULL,
   PRIMARY KEY  (`quiztaker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;