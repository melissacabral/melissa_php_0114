-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2014 at 08:37 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog_mmc_0114`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Tutorials'),
(2, 'Code Snippets'),
(3, 'Miscellaneous'),
(4, 'sandwiches'),
(5, 'movie reviews');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `url` text NOT NULL,
  `body` text NOT NULL,
  `post_id` mediumint(9) NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `date`, `name`, `email`, `url`, `body`, `post_id`, `is_approved`) VALUES
(1, '2013-09-06 10:57:55', 'bob', 'bobbo@bobber.com', 'http://bobber.com', 'Bacon ipsum dolor sit amet meatball salami drumstick, beef ribs kevin beef swine. Swine brisket sausage prosciutto sirloin t-bone pork belly kielbasa turducken. Turducken ground round cow hamburger frankfurter shank jowl chuck bresaola prosciutto biltong pig brisket. Venison shankle cow doner. Ham pork loin prosciutto bresaola venison cow swine strip steak leberkas filet mignon tongue. Turkey pork loin t-bone short ribs ball tip turducken cow filet mignon. Fatback frankfurter brisket tenderloin, ground round short ribs beef salami drumstick pork chop cow pastrami leberkas.', 1, 1),
(2, '2013-09-04 00:00:00', 'Frank', 'Frank@furter.com', '', 'Bacon ipsum dolor sit amet meatball salami drumstick, beef ribs kevin beef swine. Swine brisket sausage prosciutto sirloin t-bone pork belly kielbasa turducken. Turducken ground round cow hamburger frankfurter shank jowl chuck bresaola prosciutto biltong pig brisket. Venison shankle cow doner. Ham pork loin prosciutto bresaola venison cow swine strip steak leberkas filet mignon tongue. Turkey pork loin t-bone short ribs ball tip turducken cow filet mignon. Fatback frankfurter brisket tenderloin, ground round short ribs beef salami drumstick pork chop cow pastrami leberkas.', 2, 1),
(3, '2013-09-10 00:00:00', 'Billy', 'Bill@mail.com', '', 'first!~!!', 2, 1),
(4, '2013-09-10 08:52:20', 'Sue', 'Suzy@mail.com', '', 'this is sue''s comment', 2, 1),
(8, '2013-09-13 11:24:41', 'Herro', 'dzsgh@mail.com', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent hendrerit erat eu faucibus aliquam. Vivamus at lobortis libero. Nam mattis egestas congue. Duis convallis sed lorem lobortis fringilla. Vivamus pretium nisl eget pharetra dapibus. Donec ipsum metus, elementum in feugiat ac, semper ac arcu. Suspendisse vel feugiat mi. Nam a dolor bibendum, egestas urna et, interdum elit. Phasellus fermentum semper sem, sit amet adipiscing nulla fringilla vitae. Morbi ac augue enim. Suspendisse vitae porttitor sapien.', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`link_id`, `url`, `title`, `description`) VALUES
(1, 'http://uiparade.com', 'UI Parade', 'Good stuff!'),
(2, 'http://wordpress.org', 'WordPress', 'the best');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `date` datetime NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `body` text NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `allow_comments` tinyint(1) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `date`, `user_id`, `category_id`, `body`, `is_published`, `allow_comments`) VALUES
(1, 'Happy Friday', '2013-09-06 10:41:18', 1, 2, 'Bacon ipsum dolor sit amet meatball salami drumstick, beef ribs kevin beef swine. Swine brisket sausage prosciutto sirloin t-bone pork belly kielbasa turducken. Turducken ground round cow hamburger frankfurter shank jowl chuck bresaola prosciutto biltong pig brisket. Venison shankle cow doner. Ham pork loin prosciutto bresaola venison cow swine strip steak leberkas filet mignon tongue. Turkey pork loin t-bone short ribs ball tip turducken cow filet mignon. Fatback frankfurter brisket tenderloin, ground round short ribs beef salami drumstick pork chop cow pastrami leberkas.', 1, 0),
(2, 'Who''s got big weekend plans?', '2013-09-06 00:00:00', 2, 3, 'Bacon ipsum dolor sit amet meatball salami drumstick, beef ribs kevin beef swine. Swine brisket sausage prosciutto sirloin t-bone pork belly kielbasa turducken. Turducken ground round cow hamburger frankfurter shank jowl chuck bresaola prosciutto biltong pig brisket. Venison shankle cow doner. Ham pork loin prosciutto bresaola venison cow swine strip steak leberkas filet mignon tongue. Turkey pork loin t-bone short ribs ball tip turducken cow filet mignon. Fatback frankfurter brisket tenderloin, ground round short ribs beef salami drumstick pork chop cow pastrami leberkas.', 1, 1),
(3, 'Happy Monday', '2013-09-09 10:48:30', 1, 1, 'Bla bla this is the post body', 1, 1),
(4, 'Today is Friday September 20th', '2013-09-20 09:23:56', 1, 1, 'Yes it is', 1, 1),
(5, 'Happy Friday... but it''s MOnday!!!!!', '2013-09-23 09:47:11', 1, 2, 'Bacon ipsum dolor sit amet meatball salami drumstick, beef ribs kevin beef swine. Swine brisket sausage prosciutto sirloin t-bone pork belly kielbasa turducken. Turducken ground round cow hamburger frankfurter shank jowl chuck bresaola prosciutto biltong pig brisket. Venison shankle cow doner. Ham pork loin prosciutto bresaola venison cow swine strip steak leberkas filet mignon tongue. Turkey pork loin t-bone short ribs ball tip turducken cow filet mignon. Fatback frankfurter brisket tenderloin, ground round short ribs beef salami drumstick pork chop cow pastrami leberkas.', 1, 0),
(6, 'Happy New Year', '2014-01-03 10:43:44', 1, 1, 'Bacon ipsum dolor sit amet tail tri-tip jerky kielbasa turkey short loin. Ground round tri-tip brisket sirloin beef boudin ham ham hock swine bresaola doner. Cow tenderloin tongue meatloaf rump pork chop filet mignon meatball. Meatball swine leberkas ham hock shank, brisket ham beef ribs flank drumstick t-bone. Chicken tail t-bone strip steak sirloin.', 1, 1),
(7, 'turkey sandwich', '2014-01-07 11:40:45', 1, 4, 'yummy', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(35) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `join_date` datetime NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `thumb_img` text NOT NULL,
  `medium_img` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `join_date`, `is_admin`, `thumb_img`, `medium_img`) VALUES
(1, 'melissa', 'password', 'mcabral@platt.edu', '2014-01-03 10:37:08', 1, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
