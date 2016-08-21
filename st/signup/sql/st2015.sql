/*
MySQL Data Transfer
Source Host: localhost
Source Database: zp20v1_db
Target Host: localhost
Target Database: zp20v1_db
Date: 2015/3/17 22:07:10
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for st2015
-- ----------------------------
DROP TABLE IF EXISTS `st2015`;
CREATE TABLE `st2015` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `muqu` varchar(50) NOT NULL,
  `student` tinyint(1) NOT NULL,
  `hometown` varchar(50) NOT NULL,
  `dirth_year` int(4) NOT NULL,
  `dirth_month` int(2) NOT NULL,
  `size` varchar(10) NOT NULL DEFAULT 'M',
  `phone` varchar(11) NOT NULL,
  `zz_name` varchar(30) NOT NULL,
  `zz_phone` varchar(11) NOT NULL,
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
  `dis_username` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_name_phone` (`name`,`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `st2015` VALUES ('3', '刘玛丽', '0', '市区', '1', '江西省九江市', '1992', '1', 'M', '18698564908', '于凡格', '18806817418', '0', '1', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '0', '2015-03-17 09:38:18', '433', 'julieyfg');
INSERT INTO `st2015` VALUES ('4', '屠密迦', '0', '下沙', '1', '浙江宁波', '1994', '6', 'M', '15757123449', '屠密迦', '15757123449', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2015-03-17 14:33:18', '430', 'mijia');
