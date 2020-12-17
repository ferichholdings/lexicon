-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 03:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lexicon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminId` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `paswd` varchar(200) NOT NULL,
  `adminLevel` enum('0','1') NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `name`, `email`, `paswd`, `adminLevel`, `createdAt`) VALUES
(1, 'Anthony Chris', 'nnadidsuccess@yahoo.com', 'e00cf25ad42683b3df678c61f42c6bda', '1', '2020-11-12 16:52:23'),
(2, 'John Debeloved', 'john@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', '0', '2020-11-12 17:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `bankinfo`
--

CREATE TABLE `bankinfo` (
  `bnk_id` int(10) NOT NULL,
  `memId` int(10) NOT NULL,
  `accountName` varchar(120) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `accountNumber` varchar(19) NOT NULL,
  `accountType` varchar(15) NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bankinfo`
--

INSERT INTO `bankinfo` (`bnk_id`, `memId`, `accountName`, `bankName`, `accountNumber`, `accountType`, `date_updated`) VALUES
(2, 101, 'Didigwu Nnameka Christian', 'Fidelity Bank', '09887465342', 'Savings', '2020-11-09 14:22:06'),
(3, 103, 'AnthonyObilikwu Ojocho', 'zenith Bank', '0022356464', 'Current', '2020-11-16 16:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `lexicon_algo`
--

CREATE TABLE `lexicon_algo` (
  `algoId` int(20) NOT NULL,
  `algoLetter` char(1) NOT NULL,
  `xteristics` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lexicon_algo`
--

INSERT INTO `lexicon_algo` (`algoId`, `algoLetter`, `xteristics`) VALUES
(1, 'A', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.'),
(2, 'B', 'You are very friendly. You have a sensitive personality. You are a large-hearted individual. Sometimes, you get very aggressive.'),
(4, 'C', 'You are a clever person. You have a sociable nature. You are a charming person. You can be inattentive at times.'),
(5, 'D', 'You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.'),
(6, 'E', 'You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.'),
(7, 'F', 'You are softhearted. You love to shower your affection on your near ones. You are quite reliable in important matters. You go into a gloomy mood.'),
(8, 'G', 'You are religious at heart. You have a strong intuition. Wisdom is your forte. You are quite cynical sometimes.'),
(9, 'H', 'You are quite efficient in your work. You are a nature loving person. You have strong business acumen. You are an egoistic person.'),
(10, 'I', 'You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations'),
(11, 'J', 'You are known for your kindness. You are a brainy person. Your honesty is appreciable. Laziness is your bad quality.'),
(12, 'K', 'You have a lot of influence over others. Your assertive nature can take you places. Your energy levels know no bounds. Sometimes, you get quite discontented with how your life is going.'),
(13, 'L', 'You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.'),
(14, 'M', 'Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.'),
(15, 'N', 'Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.'),
(16, 'O', 'Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.'),
(17, 'P', 'You are a knowledgeable person. You have a powerful aura which puts you in command. You think too much about your own self.'),
(18, 'Q', 'You are quite enthusiastic in your daily life. You have an enigmatic personality which attracts others towards you. You have a tendency of becoming very boring while conversing with others. You have strong will power.'),
(19, 'R', 'Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.'),
(20, 'S', 'You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.'),
(21, 'T', 'You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.'),
(22, 'U', 'You are known for your intelligence. You cherish your freedom. You are quite social and outgoing. You have a tendency to behave selfishly.'),
(23, 'V', 'Your indefatigable attitude towards your work is worth praise. You remain faithful in a relationship. You are very unpredictable. You are truthful in your dealings.'),
(24, 'W', 'You are able to express your views very clearly. You are gregarious and hence have many friends. You act greedy every now and then. You have an enchanting persona.'),
(25, 'X', 'You are indulgent by nature. You are a sensual person. You can be unfaithful in a romantic relationship. You are always in the seek of pleasures in life.'),
(26, 'Y', 'You have an inventive streak. You love your freedom and don\'t like anyone messing with it. You are indecisive and always in a dilemma. You have a beautiful aura around you.'),
(27, 'Z', 'You have a sympathetic heart. You act as peacemaker whenever there is trouble among your near and dear ones. Your diplomacy skills help you in a number of situations. You take rash and bold decisions in a foolhardy manner.');

-- --------------------------------------------------------

--
-- Table structure for table `lexipoints`
--

CREATE TABLE `lexipoints` (
  `lexp_id` int(11) NOT NULL,
  `memId` int(11) NOT NULL,
  `namesId` int(11) NOT NULL,
  `name` int(1) NOT NULL DEFAULT 0,
  `gender` float NOT NULL DEFAULT 0,
  `n_usage` float NOT NULL DEFAULT 0,
  `origin` int(1) NOT NULL DEFAULT 0,
  `history` int(1) NOT NULL DEFAULT 0,
  `meaning` int(1) NOT NULL DEFAULT 0,
  `pronounce` int(1) NOT NULL DEFAULT 0,
  `otherForms` int(1) NOT NULL DEFAULT 0,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lexipoints`
--

INSERT INTO `lexipoints` (`lexp_id`, `memId`, `namesId`, `name`, `gender`, `n_usage`, `origin`, `history`, `meaning`, `pronounce`, `otherForms`, `updatedAt`) VALUES
(6, 109, 88, 1, 0.5, 0.5, 1, 1, 1, 1, 1, '2020-12-12 11:28:26'),
(8, 105, 94, 1, 0.5, 0.5, 1, 0, 1, 0, 0, '2020-12-12 11:43:40'),
(9, 105, 95, 1, 0.5, 0.5, 1, 1, 1, 1, 1, '2020-12-15 15:59:31'),
(10, 103, 63, 0, 0.5, 0, 1, 1, 1, 1, 1, '2020-12-15 15:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memId` int(10) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `gender` varchar(40) DEFAULT NULL,
  `dob` varchar(40) DEFAULT NULL,
  `profilePix` varchar(200) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `lexiPoints` int(10) NOT NULL DEFAULT 0,
  `user_status` enum('1','0') NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memId`, `fullName`, `gender`, `dob`, `profilePix`, `email`, `pwd`, `lexiPoints`, `user_status`, `date_created`, `date_updated`) VALUES
(100, 'Ejiroghene Gbenedio', 'Male', '1998-11-11', 'nigeria.jpg', 'nnadid@yahoo.com', '$2y$10$JE7P6fgI6WB6JSd/slqT0.JTcMj5C243SepE8OGxqwn7ModdW5fRi', 60, '', '2020-11-03 18:12:53', '2020-11-17 10:37:54'),
(101, 'Didigwu  Nnaemeka Christian', 'Male', '2002-11-20', 'my_country.jpg', 'nnadidsuccess@yahoo.com', '$2y$10$SlBbwecpVOOBGzPNtHOaY.JuHok1w0S/He9KKJ/0.jA60ZXs.Ys2u', 140, '1', '2020-11-04 10:43:10', '2020-11-06 17:56:28'),
(102, 'Sunny Odogwu', NULL, '2000-01-20', NULL, 'odogwu@gmail', '$2y$10$vdxQgy9ND03jQIADJTiArufcKSO9OgZboWOgoxCjDhaKV69n26RAi', 0, '1', '2020-11-05 11:46:35', NULL),
(103, 'Anthony Obilikwu Ojochogwu', 'Male', '2000-11-18', 'restscene.jpg', 'antho@yahoo.com', '$2y$10$Ta7plePjACOSlPkY03ZZcuJ9Ds4yH9du3ai46wliDDg1qUy8hOIcG', 0, '1', '2020-11-16 16:01:53', '2020-11-16 16:02:46'),
(105, 'Vakpor Emeke', 'Male', '2009-07-08', 'restscene.jpg', 'va@yahoo.com', '$2y$10$Il7szKdvkc5gHLp8hVP0ieVKj0/MbnFVJcjZxUHL8wB5XtOzVwtHq', 30, '1', '2020-11-23 13:59:23', '2020-11-23 14:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msgId` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `msg` text NOT NULL,
  `msgTitle` varchar(200) NOT NULL,
  `replyMsgId` int(11) DEFAULT NULL,
  `readStatus` enum('0','1') NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL,
  `readAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msgId`, `senderId`, `receiverId`, `msg`, `msgTitle`, `replyMsgId`, `readStatus`, `createdAt`, `readAt`) VALUES
(43, 1, 2, 'I wish to let you know that the codes I lost last time as a result of system recovery to a point is fully recovered', 'I have successfully recovered the code after all', 0, '1', '2020-12-09 18:09:43', '2020-12-16 17:11:05'),
(44, 2, 105, 'wow!!! All thanks to God 00000.\r\nCongratulations', '', 43, '0', '2020-12-09 18:17:35', NULL),
(62, 2, 1, 'The program uses urllib to read the HTML from the data files , extract the href= vaues from the anchor tags, scan for a tag that is in a particular position relative to the first name in the list, follow that link and repeat the process a number of times and report the last name you find.', '', 44, '1', '2020-12-10 14:48:06', '2020-12-17 09:23:11'),
(63, 2, 1, 'The program uses urllib to read the HTML from the data files , extract the href= vaues from the anchor tags, scan for a tag that is in a particular position relative to the first name in the list, follow that link and repeat the process a number of times and report the last name you find.', '', 44, '1', '2020-12-10 14:48:06', '2020-12-17 12:09:21'),
(64, 2, 1, 'The program uses urllib to read the HTML from the data files , extract the href= vaues from the anchor tags, scan for a tag that is in a particular position relative to the first name in the list, follow that link and repeat the process a number of times and report the last name you find.', '', 45, '1', '2020-12-10 14:52:57', '2020-12-17 12:09:25'),
(67, 2, 1, 'The program uses urllib to read the HTML from the data files , extract the href= vaues from the anchor tags, scan for a tag that is in a particular position relative to the first name in the list, follow that link and repeat the process a number of times and report the last name you find.', '', 45, '1', '2020-12-10 14:52:57', '2020-12-17 12:09:28'),
(68, 2, 1, 'The program uses urllib to read the HTML from the data files , extract the href= vaues from the anchor tags, scan for a tag that is in a particular position relative to the first name in the list, follow that link and repeat the process a number of times and report the last name you find.', '', 45, '1', '2020-12-10 14:52:57', '2020-12-17 12:09:30'),
(69, 2, 1, 'The program uses urllib to read the HTML from the data files , extract the href= vaues from the anchor tags, scan for a tag that is in a particular position relative to the first name in the list, follow that link and repeat the process a number of times and report the last name you find.', '', 43, '1', '2020-12-10 14:53:33', '2020-12-17 12:09:31'),
(71, 2, 1, 'The program uses urllib to read the HTML from the data files , extract the href= vaues from the anchor tags, scan for a tag that is in a particular position relative to the first name in the list, follow that link and repeat the process a number of times and report the last name you find.', '', 43, '1', '2020-12-10 14:53:33', '2020-12-17 09:23:09'),
(72, 2, 1, 'The program uses urllib to read the HTML from the data files , extract the href= vaues from the anchor tags, scan for a tag that is in a particular position relative to the first name in the list, follow that link and repeat the process a number of times and report the last name you find.', '', 43, '1', '2020-12-10 14:53:33', '2020-12-17 09:23:10'),
(75, 1, 2, 'sssasaS', '', 44, '1', '2020-12-16 15:24:56', '2020-12-16 15:28:33'),
(76, 1, 2, 'sssasaS', '', 44, '1', '2020-12-16 15:24:56', '2020-12-16 15:28:32'),
(83, 105, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora maxime libero reiciendis illum consequatur, eligendi explicabo mollitia tenetur illo voluptate doloribus dignissimos est temporibus eius excepturi odio. Tempora, itaque molestias.', 'I am understanding it now', 0, '0', '2020-12-17 10:22:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE `names` (
  `namesId` int(10) NOT NULL,
  `name` varchar(70) NOT NULL COMMENT 'name of a person',
  `otherForms` varchar(150) NOT NULL COMMENT 'Other forms of the name\r\n',
  `nameUsage` varchar(200) DEFAULT NULL,
  `gender` varchar(15) NOT NULL COMMENT 'the gender of the person',
  `origin` text NOT NULL COMMENT 'origin of the name',
  `pronounce` varchar(200) NOT NULL COMMENT 'how to prnounce the name',
  `meaning` text NOT NULL COMMENT 'The meaning of the name',
  `history` text NOT NULL COMMENT 'history of the name',
  `personality` mediumtext DEFAULT NULL COMMENT 'the personality trait associated with the name',
  `addedBy` int(10) NOT NULL COMMENT 'ID of the User who added this name',
  `status` enum('pending','approved','waiting') NOT NULL DEFAULT 'pending',
  `approvedBy` int(11) DEFAULT NULL,
  `published` enum('0','1') NOT NULL DEFAULT '0',
  `publishedAt` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL COMMENT 'date the name was added',
  `date_updated` datetime DEFAULT NULL COMMENT 'date the details was changed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`namesId`, `name`, `otherForms`, `nameUsage`, `gender`, `origin`, `pronounce`, `meaning`, `history`, `personality`, `addedBy`, `status`, `approvedBy`, `published`, `publishedAt`, `date_created`, `date_updated`) VALUES
(26, 'nnadid', 'Nna,Nnaemeka,Nnam, Nnanna', 'Biafra', 'Masculine', 'Biafra', 'nannaana', 'Naijasermons.com.ng respects the rights of copyright holders and will work with the said copyright holders to ensure that infringing material is removed. We monitor all files we upload to make sure that copyrighted material is not uploaded.Naijasermons.com.ng respects the rights of copyright holders and will work with the said copyright holders to ensure that infringing material is removed. We monitor all files we upload to make sure that copyrighted material is not uploaded.Naijasermons.com.ng respects the rights of copyright holders and will work with the said copyright holders to ensure that infringing material is removed. We monitor all files we upload to make sure that copyrighted material is not uploaded.Naijasermons.com.ng respects the rights of copyright holders and will work with the said copyright holders to ensure that infringing material is removed. We monitor all files we upload to make sure that copyrighted material is not uploaded.Naijasermons.com.ng respects the rights of copyright holders and will work with the said copyright holders to ensure that infringing material is removed. We monitor all files we upload to make sure that copyrighted material is not uploaded.', 'Naijasermons.com.ng respects the rights of copyright holders and will work with the said copyright holders to ensure that infringing material is removed. We monitor all files we upload to make sure that copyrighted material is not uploaded.', 'Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 1, 'approved', 2, '1', '2020-11-26 17:47:34', '2020-11-12 12:26:54', '2020-11-18 17:08:22'),
(30, 'Richmond', 'Richie, Rich, Richy', 'French', 'Masculine', 'Biafra', 'Ebebebenennene', 'Sand and dust storms (SDSs) offer very serious hazards to the environment, economy and health. An early warning of the upcoming SDS would allow people to take precautionary measures. Traditionally, satellite imaging is used to detect large-scale and long-term SDSs. However, small-scale and short-term SDSs may go undetected due to the poor spatial', 'Sand and dust storms (SDSs) offer very serious hazards to the environment, economy and health. An early warning of the upcoming SDS would allow people to take precautionary measures. Traditionally, satellite imaging is used to detect large-scale and long-term SDSs. However, small-scale and short-term SDSs may go undetected due to the poor spatial', NULL, 2, 'approved', 2, '1', '2020-11-27 16:09:00', '2020-11-17 19:27:19', NULL),
(34, 'ebenezer', 'Eb, Ebene, Ebeneziieer', 'Greek', 'Masculine', 'Israel', 'Ebenebenezer', 'It means orororor', 'hello the history of this name is dated back', 'You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are very friendly. You have a sensitive personality. You are a large-hearted individual. Sometimes, you get very aggressive.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You have a sympathetic heart. You act as peacemaker whenever there is trouble among your near and dear ones. Your diplomacy skills help you in a number of situations. You take rash and bold decisions in a foolhardy manner.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>', 2, 'approved', 2, '1', '2020-12-02 15:34:36', '2020-11-18 11:20:07', '2020-12-02 15:27:56'),
(35, 'calista', 'Callista, Celeste, Callie, Kalista', 'Nigeria', 'Feminine', 'Hebrew', 'KALISTA', 'The name Calista means Beautiful and is of Greek origin. Calista is a name that\'s been used primarily by parents who are considering baby names for girls.', 'The name Calista means Beautiful and is of Greek origin. Calista is a name that\'s been used primarily by parents who are considering baby names for girls.', 'You are a clever person. You have a sociable nature. You are a charming person. You can be inattentive at times.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>', 1, 'approved', 2, '1', '2020-12-02 15:34:48', '2020-11-18 12:15:14', '2020-12-02 15:28:35'),
(36, 'elizabeth', 'Beth, Betsy, Eli, Bettina, Betty, Elisabetha, Elisa', 'English', 'Feminine', 'Europe', 'Elisheva (אֱלִישֶׁבַע‎)', 'Elizabeth is a feminine given name derived from a form of the Hebrew name Elisheva (אֱלִישֶׁבַע‎), meaning &quot;My God is an oath&quot; or &quot;My God is abundance&quot;, as rendered in the Septuagint.', 'The name has many variants in use across the world and has been in consistent use worldwide. Elizabeth was the tenth most popular name given to baby girls in the United States in 2007 and has been among the 25 most popular names given to girls in the United States for the past 100 years. It is the only name that has remained in the top ten US girls\' names list from 1925 to 1972.[1]\r\n\r\nIn the early 21st century it has been among the top 50 names given to girls born in England and Wales as well as in Canada and in Australia in the past 10 years and has been in the top 100 most popular names given to baby girls born in Scotland and Ireland. Elizaveta (Eлизaвeтa), a Russian form of the name, has been in the top 10 names given to baby girls born in Moscow, Russia in the past 10 years. The name is also popular in Ukraine and in Belarus.', 'You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You have a sympathetic heart. You act as peacemaker whenever there is trouble among your near and dear ones. Your diplomacy skills help you in a number of situations. You take rash and bold decisions in a foolhardy manner.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are very friendly. You have a sensitive personality. You are a large-hearted individual. Sometimes, you get very aggressive.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>You are quite efficient in your work. You are a nature loving person. You have strong business acumen. You are an egoistic person.<br/>', 1, 'approved', 2, '1', '2020-11-28 11:06:47', '2020-11-18 12:38:22', '2020-11-18 15:06:55'),
(37, 'onyinye', 'Onyi, Onyi, Onyinyechukwu', 'African', 'Both', 'African', 'Onyinye', 'having meaning as “God\'s gift is the best', 'Onyinye is Short form of “Onyinyechukwuka” , having meaning as “God\'s gift is the best / greatest”. Variant meanings include given, great gift, Offering. It is used 90% as first name and 10% as a surname.', 'Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You have an inventive streak. You love your freedom and don\'t like anyone messing with it. You are indecisive and always in a dilemma. You have a beautiful aura around you.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>', 2, 'approved', 2, '1', '2020-12-02 15:38:07', '2020-11-18 13:14:24', '2020-12-02 15:33:47'),
(38, 'precious', 'Precy,Precious, prepre', 'English', 'Feminine', 'Europe', 'Preciousci', 'ddadadada', 'dsddaadsdd', 'You are a knowledgeable person. You have a powerful aura which puts you in command. You think too much about your own self.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are a clever person. You have a sociable nature. You are a charming person. You can be inattentive at times.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>You are known for your intelligence. You cherish your freedom. You are quite social and outgoing. You have a tendency to behave selfishly.<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>', 2, 'approved', 2, '1', '2020-12-02 15:39:13', '2020-11-18 13:53:01', NULL),
(39, 'john', 'J, Jj, Johny, joni', 'English', 'Masculine', 'Hebrew', 'jowan', 'john the Devine', 'John the apostle', 'You are known for your kindness. You are a brainy person. Your honesty is appreciable. Laziness is your bad quality.<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>You are quite efficient in your work. You are a nature loving person. You have strong business acumen. You are an egoistic person.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>', 2, 'approved', 2, '1', '2020-12-02 15:35:28', '2020-11-18 13:54:55', NULL),
(40, 'manu', 'Man, Manunu, nunu', 'African', 'Masculine', 'African', 'maanuu', 'I have given tender', 'The name originated from the very person', 'Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are known for your intelligence. You cherish your freedom. You are quite social and outgoing. You have a tendency to behave selfishly.<br/>', 1, 'approved', 2, '1', '2020-12-02 15:38:45', '2020-11-18 14:15:24', NULL),
(43, 'Adamu', 'Admams', 'Adma', 'Masculine', 'Biafra', 'uukkaa', 'Ukamaka is originated from the vry core of the', 'Ukamaka is originated from the vry core of the', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>', 100, 'approved', 2, '1', '2020-12-15 18:03:38', '2020-11-19 18:16:41', '2020-11-18 17:09:05'),
(48, 'Aminu', 'Amina, Aminu,Amin', 'Saudi, Africa', 'Masculine', 'Saudi-arabia', 'AM-min-nu', 'Ukamaka is originated from the vry core of the', 'Aminuis originated from the vry core of the', 'You are known for your intelligence. You cherish your freedom. You are quite social and outgoing. You have a tendency to behave selfishly.<br/>You have a lot of influence over others. Your assertive nature can take you places. Your energy levels know no bounds. Sometimes, you get quite discontented with how your life is going.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>', 100, 'approved', 2, '0', NULL, '2020-11-19 18:33:31', '2020-11-18 18:01:50'),
(49, 'ukamaka', 'Uka', 'Uka', 'Feminine', 'Biafra', 'uukkaa', 'Ukamaka is originated from the vry core of the', 'Ukamaka is originated from the vry core of the', 'You are known for your intelligence. You cherish your freedom. You are quite social and outgoing. You have a tendency to behave selfishly.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>You have a lot of influence over others. Your assertive nature can take you places. Your energy levels know no bounds. Sometimes, you get quite discontented with how your life is going.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>', 100, 'approved', 2, '1', '2020-12-02 15:39:25', '2020-11-19 17:46:49', '2020-11-18 17:34:24'),
(50, 'tobi', 'Tobs, tobe, Tobo', 'African', 'Masculine', 'African', 'T-o-o-b-i', 'Tobi means “Yahweh is good” (from Hebrew “tov” = good + “Yahweh” = referring to the Hebrew God)', 'Tobi is a short variant of the name Tobias, which is a Greek form of the Hebrew “Tuvijah(u)”. It is also common as a girl’s name (especially in the 1930s and 40s).', 'You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>You are very friendly. You have a sensitive personality. You are a large-hearted individual. Sometimes, you get very aggressive.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 105, 'approved', 2, '0', NULL, '2020-11-23 14:02:36', '2020-11-23 14:50:41'),
(51, 'eliazar', 'Eli, Elizar,', 'French, Italy, Spanish', 'Masculine', 'Europe', 'Eli-a-r-z-a-r', 'In Spanish Baby Names the meaning of the name Eliazar is: God has helped.', 'In Spanish Baby Names the meaning of the name Eliazar is: God has helped.', 'You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You have a sympathetic heart. You act as peacemaker whenever there is trouble among your near and dear ones. Your diplomacy skills help you in a number of situations. You take rash and bold decisions in a foolhardy manner.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>', 105, 'approved', 2, '1', '2020-12-02 15:34:56', '2020-11-23 14:17:17', '2020-11-23 14:29:31'),
(52, 'elmondi', 'Eb, Ebene, Ebeneziieer', 'Biafra', 'Masculine', 'Oshodi', 'Ebenebenezer', 'retrtretertret tyutyutyutyuty\r\nrtytrytry', 'ddsddaddfddddfdfd\r\nrteetertertrtrtddsdsds', 'You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 105, 'approved', 2, '0', NULL, '2020-11-24 17:02:31', '2020-11-24 17:15:49'),
(53, 'festus', 'festula, festuss', 'english', 'Masculine', 'from new york to benin', 'fes-tus', 'fine man', 'fine young men are given the name', 'You are softhearted. You love to shower your affection on your near ones. You are quite reliable in important matters. You go into a gloomy mood.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>You are known for your intelligence. You cherish your freedom. You are quite social and outgoing. You have a tendency to behave selfishly.<br/>', 106, 'approved', 2, '1', '2020-12-02 15:35:01', '2020-11-25 11:28:07', '2020-11-25 11:39:35'),
(54, 'tolu', 'ebenezer', 'italian', 'Masculine', 'Oshodi', 'to-lu', 'great is ola', 'a yoruba name with realistic origin', 'You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are known for your intelligence. You cherish your freedom. You are quite social and outgoing. You have a tendency to behave selfishly.<br/>', 106, 'approved', 2, '1', '2020-11-26 16:56:15', '2020-11-25 11:52:40', NULL),
(55, 'taiwo', 'taye, taiyewo, taiwo', 'African, English', 'Masculine', 'African', 't-a-ye-wo', 'Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Etiam vel augue. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sit amet sapien dignissim vestibulum. Integer non velit. Vestibulum ac est lacinia nisi venenatis tristique.', 'Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Etiam vel augue. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sit amet sapien dignissim vestibulum. Integer non velit. Vestibulum ac est lacinia nisi venenatis tristique.', 'You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You are able to express your views very clearly. You are gregarious and hence have many friends. You act greedy every now and then. You have an enchanting persona.<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>', 107, 'approved', 2, '0', '2020-12-02 15:39:41', '2020-12-02 15:26:50', '2020-12-02 15:28:24'),
(56, 'alba', 'Albert, Albinus', 'Italian, Spanish', 'Feminine', 'Italian, Spanish, Catalan, Galicia', 'AL-ba (Italian, Spanish), AL-bə (Catalan)', 'In Latin it means \'dawn\'. It is also considered as a feminine variant of the male name Albert or Albinus', 'The name has two distinct origins namely Germanic and Latin. In Latin it means \'dawn\'. It is also considered as a feminine variant of the male name Albert or Albinus', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are very friendly. You have a sensitive personality. You are a large-hearted individual. Sometimes, you get very aggressive.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:09:29', NULL),
(57, 'alberta', 'Albertha, Albertina, Albertine, Bertina, Tina', 'English,Italian', 'Feminine', 'English, Germanic, Italian, Portuguese', 'al-BUR-tə (English), al-BER-ta (Italian)', 'It is the feminine variant of the name Albert. It means bright, intelligent, noble', 'It is the feminine variant of the name Albert. It means bright, intelligent, noble. From the old from the Old German Adalbert The Canadian province Alberta was named for Queen Victoria and prince Albert\'s daughter Princess Louise Alberta', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are very friendly. You have a sensitive personality. You are a large-hearted individual. Sometimes, you get very aggressive.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:13:02', NULL),
(58, 'alda', 'Aldina, Adela, Adelia, Ethel, Adelene, Adelina', 'North American families, Italy', 'Feminine', 'Italian, Portuguese, Old German', 'AL-ba, AL-də', 'Feminine form of the name Aldo. It means old, wise, wealthy, prosperous.', 'Feminine form of the name Aldo. It means old, wise, wealthy, prosperous. It\'s popular in Italy and North American families of Italian descent.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:16:44', NULL),
(59, 'alecia', 'Alicia, Alice, Alica, Alisha, Alissa, Alise, Alix, Alyse, Allyson, Allison', 'French, German, Italian, Portuguese', 'Feminine', 'French, Germanic', 'ah LEE see ah', 'It means \'of the noble kind\'', 'It means \'of the noble kind\'. From the Old French name Aalis, a short form of Adelais, itself a short form of the Germanic name Adalheidis (see ADELAIDE). This name became popular in France and England in the 12th century. It was borne by the heroine of Lewis Carroll\'s \'Alice\'s Adventures in Wonderland\' (1865) and \'Through the Looking Glass\' (1871).', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are a clever person. You have a sociable nature. You are a charming person. You can be inattentive at times.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:19:27', NULL),
(60, 'aletha', 'Alethea, Letha', 'English, Greek, Italian, American', 'Feminine', 'Greek', 'ah LEETH ah', 'It means Truthful', 'It means Truthful. After Alethea the Greek mythological goddess of truth.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>You are quite efficient in your work. You are a nature loving person. You have strong business acumen. You are an egoistic person.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:21:21', NULL),
(61, 'alexandra', 'Alexandrea, Alexandria(English) Alejandrina(Spanish), Alexandrine (French), Alexis', 'English, German, Dutch, French, Spanish, Italian, Portuguese, Russian Ancient Greek, Greek Mythology', 'Feminine', 'Greek', 'al-əg-ZAN-drə (English), a-le-KSAN-dra (German), ah-lək-SAHN-drah (Dutch), A-LUG-ZAHN-DRA (French), a-le-KSAN-dhra (Greek), ə-li-SHUN-drə  (Portuguese), a-le-SHUN-dru  (Romanian, Spanish, Italian) A-L', 'It means defender of Men.', 'Feminine form of Alexander. It means defender of Men. In Greek mythology this was a Mycenaean epithet of the goddess Hera, and an alternate name of Cassandra. Used in Britain since early 13th century; it became popular after the marriage of the 1863 marriage of future King Edward VII to Princess Alexandra of Denmark.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are indulgent by nature. You are a sensual person. You can be unfaithful in a romantic relationship. You are always in the seek of pleasures in life.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>', 2, 'approved', 2, '1', '2020-12-15 18:11:42', '2020-12-02 17:23:50', NULL),
(62, 'alfreda', 'ALFRED', 'English,German, Italian, Spanish', 'Feminine', 'Germanic, Anglo-saxon', 'al-FRE-da (Polish, German, Italian)', 'From the Old English Aelfraed, meaning elf counsel.', 'Feminine form of ALFRED. From the Old English name Aelfthryth meaning sage, or wise, or from the Old English Aelfraed, meaning elf counsel. In old German it means Oracle.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are softhearted. You love to shower your affection on your near ones. You are quite reliable in important matters. You go into a gloomy mood.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>', 100, 'waiting', 2, '0', NULL, '2020-12-02 17:27:18', NULL),
(63, 'allegra', 'Alegra(Spanish), Alegria, Allegretta, Legra', 'Italian, English ,Spanish', 'Feminine', 'Italian', ': ah-LEHG-Rah (English) or aaL-LEH-GRaa (Italian)', 'It is derived from the element allegro which is of the meaning \'happy, lively, merry\'.', 'It is derived from the element allegro which is of the meaning \'happy, lively, merry\'. The meaning of the name is related to the musical term allegro. The name was first coined by the British poet Lord Byron for his illegitimate daughter Allegra Byron (1817-1822), and has since been adopted in English-speaking countries', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are religious at heart. You have a strong intuition. Wisdom is your forte. You are quite cynical sometimes.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>', 103, 'waiting', 2, '0', NULL, '2020-12-02 17:29:11', NULL),
(64, 'alma', 'Allma, Almah', 'English, Italian', 'Both', 'Latin', 'AHL-mə', 'It means kind, loving, nourishing to the soul.', 'It became popular after the Battle of Alma in the 19th century and became fashionable as a name for girls', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>', 105, 'waiting', 2, '0', NULL, '2020-12-02 17:30:55', NULL),
(65, 'almeda', 'Almea, Almeta, Almetta, Almida', 'English, Spanish', 'Both', 'Latin, Spanish, Arabic', 'aaLMEYDAH', 'In Latin it means ambitious, driven.', 'In Latin it means ambitious, driven. Also possibly derived from the Spanish surname Almeida, from the Arabic phrase &quot;al ma\'ida&quot;, meaning &quot;plateau&quot;.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:33:04', '2020-12-15 13:10:17'),
(66, 'alva', 'Elfa, Elva (Icelandic) Elba (Spanish)', 'Jewish, Sweden, Norway', 'Both', 'Hebrew, Nordic', 'nill', 'Feminine form of the Nordic or Germanic Alf meaning Elf. In Hebrew the meaning of the name Alva is: Brightness, exalted, exalted one.', 'The form Alvah is used in the Old Testament. Famous bearer: prolific American inventor Thomas Alva Edison developed the electric light bulb. Alva is a currently popular name in Sweden, where it was ranked among the ten most popular names given to newborn girls in 2012.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>Your indefatigable attitude towards your work is worth praise. You remain faithful in a relationship. You are very unpredictable. You are truthful in your dealings.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:35:14', NULL),
(67, 'alvina', 'Alveena, Elvena, Elvina', 'German, Jewish, English,', 'Feminine', 'Old German', 'aeLVIY-Naa', 'Feminine form of the name Alvin which comes from either the Old English name Ælfwine, containing the words ælf meaning &quot;elf&quot; and wine meaning &quot;friend&quot;, or from the old high German name Adelwin / Adalwin, meaning Noble Friend. Also, means &quot;loved by everyone&quot; or dearly loved.', 'Feminine form of the name Alvin which comes from either the Old English name Ælfwine, containing the words ælf meaning &quot;elf&quot; and wine meaning &quot;friend&quot;, or from the old high German name Adelwin / Adalwin, meaning Noble Friend. Also, means &quot;loved by everyone&quot; or dearly loved.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>Your indefatigable attitude towards your work is worth praise. You remain faithful in a relationship. You are very unpredictable. You are truthful in your dealings.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:36:30', NULL),
(68, 'amada', 'Amanda, Amadea, Amadita, Amata.', 'Spanish, Italian', 'Feminine', 'Latin', 'ah-MAH-dah', 'Feminine variant of the name Amado which in Spanish means loved. It is of Latin origin, and the meaning of Amada is &quot;lovable&quot;. Spanish variant of Amanda.', 'Feminine variant of the name Amado which in Spanish means loved. It is of Latin origin, and the meaning of Amada is &quot;lovable&quot;. Spanish variant of Amanda.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:37:49', NULL),
(69, 'amalia', 'Αμαλια (Greek),Amelia, Amelie (French)', 'Spanish, Italian, Romanian, Greek, Swedish, Dutch, German, Ancient Germanic (Latinized)', 'Feminine', 'Germanic, Latin', 'ah-MAH-lee-ah (Dutch), a-MA-lya (German)', 'It is derived from the Germanic \'Amal\' which means \'work\', \'labour\' \'activity\'', 'It is derived from the Germanic \'Amal\' which means \'work\', \'labour\' \'activity\'', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:39:51', NULL),
(70, 'amber', 'Amberley, Ambar (Spanish)', 'English, Dutch', 'Feminine', 'Arabic', 'AM-bər (English), AHM-bər (Dutch)', 'From the English word amber that denotes either the gemstone, which is formed from fossil resin, or the reddish-yellow colour. The word ultimately derives from Arabic عنبر (\'anbar). It began to be used as a given name in the late 19th century, but it only became fashionable as a name for girls after the release of Kathleen Winsor\'s novel \'Forever Amber\' (1944).', 'From the English word amber that denotes either the gemstone, which is formed from fossil resin, or the reddish-yellow colour. The word ultimately derives from Arabic عنبر (\'anbar). It began to be used as a given name in the late 19th century, but it only became fashionable as a name for girls after the release of Kathleen Winsor\'s novel \'Forever Amber\' (1944).', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>You are very friendly. You have a sensitive personality. You are a large-hearted individual. Sometimes, you get very aggressive.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:41:53', NULL),
(71, 'ami', 'Ami, Amie', 'English', 'Feminine', 'French', 'AY-mee', 'English form of the Old French name Amée meaning &quot;beloved&quot; or \'dearly loved\' (modern French Aimee), a derivative form of the Latin Amatus.In common use after publication of American Louisa May Alcott\'s \'Little Women\'.', 'English form of the Old French name Amée meaning &quot;beloved&quot; or \'dearly loved\' (modern French Aimee), a derivative form of the Latin Amatus.In common use after publication of American Louisa May Alcott\'s \'Little Women\'.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:43:00', NULL),
(72, 'ana', 'Anna, Ann, Annie, Anita, Annetta, Anette', 'Spanish, Croatian, Portuguese, Slovene, Macedonian, Georgian', 'Feminine', 'Hebrew, Maori', 'A-na (Spanish)', 'Anglicized form of the Hebrew Chaanach  meaning gracious, full of grace, mercy.  In Maori it means serene.', 'Anglicized form of the Hebrew Chaanach  meaning gracious, full of grace, mercy.  In Maori it means serene.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:44:46', NULL),
(73, 'anabel', 'Anna, Annabel, Annabella, Anabelle', 'Spanish', 'Both', 'Latin, Spanish', 'AHN-ah-bell.', 'Derived from the old Anglo-Norman name Amabel. Amabel ultimately comes from the Old French (via the Latin) “amabilis” meaning “loveable”. It  means of the beautiful, graceful.', 'Derived from the old Anglo-Norman name Amabel. Amabel ultimately comes from the Old French (via the Latin) “amabilis” meaning “loveable”. It  means of the beautiful, graceful.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are very friendly. You have a sensitive personality. You are a large-hearted individual. Sometimes, you get very aggressive.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>', 2, 'waiting', 2, '0', NULL, '2020-12-02 17:45:50', NULL),
(74, 'anastasia', 'Anastasiya (Russian) Anastacia (English)', 'Greek, Italian, Russian, Spanish', 'Feminine', 'Ancient Greek', 'a-nə-STAY-zhə (English), a-nə-STAS-yə(English), a-nas-TA-sya (Spanish), a-nas-TA-zya (Italian), A-NA-STA-SEE-A(Classical Greek)', 'Feminine form of the name Anastasius meaning Resurrection or to be reborn.', 'Feminine form of the name Anastasius meaning Resurrection or to be reborn. This was the name of a 4th-century Dalmatian saint who was martyred during the persecutions of the Roman emperor Diocletian. Due to her, the name has been common in Eastern Orthodox Christianity (in various spellings). As an English name it has been in use since the Middle Ages. A famous bearer was the youngest daughter of the last Russian Tsar Nicholas II, who was believed to have escaped the execution of her family in 1918.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:47:22', NULL),
(75, 'andrea', 'Aindrea, Andee, Andra,Andria Andriana, Drea,', 'Aindrea, Andee, Andra,Andria Andriana, Drea,', 'Feminine', 'Greek', 'AN-dree-ah', 'It is from the Greek Andros meaning  \'manly, virile\'. Also from the word &quot;andreia&quot; or feminine form of Andrew or Andreas much favored for blended variants. Also used as nickname of Alexandra.', 'It is from the Greek Andros meaning  \'manly, virile\'. Also from the word &quot;andreia&quot; or feminine form of Andrew or Andreas much favored for blended variants. Also used as nickname of Alexandra.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:49:05', NULL),
(76, 'angela', 'Angel, Andjela, Angelica, Angelique, Angie', 'English, French, Spanish, Italian, Portuguese, Croatian', 'Feminine', 'Greek', 'N-jəl-ə (English), ANG-je-la (Italian), ANG-ge-la (German), AN-gyi-lə(Russian)', 'The origin of the name is Latin and its background is Christian. It is derived from the Greek word ángelos (αγγελος), meaning &quot;messenger of gods&quot;. ). As an English name, it came into use in the 18th century.', 'The origin of the name is Latin and its background is Christian. It is derived from the Greek word ángelos (αγγελος), meaning &quot;messenger of gods&quot;. ). As an English name, it came into use in the 18th century.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are religious at heart. You have a strong intuition. Wisdom is your forte. You are quite cynical sometimes.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:51:09', NULL),
(77, 'analisa', 'Annalisa, Analicia, Analiese, Analise, Analie', 'Italian, Spanish, Portuguese, English', 'Feminine', 'Latin', 'null', 'graced with God\'s bounty&quot;.', 'graced with God\'s bounty&quot;.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:52:26', NULL);
INSERT INTO `names` (`namesId`, `name`, `otherForms`, `nameUsage`, `gender`, `origin`, `pronounce`, `meaning`, `history`, `personality`, `addedBy`, `status`, `approvedBy`, `published`, `publishedAt`, `date_created`, `date_updated`) VALUES
(78, 'antionette', 'Antwinette, Antionetta', 'French', 'Feminine', 'Latin', 'AHN-TWA-NET', 'Feminine diminutive of Antoine. In English the meaning of the name Antoinette is: Highly praiseworthy. From a Roman clan name. In the 17th century, the spelling Anthony was associated with the Greek anthos meaning flower. This name was borne by Marie Antoinette, the queen of France during the French Revolution. She was executed by guillotine.', 'Feminine diminutive of Antoine. In English the meaning of the name Antoinette is: Highly praiseworthy. From a Roman clan name. In the 17th century, the spelling Anthony was associated with the Greek anthos meaning flower. This name was borne by Marie Antoinette, the queen of France during the French Revolution. She was executed by guillotine.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:53:48', NULL),
(79, 'anthonia', 'Antonia, Antonie, Antonina, Antonya, Tonia,', 'English, Spanish, Italian, Danish, Dutch, Swedish', 'Feminine', 'Latin', 'AHN - toNIA', 'Feminine form of the Latin name Antonius. An old noble family name in ancient Rome. It means \'priceless\', \'inestimable\'.', 'Feminine form of the Latin name Antonius. An old noble family name in ancient Rome. It means \'priceless\', \'inestimable\'.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>You are quite efficient in your work. You are a nature loving person. You have strong business acumen. You are an egoistic person.<br/>Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:55:02', NULL),
(80, 'april', 'Avril (French)', 'English', 'Both', 'Latin', 'AY-prəl', 'from the Latin aperire which means to open. It signifies the opening buds of flowers in Spring. Associated with the 4th month of the Julian Calendar which is associated with Spring.', 'from the Latin aperire which means to open. It signifies the opening buds of flowers in Spring. Associated with the 4th month of the Julian Calendar which is associated with Spring.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are a knowledgeable person. You have a powerful aura which puts you in command. You think too much about your own self.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:56:02', NULL),
(81, 'ardell', 'Ardel', 'English', 'Both', 'Latin', ': ar-DELL.', 'It means Eager, burning, faithful, industrious.', 'It means Eager, burning, faithful, industrious.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:58:29', NULL),
(82, 'ariana', 'Ariadne, Arianna, Aryana', 'English, Italian, Spanish', 'Feminine', 'Latin', 'nill', 'Ariana is derived from the Mythological Ariadne who aided Theseus to escape from the Cretan labyrinth.  It means very holy. The name is also associated with the eastern countries of the Persian empire.', 'Ariana is derived from the Mythological Ariadne who aided Theseus to escape from the Cretan labyrinth.  It means very holy. The name is also associated with the eastern countries of the Persian empire.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 17:59:34', NULL),
(83, 'arminda', 'Armida, Araminta', 'Italian, Portuguese, English, Spanish', 'Feminine', 'Latin', 'aa-RMIHND-ah', 'It means soldier', 'It means soldier', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 18:00:52', NULL),
(84, 'arvilla', 'Avile, Arvira', 'Italian, Spanish, English, German', 'Both', 'Old German, Latin', 'nill', 'Arvilla is a variant form of Arnette (Old German): feminine of Arnold. It means \'Eagle ruler\'. Possibly also from the Latin Arvil meaning fertile', 'Arvilla is a variant form of Arnette (Old German): feminine of Arnold. It means \'Eagle ruler\'. Possibly also from the Latin Arvil meaning fertile', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>Your indefatigable attitude towards your work is worth praise. You remain faithful in a relationship. You are very unpredictable. You are truthful in your dealings.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 18:01:54', NULL),
(85, 'asha', '...', 'English, Indian, Swahili', 'Feminine', 'Sanskrit, Swahili', 'nill', 'Asha is an Indian name that comes from the Sanskrit word for hope or desire, but it is also a Swahili name derived from Aisha meaning life', 'Asha is an Indian name that comes from the Sanskrit word for hope or desire, but it is also a Swahili name derived from Aisha meaning life', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>You are quite efficient in your work. You are a nature loving person. You have strong business acumen. You are an egoistic person.<br/>', 2, 'approved', 2, '1', '2020-12-15 18:09:22', '2020-12-02 18:03:59', NULL),
(86, 'ashley', 'Ashlea, Ashlee, Ashlie, Ashlyn, Ashton', 'English', 'Both', 'Old English', 'AASH - LEE', 'the meaning of the name Ashley is: One who lives in the ash tree grove. Derived from a surname and place name based on the Old English word for ash wood. Famous bearer: Ashley, the male character in Margaret Mitchell\'s popular \'Gone with the Wind\'. Both a male and female name although until the 1960s it was more commonly given to boys in the United States, but it is now most often used on girls', 'the meaning of the name Ashley is: One who lives in the ash tree grove. Derived from a surname and place name based on the Old English word for ash wood. Famous bearer: Ashley, the male character in Margaret Mitchell\'s popular \'Gone with the Wind\'. Both a male and female name although until the 1960s it was more commonly given to boys in the United States, but it is now most often used on girls', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>You are quite efficient in your work. You are a nature loving person. You have strong business acumen. You are an egoistic person.<br/>You are rational and sensible. You are an exuberant person. Smartness is one of your assets. Your clumsiness makes you prone to accidents.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>You have an inventive streak. You love your freedom and don\'t like anyone messing with it. You are indecisive and always in a dilemma. You have a beautiful aura around you.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-02 18:05:43', NULL),
(87, 'asia', 'Aja, Asianne, Asya', 'English', 'Feminine', 'Greek', 'AY-zhah', 'the meaning of Asia is &quot;sunrise&quot;. May also derive from Assyrian &quot;asu&quot; meaning &quot;east&quot;. Modern name, usually used in reference to the continent. Also sometimes used as a short form of a name ending with -ia, such as Aspasia According to the Koran, Asia was the name of the Pharoah\'s wife who raised the infant Moses. Asia is also a variant of Aisha , the name of Muhammad\'s favorite wife, one of the four &quot;perfect women&quot;.', 'the meaning of Asia is &quot;sunrise&quot;. May also derive from Assyrian &quot;asu&quot; meaning &quot;east&quot;. Modern name, usually used in reference to the continent. Also sometimes used as a short form of a name ending with -ia, such as Aspasia According to the Koran, Asia was the name of the Pharoah\'s wife who raised the infant Moses. Asia is also a variant of Aisha , the name of Muhammad\'s favorite wife, one of the four &quot;perfect women&quot;.', 'You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>', 2, 'approved', 2, '1', '2020-12-15 18:12:33', '2020-12-02 18:08:51', NULL),
(88, 'funny', 'funnie, fun', 'England, Wales', 'Masculine', 'English', 'fu-nn-y', 'Means funny indeed', 'The history of the name funny', 'You are softhearted. You love to shower your affection on your near ones. You are quite reliable in important matters. You go into a gloomy mood.<br/>You are known for your intelligence. You cherish your freedom. You are quite social and outgoing. You have a tendency to behave selfishly.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You have an inventive streak. You love your freedom and don\'t like anyone messing with it. You are indecisive and always in a dilemma. You have a beautiful aura around you.<br/>', 109, 'approved', 2, '0', NULL, '2020-12-04 13:04:57', '2020-12-12 11:28:58'),
(89, 'christian', 'Chris,Christopher,chriso', 'English', 'Masculine', 'Antioch', 'chr-i-st-ian', 'The name that means followers of Christ', 'I am here to tell you the history of the name Christian', 'You are a clever person. You have a sociable nature. You are a charming person. You can be inattentive at times.<br/>You are quite efficient in your work. You are a nature loving person. You have strong business acumen. You are an egoistic person.<br/>Being charitable and kind comes naturally to you. You are quite easygoing in life. You are quite a sensible person. You lose your temper easily.<br/>You are a refined individual. You are polite with others. You are an inspirational person. You can act cowardly in difficult situations<br/>You are mentally strong. You are lucky with money which is awesome. You are an attractive person. You behave recklessly from time to time.<br/>You are very romantic at heart. Spirituality is ingrained in you. Your lively personality is your plus point. You can be easily deceived by others.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>', 109, 'approved', 1, '0', NULL, '2020-12-04 13:28:11', '2020-12-07 17:24:21'),
(93, 'odafe', 'Oda, dafe', 'English', 'Masculine', 'African', 'o-d-a-fee', 'Excellence', 'Is a name associated with the ....', 'Your persistent personality helps you get work done faster. You like to help others. You have a studious temperament. You often indulge in melodrama to get your way.<br/>You have a sharp mind. You have a balanced nature. You act in a determined way. You can be uncompromising when required to co-operate.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You are softhearted. You love to shower your affection on your near ones. You are quite reliable in important matters. You go into a gloomy mood.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>', 2, 'approved', 2, '0', NULL, '2020-12-12 11:36:26', NULL),
(94, 'nnaemeka', 'Nnamee', 'Biafra', 'Masculine', 'Biafra', 'nananan', 'God does great things', 'Great name for great people exclusive to ...', 'Your extroverted nature does your personality wonders. You have artistic abilities. You are a deep thinker. Jealousy is a sin which you commit once in a while.<br/>You are a confident person. You are a born leader. You have an adventurous streak. At times, you can be arrogant.<br/>You have an ingenious mind. You love to be independent. You can be very unreliable when people least expect it. You have a compassionate heart.<br/>Your clairvoyance can surprise others. Few people are as hardworking as you are. Your self confidence is immense. You tend to act in haste without thinking.<br/>You have a lot of influence over others. Your assertive nature can take you places. Your energy levels know no bounds. Sometimes, you get quite discontented with how your life is going.<br/>', 105, 'approved', 2, '0', NULL, '2020-12-12 11:48:00', '2020-12-12 11:45:47'),
(95, 'ebenebe', 'Ebeano', 'English', 'Masculine', 'Hebrew', 'nannaana', 'Hope you are there', 'The only thing', NULL, 105, 'pending', NULL, '0', NULL, '2020-12-12 11:57:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `notifyId` int(11) NOT NULL,
  `memId` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `_read` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`notifyId`, `memId`, `subject`, `message`, `_read`, `date_created`) VALUES
(67, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!', '0', '2020-12-12 11:43:25'),
(68, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!', '0', '2020-12-12 11:43:40'),
(69, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name', '0', '2020-12-12 11:58:07'),
(70, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!', '0', '2020-12-12 11:58:09'),
(71, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. History Confirmed!', '0', '2020-12-14 15:42:03'),
(72, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!', '0', '2020-12-14 15:43:17'),
(73, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!', '0', '2020-12-14 16:00:40'),
(74, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!', '0', '2020-12-14 16:01:24'),
(75, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!', '0', '2020-12-14 16:01:26'),
(76, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!', '0', '2020-12-14 16:25:34'),
(77, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed', '0', '2020-12-14 16:25:38'),
(78, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!', '0', '2020-12-14 16:25:43'),
(79, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Name pronounciation Confirmed!', '0', '2020-12-14 16:25:45'),
(80, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. History Confirmed!', '0', '2020-12-14 16:25:50'),
(81, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!', '0', '2020-12-14 16:25:53'),
(82, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!', '0', '2020-12-14 16:28:40'),
(83, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!', '0', '2020-12-14 16:28:46'),
(84, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed', '0', '2020-12-14 16:28:48'),
(85, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!', '0', '2020-12-14 16:30:14'),
(86, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!', '0', '2020-12-14 16:30:16'),
(87, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!', '0', '2020-12-14 16:30:20'),
(88, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed', '0', '2020-12-14 16:30:22'),
(89, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Name pronounciation Confirmed!', '0', '2020-12-14 16:30:24'),
(90, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!', '0', '2020-12-14 16:30:25'),
(91, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. History Confirmed!', '0', '2020-12-14 16:30:26'),
(92, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed', '0', '2020-12-14 16:31:01'),
(93, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!', '0', '2020-12-14 16:31:05'),
(94, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!', '0', '2020-12-14 16:35:28'),
(95, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed', '0', '2020-12-14 16:35:30'),
(96, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!', '0', '2020-12-14 16:35:33'),
(97, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Name pronounciation Confirmed!', '0', '2020-12-14 16:35:34'),
(98, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!', '0', '2020-12-14 16:35:36'),
(99, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. History Confirmed!', '0', '2020-12-14 16:35:37'),
(100, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!', '0', '2020-12-14 16:35:40'),
(101, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed', '0', '2020-12-15 09:46:41'),
(102, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!', '0', '2020-12-15 09:46:45'),
(103, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Name pronounciation Confirmed!', '0', '2020-12-15 09:46:47'),
(104, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!', '0', '2020-12-15 09:46:48'),
(105, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. History Confirmed!', '0', '2020-12-15 09:46:56'),
(106, 103, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!', '0', '2020-12-15 15:58:37'),
(107, 103, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed', '0', '2020-12-15 15:58:39'),
(108, 103, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!', '0', '2020-12-15 15:58:41'),
(109, 103, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Name pronounciation Confirmed!', '0', '2020-12-15 15:58:43'),
(110, 103, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!', '0', '2020-12-15 15:58:44'),
(111, 103, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. History Confirmed!', '0', '2020-12-15 15:58:46'),
(112, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!', '0', '2020-12-15 15:59:17'),
(113, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!', '0', '2020-12-15 15:59:20'),
(114, 105, 'Lexi points ~ CR-0.5', 'Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed', '0', '2020-12-15 15:59:21'),
(115, 105, 'Lexi points ~ CR-1', 'Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!', '0', '2020-12-15 15:59:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `bankinfo`
--
ALTER TABLE `bankinfo`
  ADD PRIMARY KEY (`bnk_id`),
  ADD UNIQUE KEY `accountNumber` (`accountNumber`);

--
-- Indexes for table `lexicon_algo`
--
ALTER TABLE `lexicon_algo`
  ADD PRIMARY KEY (`algoId`);

--
-- Indexes for table `lexipoints`
--
ALTER TABLE `lexipoints`
  ADD PRIMARY KEY (`lexp_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msgId`);

--
-- Indexes for table `names`
--
ALTER TABLE `names`
  ADD PRIMARY KEY (`namesId`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`notifyId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bankinfo`
--
ALTER TABLE `bankinfo`
  MODIFY `bnk_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lexicon_algo`
--
ALTER TABLE `lexicon_algo`
  MODIFY `algoId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `lexipoints`
--
ALTER TABLE `lexipoints`
  MODIFY `lexp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`
  MODIFY `namesId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `notifyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
