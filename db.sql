-- MySQL dump 10.19  Distrib 10.3.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: tec_web
-- ------------------------------------------------------
-- Server version	10.3.29-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articolo`
--

DROP TABLE IF EXISTS `articolo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articolo` (
  `ID` int(6) NOT NULL,
  `titolo` varchar(126) NOT NULL,
  `descrizione` varchar(300) DEFAULT NULL,
  `testo` varchar(10000) NOT NULL,
  `autore` int(6) NOT NULL,
  `data_pub` datetime DEFAULT NULL,
  `upvotes` int(7) NOT NULL,
  `downvotes` int(7) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `alt_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `autore` (`autore`),
  CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`autore`) REFERENCES `utente` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articolo`
--

LOCK TABLES `articolo` WRITE;
/*!40000 ALTER TABLE `articolo` DISABLE KEYS */;
INSERT INTO `articolo` VALUES (123548,'Scontro sul Recovery plan, il cdm slitta di quattro ore e comincia alle 13. Bellanova: \"Iv non vota un testo al buio\"',NULL,'La giornata, per il governo, parte in salita. Il consiglio dei ministri sulla governance del Recovery plan, inizialmente previsto alle 9, slitta di ben quattro ore e comincia alle 13. Un ritardo dovuto alle resistenze di Italia viva sulla cabina di regia che dovrà gestire gli stanziamenti del Recovery fund. \"209 miliardi non sono un fatto privato - afferma la ministra dell\'Agricoltura Teresa Bellanova, capodelegazione di Iv al governo - Ho ricevuto alle 2 di stanotte un testo, senza avere il tempo di un approfondimento puntuale. Una pratica inaccettabile e discutibilissima, soprattutto se è in gioco il futuro del Paese. Equivale a chiedere di votare al buio. Italia Viva non lo ritiene possibile\". E poi aggiunge su Facebook: \"Non abbiamo alcun bisogno di strutture parallele, che esautorano Ministri, Ministeri e Parlamento, accentrando e spostando altrove il cuore del processo, decisivo per l\'Italia dei prossimi 10 anni\". Sulla stessa linea la ministra della famiglia Elena Bonetti di Iv: \"Inaccettabile task force come struttura parallela. Ci sono italiani che hanno perso il lavoro e noi ci preoccupiamo di questo e non di moltiplicare poltrone e consulenze. C\'è una sanità che ha bisogno di investimenti, lo sanno le persone che stanno soffrendo negli ospedali e quindi il Mes deve essere usato\".A testimoniare il clima di tensione, le parole del ministro per il Sud, Giuseppe Provenzano: \"Chi si assume questa responsabilità ne trarrà le conseguenze\". E poi: \"Già abbiamo Orban che ci sta creando problemi, se anche qualcuno nella maggioranza per motivi di visibilità mette a rischio questa enorme opportunità del recovery fund non va bene\".<br>+CHAR(13)A quanto si apprende, oggi dovrebbe arrivare il via libera alla bozza dello schema di aggiornamento del piano, ovvero la strutturazione in missioni, componenti e progetti mentre per la partita della struttura di governance, su cui come detto si registra il dissenso dei renziani, si ipotizza un nuovo consiglio dei ministri mercoledì sera.',716989,'2020-12-07 12:30:57',0,0,' null','foto del parlamento'),(144688,'Basket, un nuovo record all\'asta per Jordan: 320mila dollari per una maglia del 1984',NULL,'Il prezzo più alto di sempre per una divisa di Michael Jordan. Una sua maglia dei Chicago Bulls indossata nel 1984, infatti, è stata venduta a un\'asta tenutasi a Beverly Hills alla cifra record di 320mila dollari e, secondo Julien\'s Auctions che ha organizzato l\'asta, la vendita ha stabilito un nuovo primato mondiale per una maglia dell\'ex stella del basket Nba.<br>+CHAR(13)Non è, però, la prima volta che qualcosa appartenente ad Air Jordan raggiunga cifre esorbitanti. L\'ultima pochi mesi fa quando, dopo la messa in onda del documentario \'The Last Dance\', un\'altra maglia, una jersey nera usata contro i Detroit Pistons nell\'aprile del 1997 in una serata non particolarmente fortunata per Michael con soli 18 punti, era stata battuta a 288mila dollari. Prima ancora il primato era detenuto da un\'altra maglia, quella del Dream Team di Barcellona 1992, venduta alla “modica” cifra di 216mila dollari.<br>+CHAR(13)Ma se la maglia del 1984 di MJ ha portato sopra la soglia dei 300mila dollari il primato per una divisa, cosa dire delle Air Jordan usate (e firmate!) nel 1985? 560mila dollari, la cifra più alta mai pagata per un paio di scarpe, oscurando un altro record per un altro paio di scarpe, quelle indossate dallo stesso Jordan alle Olimpiadi del 1984 a Los Angeles vendute per “appena” 190.373 dollari. Una cifra quasi irrisoria in confronto a quella da oltre mezzo milioni di dollari che all\'epoca sembrava comunque enorme, anche in confronto al precedente primato: 104.765 dollari per le scarpe indossate dall\'ex Chicago nel famoso \'flu game\' del 1997 nello Utah. Cifre assurde che comunque fanno capire l\'importanza che Michael Jordan ha avuto per milioni di amanti della pallacanestro sparsi in tutto il mondo e che ancora continua ad avere.',456468,'2020-12-06 05:02:44',0,0,' null','foto del parlamento'),(156612,'Coppola riscrive Il Padrino 3 dall\'inizio alla fine',NULL,'Francis Ford Coppola riscrive dall\'inizio al finale uno dei suoi film più discussi. Trent\'anni dopo esser stato scorticato dalla critica all\'uscita del \"Padrino-Parte Terza\", il regista americano si prepara a distribuire in un numero limitato di sale e in home video il \"director\'s cut\" del terzo e ultimo episodio della celebre trilogia.<br>+CHAR(13)Per il ritorno alla ribalta a partire da questo fine settimana, Coppola ha modificato anche il titolo. \"Mario Puzo\'s The Godfather Coda: The Death of Michael Corleone\" rende omaggio allo scrittore e co-sceneggiatore ripristinando quello scelto da entrambi e che fu invece cambiato dalla Paramount per richiamare il successo delle prime due pellicole. L\'81enne regista ha fatto ritocchi ovunque per chiarire la trama imperniata sui temi della mortalità e della redenzione. In Italia sarà disponibile dal 10 dicembre con Universal Pictures Home Entertainment in DVD e Bluray.<br>+CHAR(13)\"Coda\" comincia adesso andando \"in medias res\" con la scena in cui Michael Corleone (Al Pacino) negozia un prestito multimilionario con la Banca Vaticana, mentre alla fine, anziché far morire l\'anziano Padrino, il nuovo montaggio lo mostra vecchio ma vivo: \"Quando i siciliani ti augurano \'Cent\'anni\'...significa \'lunga vita\'...E un siciliano non dimentica mai\", si legge sullo schermo prima dei titoli di coda. Il nuovo finale lascia Michael Corleone in un \'purgatorio\' di sua totale creazione: \"Lasciare Michael in vita è la vera tragedia\", ha commentato Al Pacino dando, assieme a Diane Keaton (la moglie di Michael, Kay Adams), il suo imprimatur al \"director\'s cut\".<br>+CHAR(13)I primi due \"Padrini\", usciti nel 1972 e 1974, hanno collezionato nove Oscar e quasi un miliardo di dollari di incassi. \"Parte Terza, con sette nomination ma nessuna statuetta e un box office di 136 milioni, è sempre stato considerato la cenerentola della trilogia. Coppola era stato tirato per i capelli nell\'impresa dopo i flop di \"Cotton Club\" e il musical \"Un Sogno Lungo Un Giorno\". \"Avevo bisogno di soldi per uscire da una crisi in cui avevo perso quasi tutto\", ha spiegato il regista al New York Times. La Paramount premeva per uscire nelle sale per Natale 1990. Coppola rispettò gli impegni, ma al debutto del film la critica fu spietata: \"Non solo una delusione, ma un fallimento di proporzioni tali che spezza il cuore\", scrisse il Washington Post.<br>+CHAR(13)Non solo Coppola fu preso di mira. Le recensioni dell\'epoca attaccarono soprattutto la recitazione amatoriale della figlia Sofia, scelta in corsa per il ruolo di Mary, la figlia di Michael, al posto di Wynona Ryder che all\'ultimo momento aveva dato forfait. \"Colpirono Sofia con il proiettile che era destinato a me\", ha commentato con il New York Times il regista, evocando una delle ultime scene del film in cui Mary viene uccisa da un sicario mandato dalla mafia sui gradini del Teatro Massimo di Palermo.',125333,'2020-11-27 21:53:01',0,0,'/web/tecweb/public/img/Sala_del_Consiglio_dei_Ministri_(Palazzo_Chigi,_Roma).jpeg','foto del parlamento'),(878541,'Gualtieri esclude un nuovo blocco dei licenziamenti dopo marzo. Plauso di Bonomi',NULL,'Il governo non ha in programma una proroga del divieto di licenziamento dopo le nuove settimane di cassa integrazione straordinaria, che avranno termine alla fine di marzo. Lo afferma il ministro dell\'Economia Roberto Gualtieri, nel corso di un intervento a Sky TG24. \"Stiamo lavorando per evitare una terza ondata per evitare che le festività diventino momento di propagazione del  contagio, siamo fiduciosi sui passi avanti sul fronte dei vaccini. - precisa il ministro - Tutto questo ci porta auspicabilmente ad escludere di dover prolungare ulteriormente le misure straordinarie\".<br>+CHAR(13)Gualtieri fa notare che il governo ha dovuto praticare la flessbilità e la capacità di adeguarsi a eventi, ad imparare a fare le cose in pochissimo tempo, ad affrontare una situazione inedita. E conclude: \"I segnali sul fronte economico sono tali da far pensare che a marzo la ripresa sarà già avviata\".<br>+CHAR(13)Gli intenti del governo vanno nella direzione voluta da Confindustria: nel corso della stessa trasmissione di Sky Tg24, \'Live in Courmayeur\', il presidente Carlo Bonomi ha espresso l\'auspicio che a partire da marzo il governo non rinnovi il blocco dei licenziamenti, perchè \"questo sarebbe un vero segnale di ripresa per la nostra economia\".<br>+CHAR(13)Non rinnovare il blocco, spiega Bonomi, \"vuol dire che abbiamo superato la fase più acuta della crisi e possiamo far ripartire il Paese\". E del resto il blocco non ha messo in salvo tutti i lavoratori, precisa il leader di Confindustria:  \"Già oggi abbiamo perso mezzo milione di posti di lavoro da inizio pandemia, le stime al 31 marzo ci parlano di un milione di posti di lavoro. Speriamo di essere smentiti\".',846787,'2020-12-04 17:17:05',0,0,' null','foto del parlamento');
/*!40000 ALTER TABLE `articolo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_art`
--

DROP TABLE IF EXISTS `cat_art`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_art` (
  `ID_art` int(6) NOT NULL,
  `nome_cat` varchar(20) NOT NULL,
  PRIMARY KEY (`nome_cat`,`ID_art`),
  KEY `ID_art` (`ID_art`),
  CONSTRAINT `cat_art_ibfk_1` FOREIGN KEY (`nome_cat`) REFERENCES `categoria` (`nome`),
  CONSTRAINT `cat_art_ibfk_2` FOREIGN KEY (`ID_art`) REFERENCES `articolo` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_art`
--

LOCK TABLES `cat_art` WRITE;
/*!40000 ALTER TABLE `cat_art` DISABLE KEYS */;
INSERT INTO `cat_art` VALUES (123548,'Covid'),(878541,'Covid'),(123548,'Economia'),(878541,'Economia'),(123548,'Politica'),(156612,'Spettacolo'),(144688,'Sport');
/*!40000 ALTER TABLE `cat_art` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `nome` varchar(20) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES ('Covid','Tutto l\'essenziale per tenersi aggiornati sulla pandemia','/img/covid_cat.jpeg'),('Economia','/*description*/','/img/economy_cat.jpeg'),('Gossip','Tutti i pettegolezzi sulle star e i personaggi di rilievo','/img/gossip_cat.jpeg'),('Mondo','Le principali notizie sui paesi esteri','/img/world_cat.jpeg'),('Politica','Le ultime notizie su elezioni, leggi e politica','/img/politics_cat.jpeg'),('Scienze','Stai al passo con i tempi grazie alla sezione dedicata a scienze e tecnologia','/img/science_cat.jpeg'),('Spettacolo','Nuovi film, musica, libri e teatro, c\'è tutto ciò che cerchi','/img/spett_cat.jpeg'),('Sport','Calcio, Basket, Tennis e tutto il meglio dello sport internazionale','/img/sport_cat.jpeg');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commento`
--

DROP TABLE IF EXISTS `commento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commento` (
  `ID_art` int(6) NOT NULL,
  `ID_com` int(6) NOT NULL AUTO_INCREMENT,
  `autore` int(6) NOT NULL,
  `testo` varchar(10000) NOT NULL,
  `data_pub` datetime NOT NULL,
  PRIMARY KEY (`ID_com`),
  KEY `commento_ibfk_1` (`ID_art`),
  KEY `commento_ibfk_2` (`autore`),
  CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`ID_art`) REFERENCES `articolo` (`ID`),
  CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`autore`) REFERENCES `utente` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=530763 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commento`
--

LOCK TABLES `commento` WRITE;
/*!40000 ALTER TABLE `commento` DISABLE KEYS */;
INSERT INTO `commento` VALUES (144688,1,218796,' Wow!','2020-12-07 15:47:00'),(156612,430759,716989,'articolo stupendo, siete fantastici!','2021-05-19 18:58:00');
/*!40000 ALTER TABLE `commento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `ID` int(6) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `permesso` char(3) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (125333,'Giosuè','Calgaro','giosue@admin.com','/*hash(admin)*/','adm','/img/male_icon.png'),(218796,'Utente','Standard','utente@user.com','/*hash(user)*/','adm','/img/genderfluid_icon.png'),(456468,'Matteo','Miotello','matteo@admin.com','/*hash(admin)*/','adm','/img/male_icon.png'),(716989,'Andrea','Polato','andrea@admin.com','/*hash(admin)*/','adm','/img/male_icon.png'),(846787,'Tommaso','Allegretti','tommaso@admin.com','/*hash(admin)*/','adm','/img/male_icon.png');
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-20 16:12:07
