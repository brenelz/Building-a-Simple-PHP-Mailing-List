CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(30) NOT NULL auto_increment,
  `email` varchar(60) NOT NULL,
  `unsubscribeLink` varchar(35) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(30) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `users`
--
--
-- INSERT INTO `users` (`id`, `username`, `password`) VALUES
-- (1, 'alex', '5f4dcc3b5aa765d61d8327deb882cf99');
