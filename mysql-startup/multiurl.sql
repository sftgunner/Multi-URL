DROP TABLE IF EXISTS `multiurl`;
CREATE TABLE `multiurl` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shortlink` varchar(20) NOT NULL,
  `title` text,
  `count` int(11) NOT NULL,
  `urls` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=620 DEFAULT CHARSET=latin1;