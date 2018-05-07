-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 04 maj 2018 kl 00:47
-- Serverversion: 10.1.31-MariaDB
-- PHP-version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `todo`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `tasks`
--

CREATE DATABASE IF NOT EXISTS todo;

USE todo;

CREATE TABLE IF NOT EXISTS `tasks` (
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(100) COLLATE utf8_bin NOT NULL,
  `creation_time` date NOT NULL,
  `due_date` date NOT NULL,
  `last_update` date NOT NULL,
  `priority` int(10) NOT NULL,
  `completed_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP USER IF EXISTS 'tasker'@'localhost';
CREATE USER 'tasker'@'localhost' IDENTIFIED BY 'password';
GRANT USAGE ON *.* TO 'tasker'@'localhost';
GRANT ALL PRIVILEGES ON todo.tasks TO 'tasker'@'localhost';
FLUSH PRIVILEGES;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
