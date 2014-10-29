DROP TABLE IF EXISTS `#__quiz`;

CREATE TABLE `#__quiz` (
  `user_id` int(11) NOT NULL,
  `question0` char(1) NOT NULL,
  `question1` char(1) NOT NULL,
  `question2` char(1) NOT NULL,
  `question3` char(1) NOT NULL,
  `question4` char(1) NOT NULL,
  `question5` char(1) NOT NULL,
  `question6` char(1) NOT NULL,
  `question7` char(1) NOT NULL,
  `question8` char(1) NOT NULL,
  `question9` char(1) NOT NULL,
  `email_updates` bit(1) NOT NULL,
  `date_taken` date NOT NULL,
   PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;