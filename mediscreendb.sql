-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2019 at 08:28 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediscreendb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `FNAME` varchar(30) DEFAULT NULL,
  `LNAME` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `PWORD` varchar(30) DEFAULT NULL,
  `PHONE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `FNAME`, `LNAME`, `EMAIL`, `PWORD`, `PHONE`) VALUES
(1, 'Joey', 'the admin guy', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `breast_cancer`
--

CREATE TABLE `breast_cancer` (
  `PATIENT_ID` int(11) NOT NULL,
  `F1` float DEFAULT NULL,
  `F2` float DEFAULT NULL,
  `F3` float DEFAULT NULL,
  `F4` float DEFAULT NULL,
  `F5` float DEFAULT NULL,
  `F6` float DEFAULT NULL,
  `F7` float DEFAULT NULL,
  `F8` float DEFAULT NULL,
  `F9` float DEFAULT NULL,
  `F10` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breast_cancer`
--

INSERT INTO `breast_cancer` (`PATIENT_ID`, `F1`, `F2`, `F3`, `F4`, `F5`, `F6`, `F7`, `F8`, `F9`, `F10`) VALUES
(1, 5, 5, 9, 9, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `diabetes`
--

CREATE TABLE `diabetes` (
  `PATIENT_ID` int(11) NOT NULL,
  `F1` float DEFAULT NULL,
  `F2` float DEFAULT NULL,
  `F3` float DEFAULT NULL,
  `F4` float DEFAULT NULL,
  `F5` float DEFAULT NULL,
  `F6` float DEFAULT NULL,
  `F7` float DEFAULT NULL,
  `F8` float DEFAULT NULL,
  `F9` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diabetes`
--

INSERT INTO `diabetes` (`PATIENT_ID`, `F1`, `F2`, `F3`, `F4`, `F5`, `F6`, `F7`, `F8`, `F9`) VALUES
(1, 4, 147, 72, 35, 0, 30.2, 0.627, 5, 1),
(5, 1, 153, 70, 30, 0, 29.5, 0.56, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `ID` int(11) NOT NULL,
  `FNAME` varchar(30) DEFAULT NULL,
  `LNAME` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `PWORD` varchar(30) DEFAULT NULL,
  `PHONE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`ID`, `FNAME`, `LNAME`, `EMAIL`, `PWORD`, `PHONE`) VALUES
(1, 'Dr. John', 'Doe', 'dylan.olney@mycit.ie', '123456789', '123456789'),
(2, 'Dr. Pete', 'Murphy', 'pete.murphy@docs.ie', '123456789', '0868718204'),
(3, 'Dr. Dan', 'Crowley', 'dan.crowley@docs.ie', '123456789', '0877717205'),
(4, 'Dr. Mary', 'O\'Neill', 'mary.oneill@docs.ie', '123456789', '0866708203'),
(5, 'Bill', 'Smith', 'bill.smith@gmail.com', '123456789', '08712334567');

-- --------------------------------------------------------

--
-- Table structure for table `heart_disease`
--

CREATE TABLE `heart_disease` (
  `PATIENT_ID` int(11) NOT NULL,
  `F1` float DEFAULT NULL,
  `F2` float DEFAULT NULL,
  `F3` float DEFAULT NULL,
  `F4` float DEFAULT NULL,
  `F5` float DEFAULT NULL,
  `F6` float DEFAULT NULL,
  `F7` float DEFAULT NULL,
  `F8` float DEFAULT NULL,
  `F9` float DEFAULT NULL,
  `F10` float DEFAULT NULL,
  `F11` float DEFAULT NULL,
  `F12` float DEFAULT NULL,
  `F13` float DEFAULT NULL,
  `F14` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heart_disease`
--

INSERT INTO `heart_disease` (`PATIENT_ID`, `F1`, `F2`, `F3`, `F4`, `F5`, `F6`, `F7`, `F8`, `F9`, `F10`, `F11`, `F12`, `F13`, `F14`) VALUES
(1, 22, 1, 4, 140, 268, 0, 2, 160, 0, 3.6, 3, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `insurance_professionals`
--

CREATE TABLE `insurance_professionals` (
  `ID` int(11) NOT NULL,
  `FNAME` varchar(30) DEFAULT NULL,
  `LNAME` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `PWORD` varchar(30) DEFAULT NULL,
  `PHONE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurance_professionals`
--

INSERT INTO `insurance_professionals` (`ID`, `FNAME`, `LNAME`, `EMAIL`, `PWORD`, `PHONE`) VALUES
(1, 'Joe ', 'Bloggs', 'olney.dylan@gmail.com', '123456789', '123456789'),
(2, 'Pete', 'Crowley', 'pete.crowley@pros.ie', '123456789', '0868715205');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID` int(11) NOT NULL,
  `FNAME` varchar(30) DEFAULT NULL,
  `LNAME` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `PWORD` varchar(30) DEFAULT NULL,
  `PHONE` varchar(30) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `GENDER` varchar(10) DEFAULT NULL,
  `app_rating` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`ID`, `FNAME`, `LNAME`, `EMAIL`, `PWORD`, `PHONE`, `DOB`, `GENDER`, `app_rating`) VALUES
(1, 'Dylan', 'Olney', 'dylan.olney@mycit.ie', '123456789', '0868718204', '14 jun 1973', 'M', 'Well, this is a great app! To be sure.\nStar Rating: *****'),
(2, 'Stephen', 'Walsh', 'stephen.walsh@mycit.ie', '123456789', '0861233456', 'Oct 28, 2019', 'M', NULL),
(3, 'Padraig', 'O\'Rourke', 'padraig.orourke@mycit.ie', '123456789', '086123456', 'Oct 28, 2019', 'M', NULL),
(4, 'Joshua', 'Desmond', 'joshua.desmond@mycit.ie', '123456789', '086123456', 'Oct 28, 2019', 'M', NULL),
(5, 'Mick', 'Murphy', 'mick.murphy@mycit.ie', '123456789', '0861234567', 'Dec 05, 1990', 'M', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_doctor`
--

CREATE TABLE `patient_doctor` (
  `PATIENT_ID` int(10) NOT NULL,
  `DOC_ID` int(10) NOT NULL,
  `RISK_REPORT` text,
  `msg` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_doctor`
--

INSERT INTO `patient_doctor` (`PATIENT_ID`, `DOC_ID`, `RISK_REPORT`, `msg`) VALUES
(1, 1, 'This guy has a clean bill of health. He\'s not at risk from any of the conditions!', 'Hi, can I make an appointment to see you this week?\n\n(Sent at: 2019/11/27 22:49:44 as an e-mail from app.)'),
(2, 1, NULL, NULL),
(3, 1, NULL, NULL),
(4, 1, NULL, NULL),
(5, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_professional`
--

CREATE TABLE `patient_professional` (
  `PATIENT_ID` int(10) NOT NULL,
  `PROF_ID` int(10) NOT NULL,
  `RISK_REPORT` text,
  `msg` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_professional`
--

INSERT INTO `patient_professional` (`PATIENT_ID`, `PROF_ID`, `RISK_REPORT`, `msg`) VALUES
(1, 1, 'This is an insurance report! Blah Blah!', ''),
(2, 1, NULL, NULL),
(3, 1, NULL, NULL),
(4, 1, NULL, NULL),
(5, 2, 'According to Medi AI and the doctors report, this client has a high risk of developing heart disease. The health insurance premium for clients in this high risk category is 3000 euro.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prostate_cancer`
--

CREATE TABLE `prostate_cancer` (
  `PATIENT_ID` int(11) NOT NULL,
  `F1` float DEFAULT NULL,
  `F2` float DEFAULT NULL,
  `F3` float DEFAULT NULL,
  `F4` float DEFAULT NULL,
  `F5` float DEFAULT NULL,
  `F6` float DEFAULT NULL,
  `F7` float DEFAULT NULL,
  `F8` float DEFAULT NULL,
  `F9` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prostate_cancer`
--

INSERT INTO `prostate_cancer` (`PATIENT_ID`, `F1`, `F2`, `F3`, `F4`, `F5`, `F6`, `F7`, `F8`, `F9`) VALUES
(1, 22, 12, 151, 954, 0.143, 0.278, 0.242, 0.079, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `breast_cancer`
--
ALTER TABLE `breast_cancer`
  ADD PRIMARY KEY (`PATIENT_ID`);

--
-- Indexes for table `diabetes`
--
ALTER TABLE `diabetes`
  ADD PRIMARY KEY (`PATIENT_ID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `heart_disease`
--
ALTER TABLE `heart_disease`
  ADD PRIMARY KEY (`PATIENT_ID`);

--
-- Indexes for table `insurance_professionals`
--
ALTER TABLE `insurance_professionals`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patient_doctor`
--
ALTER TABLE `patient_doctor`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD KEY `DOC_ID` (`DOC_ID`);

--
-- Indexes for table `patient_professional`
--
ALTER TABLE `patient_professional`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD KEY `PROF_ID` (`PROF_ID`);

--
-- Indexes for table `prostate_cancer`
--
ALTER TABLE `prostate_cancer`
  ADD PRIMARY KEY (`PATIENT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `insurance_professionals`
--
ALTER TABLE `insurance_professionals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `breast_cancer`
--
ALTER TABLE `breast_cancer`
  ADD CONSTRAINT `breast_cancer_ibfk_1` FOREIGN KEY (`PATIENT_ID`) REFERENCES `patients` (`ID`);

--
-- Constraints for table `diabetes`
--
ALTER TABLE `diabetes`
  ADD CONSTRAINT `diabetes_ibfk_1` FOREIGN KEY (`PATIENT_ID`) REFERENCES `patients` (`ID`);

--
-- Constraints for table `heart_disease`
--
ALTER TABLE `heart_disease`
  ADD CONSTRAINT `heart_disease_ibfk_1` FOREIGN KEY (`PATIENT_ID`) REFERENCES `patients` (`ID`);

--
-- Constraints for table `patient_doctor`
--
ALTER TABLE `patient_doctor`
  ADD CONSTRAINT `patient_doctor_ibfk_1` FOREIGN KEY (`PATIENT_ID`) REFERENCES `patients` (`ID`),
  ADD CONSTRAINT `patient_doctor_ibfk_2` FOREIGN KEY (`DOC_ID`) REFERENCES `doctors` (`ID`);

--
-- Constraints for table `patient_professional`
--
ALTER TABLE `patient_professional`
  ADD CONSTRAINT `patient_professional_ibfk_1` FOREIGN KEY (`PATIENT_ID`) REFERENCES `patients` (`ID`),
  ADD CONSTRAINT `patient_professional_ibfk_2` FOREIGN KEY (`PROF_ID`) REFERENCES `insurance_professionals` (`ID`);

--
-- Constraints for table `prostate_cancer`
--
ALTER TABLE `prostate_cancer`
  ADD CONSTRAINT `prostate_cancer_ibfk_1` FOREIGN KEY (`PATIENT_ID`) REFERENCES `patients` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
