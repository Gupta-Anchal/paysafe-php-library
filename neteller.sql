-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2020 at 05:33 PM
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
-- Database: `neteller`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `payment_gateway` varchar(100) DEFAULT 'Netller',
  `mode` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `GatewaytransactionId` varchar(100) DEFAULT NULL,
  `merchantRefNum` varchar(100) DEFAULT NULL,
  `paymentType` varchar(100) DEFAULT NULL,
  `txnTime` varchar(100) DEFAULT NULL,
  `created_at` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `paymentHandleToken` varchar(100) DEFAULT NULL,
  `currencyCode` varchar(100) DEFAULT NULL,
  `orderId` varchar(100) DEFAULT NULL,
  `customerId` varchar(100) DEFAULT NULL,
  `Gatewaystatus` varchar(100) DEFAULT NULL,
  `transactionType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`id`, `username`, `user_id`, `transaction_id`, `amount`, `payment_gateway`, `mode`, `status`, `GatewaytransactionId`, `merchantRefNum`, `paymentType`, `txnTime`, `created_at`, `paymentHandleToken`, `currencyCode`, `orderId`, `customerId`, `Gatewaystatus`, `transactionType`) VALUES
(250, 'test', 1, '20200730052730', '2.5', 'Deposit', 'Netller', 'INITIATED', '', '20200730052730', 'NETELLER', '2020-07-30T15:27:33Z', '2020-07-30 20:57:30', 'PHIcKu9vHtJJigEz', 'USD', 'ORD_907f6aeb-5180-4167-8942-e16015d34401', '', 'pending', 'PAYMENT'),
(251, 'test', 1, '20200730052815', '3.5', 'Deposit', 'Netller', 'PAYABLE', '198596123144205', '20200730052815', 'NETELLER', '2020-07-30T15:28:15Z', '2020-07-30 20:58:15', 'PH0t04BLAof8f9dc', 'USD', 'ORD_32b1bf4b-30d3-4bff-b4b1-ae0d83a6cae9', 'CUS_923DE5D6-7621-4AEC-8E3A-E017F1878906', 'paid', 'PAYMENT'),
(252, 'test', 1, '20200730053253', '5.5', 'Withdraw', 'Netller', 'COMPLETED', NULL, '20200730053253', 'NETELLER', '2020-07-30T15:32:53Z', '2020-07-30 21:02:53', 'PHVsFCartN85NTMj', 'USD', NULL, NULL, NULL, 'STANDALONE_CREDIT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
