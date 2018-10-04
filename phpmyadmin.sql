-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2018 at 07:00 PM
-- Server version: 10.1.23-MariaDB-9+deb9u1
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE `Event` (
  `Id` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Date` date NOT NULL,
  `CurrentMatch` int(11) NOT NULL,
  `Open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`Id`, `Name`, `Date`, `CurrentMatch`, `Open`) VALUES
(1, 'Indiana FTC State Championship', '2018-02-24', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `EventMatch`
--

CREATE TABLE `EventMatch` (
  `Id` int(11) NOT NULL,
  `Red1` int(11) NOT NULL,
  `Red2` int(11) NOT NULL,
  `Blue1` int(11) NOT NULL,
  `Blue2` int(11) NOT NULL,
  `Red1Queued` tinyint(1) NOT NULL,
  `Red2Queued` tinyint(1) NOT NULL,
  `Blue1Queued` tinyint(1) NOT NULL,
  `Blue2Queued` tinyint(1) NOT NULL,
  `RedScore` int(11) NOT NULL,
  `BlueScore` int(11) NOT NULL,
  `MatchNumber` int(11) NOT NULL,
  `IsComplete` int(11) NOT NULL,
  `EventId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EventMatch`
--

INSERT INTO `EventMatch` (`Id`, `Red1`, `Red2`, `Blue1`, `Blue2`, `Red1Queued`, `Red2Queued`, `Blue1Queued`, `Blue2Queued`, `RedScore`, `BlueScore`, `MatchNumber`, `IsComplete`, `EventId`) VALUES
(213, 8793, 12551, 3537, 8435, 0, 0, 0, 0, 0, 0, 1, 0, 1),
(214, 8746, 7234, 13414, 8791, 0, 0, 0, 0, 0, 0, 3, 0, 1),
(215, 8711, 12014, 12043, 9864, 0, 0, 0, 0, 0, 0, 4, 0, 1),
(216, 8971, 12231, 6360, 11081, 0, 0, 0, 0, 0, 0, 8, 0, 1),
(217, 8746, 11985, 10133, 8793, 0, 0, 0, 0, 0, 0, 9, 0, 1),
(218, 11114, 3537, 11992, 9864, 0, 0, 0, 0, 0, 0, 10, 0, 1),
(219, 8435, 8711, 9790, 12835, 0, 0, 0, 0, 0, 0, 11, 0, 1),
(220, 9862, 12043, 8971, 4600, 0, 0, 0, 0, 0, 0, 12, 0, 1),
(221, 4600, 11992, 11985, 12130, 0, 0, 0, 0, 0, 0, 2, 0, 1),
(222, 12551, 5300, 10621, 11081, 0, 0, 0, 0, 0, 0, 13, 0, 1),
(223, 13034, 8791, 12231, 535, 0, 0, 0, 0, 0, 0, 14, 0, 1),
(224, 8272, 13414, 8417, 6360, 0, 0, 0, 0, 0, 0, 15, 0, 1),
(225, 11985, 12835, 3537, 12043, 0, 0, 0, 0, 0, 0, 17, 0, 1),
(226, 8711, 4600, 12231, 12551, 0, 0, 0, 0, 0, 0, 18, 0, 1),
(227, 5300, 13414, 8793, 11114, 0, 0, 0, 0, 0, 0, 19, 0, 1),
(228, 535, 10621, 8971, 7234, 0, 0, 0, 0, 0, 0, 20, 0, 1),
(229, 10133, 6360, 9790, 13034, 0, 0, 0, 0, 0, 0, 21, 0, 1),
(230, 8417, 11114, 13295, 13034, 0, 0, 0, 0, 0, 0, 6, 0, 1),
(231, 12130, 9862, 8746, 8417, 0, 0, 0, 0, 0, 0, 23, 0, 1),
(232, 535, 9862, 5300, 9790, 0, 0, 0, 0, 0, 0, 7, 0, 1),
(233, 12835, 10621, 8272, 10133, 0, 0, 0, 0, 0, 0, 5, 0, 1),
(234, 10621, 8791, 11985, 8711, 0, 0, 0, 0, 0, 0, 26, 0, 1),
(235, 3537, 9790, 4600, 8746, 0, 0, 0, 0, 0, 0, 27, 0, 1),
(236, 11081, 12014, 8435, 11992, 0, 0, 0, 0, 0, 0, 24, 0, 1),
(237, 12014, 12130, 7234, 13295, 0, 0, 0, 0, 0, 0, 16, 0, 1),
(238, 8435, 12043, 8272, 535, 0, 0, 0, 0, 0, 0, 30, 0, 1),
(239, 10133, 13295, 11992, 5300, 0, 0, 0, 0, 0, 0, 31, 0, 1),
(240, 13295, 9864, 8791, 8272, 0, 0, 0, 0, 0, 0, 22, 0, 1),
(241, 8417, 8793, 12231, 12014, 0, 0, 0, 0, 0, 0, 28, 0, 1),
(242, 13034, 8971, 12551, 12130, 0, 0, 0, 0, 0, 0, 32, 0, 1),
(243, 6360, 535, 12014, 3537, 0, 0, 0, 0, 0, 0, 35, 0, 1),
(244, 8793, 9864, 12835, 8971, 0, 0, 0, 0, 0, 0, 36, 0, 1),
(245, 11992, 12551, 13414, 12043, 0, 0, 0, 0, 0, 0, 37, 0, 1),
(246, 12130, 8435, 10133, 8791, 0, 0, 0, 0, 0, 0, 38, 0, 1),
(247, 13034, 8272, 5300, 4600, 0, 0, 0, 0, 0, 0, 39, 0, 1),
(248, 13295, 11081, 8746, 8711, 0, 0, 0, 0, 0, 0, 40, 0, 1),
(249, 12835, 7234, 11114, 6360, 0, 0, 0, 0, 0, 0, 25, 0, 1),
(250, 7234, 9790, 11985, 8417, 0, 0, 0, 0, 0, 0, 33, 0, 1),
(251, 9864, 11081, 9862, 13414, 0, 0, 0, 0, 0, 0, 29, 0, 1),
(252, 12231, 11114, 9862, 10621, 0, 0, 0, 0, 0, 0, 34, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Team`
--

CREATE TABLE `Team` (
  `TeamNumber` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Team`
--

INSERT INTO `Team` (`TeamNumber`, `Name`) VALUES
(535, 'Tobor'),
(3537, 'Mecha Hamsters'),
(4537, 'DRSS Enterprise'),
(4600, 'B1nary B0ts'),
(5300, 'Dirty Dozen'),
(6360, 'Brazen Bots'),
(7234, 'Cville-ized Botman'),
(8272, 'CC Sparks'),
(8417, 'Lectric Legends'),
(8435, 'KnightBots'),
(8711, 'Gas Attendants'),
(8746, 'EFF 5 (Engineering for Fun)'),
(8791, 'Green Machine'),
(8793, 'Wired Woodmen'),
(8971, 'Diamond Blades'),
(9790, 'Vier Left'),
(9862, 'CTRL ALT DESTROY'),
(9864, 'Jug Rox Robotix'),
(10133, 'Machines of Mayhem'),
(10621, 'North Robotics'),
(11081, 'SPARC Robotics'),
(11114, 'Ultrasonic Scouts'),
(11985, 'Miss Calculation'),
(11992, 'Radioactivity'),
(12014, 'Fire Wires'),
(12043, 'Power Surge'),
(12130, 'Ravemen'),
(12231, 'Warrior Tech'),
(12551, 'Natural Disasters'),
(12835, 'Pixelated'),
(13034, 'Whitefield Rocks Robotics'),
(13295, 'Red Alert: Disaster Management'),
(13414, 'Crew 272 Circuit Breakers');

-- --------------------------------------------------------

--
-- Table structure for table `TeamEvent`
--

CREATE TABLE `TeamEvent` (
  `EventId` int(11) NOT NULL,
  `TeamId` int(11) NOT NULL,
  `IsCheckedIn` tinyint(1) NOT NULL,
  `PassedRobotInspection` tinyint(1) NOT NULL,
  `PassedFieldInspection` tinyint(1) NOT NULL,
  `ReadyForJudging` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TeamEvent`
--

INSERT INTO `TeamEvent` (`EventId`, `TeamId`, `IsCheckedIn`, `PassedRobotInspection`, `PassedFieldInspection`, `ReadyForJudging`) VALUES
(1, 535, 0, 0, 0, 0),
(1, 3537, 0, 0, 0, 0),
(1, 4600, 0, 0, 0, 0),
(1, 5300, 0, 0, 0, 0),
(1, 6360, 0, 0, 0, 0),
(1, 7234, 0, 0, 0, 0),
(1, 8272, 0, 0, 0, 0),
(1, 8417, 0, 0, 0, 0),
(1, 8435, 0, 0, 0, 0),
(1, 8711, 0, 0, 0, 0),
(1, 8746, 0, 0, 0, 0),
(1, 8791, 0, 0, 0, 0),
(1, 8793, 0, 0, 0, 0),
(1, 8971, 0, 0, 0, 0),
(1, 9790, 0, 0, 0, 0),
(1, 9862, 0, 0, 0, 0),
(1, 9864, 0, 0, 0, 0),
(1, 10133, 0, 0, 0, 0),
(1, 10621, 0, 0, 0, 0),
(1, 11081, 0, 0, 0, 0),
(1, 11114, 0, 0, 0, 0),
(1, 11985, 0, 0, 0, 0),
(1, 11992, 0, 0, 0, 0),
(1, 12014, 0, 0, 0, 0),
(1, 12043, 0, 0, 0, 0),
(1, 12130, 0, 0, 0, 0),
(1, 12231, 0, 0, 0, 0),
(1, 12551, 0, 0, 0, 0),
(1, 12835, 0, 0, 0, 0),
(1, 13034, 0, 0, 0, 0),
(1, 13295, 0, 0, 0, 0),
(1, 13414, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Id` int(11) NOT NULL,
  `Role` varchar(32) NOT NULL,
  `UserName` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Id`, `Role`, `UserName`, `Password`) VALUES
(1, 'Admin', 'Administrator', ''),
(2, 'RobotInspector', 'RobotInspector', ''),
(3, 'Queuer', 'Queuer', ''),
(4, 'FieldInspector', 'FieldInspector', ''),
(5, 'Guest', 'GuestUser', ''),
(6, 'Receptionist', 'Receptionist', ''),
(7, 'Judging', 'JudgeMonitor', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `EventMatch`
--
ALTER TABLE `EventMatch`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `TeamEvent`
--
ALTER TABLE `TeamEvent`
  ADD PRIMARY KEY (`EventId`,`TeamId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Event`
--
ALTER TABLE `Event`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `EventMatch`
--
ALTER TABLE `EventMatch`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
