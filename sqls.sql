create DATABASE simpleapi;

use simpleapi;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;


INSERT INTO `users` (`id`, `name`, `password`, `email`) VALUES
(1, 'Svilen Dimitrov', 'pass1', 'sv@abv.bg'),
(2, 'Ivan petkov', 'pass2', 'ip@abv.bg'),
(3, 'Anatoli borisov', 'pass3', 'ab@abv.bg'),
(4, 'Bench Shirt', 'pass4', 'bsh@abv.bg');
