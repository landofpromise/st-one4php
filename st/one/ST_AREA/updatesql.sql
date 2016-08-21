
CREATE TABLE IF NOT EXISTS `st2015_field` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MQ` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(10) NOT NULL,
  `locale` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `traffic` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts` text COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;



CREATE TABLE IF NOT EXISTS `st2015_fieldtype` (
  `id` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `st2015_fieldtype` (`id`, `name`) VALUES
(0, '商场/住宅区'),
(1, '学校'),
(2, '医院');

