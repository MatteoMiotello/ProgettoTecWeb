-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 01, 2021 alle 15:50
-- Versione del server: 10.4.19-MariaDB
-- Versione PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tec_web`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(6) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `permesso` char(3) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `nome`, `cognome`, `email`, `password`, `permesso`, `img_path`) VALUES
(846802, 'Andrea', 'Polato', 'andrea@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/male_icon.png'),
(846803, 'Giosuè', 'Calgaro', 'giosue@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/male_icon.png'),
(846804, 'Tommaso', 'Allegretti', 'tommaso@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/male_icon.png'),
(846805, 'Matteo', 'Miotello', 'matteo@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/male_icon.png'),
(846806, 'Utente', 'Standard', 'user@user.it', 'ee11cbb19052e40b07aac0ca060c23ee', 'usr', '/img/female_icon.png'),
(846808, 'admin', 'admin', 'admin@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/genderfluid_icon.png');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=846809;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
