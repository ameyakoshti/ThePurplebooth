-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2013 at 10:34 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codenameDS`
--

-- --------------------------------------------------------

--
-- Table structure for table `imagecomment`
--

CREATE TABLE `imagecomment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_user_id` int(11) unsigned NOT NULL,
  `comment_text` varchar(200) NOT NULL,
  `comment_image_id` int(11) NOT NULL,
  `comment_timestamp` datetime NOT NULL,
  `comment_user_name` varchar(45) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_user_id` (`comment_user_id`),
  KEY `comment_image_id` (`comment_image_id`),
  KEY `comment_user_id_2` (`comment_user_id`),
  KEY `comment_image_id_2` (`comment_image_id`),
  KEY `comment_timestamp` (`comment_timestamp`),
  KEY `comment_user_name` (`comment_user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `imageinfo`
--

CREATE TABLE `imageinfo` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `partner_id` int(11) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `content` longblob NOT NULL,
  `edited_image` longblob,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `deletable` varchar(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `closed_project` int(1) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `user_id` (`user_id`),
  KEY `partner_id` (`partner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `replycomment`
--

CREATE TABLE `replycomment` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_user_id` int(11) unsigned NOT NULL,
  `reply_user_name` varchar(45) NOT NULL,
  `reply_comment_id` int(11) NOT NULL,
  `reply_text` varchar(200) NOT NULL,
  `reply_timestamp` datetime NOT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `reply_user_id` (`reply_user_id`),
  KEY `reply_comment_id` (`reply_comment_id`),
  KEY `reply_user_name` (`reply_user_name`),
  KEY `reply_user_name_2` (`reply_user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `userrating`
--

CREATE TABLE `userrating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `stars` int(1) NOT NULL,
  `reviews` varchar(200) NOT NULL,
  `rated_by_user_id` int(11) NOT NULL,
  `rated_by_user_name` varchar(45) NOT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `active` int(11) NOT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `profile_url` varchar(160) DEFAULT NULL,
  `provider_id` varchar(150) NOT NULL,
  `about_me` varchar(200) DEFAULT NULL,
  `class` varchar(25) NOT NULL,
  `creativity` varchar(10) NOT NULL,
  `rating` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `imageinfo`
--
ALTER TABLE `imageinfo`
  ADD CONSTRAINT `imageinfo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `userrating`
--
ALTER TABLE `userrating`
  ADD CONSTRAINT `rated_by_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
