-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 11:21 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gcp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cp`
--

CREATE TABLE `tbl_cp` (
  `cp_id` int(11) NOT NULL,
  `cp_title` varchar(100) NOT NULL,
  `cp_datetime` datetime NOT NULL,
  `cp_location` varchar(20) NOT NULL,
  `cp_ordre` text NOT NULL,
  `cp_detail` text NOT NULL,
  `cp_intervension` text NOT NULL,
  `cp_semestre` int(10) NOT NULL,
  `cp_prom_id` int(20) NOT NULL,
  `cp_status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cp`
--

INSERT INTO `tbl_cp` (`cp_id`, `cp_title`, `cp_datetime`, `cp_location`, `cp_ordre`, `cp_detail`, `cp_intervension`, `cp_semestre`, `cp_prom_id`, `cp_status`) VALUES
(15, 'Procès-Verbal de réunion Du Comité Pédagogique de Promotion1', '2020-10-09 06:11:00', 'E8', 'avancement \r\nvalidation de tp\r\netat d\'abcence\r\nExames', 'En l’an [ ANNE], le [ NBR] jour du mois de [ MOIS ], à [ HEUR ] s’est réuni, au niveau\r\ndu département, le comité pédagogique pour débattre les points ci-dessus, et pour lesquels a été\r\nretenu ce qui suit :', 'aucun', 1, 26, 0),
(16, 'CP1', '2020-12-03 21:58:00', 'E8', 'oui\r\nok\r\nok', 'En l’an [ ANNE], le [ NBR] jour du mois de [ MOIS ], à [ HEUR ] s’est réuni, au niveau\r\ndu département, le comité pédagogique pour débattre les points ci-dessus, et pour lesquels a été\r\nretenu ce qui suit :', 'aucun', 1, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data`
--

CREATE TABLE `tbl_data` (
  `data_id` int(50) NOT NULL,
  `data_avncm_glob` varchar(40) NOT NULL,
  `data_nbr_chap` varchar(40) NOT NULL,
  `data_nbr_cours` varchar(40) NOT NULL,
  `data_nbr_tdtp` varchar(40) NOT NULL,
  `data_nbr_crtdtp` varchar(40) NOT NULL,
  `data_exps_micro` varchar(40) NOT NULL,
  `data_valid_tp` varchar(40) NOT NULL,
  `data_polycp_cour` varchar(40) NOT NULL,
  `data_usr_id` int(30) NOT NULL,
  `data_modl_id` int(11) NOT NULL,
  `data_cp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_data`
--

INSERT INTO `tbl_data` (`data_id`, `data_avncm_glob`, `data_nbr_chap`, `data_nbr_cours`, `data_nbr_tdtp`, `data_nbr_crtdtp`, `data_exps_micro`, `data_valid_tp`, `data_polycp_cour`, `data_usr_id`, `data_modl_id`, `data_cp_id`) VALUES
(53, '100%', '07/07', '12', '08 (TP) & 09 (TD)', '00', 'Fait', 'Fait', 'Remis au étudiants', 101, 36, 15),
(54, '100%', '07/07', '12', '08 (TP) & 09 (TD)', '00', 'Fait', 'Fait', 'Remis au étudiants', 99, 36, 15),
(55, 'h', 'f', 'g', 'fd', 'hfds', 's', 'gf', 'sdf', 109, 42, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delegation`
--

CREATE TABLE `tbl_delegation` (
  `delegation_id` int(11) NOT NULL,
  `delegation_del_id` int(11) NOT NULL,
  `delegation_prom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_delegation`
--

INSERT INTO `tbl_delegation` (`delegation_id`, `delegation_del_id`, `delegation_prom_id`) VALUES
(14, 109, 27);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `details` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messagerie`
--

CREATE TABLE `tbl_messagerie` (
  `msg_id` int(20) NOT NULL,
  `msg_from_id` int(20) NOT NULL,
  `msg_to_id` int(20) NOT NULL,
  `msg_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `msg_subject` varchar(20) NOT NULL,
  `msg_content` text NOT NULL,
  `msg_status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_messagerie`
--

INSERT INTO `tbl_messagerie` (`msg_id`, `msg_from_id`, `msg_to_id`, `msg_datetime`, `msg_subject`, `msg_content`, `msg_status`) VALUES
(83, 109, 98, '2020-12-04 21:42:14', '', 'cc', 0),
(84, 109, 108, '2020-12-04 21:42:31', 'bnj', 'bnj \r\ncv ?', 0),
(85, 98, 112, '2020-12-05 08:18:07', '', 'hey', 0),
(86, 112, 98, '2020-12-05 08:18:39', '', 'Yes', 0),
(87, 98, 112, '2020-12-05 21:25:42', '', 'f', 1),
(88, 98, 108, '2020-12-06 10:18:51', '', 'ghvcg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module`
--

CREATE TABLE `tbl_module` (
  `modl_id` int(50) NOT NULL,
  `modl_name` varchar(50) NOT NULL,
  `modl_abbr` varchar(10) NOT NULL,
  `modl_promo_id` int(50) NOT NULL,
  `modl_semestre` int(50) NOT NULL,
  `modl_ens_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_module`
--

INSERT INTO `tbl_module` (`modl_id`, `modl_name`, `modl_abbr`, `modl_promo_id`, `modl_semestre`, `modl_ens_id`) VALUES
(42, 'MODULE1', 'MDL1', 27, 1, 110),
(43, 'MODULE2', 'MDL2', 27, 1, 111),
(44, 'MODULE3', 'MDL3', 27, 1, 112),
(45, 'MODULE4', 'MDL4', 27, 1, 113),
(46, 'MODULE5', 'MDL5', 27, 1, 114),
(47, 'MODULE6', 'MDL6', 27, 1, 115);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promo`
--

CREATE TABLE `tbl_promo` (
  `prom_id` int(50) NOT NULL,
  `prom_name` varchar(50) NOT NULL,
  `prom_resp_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_promo`
--

INSERT INTO `tbl_promo` (`prom_id`, `prom_name`, `prom_resp_id`) VALUES
(27, 'PROMOTION1', '108');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fullname`, `user_name`, `user_email`, `user_pass`, `user_type`) VALUES
(98, 'admin', 'admin', '', '25d55ad283aa400af464c76d713c07ad', 'admin'),
(108, 'RESPONSABLE1', 'responsable1', '', '25d55ad283aa400af464c76d713c07ad', '1'),
(109, 'DELEGUE1', 'delegue1', '', '25d55ad283aa400af464c76d713c07ad', '3'),
(110, 'ENSEIGNANT1', 'enseignant1', '', '25d55ad283aa400af464c76d713c07ad', '2'),
(111, 'ENSEIGNANT2', 'enseignant2', '', '25d55ad283aa400af464c76d713c07ad', '2'),
(112, 'ENSEIGNANT3', 'enseignant3', '', '25d55ad283aa400af464c76d713c07ad', '2'),
(113, 'ENSEIGNANT4', 'enseignant4', '', '25d55ad283aa400af464c76d713c07ad', '2'),
(114, 'ENSEIGNANT5', 'enseignant5', '', '25d55ad283aa400af464c76d713c07ad', '2'),
(115, 'ENSEIGNANT6', 'enseignant6', '', '25d55ad283aa400af464c76d713c07ad', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cp`
--
ALTER TABLE `tbl_cp`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `tbl_data`
--
ALTER TABLE `tbl_data`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `tbl_delegation`
--
ALTER TABLE `tbl_delegation`
  ADD PRIMARY KEY (`delegation_id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_messagerie`
--
ALTER TABLE `tbl_messagerie`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `tbl_module`
--
ALTER TABLE `tbl_module`
  ADD PRIMARY KEY (`modl_id`);

--
-- Indexes for table `tbl_promo`
--
ALTER TABLE `tbl_promo`
  ADD PRIMARY KEY (`prom_id`),
  ADD UNIQUE KEY `prom_name` (`prom_name`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cp`
--
ALTER TABLE `tbl_cp`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_data`
--
ALTER TABLE `tbl_data`
  MODIFY `data_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_delegation`
--
ALTER TABLE `tbl_delegation`
  MODIFY `delegation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_messagerie`
--
ALTER TABLE `tbl_messagerie`
  MODIFY `msg_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tbl_module`
--
ALTER TABLE `tbl_module`
  MODIFY `modl_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_promo`
--
ALTER TABLE `tbl_promo`
  MODIFY `prom_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
