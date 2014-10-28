DROP TABLE IF EXISTS `#__quiz`;

CREATE TABLE `#__quiz` (
  `user_id` int(11) NOT NULL,
  `question1` varchar(50) NOT NULL,
  `question2` varchar(50) NOT NULL,
  `question3` varchar(50) NOT NULL,
  `question4` varchar(50) NOT NULL,
  `question5` varchar(50) NOT NULL,
  `question6` varchar(50) NOT NULL,
  `question7` varchar(50) NOT NULL,
   PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;