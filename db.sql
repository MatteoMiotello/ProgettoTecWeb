-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 31, 2021 alle 14:34
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
-- Struttura della tabella `articolo`
--
DROP TABLE IF EXISTS `articolo`;

CREATE TABLE `articolo` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(126) NOT NULL,
  `descrizione` varchar(300) DEFAULT NULL,
  `testo` varchar(10000) NOT NULL,
  `autore` int(6) NOT NULL,
  `data_pub` datetime DEFAULT NULL,
  `upvotes` int(7) DEFAULT 0,
  `downvotes` int(7) DEFAULT 0,
  `img_path` varchar(255) DEFAULT NULL,
  `alt_img` varchar(255) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `autore` (`autore`),
  CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`autore`) REFERENCES `utente` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=878545 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`ID`, `titolo`, `descrizione`, `testo`, `autore`, `data_pub`, `upvotes`, `downvotes`, `img_path`, `alt_img`, `verificato`) VALUES
(878546, 'Zidane: \"Il Real Madrid non ha memoria, ecco perché vado via\"', 'In una lettera ai tifosi pubblicata dal quotidiano \'As\' l\'allenatore francese spiega i motivi dell\'addio: \"Il club non mi ha dato la fiducia di cui avevo bisognoI rapporti umani sono più importanti del denaro e della fama\"', '\"Ho deciso di lasciare perché il club non mi ha dato la fiducia di cui avevo bisogno\". In una lunga lettera aperta ai tifosi pubblicata dal quotidiano sportivo \'As\', Zinedine Zidane spiega i motivi che lo hanno portato a lasciare il Real Madrid. \"A maggio 2018 sono andato via perché dopo due anni e mezzo con tante vittorie e tanti trofei sentivo che la squadra aveva bisogno di nuovi stimoli per restare al top. Oggi le cose sono diverse. Me ne vado perché sento che la società non mi dà più la fiducia di cui ho bisogno, non mi offre il supporto per costruire qualcosa a medio o lungo termine. So - prosegue il tecnico francese - che quando non vinci devi andare. Ma qui è stata dimenticata una cosa molto importante, tutto quello che ho costruito quotidianamente\".\r\n\"Non chiedevo privilegi ma solo un po\' di memoria\"\r\n\r\nZidane, che ha guidato il Real in due periodi (2016-2018 e 2019-2021) vincendo tre Champions League, due campionati, due Mondiali per club e due supercoppe europee, parla dei 20 anni al Real come la \"cosa più bella nella vita\", riconosce a Perez di averlo scelto nel 2001 (\"ha lottato per me, per farmi venire quando c\'erano certe persone che erano contrarie. Lo dico di cuore, sarò sempre grato al presidente per questo\"), ma aggiunge che \"mi sarebbe piaciuto che in questi mesi il mio rapporto con la società e con il presidente fosse stato un po\' diverso da quello con altri allenatori. Non chiedevo privilegi, ovviamente, ma un po\' più di memoria\".\r\n\"Sono stato rimproverato\"\r\n\r\nZidane ricorda di essere tornato a marzo 2019 dopo otto mersi di stop \"perché me lo ha chiesto Perez ma soprattutto perché me lo chiedevano i tifosi. Quando vi incontravo per strada, sentivo il supporto e la voglia di rivedermi con la squadra. Perché condivido i valori del \'madridismo\', questo club che appartiene ai suoi membri, ai suoi tifosi, al mondo intero\". Racconta che \"io sono un vincitore nato ed ero qui per conquistare trofei, ma al di là di questo ci sono gli esseri umani, le emozioni, la vita e ho la sensazione che queste cose non siano state valorizzate e anzi, in un certo senso, sono stato rimproverato\". E conclude notando come \"oggi la vita di un allenatore sulla panchina di un grande club è di due stagioni, poco di più. Perché duri più a lungo, i rapporti umani sono essenziali, sono più importanti del denaro e della fama. Ecco perché mi ha fatto male leggere sui giornali, dopo una sconfitta, che dovevo vincere la partita successiva o mi avrebbero cacciato, sapendo che tutto ciò trapelava dal club\".', 846802, '2021-05-31 12:11:54', 0, 0, '/assets/article_images/103819202-993eaf67-96c8-4d44-8573-83b677b68153.webp', 'Zinedine Zidane con un pallone in mano', 1),
(878548, 'Calcio Amputati, il Vicenza sul podio della Champions League', 'In Turchia la straordinaria avventura dei campioni d\'Italia: \"Le nostre storie un esempio di chi combatte con i propri limiti\"', 'QUESTA è una Champions League differente. Pochi soldi, nessuna baruffa per aggiudicarsi le dirette televisive. E loro, i protagonisti, raccontano di un calcio in cui esserci è davvero l\'unica cosa che conta. Arrivare sul podio, poi, non può che significare un trionfo. Per questo, anche per questo, gli atleti del Vicenza Calcio Amputati sorridono e si abbracciano a Gaziantep, nel profondo sud della Turchia: terzo posto all\'EAFF Champions League, cui la squadra veneta ha preso parte in qualità di vincitrice dello scudetto nel campionato italiano, insieme ai campioni di Georgia, Azerbaijan, Polonia e Turchia.\r\n\r\n\"Abbiamo sudato, abbiamo fatto fatica, abbiamo messo in campo tutte le nostre energie e ci siamo battuti fino all\'ultimo secondo per conquistare questo traguardo\", raccontano. E le loro storie si assomigliano: cuore e passione oltre l\'ostacolo, semirovesciate con le stampelle che disegnano traiettorie di vita, il pallone c\'entra fino a un certo punto. \"Era l\'esordio della Champions, è stata un\'esperienza fantastica e ci siamo confrontati con realtà di livello più alto rispetto al nostro campionato\", spiega Emanuele \"Lele\" Padoan, anni 20, vicentino di Castagnero: è nato con la gamba destra più corta della sinistra, ma non ha mai smesso di sognare. \"Siamo contenti, la nostra è una squadra giovane che ha bisogno di ancora nuovi innesti. Lo sport non fa differenza, lo sport fa la differenza\", commenta Gianni Sasso, anni 51, tre gol all\'attivo nel week end turco e il ricordo, indelebile, di quel giorno maledetto in cui fu travolto da un\'auto - lui era in vespa - e dovette dire addio, forse, al sogno di diventare Maradona, della sua Ischia. \r\n\r\n\"Ero un predestinato, mi dicevano. Vidi la mia gamba staccarsi e rotolare via, sembrava la fine di tutto. E invece eccomi qui, a vivere come se i limiti non esistano\". Chapeau. I limiti, a ben vedere, non esistono per nessuno di loro. Oggi la si chiamerebbe \'resilienza\', termine che va di moda. \"In realtà - spiega Sasso - il segreto è non far caso a quel che manca, sia persino una gamba, pur di realizzare i propri sogni. E, piuttosto, puntare su quel che si ha a disposizione\". \r\n\r\nE quel che i campioni d\'Italia avevano a disposizione è valso il gradino più basso del podio, certificando la crescita dell\'intero sistema italiano: vittoria con l\'AFC Tbilisi all\'esordio, sconfitta sonora con i turchi della Team Sahinbey Bld Amputee (che si aggiudicherà il trofeo), ancora una vittoria con il Karabakh F. K. (reti di Padoan, La Manna e doppietta di Sasso), pareggio con i polacchi del Legia Amp Futbol. In finale va proprio il Legia, decisiva la differenza reti. Nella \"finalina\" contro gli azeri, invece, al Vicenza basta una prodezza di Lahcen Aloui, nazionalità marocchina. \"L\'anno prossimo - promette - giocheremo la finale e la vinceremo\".\r\n\r\nQuesta è anche la storia di Alejandra Argento, però: ha appena 34 anni ed è il tecnico della squadra scudettata. \"Il merito è tutto loro, questa è una vera e propria famiglia\", spiega, mentre tutt\'intorno è festa grande anche per chi aveva assaporato il calcio per normodotati (vietato dire il calcio vero, basta vederli all\'opera per capire perché). Lorenzo Bulloni, ad esempio, ha esordito in Lega Pro con l\'Albinoleffe e giocava nel Crema quando - il 3 agosto 2018 - rovinò a terra con la sua moto. \"Mi amputarono la gamba, vidi i miei sogni in frantumi. Dopo qualche mese ho capito che, invece, iniziavo un\'altra vita. E ora gioisco\". Merito anche di chi - come Francesco Messori, classe 1998 - racconta sui social la vita da calciatore amputato: colonna della nazionale, il suo libro \"Mi chiamano Messi\" è servito da stimolo a tanti.\r\n\r\nEsempi, non eroi. O meglio: qualcheduno, tra loro, eroe lo è per davvero. Salvatore La Manna, 36 anni, già Caporal Maggiore Scelto dell\'esercito italiano: nel 2009 gli amputarono la gamba, fu ferito per salvare un collega durante un\'azione militare in Libano. Molti, tra i calciatori del Vicenza, saranno impegnati a Cracovia con la maglia della nazionale italiana di calcio per amputati, dal 12 al 19 settembre. Prima, però, riprende il campionato italiano: a Fano il 26 e il 27 giugno - dopo un ampio stop per il Covid - c\'è la seconda tappa, si chiude dal 9 all\'11 luglio. In attesa che il movimento rientri nella FIGC, il campionato è organizzato dalla FISPES, la Federazione Italiana Sport Paralimpici Sperimentali. Il Vicenza vuole rivincere, certo. Ma sarà una festa per tutti, questo è certo. Vero, de Coubertin?', 846803, '2021-05-31 12:33:07', 0, 0, '/assets/article_images/192234873-c23555cf-d792-4a5a-82e5-3baaed9e53ea.webp', 'la squadra di Vicenza Calcio amputati nel momento della premiazione', 1),
(878549, 'Il Covid cambia pelle, ma niente paura. Così ci proteggiamo dalle varianti', 'Funzionano vaccini e vigilanza costante. I medici: importante controllare che le mutazioni non sfuggano agli anticorpi', '\"Questo virus continua a mutare, ma le varianti non devono farci paura\". Lo diceva esattamente un mese fa l’immunologo Andrea Cossarizza, docente all’Università di Modena e Reggio Emilia, e gli sviluppi sembrano dargli ragione. \"Fare previsioni è difficile, ma non ci dobbiamo preoccupare – ha affermato Cossarizza – abbiamo vari elementi rassicuranti. Ad esempio uno studio recentissimo sul Covid evidenzia una risposta anticorpale aumentata di 150 volte con l’impiego di una seconda dose di vaccino mRna dopo una prima a vettore virale\". Sono indicazioni positive sulla immunogenicità della vaccinazione combinata, ovvero la possibilità di fare richiami con prodotti diversi da quelli somministrati con la prima inoculazione.\r\nMa le varianti del virus sono sotto controllo?\r\n\r\n\"Sono oltre 4mila i microorganismi noti, sono milioni quelli che dobbiamo ancora scoprire, ma un virus non può variare all’infinito\". Così Massimo Clementi, docente all’Università Vita-Salute, ospedale San Raffaele di Milano, e Giorgio Palù, presidente dell’Agenzia italiana del farmaco. \"Anche la variante indiana può essere controllata\", ha aggiunto il numero uno dell’Aifa parlando del libro Virosfera (edizioni la Nave di Teseo), presentato l’altra sera a Porta a Porta, da Bruno Vespa. \"Nostro compito, come virologi, è definire se la mutazione è correlata alla virulenza, e quindi alla capacità di dare una malattia più grave\".\r\nLa variante indiana è la più pericolosa?\r\n\r\nIn merito alla pericolosità della variante indiana, che tanto preoccupa le autorità del Regno Unito, gli specialisti sono prudenti: \"Per definire pericolosa una variante bisogna aver accertato che c’è un aggravamento delle condizioni - precisa il professor Palù - e questo al momento possiamo escluderlo. Un’evoluzione naturale del virus che muta non deve sconvolgere, dobbiamo piuttosto controllare che queste varianti non sfuggano agli anticorpi che vengono indotti dalla vaccinazione\". Oggi sappiamo che per effetto delle vaccinazioni stiamo uscendo dall’emergenza. La variante indiana è documentata in Italia in meno dell’1% dei casi mentre la variante inglese (B.1.1.7) del virus Sars-CoV-2 è scesa all’88,1%, in calo rispetto al 91,6% del 15 aprile, con valori oscillanti tra le singole regioni tra il 40% e il 100%. La brasiliana è al 7,3% mentre la nigeriana e la sudafricana ricorrono in percentuali variabili, intorno al 3 per cento. La stima viene dall’ultima indagine condotta dall’Istituto superiore di sanità e dal ministero insieme ai laboratori regionali e alla Fondazione Bruno Kessler.\r\nChe cosa sappiamo della variante vietnamita?\r\n\r\nIn Vietnam è stata rilevata una variante ibrida del coronavirus, formata da quelle indiana e inglese, che si diffonde più rapidamente nell’aria rispetto alle altre. Niente paura, il patogeno responsabile della sindrome da Covid-19 continua a cambiare pelle, ma noi abbiamo gli strumenti. \"Le varianti ci saranno sempre. Più le cerchiamo, più le troveremo\", ha affermato Matteo Bassetti, presidente della Società italiana terapia antinfettiva. La nuova mutazione del Vietnam, che appare come un mix tra quella indiana e quella britannica, \"non è la prima né sarà l’ultima\". Dobbiamo continuare con quello che stiamo facendo. \"Abbiamo vaccini che funzionano bene anche con le varianti e dobbiamo vigilare - ha spiegato l’infettivologo del San Martino di Genova - si tratta di mutanti che arrivano dall’estero, è anche ora di finirla con il terrorismo delle varianti. Anche perché ogni volta che lo abbiamo fatto ci siamo sbagliati. E anche su questa nuova variante, quindi, eviterei di farlo\".\r\nChe cosa resta da fare ora?\r\n\r\nNel contesto italiano, la campagna di vaccinazione deve proseguire a ritmi sostenuti in modo da raggiungere coperture sufficienti che possano sbarrare la strada alla diffusione di varianti di importazione. \"Nell’attuale scenario caratterizzato dalla circolazione di varianti della Sars-Cov2 è necessario continuare a monitorare con grande attenzione - affermano gli autori dell’indagine epidemiologica dell’ISS - in coerenza con le raccomandazioni nazionali e internazionali e con le indicazioni ministeriali. Al fine di contenere e attenuarne l’impatto è importante mantenere l’incidenza su valori che permettano il sistematico tracciamento della maggior parte dei casi\".', 846805, '2021-05-31 12:41:02', 0, 0, '/assets/article_images/41564654186864564198749841989841.webp', 'Vaccinazione anti-Covid', 1),
(878550, 'Marte, nuvole misteriose sul pianeta: il dettaglio ripreso dal rover che sconcerta la Nasa', 'Le misteriose immagini mostrano particolari insoliti che potrebbero condurre a nuove scoperte', 'Quelle che mostra il rover della Nasa Curiosity su Marte sono immagini spettacolari e misteriose. Il robot, che è arrivato al suo decimo anno di missione sul Pianeta rosso, ora affiancato dal più avanzato Perseverance, ha scattato delle foto nel cielo di Marte che hanno attirato l’attenzione degli scienziati. Di solito, infatti, spiegano alla Nasa, le giornate nuvolose sono rare su Marte e le nubi tendono ad accumularsi attorno all’equatore, a causa dell’atmosfera estremamente rarefatta del pianeta. Ma le immagini riprese dal rover e mostrate dell’agenzia spaziale americana mostrano invece alcuni dettagli davvero insoliti.\r\n\r\nLe immagini mostrano nuvole che si sono formate prima del previsto, riporta il Messaggero, e Curiosity ha potuto documentare l’evento, dal gennaio scorso a oggi. Nelle foto si vedono nubi gonfie di cristalli di ghiaccio, alcune delle quali molto colorate. Non solo. Le nuvole sono anche molto più in alta quota del solito. Normalmente le nubi marziane si formano non oltre i 60 chilometri di quota e sono composte di acqua ghiacciata. Ma quelle analizzate da Curiosity sono ancora più in alta quota, e quindi ancora più fredde. Gli scienziati della Nasa ipotizzano che si tratti di anidride carbonica ghiacciata, ovvero quello che chiamiamo ghiaccio secco.\r\n\r\nServiranno ulteriori analisi per capire la loro esatta composizione. In modo del tutto simile a quanto accade sulla Terra, le nubi di Marte appaiono più brillanti al tramonto. Proprio questo cambiamento di colore è servito ai ricercatori per capire a quale altitudine si trovino, comparando la posizione di Marte rispetto al Sole. Ancora più spettacolari sono quelle iridescenti, che sembrano composte di un tappeto di perle. Ma è stato proprio questo decisivo salto di tonalità a far capire agli studiosi come col passare del tempo alcune dinamiche si stiano profondamente modificando.', 846804, '2021-05-31 12:50:06', 0, 0, '/assets/article_images/071115161-ff9adda6-90b6-467d-a2cb-5e1746ad67d1.jpg', 'Nuvole nel cielo marziano', 1),
(878551, 'Morto in un incidente aereo Joe Lara, star di «Tarzan-La grande avventura»', 'L’attore aveva 59 anni ed era stato anche protagonista di «Tarzan a Manhattan» ', '\r\n\r\nUn piccolo aereo si è schiantato in Tennessee. Il bilancio è di sette morti. Fra le vittime c’è anche William Lara, 59 anni, conosciuto come Joe Lara, l’attore che ha interpretato Tarzan nel film Tarzan a Manhattan e la serie televisiva Tarzan: La grande avventura. Con lui è morta anche la moglie, Gwen Shamblin Lara, leader del gruppo cristiano per la perdita di peso Weight Down Ministries, fondato dalla donna nel 1968. La coppia, insieme ad altre cinque persone, era sn Cessna C501 è decollato dall’aeroporto Smyrna Rutherford County e diretto all’aeroporto internazionale di Palm Beach in Florida. Per cause ancora da chiarire il piccolo velivolo è precipitato nel lago Percy Priest vicino a Smyrna, nel Tennessee. Le squadre di soccorso della contea di Rutherford hanno lavorato per tutta la notte tra sabato e domenica ma non sono stati trovati sopravvissuti. «I nostri sforzi sono passati dall’iniziale speranza di salvataggio al recupero dei cadaveri», ha detto un portavoce che ha coordinato i soccorsi.\r\n\r\nNato a San Diego, in California, il 2 febbraio 1962, William Joseph Lara ha iniziato la carriera come modello prima di ottenere, come debuttante, il ruolo principale nel film della Cbs del 1989 Tarzan a Manhattan, che vedeva in azione il re della giungla a New York. Ha poi interpretato il personaggio creato da Edgar Rice Burroughs nella serie tv Tarzan - La grande avventura che tra gli elementi ricorrenti faceva comparire stregoni malvagi, esseri magici, viaggi in altri regni e civiltà nascoste. La serie insisteva molto anche sull’identità di Tarzan, su chi fosse veramente e sul mistero della scomparsa della tribù di Themba. Joe Lara è apparso anche in film d’azione come Bersaglio di mezzanotte (1992), Il guerriero di acciaio (1993), Final Equinox» (1995) e Il giorno del giudizio (2000) e in serie tv tra cui Baywatch e Conan. Ha abbandonato la recitazione dopo vent’anni nel 2002 per perseguire la carriera nella musica country.', 846802, '2021-05-31 12:58:22', 0, 0, '/assets/article_images/cfgyudcsivbuebouircewi98787878199.jpg', 'L\'attore nei panni di Tarzan', 1),
(878552, 'Volo Ryanair Ibiza-Bergamo, la passeggera denunciata: «Io la vita me la godo»', 'L’episodio sul volo Ibiza-Bergamo per la mancata mascherina: la donna ha aggredito passeggeri e steward. Lei minaccia di citare in giudizio chi fa girare i video a bordo', '\r\n\r\nÈ stata denunciata dalla polizia di frontiera la giovane che sul volo Ibiza-Bergamo di qualche giorno fa ha dato in escandescenze sputando, insultando e tirando calci contro diversi passeggeri. Poteva però anche rischiare l’arresto e la richiesta di risarcimento danni per decine di migliaia di euro se il comandante non avesse deciso di tirare dritto e non di dirottare altrove per farla scendere. A bordo del Boeing 737 ha anche riferito di avere «un fratello giudice» a una signora alla quale aveva appena tirato i capelli, salvo poi aggiungere «e tu sei una p...». (Altri due passeggeri sarebbero intenzionati a denunciarla per lesioni, una terza persona si è riservata di deciderlo, come scritto qui).\r\n\r\nPoche ore dopo quello che è stato forse il video più visto sui social e condiviso sulle app di messaggistica istantanea d’Italia, la giovane — che in aereo ha alternato insulti in italiano e in pugliese — ha fornito la sua versione su Instagram. «Le persone che hanno creato gruppi, hanno sponsorizzato o inviato ad altre persone il mio video sul volo al ritorno da Ibiza a Bergamo avranno conseguenze legali perché sta già indagando la Polizia postale, saranno citate in giudizio, avranno conseguenze belle toste perché comunque non è una cosa regolare», dice in una serie di storie. «Però la cosa che mi rammarica è il fatto che al rientro da Ibiza evidentemente quella persona o era troppo frustrata oppure troppo sfigata... evidentemente sarà una bruttissima persona, però alla fine io non mi nascondo dietro a un cellulare o a una tastiera, io la vita me la godo».\r\n\r\nNon si sono di certo goduti molto il volo di ritorno altri passeggeri attorno a lei. Nei vari spezzoni che girano si nota che se la prende con più di un viaggiatore. E il tutto sarebbe partito da una richiesta di rispettare la distanza e di indossare nel modo appropriato la mascherina. Nei filmati la mascherina c’è, ma naso e bocca non sono coperti. In un video di pochi secondi si vede la giovane arrabbiata con un’altra, quindi passa a insultare a sputare. Quando l’assistente di volo si avvicina chiedendo di darsi una calmata lei replica «Evitami.. Evitami... Go away (vai via, in inglese, ndr)». Poi riattacca contro la vicina: «Cioè vieni a dire a me la distanza? Ma come ca... sei salita sull’aereo trim... di me...». («trim...» è la parolaccia più usata dai baresi per dare dello stupido, ndr).\r\n\r\nNon contenta passa a commentare i capelli della malcapitata. «Sta mesciata di me...», riferendosi alla tintura. L’assistente di volo interviene con un «guarda che se non la smetti...» e lei per nulla intimorita: «Perché cosa mi fai eh?». E lui: «Ci sono problemi». Lei: «Quali problemi?». Lui: «Chiudi la bocca, basta per favore». E lei a raffica: «Quali problemi? Quali problemi? Quali problemi?». La giovane — pantaloncini cortissimi, costume da bagno scollato e una camicia annodata a coprirle le spalle — si alza e ribatte a muso duro allo steward che cerca di calmarla, ma lei ribatte che «siamo in Paese democratico e io parlo quanto ca... mi pare». «Ma non puoi offendere», contesta l’assistente di volo. E lei, rivolta all’altra passeggera: «Ha offeso lei ‘sta pu... e tro...».\r\n\r\nIl battibecco irrita anche gli altri viaggiatori. «Ma smettila daiiii, deficiente», si sente dire vicino a chi sta riprendendo la scena con il telefonino. «Ma sei veramente una zoc...». Poi la giovane tira il ciuffo di capelli di una signora davanti a lei da farla urlare di dolore. E via con un altro giro di insulti. È a questo punto che — minacciata di denuncia — la protagonista parla di un fratello «giudice» e «avvocato». La passeggera seduta di fianco ne approfitta per scappare dietro, poi l’equipaggio accompagna la giovane vicino alla cabina del comandante, mentre lei continua a inveire e a tirare qualche calcio.\r\n\r\n«L’equipaggio del volo del 26 maggio da Ibiza a Milano Bergamo ha richiesto l’assistenza della polizia all’arrivo dopo che un passeggero è diventato aggressivo a bordo», spiega Ryanair in una nota inviata al Corriere. «L’aereo è atterrato normalmente e la polizia ha prelevato l’individuo all’aeroporto di Milano Bergamo. Ora il caso è affidato alle autorità di polizia».', 846803, '2021-05-31 13:02:55', 0, 0, '/assets/article_images/47894848955989444444.jpg', 'La ragazza in piedi dentro all\'aereo mentre urla', 1),
(878553, 'Bitcoin, mai così male da settembre 2011, opportunità di acquisto ', NULL, 'Il Bitcoin sta per chiudere il mese di maggio come mai non era accaduto dal settembre 2011, in calo del 37% su base mensile e oltre il -40% rispetto ai massimi toccato il 14 aprile oltre $64 mila.</p><p>\r\nSecondo Robert Kiyosaki, investitore e autore del libro \"Rich Dad, Poor Dad\", questa è \"una grande notizia\". \"Quando il prezzo raggiungerà $ 27.000, comprerò di nuovo, ma molto dipenderà dall\'ambiente macro globale \", ha affermato l\'uomo d\'affari.</p><p>\r\nAd aprile, Kiyosaki aveva previsto in un\'intervista che il prezzo del Bitcoin avrebbe superato il milione di dollari nei prossimi cinque anni. Tuttavia, oro e argento restano gli investimenti preferiti da Kiyosaki, che in passato li ha definiti \"denaro di Dio\".</p><p>\r\nI prezzi delle criptovalute hanno continuato a mostrare volatilità durante il fine settimana, con il Btc che è sceso di circa il 5% sabato, rimbalzando di circa il 4% nelle 24 ore successive e scambiando in un intervallo compreso tra 33.000 e 37.000. Al momento, il token segna il +1,73% a $36.229.</p><p>Per quanto riguarda l\'ether (+3,08% a $2.488), i prezzi hanno visto un\'oscillazione simile, perdendo il 6% sabato e recuperando oltre il 5% il giorno successivo.</p><p>\r\nUna moneta che non ha seguito il trend delle altre controparti è il Ripple, in rialzo del 16% nell\'ultima settimana e del +15% in questo lunedì. I rialzi hanno portato la divisa sopra $1 con market cap di $46,36 miliardi. La divisa digitale ha toccato i massimi storici di $3,29 ed una capitalizzazione di $83,44 miliardi il 4 gennaio 2018. ', 846805, '2021-05-31 13:20:13', 0, 0, '/assets/article_images/8486468484846.webp', 'Simbolo del bitcoin', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `nome` varchar(20) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`nome`, `descrizione`, `img`) VALUES
('Covid', 'Tutto l\'essenziale per tenersi aggiornati sulla pandemia', '/img/covid_cat.jpeg'),
('Economia', '/*description*/', '/img/economy_cat.jpeg'),
('Gossip', 'Tutti i pettegolezzi sulle star e i personaggi di rilievo', '/img/gossip_cat.jpeg'),
('Mondo', 'Le principali notizie sui paesi esteri', '/img/world_cat.jpeg'),
('Politica', 'Le ultime notizie su elezioni, leggi e politica', '/img/politics_cat.jpeg'),
('Scienze', 'Stai al passo con i tempi grazie alla sezione dedicata a scienze e tecnologia', '/img/science_cat.jpeg'),
('Spettacolo', 'Nuovi film, musica, libri e teatro, c\'è tutto ciò che cerchi', '/img/spett_cat.jpeg'),
('Sport', 'Calcio, Basket, Tennis e tutto il meglio dello sport internazionale', '/img/sport_cat.jpeg');

-- --------------------------------------------------------

--
-- Struttura della tabella `cat_art`
--

DROP TABLE IF EXISTS `cat_art`;

CREATE TABLE `cat_art` (
  `ID_art` int(6) NOT NULL,
  `nome_cat` varchar(20) NOT NULL,
  PRIMARY KEY (`nome_cat`,`ID_art`),
  KEY `ID_art` (`ID_art`),
  CONSTRAINT `cat_art_ibfk_2` FOREIGN KEY (`ID_art`) REFERENCES `articolo` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `cat_art_ibfk_3` FOREIGN KEY (`nome_cat`) REFERENCES `categoria` (`nome`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cat_art`
--

INSERT INTO `cat_art` (`ID_art`, `nome_cat`) VALUES
(878549, 'Covid'),
(878553, 'Economia'),
(878552, 'Mondo'),
(878550, 'Scienze'),
(878551, 'Spettacolo'),
(878546, 'Sport'),
(878548, 'Sport');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

DROP TABLE IF EXISTS `commento`;

CREATE TABLE `commento` (
  `ID_art` int(6) NOT NULL,
  `ID_com` int(6) NOT NULL AUTO_INCREMENT,
  `autore` int(6) NOT NULL,
  `testo` varchar(10000) NOT NULL,
  `data_pub` datetime NOT NULL,
  PRIMARY KEY (`ID_com`),
  KEY `autore` (`autore`),
  KEY `ID_art` (`ID_art`),
  CONSTRAINT `commento_ibfk_5` FOREIGN KEY (`ID_art`) REFERENCES `articolo` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `commento_ibfk_6` FOREIGN KEY (`autore`) REFERENCES `utente` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=530769 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

DROP TABLE IF EXISTS `utente`;

CREATE TABLE `utente` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `permesso` char(3) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=846799 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `nome`, `cognome`, `email`, `password`, `permesso`, `img_path`) VALUES
(846802, 'Andrea', 'Polato', 'andrea@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/male_icon.png'),
(846803, 'Giosuè', 'Calgaro', 'giosue@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/male_icon.png'),
(846804, 'Tommaso', 'Allegretti', 'tommaso@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/male_icon.png'),
(846805, 'Matteo', 'Miotello', 'matteo@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/img/male_icon.png'),
(846806, 'Utente', 'Standard', 'utente@user.it', 'ee11cbb19052e40b07aac0ca060c23ee', 'usr', '/img/female_icon.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `voto`
--

DROP TABLE IF EXISTS `voto`;

CREATE TABLE `voto` (
  `utente` int(6) NOT NULL,
  `articolo` int(6) NOT NULL,
  `up` tinyint(1) DEFAULT 0,
  `down` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`utente`,`articolo`),
  KEY `articolo` (`articolo`),
  CONSTRAINT `voto_ibfk_4` FOREIGN KEY (`articolo`) REFERENCES `articolo` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `voto_ibfk_5` FOREIGN KEY (`utente`) REFERENCES `utente` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
