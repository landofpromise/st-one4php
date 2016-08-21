DROP TABLE IF EXISTS `st2015`;
CREATE TABLE `st2015` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `muqu` varchar(50) CHARACTER SET utf8 NOT NULL,
  `student` tinyint(1) NOT NULL,
  `hometown` varchar(50) CHARACTER SET utf8 NOT NULL,
  `dirth_year` int(4) NOT NULL,
  `dirth_month` int(2) NOT NULL,
  `size` varchar(10) NOT NULL DEFAULT 'M',
  `phone` varchar(11) NOT NULL,
  `zz_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `zz_phone` varchar(11) CHARACTER SET utf8 NOT NULL,
  `is_dzz` tinyint(1) NOT NULL,
  `full` tinyint(1) NOT NULL,
  `exp_st` tinyint(1) NOT NULL,
  `exp_fishing` tinyint(1) NOT NULL,
  `day0` tinyint(1) NOT NULL,
  `day1` tinyint(1) NOT NULL,
  `day2` tinyint(1) NOT NULL,
  `day3` tinyint(1) NOT NULL,
  `day4` tinyint(1) NOT NULL,
  `day5` tinyint(1) NOT NULL,
  `day6` tinyint(1) NOT NULL,
  `day6_2` tinyint(1) NOT NULL,
  `hotel_1` tinyint(1) NOT NULL,
  `hotel0` tinyint(1) NOT NULL,
  `hotel1` tinyint(1) NOT NULL,
  `hotel2` tinyint(1) NOT NULL,
  `hotel3` tinyint(1) NOT NULL,
  `hotel4` tinyint(1) NOT NULL,
  `hotel5` tinyint(1) NOT NULL,
  `hotel6` tinyint(1) NOT NULL,
  `add_date` timestamp NULL DEFAULT NULL,
  `dis_uid` int(20) NOT NULL,
  `dis_username` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_name_phone` (`name`,`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;