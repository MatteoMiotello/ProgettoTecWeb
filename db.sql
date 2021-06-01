-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 01, 2021 alle 15:58
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

CREATE TABLE `articolo` (
  `ID` int(6) NOT NULL,
  `titolo` varchar(126) NOT NULL,
  `descrizione` varchar(300) NOT NULL,
  `testo` varchar(10000) NOT NULL,
  `autore` int(6) NOT NULL,
  `data_pub` datetime DEFAULT NULL,
  `upvotes` int(7) DEFAULT 0,
  `downvotes` int(7) DEFAULT 0,
  `img_path` varchar(255) DEFAULT NULL,
  `alt_img` varchar(255) DEFAULT NULL,
  `verificato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`ID`, `titolo`, `descrizione`, `testo`, `autore`, `data_pub`, `upvotes`, `downvotes`, `img_path`, `alt_img`, `verificato`) VALUES
(878546, 'Zidane: \"Il Real Madrid non ha memoria, ecco perché vado via\"', 'In una lettera ai tifosi pubblicata dal quotidiano \'As\' l\'allenatore francese spiega i motivi dell\'addio: \"Il club non mi ha dato la fiducia di cui avevo bisognoI rapporti umani sono più importanti del denaro e della fama\"', '\"Ho deciso di lasciare perché il club non mi ha dato la fiducia di cui avevo bisogno\". In una lunga lettera aperta ai tifosi pubblicata dal quotidiano sportivo \'As\', Zinedine Zidane spiega i motivi che lo hanno portato a lasciare il Real Madrid. \"A maggio 2018 sono andato via perché dopo due anni e mezzo con tante vittorie e tanti trofei sentivo che la squadra aveva bisogno di nuovi stimoli per restare al top. Oggi le cose sono diverse. Me ne vado perché sento che la società non mi dà più la fiducia di cui ho bisogno, non mi offre il supporto per costruire qualcosa a medio o lungo termine. So - prosegue il tecnico francese - che quando non vinci devi andare. Ma qui è stata dimenticata una cosa molto importante, tutto quello che ho costruito quotidianamente.\"</p><p tabindex=\"0\">\r\nZidane, che ha guidato il Real in due periodi (2016-2018 e 2019-2021) vincendo tre Champions League, due campionati, due Mondiali per club e due supercoppe europee, parla dei 20 anni al Real come la \"cosa più bella nella vita\", riconosce a Perez di averlo scelto nel 2001 (\"ha lottato per me, per farmi venire quando c\'erano certe persone che erano contrarie. Lo dico di cuore, sarò sempre grato al presidente per questo\"), ma aggiunge che \"mi sarebbe piaciuto che in questi mesi il mio rapporto con la società e con il presidente fosse stato un po\' diverso da quello con altri allenatori. Non chiedevo privilegi, ovviamente, ma un po\' più di memoria\".</p><p tabindex=\"0\">Zidane ricorda di essere tornato a marzo 2019 dopo otto mersi di stop \"perché me lo ha chiesto Perez ma soprattutto perché me lo chiedevano i tifosi. Quando vi incontravo per strada, sentivo il supporto e la voglia di rivedermi con la squadra. Perché condivido i valori del \'madridismo\', questo club che appartiene ai suoi membri, ai suoi tifosi, al mondo intero\". Racconta che \"io sono un vincitore nato ed ero qui per conquistare trofei, ma al di là di questo ci sono gli esseri umani, le emozioni, la vita e ho la sensazione che queste cose non siano state valorizzate e anzi, in un certo senso, sono stato rimproverato\". E conclude notando come \"oggi la vita di un allenatore sulla panchina di un grande club è di due stagioni, poco di più. Perché duri più a lungo, i rapporti umani sono essenziali, sono più importanti del denaro e della fama. Ecco perché mi ha fatto male leggere sui giornali, dopo una sconfitta, che dovevo vincere la partita successiva o mi avrebbero cacciato, sapendo che tutto ciò trapelava dal club\".', 846802, '2021-05-31 12:11:54', 0, 0, '/apolato/assets/article_images/103819202-993eaf67-96c8-4d44-8573-83b677b68153.webp', 'Zinedine Zidane con un pallone in mano', 1),
(878548, 'Calcio Amputati, il Vicenza sul podio della Champions League', 'In Turchia la straordinaria avventura dei campioni d\'Italia: \"Le nostre storie un esempio di chi combatte con i propri limiti\"', 'Questa è una Champions League differente. Pochi soldi, nessuna baruffa per aggiudicarsi le dirette televisive. E loro, i protagonisti, raccontano di un calcio in cui esserci è davvero l\'unica cosa che conta. Arrivare sul podio, poi, non può che significare un trionfo. Per questo, anche per questo, gli atleti del Vicenza Calcio Amputati sorridono e si abbracciano a Gaziantep, nel profondo sud della Turchia: terzo posto all\'EAFF Champions League, cui la squadra veneta ha preso parte in qualità di vincitrice dello scudetto nel campionato italiano, insieme ai campioni di Georgia, Azerbaijan, Polonia e Turchia.\r\n</p><p tabindex=\"0\">\r\n\"Abbiamo sudato, abbiamo fatto fatica, abbiamo messo in campo tutte le nostre energie e ci siamo battuti fino all\'ultimo secondo per conquistare questo traguardo\", raccontano. E le loro storie si assomigliano: cuore e passione oltre l\'ostacolo, semirovesciate con le stampelle che disegnano traiettorie di vita, il pallone c\'entra fino a un certo punto. \"Era l\'esordio della Champions, è stata un\'esperienza fantastica e ci siamo confrontati con realtà di livello più alto rispetto al nostro campionato\", spiega Emanuele \"Lele\" Padoan, anni 20, vicentino di Castagnero: è nato con la gamba destra più corta della sinistra, ma non ha mai smesso di sognare. \"Siamo contenti, la nostra è una squadra giovane che ha bisogno di ancora nuovi innesti. Lo sport non fa differenza, lo sport fa la differenza\", commenta Gianni Sasso, anni 51, tre gol all\'attivo nel week end turco e il ricordo, indelebile, di quel giorno maledetto in cui fu travolto da un\'auto - lui era in vespa - e dovette dire addio, forse, al sogno di diventare Maradona, della sua Ischia. \r\n</p><p tabindex=\"0\">\r\n\"Ero un predestinato, mi dicevano. Vidi la mia gamba staccarsi e rotolare via, sembrava la fine di tutto. E invece eccomi qui, a vivere come se i limiti non esistano\". Chapeau. I limiti, a ben vedere, non esistono per nessuno di loro. Oggi la si chiamerebbe \'resilienza\', termine che va di moda. \"In realtà - spiega Sasso - il segreto è non far caso a quel che manca, sia persino una gamba, pur di realizzare i propri sogni. E, piuttosto, puntare su quel che si ha a disposizione\". \r\n</p><p tabindex=\"0\">\r\nE quel che i campioni d\'Italia avevano a disposizione è valso il gradino più basso del podio, certificando la crescita dell\'intero sistema italiano: vittoria con l\'AFC Tbilisi all\'esordio, sconfitta sonora con i turchi della Team Sahinbey Bld Amputee (che si aggiudicherà il trofeo), ancora una vittoria con il Karabakh F. K. (reti di Padoan, La Manna e doppietta di Sasso), pareggio con i polacchi del Legia Amp Futbol. In finale va proprio il Legia, decisiva la differenza reti. Nella \"finalina\" contro gli azeri, invece, al Vicenza basta una prodezza di Lahcen Aloui, nazionalità marocchina. \"L\'anno prossimo - promette - giocheremo la finale e la vinceremo\".\r\n</p><p tabindex=\"0\">\r\nQuesta è anche la storia di Alejandra Argento, però: ha appena 34 anni ed è il tecnico della squadra scudettata. \"Il merito è tutto loro, questa è una vera e propria famiglia\", spiega, mentre tutt\'intorno è festa grande anche per chi aveva assaporato il calcio per normodotati (vietato dire il calcio vero, basta vederli all\'opera per capire perché). Lorenzo Bulloni, ad esempio, ha esordito in Lega Pro con l\'Albinoleffe e giocava nel Crema quando - il 3 agosto 2018 - rovinò a terra con la sua moto. \"Mi amputarono la gamba, vidi i miei sogni in frantumi. Dopo qualche mese ho capito che, invece, iniziavo un\'altra vita. E ora gioisco\". Merito anche di chi - come Francesco Messori, classe 1998 - racconta sui social la vita da calciatore amputato: colonna della nazionale, il suo libro \"Mi chiamano Messi\" è servito da stimolo a tanti.\r\n</p><p tabindex=\"0\">\r\nEsempi, non eroi. O meglio: qualcheduno, tra loro, eroe lo è per davvero. Salvatore La Manna, 36 anni, già Caporal Maggiore Scelto dell\'esercito italiano: nel 2009 gli amputarono la gamba, fu ferito per salvare un collega durante un\'azione militare in Libano. Molti, tra i calciatori del Vicenza, saranno impegnati a Cracovia con la maglia della nazionale italiana di calcio per amputati, dal 12 al 19 settembre. Prima, però, riprende il campionato italiano: a Fano il 26 e il 27 giugno - dopo un ampio stop per il Covid - c\'è la seconda tappa, si chiude dal 9 all\'11 luglio. In attesa che il movimento rientri nella FIGC, il campionato è organizzato dalla FISPES, la Federazione Italiana Sport Paralimpici Sperimentali. Il Vicenza vuole rivincere, certo. Ma sarà una festa per tutti, questo è certo. Vero, de Coubertin?', 846803, '2021-05-31 12:33:07', 0, 0, '/apolato/assets/article_images/192234873-c23555cf-d792-4a5a-82e5-3baaed9e53ea.webp', 'la squadra di Vicenza Calcio amputati nel momento della premiazione', 1),
(878549, 'Il Covid cambia pelle, ma niente paura. Così ci proteggiamo dalle varianti', 'Funzionano vaccini e vigilanza costante. I medici: importante controllare che le mutazioni non sfuggano agli anticorpi', '\"Questo virus continua a mutare, ma le varianti non devono farci paura\". Lo diceva esattamente un mese fa l’immunologo Andrea Cossarizza, docente all’Università di Modena e Reggio Emilia, e gli sviluppi sembrano dargli ragione. \"Fare previsioni è difficile, ma non ci dobbiamo preoccupare – ha affermato Cossarizza – abbiamo vari elementi rassicuranti. Ad esempio uno studio recentissimo sul Covid evidenzia una risposta anticorpale aumentata di 150 volte con l’impiego di una seconda dose di vaccino mRna dopo una prima a vettore virale\". Sono indicazioni positive sulla immunogenicità della vaccinazione combinata, ovvero la possibilità di fare richiami con prodotti diversi da quelli somministrati con la prima inoculazione.\r\n</p><p tabindex=\"0\">\r\nMa le varianti del virus sono sotto controllo?\r\n\"Sono oltre 4mila i microorganismi noti, sono milioni quelli che dobbiamo ancora scoprire, ma un virus non può variare all’infinito\". Così Massimo Clementi, docente all’Università Vita-Salute, ospedale San Raffaele di Milano, e Giorgio Palù, presidente dell’Agenzia italiana del farmaco. \"Anche la variante indiana può essere controllata\", ha aggiunto il numero uno dell’Aifa parlando del libro Virosfera (edizioni la Nave di Teseo), presentato l’altra sera a Porta a Porta, da Bruno Vespa. \"Nostro compito, come virologi, è definire se la mutazione è correlata alla virulenza, e quindi alla capacità di dare una malattia più grave\".\r\n</p><p tabindex=\"0\">\r\nLa variante indiana è la più pericolosa?\r\nIn merito alla pericolosità della variante indiana, che tanto preoccupa le autorità del Regno Unito, gli specialisti sono prudenti: \"Per definire pericolosa una variante bisogna aver accertato che c’è un aggravamento delle condizioni - precisa il professor Palù - e questo al momento possiamo escluderlo. Un’evoluzione naturale del virus che muta non deve sconvolgere, dobbiamo piuttosto controllare che queste varianti non sfuggano agli anticorpi che vengono indotti dalla vaccinazione\". Oggi sappiamo che per effetto delle vaccinazioni stiamo uscendo dall’emergenza. La variante indiana è documentata in Italia in meno dell’1% dei casi mentre la variante inglese (B.1.1.7) del virus Sars-CoV-2 è scesa all’88,1%, in calo rispetto al 91,6% del 15 aprile, con valori oscillanti tra le singole regioni tra il 40% e il 100%. La brasiliana è al 7,3% mentre la nigeriana e la sudafricana ricorrono in percentuali variabili, intorno al 3 per cento. La stima viene dall’ultima indagine condotta dall’Istituto superiore di sanità e dal ministero insieme ai laboratori regionali e alla Fondazione Bruno Kessler.</p><p tabindex=\"0\">\r\nChe cosa sappiamo della variante vietnamita?\r\nIn Vietnam è stata rilevata una variante ibrida del coronavirus, formata da quelle indiana e inglese, che si diffonde più rapidamente nell’aria rispetto alle altre. Niente paura, il patogeno responsabile della sindrome da Covid-19 continua a cambiare pelle, ma noi abbiamo gli strumenti. \"Le varianti ci saranno sempre. Più le cerchiamo, più le troveremo\", ha affermato Matteo Bassetti, presidente della Società italiana terapia antinfettiva. La nuova mutazione del Vietnam, che appare come un mix tra quella indiana e quella britannica, \"non è la prima né sarà l’ultima\". Dobbiamo continuare con quello che stiamo facendo. \"Abbiamo vaccini che funzionano bene anche con le varianti e dobbiamo vigilare - ha spiegato l’infettivologo del San Martino di Genova - si tratta di mutanti che arrivano dall’estero, è anche ora di finirla con il terrorismo delle varianti. Anche perché ogni volta che lo abbiamo fatto ci siamo sbagliati. E anche su questa nuova variante, quindi, eviterei di farlo\".</p><p tabindex=\"0\">\r\nChe cosa resta da fare ora?\r\nNel contesto italiano, la campagna di vaccinazione deve proseguire a ritmi sostenuti in modo da raggiungere coperture sufficienti che possano sbarrare la strada alla diffusione di varianti di importazione. \"Nell’attuale scenario caratterizzato dalla circolazione di varianti della Sars-Cov2 è necessario continuare a monitorare con grande attenzione - affermano gli autori dell’indagine epidemiologica dell’ISS - in coerenza con le raccomandazioni nazionali e internazionali e con le indicazioni ministeriali. Al fine di contenere e attenuarne l’impatto è importante mantenere l’incidenza su valori che permettano il sistematico tracciamento della maggior parte dei casi\".', 846805, '2021-05-31 12:41:02', 0, 0, '/apolato/assets/article_images/41564654186864564198749841989841.webp', 'Vaccinazione anti-Covid', 1),
(878550, 'Marte, nuvole misteriose sul pianeta: il dettaglio ripreso dal rover che sconcerta la Nasa', 'Le misteriose immagini mostrano particolari insoliti che potrebbero condurre a nuove scoperte', 'Quelle che mostra il rover della Nasa Curiosity su Marte sono immagini spettacolari e misteriose. Il robot, che è arrivato al suo decimo anno di missione sul Pianeta rosso, ora affiancato dal più avanzato Perseverance, ha scattato delle foto nel cielo di Marte che hanno attirato l’attenzione degli scienziati. Di solito, infatti, spiegano alla Nasa, le giornate nuvolose sono rare su Marte e le nubi tendono ad accumularsi attorno all’equatore, a causa dell’atmosfera estremamente rarefatta del pianeta. Ma le immagini riprese dal rover e mostrate dell’agenzia spaziale americana mostrano invece alcuni dettagli davvero insoliti.\r\n</p><p tabindex=\"0\">\r\nLe immagini mostrano nuvole che si sono formate prima del previsto, riporta il Messaggero, e Curiosity ha potuto documentare l’evento, dal gennaio scorso a oggi. Nelle foto si vedono nubi gonfie di cristalli di ghiaccio, alcune delle quali molto colorate. Non solo. Le nuvole sono anche molto più in alta quota del solito. Normalmente le nubi marziane si formano non oltre i 60 chilometri di quota e sono composte di acqua ghiacciata. Ma quelle analizzate da Curiosity sono ancora più in alta quota, e quindi ancora più fredde. Gli scienziati della Nasa ipotizzano che si tratti di anidride carbonica ghiacciata, ovvero quello che chiamiamo ghiaccio secco.\r\n</p><p tabindex=\"0\">\r\nServiranno ulteriori analisi per capire la loro esatta composizione. In modo del tutto simile a quanto accade sulla Terra, le nubi di Marte appaiono più brillanti al tramonto. Proprio questo cambiamento di colore è servito ai ricercatori per capire a quale altitudine si trovino, comparando la posizione di Marte rispetto al Sole. Ancora più spettacolari sono quelle iridescenti, che sembrano composte di un tappeto di perle. Ma è stato proprio questo decisivo salto di tonalità a far capire agli studiosi come col passare del tempo alcune dinamiche si stiano profondamente modificando.', 846804, '2021-05-31 12:50:06', 0, 0, '/apolato/assets/article_images/071115161-ff9adda6-90b6-467d-a2cb-5e1746ad67d1.jpeg', 'Nuvole nel cielo marziano', 1),
(878551, 'Morto in un incidente aereo Joe Lara, star di «Tarzan-La grande avventura»', 'L’attore aveva 59 anni ed era stato anche protagonista di «Tarzan a Manhattan» ', 'Un piccolo aereo si è schiantato in Tennessee. Il bilancio è di sette morti. Fra le vittime c’è anche William Lara, 59 anni, conosciuto come Joe Lara, l’attore che ha interpretato Tarzan nel film Tarzan a Manhattan e la serie televisiva Tarzan: La grande avventura. Con lui è morta anche la moglie, Gwen Shamblin Lara, leader del gruppo cristiano per la perdita di peso Weight Down Ministries, fondato dalla donna nel 1968. La coppia, insieme ad altre cinque persone, era sn Cessna C501 è decollato dall’aeroporto Smyrna Rutherford County e diretto all’aeroporto internazionale di Palm Beach in Florida. Per cause ancora da chiarire il piccolo velivolo è precipitato nel lago Percy Priest vicino a Smyrna, nel Tennessee. Le squadre di soccorso della contea di Rutherford hanno lavorato per tutta la notte tra sabato e domenica ma non sono stati trovati sopravvissuti. «I nostri sforzi sono passati dall’iniziale speranza di salvataggio al recupero dei cadaveri», ha detto un portavoce che ha coordinato i soccorsi.\r\n</p><p tabindex=\"0\">\r\nNato a San Diego, in California, il 2 febbraio 1962, William Joseph Lara ha iniziato la carriera come modello prima di ottenere, come debuttante, il ruolo principale nel film della Cbs del 1989 Tarzan a Manhattan, che vedeva in azione il re della giungla a New York. Ha poi interpretato il personaggio creato da Edgar Rice Burroughs nella serie tv Tarzan - La grande avventura che tra gli elementi ricorrenti faceva comparire stregoni malvagi, esseri magici, viaggi in altri regni e civiltà nascoste. La serie insisteva molto anche sull’identità di Tarzan, su chi fosse veramente e sul mistero della scomparsa della tribù di Themba. Joe Lara è apparso anche in film d’azione come Bersaglio di mezzanotte (1992), Il guerriero di acciaio (1993), Final Equinox» (1995) e Il giorno del giudizio (2000) e in serie tv tra cui Baywatch e Conan. Ha abbandonato la recitazione dopo vent’anni nel 2002 per perseguire la carriera nella musica country.', 846802, '2021-05-31 12:58:22', 0, 0, '/apolato/assets/article_images/cfgyudcsivbuebouircewi98787878199.jpg', 'Joe Lara nei panni di Tarzan', 1),
(878552, 'Volo Ryanair Ibiza-Bergamo, la passeggera denunciata: «Io la vita me la godo»', 'L’episodio sul volo Ibiza-Bergamo per la mancata mascherina: la donna ha aggredito passeggeri e steward. Lei minaccia di citare in giudizio chi fa girare i video a bordo', 'È stata denunciata dalla polizia di frontiera la giovane che sul volo Ibiza-Bergamo di qualche giorno fa ha dato in escandescenze sputando, insultando e tirando calci contro diversi passeggeri. Poteva però anche rischiare l’arresto e la richiesta di risarcimento danni per decine di migliaia di euro se il comandante non avesse deciso di tirare dritto e non di dirottare altrove per farla scendere. A bordo del Boeing 737 ha anche riferito di avere «un fratello giudice» a una signora alla quale aveva appena tirato i capelli, salvo poi aggiungere «e tu sei una p...». (Altri due passeggeri sarebbero intenzionati a denunciarla per lesioni, una terza persona si è riservata di deciderlo, come scritto qui).\r\n</p><p tabindex=\"0\">\r\nPoche ore dopo quello che è stato forse il video più visto sui social e condiviso sulle app di messaggistica istantanea d’Italia, la giovane — che in aereo ha alternato insulti in italiano e in pugliese — ha fornito la sua versione su Instagram. «Le persone che hanno creato gruppi, hanno sponsorizzato o inviato ad altre persone il mio video sul volo al ritorno da Ibiza a Bergamo avranno conseguenze legali perché sta già indagando la Polizia postale, saranno citate in giudizio, avranno conseguenze belle toste perché comunque non è una cosa regolare», dice in una serie di storie. «Però la cosa che mi rammarica è il fatto che al rientro da Ibiza evidentemente quella persona o era troppo frustrata oppure troppo sfigata... evidentemente sarà una bruttissima persona, però alla fine io non mi nascondo dietro a un cellulare o a una tastiera, io la vita me la godo».\r\n</p><p tabindex=\"0\">\r\nNon si sono di certo goduti molto il volo di ritorno altri passeggeri attorno a lei. Nei vari spezzoni che girano si nota che se la prende con più di un viaggiatore. E il tutto sarebbe partito da una richiesta di rispettare la distanza e di indossare nel modo appropriato la mascherina. Nei filmati la mascherina c’è, ma naso e bocca non sono coperti. In un video di pochi secondi si vede la giovane arrabbiata con un’altra, quindi passa a insultare a sputare. Quando l’assistente di volo si avvicina chiedendo di darsi una calmata lei replica «Evitami.. Evitami... Go away (vai via, in inglese, ndr)». Poi riattacca contro la vicina: «Cioè vieni a dire a me la distanza? Ma come ca... sei salita sull’aereo trim... di me...». («trim...» è la parolaccia più usata dai baresi per dare dello stupido, ndr).</p><p tabindex=\"0\">\r\nNon contenta passa a commentare i capelli della malcapitata. «Sta mesciata di me...», riferendosi alla tintura. L’assistente di volo interviene con un «guarda che se non la smetti...» e lei per nulla intimorita: «Perché cosa mi fai eh?». E lui: «Ci sono problemi». Lei: «Quali problemi?». Lui: «Chiudi la bocca, basta per favore». E lei a raffica: «Quali problemi? Quali problemi? Quali problemi?». La giovane — pantaloncini cortissimi, costume da bagno scollato e una camicia annodata a coprirle le spalle — si alza e ribatte a muso duro allo steward che cerca di calmarla, ma lei ribatte che «siamo in Paese democratico e io parlo quanto ca... mi pare». «Ma non puoi offendere», contesta l’assistente di volo. E lei, rivolta all’altra passeggera: «Ha offeso lei ‘sta pu... e tro...».\r\n</p><p tabindex=\"0\">\r\nIl battibecco irrita anche gli altri viaggiatori. «Ma smettila daiiii, deficiente», si sente dire vicino a chi sta riprendendo la scena con il telefonino. «Ma sei veramente una zoc...». Poi la giovane tira il ciuffo di capelli di una signora davanti a lei da farla urlare di dolore. E via con un altro giro di insulti. È a questo punto che — minacciata di denuncia — la protagonista parla di un fratello «giudice» e «avvocato». La passeggera seduta di fianco ne approfitta per scappare dietro, poi l’equipaggio accompagna la giovane vicino alla cabina del comandante, mentre lei continua a inveire e a tirare qualche calcio.\r\n</p><p tabindex=\"0\">\r\n«L’equipaggio del volo del 26 maggio da Ibiza a Milano Bergamo ha richiesto l’assistenza della polizia all’arrivo dopo che un passeggero è diventato aggressivo a bordo», spiega Ryanair in una nota inviata al Corriere. «L’aereo è atterrato normalmente e la polizia ha prelevato l’individuo all’aeroporto di Milano Bergamo. Ora il caso è affidato alle autorità di polizia».', 846803, '2021-05-31 13:02:55', 0, 0, '/apolato/assets/article_images/47894848955989444444.jpg', 'La ragazza in piedi mentre urla', 1),
(878553, 'Bitcoin, mai così male da settembre 2011, opportunità di acquisto ', 'Ecco alcuni semplici consigli su come investire', 'Il Bitcoin sta per chiudere il mese di maggio come mai non era accaduto dal settembre 2011, in calo del 37% su base mensile e oltre il -40% rispetto ai massimi toccato il 14 aprile oltre $64 mila.</p><p tabindex=\"0\">\r\nSecondo Robert Kiyosaki, investitore e autore del libro \"Rich Dad, Poor Dad\", questa è \"una grande notizia\". \"Quando il prezzo raggiungerà $ 27.000, comprerò di nuovo, ma molto dipenderà dall\'ambiente macro globale \", ha affermato l\'uomo d\'affari.</p><p>\r\nAd aprile, Kiyosaki aveva previsto in un\'intervista che il prezzo del Bitcoin avrebbe superato il milione di dollari nei prossimi cinque anni. Tuttavia, oro e argento restano gli investimenti preferiti da Kiyosaki, che in passato li ha definiti \"denaro di Dio\".</p><p tabindex=\"0\">\r\nI prezzi delle criptovalute hanno continuato a mostrare volatilità durante il fine settimana, con il Btc che è sceso di circa il 5% sabato, rimbalzando di circa il 4% nelle 24 ore successive e scambiando in un intervallo compreso tra 33.000 e 37.000. Al momento, il token segna il +1,73% a $36.229.</p><p>Per quanto riguarda l\'ether (+3,08% a $2.488), i prezzi hanno visto un\'oscillazione simile, perdendo il 6% sabato e recuperando oltre il 5% il giorno successivo.</p><p tabindex=\"0\">\r\nUna moneta che non ha seguito il trend delle altre controparti è il Ripple, in rialzo del 16% nell\'ultima settimana e del +15% in questo lunedì. I rialzi hanno portato la divisa sopra $1 con market cap di $46,36 miliardi. La divisa digitale ha toccato i massimi storici di $3,29 ed una capitalizzazione di $83,44 miliardi il 4 gennaio 2018. ', 846805, '2021-05-31 13:20:13', 0, 0, '/apolato/assets/article_images/8486468484846.webp', 'Simbolo del bitcoin', 1),
(878554, 'Israele, patto Bennett Lapid: nasce l\'esecutivo anti-Netanyahu. Bibi fuori dal governo dopo 12 anni: \"è la truffa del secolo\"', 'Il leader del partito conservatore e nazionalista ha deciso di mettere la parola fine sul lungo dominio politico del Likud che ha caratterizzato l\'ultimo decennio della storia di Israele scegliendo di abbracciare il progetto di un governo formato da movimenti anche molto diversi tra loro, accomunati', 'Benjamin Netanyahu non sarà più alla guida del governo israeliano a più di 12 anni dal primo incarico da primo ministro. Un epilogo ormai inevitabile dopo che l’ago della bilancia delle ultime elezioni, il leader di Yamina, Naftali Bennett, ha annunciato che formerà “un governo di unità nazionale con Lapid per far uscire Israele dalla voragine”. Dura la reazione di Netanyahu che attacca il suo ex ministro della Difesa: “Bennett vi imbroglia, questa è la truffa del secolo“.\r\n</p><p tabindex=\"0\">\r\nIl leader del partito conservatore e nazionalista ha deciso di mettere la parola fine sul lungo dominio politico del Likud che ha caratterizzato l’ultimo decennio della storia di Israele scegliendo di abbracciare il progetto di un governo anti-Netanyahu formato da movimenti anche molto diversi tra loro, accomunati dalla volontà di rompere con la gestione del premier uscente. “Con Lapid ci sono diversità – ha infatti sottolineato Bennett – ma siano intenzionati a trovare l’unità. Lapid è molto maturato”.\r\n</p><p tabindex=\"0\">\r\nIl premier uscente però non ci sta e cerca di mettere in luce le incongruenze nel comportamento dell’ex alleato: “Aveva detto in campagna elettorale che non avrebbe appoggiato Lapid, di essere un uomo di destra, attaccato ai suoi valori. Naftali, i tuoi valori hanno il peso di una piuma“. Ha poi accusato Bennett di aver fatto “molte giravolte”: “L’unica cosa che gli interessa è fare il premier. È scandaloso che con 6 seggi si possa fare il premier. Gli israeliani che mi hanno scelto con 2 milioni e mezzo di voti volevano me come premier”.\r\n</p><p tabindex=\"0\">\r\nIl leader di Yamina aveva già ripetuto più volte di voler evitare che il Paese “scivolasse in una quinta elezione consecutiva in poco più di due anni”, una possibilità che aveva definito la peggiore possibile. Ma trovare un accordo non è stato così semplice: il primo confronto è avvenuto con lo stesso Netanyahu, vincitore delle ultime elezioni con il suo partito Likud. Dialogo che era però terminato con un nulla di fatto. Stessa sorte toccata al primo confronto con Lapid, al quale, nel bel mezzo delle violenze a Gerusalemme Est tra polizia israeliana e popolazione palestinese e lo scambio di attacchi tra Gaza e lo Stato ebraico, aveva contestato la volontà di inserire nella squadra di governo anche i partiti arabi. Quando tutto sembrava orientato verso il quinto voto in due anni, però, è arrivata la stretta di mano tra Bennett e Lapid: adesso i due hanno tempo fino a mercoledì per limare e rendere noti i particolari dell’accordo di governo, soprattutto sul ruolo che dovranno rivestire i Paesi arabi e su chi sarà il prossimo primo ministro. Carica che potrebbe ruotare, come nel precedente accordo Netanyahu-Gantz, con metà mandato affidato a Bennett e l’altra metà a Lapid.', 846805, '2021-05-31 15:29:06', 0, 0, '/apolato/assets/article_images/naftali-bennett.jpg', 'Il leader politico Bennett saluta la folla', 1),
(878555, 'Paul Rudd, grande assente alla reunion di <span lang=\"en\">«Friends»</span>, e gli altri gossip del weekend', 'Dalla giustificazione riguardo la mancata partecipazione dell\'attore allo speciale di un\'ora e mezza alle performance più intime di Leonardo DiCaprio. Dalle paure di William, preoccupato per il fratello, alle confessioni di Jay-Z. Tutto quello che, forse, vi siete persi nel fine settimana', 'Giovedì, quando la reunion di Friends è stata trasmessa, ad un anno e più dal debutto che avrebbe dovuto essere, non tutti fra i fan hanno gridato al miracolo. Qualcuno, stizzito, ha notato, invece, come Paul Rudd non fosse presente. L’attore, che nella serie televisiva ha interpretato il marito di Phoebe, la svampita bionda di Lisa Kudrow, non è stato coinvolto nelle riprese. E nemmeno lo ha fatto Cole Sprouse, volto del figlio avuto da David Schwimmer. La decisione, però, non sarebbe stata presa a tavolino, con l’intenzione di escludere gli attori.\r\n</p><p tabindex=\"0\">\r\n«Durante una pandemia, penso sia davvero difficile avere tutte le persone dove vorresti che fossero», ha spiegato il regista dello speciale, Ben Winston, «Non abbiamo avuto grande flessibilità. La reunion è stata registrata in una delle serate in cui tutti e sei i protagonisti potevano essere presenti. Trovare il momento giusto è stata un’impresa incredibilmente ardua. Chi non ha potuto esserci, alle 7 del 20 aprile, tristemente, non ha potuto fare parte dello show».', 846804, '2021-05-31 15:58:52', 0, 0, '/apolato/assets/article_images/4561684564684864684.jpg', 'Paul Rudd nella celebre sitcom Friends', 1),
(878556, 'Uomini e Donne gossip: Sophie Codegoni e Zaniolo nello stesso hotel', 'Continua il flirt tra l\'ex tronista di Maria De Filippi e il pupillo della Roma, che ha mollato di recente l\'influencer Chiara Nasti\r\n', 'Sophie Codegoni, ex tronista di Uomini e Donne, e Nicolò Zaniolo sempre più vicini. O almeno così sussurrano i gossip di questi giorni. Dopo alcune indiscrezioni che parlavano di un incontro a Roma Il Tempo spiffera ora di un appuntamento a Rapallo, nello stesso hotel.\r\n</p><p tabindex=\"0\">\r\nLa bionda modella e influencer si trova in Liguria insieme all’amica e collega Taylor Mega e pare che in un esclusivo hotel a cinque stelle abbia incontrato il calciatore della Roma, tornato recentemente single dopo la breve storia d’amore con Chiara Nasti.\r\n</p><p tabindex=\"0\">\r\nNell’alloggio dell’Excelsior Hotel, uno degli alberghi più costosi della riviera ligure, Sophie Codegoni sarebbe stata avvistata proprio in compagnia di Zaniolo, come fa sapere il quotidiano romano. A insospettire, poi, l’assoluto silenzio stampa da parte dei diretti interessati.\r\n</p><p tabindex=\"0\">\r\nNessuna conferma ma neppure nessuna smentita da parte di Sophie Codegoni e Nicolò Zaniolo. Della serie, qui gatta ci cova…\r\n</p><p tabindex=\"0\">\r\nL’ex tronista di Uomini e Donne – che ha lavorato come indossatrice per lo showroom di Chiara Ferragni – è single da poco, ovvero da quando ha lasciato il suo ex corteggiatore. Lo scorso marzo Sophie Codegoni ha chiuso la sua relazione con Matteo Ranieri, conosciuto proprio alla corte di Maria De Filippi.\r\n</p><p tabindex=\"0\">\r\nLa ventenne ha rivelato che nel programma di Canale 5 il ragazzo è riuscito più di tutti gli altri ad emozionarla e a farla stare bene. Nella vita di tutti i giorni, però, la sintonia è scemata fino a portare alla rottura definitiva. \r\n</p><p tabindex=\"0\">\r\nPerché si sono lasciati Sophie e Matteo di Uomini e Donne? A quanto pare è stata tutta colpa delle varie differenze tra i due. La Codegoni ha parlato di una forte diversità che ha portato l’ex tronista e l’ex corteggiatore ad allontanarsi. Nonostante il finale amaro, però, la modella rifarebbe la stessa scelta a Uomini e Donne.\r\n</p><p tabindex=\"0\">\r\nSophie Codegoni ha inoltre negato di essere stata tradita da Matteo Ranieri ma ha ammesso che, dopo avere ricevuto una serie di segnalazioni, si aspettava da lui delle rassicurazioni che però non sono arrivate. Da qui è scaturita rabbia e delusione che l’hanno allontanata ancora di più dal suo ormai ex fidanzato.', 846805, '2021-05-31 16:05:09', 0, 0, '/apolato/assets/article_images/sophie-codegoni-zaniolo-collage.jpeg', 'Sophie Codegoni e Nicolò Zaniolo', 1),
(878557, 'Samantha Cristoforetti, dall\'Amendola di Foggia alla guida della stazione spaziale: è la prima donna europea comandante', 'L’astronauta 44enne, nata a Milano ma originaria di Malè, prestò servizio presso il 32° storno dell’aeroporto militare di Amendola.', 'Prima italiana a volare nello spazio nel 2014, sette anni dopo Samantha Cristoforetti, è diventata la prima donna europea al comando della stazione spaziale. L’astronauta 44enne, nata a Milano ma originaria di Malè, prestò servizio presso il 32° storno dell’aeroporto militare di Amendola.\r\n</p><p tabindex=\"0\">\r\nNel dicembre 2014 l\'aviatrice, ingegnere e astronauta, aveva sorvolato Foggia, la Capitanata e il Gargano, fotografandoli e ricordando l\'esperienza presso la base militare di Capitanata”Ciao #Foggia e dintorni. Including @ItalianAirForce airbase Amendola where I trained for almost 1 year\". Aveva reso omaggio anche alla Montagna del Sole: \"Clear skies over Gargano in #Italy this morning. Cieli sereni sul Gargano stamattina! #HelloEarth\".', 846803, '2021-05-31 16:08:51', 0, 0, '/apolato/assets/article_images/samanthacristoforetti-3.jpg', 'Samantha Cristoforetti con addosso la sua tuta spaziale', 1),
(878558, 'Partita del cuore, Nazionale Cantanti: l\'ex direttore generale Gianluca Pecchini querela Aurora Leone', 'L\'attrice dei<span lang=\"en\"> The Jackal</span> aveva accusato il dirigente di averla esclusa, in quanto donna, dalla cena che aveva preceduto la gara', ' \"Alla luce dei molteplici e continui attacchi mediatici ho deciso di presentare querela nei confronti di Aurora Leone e di chi con lei mi ha leso nella reputazione\". Lo ha affermato Gianluca Pecchini, ex direttore generale dell\'Associazione Nazionale Italiana Cantanti. L\'attrice dei The Jackal aveva accusato Pecchini di averla esclusa, in quanto donna, dalla cena che aveva preceduto la Partita del cuore a Torino. \r\n</p><p tabindex=\"0\">\r\nPecchini, che in seguito all\'episodio si è dimesso, si è rivolto all\'avvocato Gabriele Bordoni per \"tutelare i miei diritti, la mia immagine e, soprattutto, la mia dignità di uomo e di professionista\".\r\n</p><p tabindex=\"0\">\r\nLo stesso avvocato Bordoni ha quindi precisato: \"L\'iniziativa assunta con querela per diffamazione aggravata presso la Procura di Torino è stata necessaria per ristabilire la verità dei fatti. L\'uso diretto e personale dei sistemi di comunicazione di massa consente ampia libertà di espressione a chiunque ed è un valore da salvaguardare che va tenuto però ben distinto dalla loro strumentalizzazione. La critica e le opinioni sono sacrosante, ma non lo è affatto la propalazione di notizie infondate, confuse e lesive, tali da innescare in poche ore la demolizione della reputazione di una persona, difficilmente recuperabile in seguito\".\r\n</p><p tabindex=\"0\">\r\n\"Si pensa in questi giorni - aggiunge - di introdurre una legge a contrasto della discriminazione per motivi fondati sul sesso o sul genere, ma si ripensa anche di riattivare forme di censura a contrasto della disinformazione, soprattutto attraverso la rete. Sono sintomi di un malessere culturale e sociale, potenzialmente inducenti pericolose derive che nella vicenda di Pecchini trovano occasione per essere considerate e discusse. Ma, intanto, va tutelata nella sede competente la dignità di un uomo, della sua famiglia e del suo lavoro, proteggendolo dal linciaggio morale e da superficiali, frettolose quanto feroci condanne mediatiche, disancorate dalla reale dimensione dei fatti. Tanto si impone in uno stato di diritto\".', 846802, '2021-05-31 16:13:55', 0, 0, '/apolato/assets/article_images/104203561-12bb216c-1c77-46bb-b8b7-7a967165f8b9.jpg', 'A sinistra Aurora Leone, a destra Gianluca Pecchini', 1),
(878559, 'Covid, Variante indiana in Gran Bretagna: Rt sopra 1. L\'esperto: \"Colpa della prima dose a tutti\"', 'L\'indice Rt è tornato sopra 1, non accadava da gennaio. Francia e Germania impongono la quarantena a chi arriva dal Regno Unito', 'La variante indiana spaventa la Gran Bretagna. Il Paese europeo che per primo sembrava essere uscito dall\'emergenza pandemica. La diffusione della variante indiana, molto più contagiosa, non fa dormire sonni tranquilli al premier britannico Boris Johnson. Anche se, nonostante la diffusione del virus, bisogna ancora capire quale siano le conseguenze cliniche effettive. Non è infatti chiaro se, nonostante la diffusione della variante, questo si traduca in un aumento considerevole dei ricoveri e delle forme gravi. Per la prima volta da gennaio l\'Rt in Inghilterra è tornato a superare 1. I contagi dovuti alla variante indiana sono raddoppiati nel giro di una settimana, sollevando dubbi sul possibile rinvio delle ultime fasi del piano di riaperture impostato dal governo di Boris Johnson. \r\n</p><p tabindex=\"0\">\r\nNonostante le rassicurazioni del governo che lega l\'aumento dei contagi alla compertura dei vaccini (come è noto nessun vaccino copre al 100% dal rischio del contagio). In ogno caso il numero di contagi legati alla variante indiana del coronavirus nel Regno Unito è aumentato di più del 160% nell’ultima settimana. Emerge dai dati dell’agenzia statale PHE -Public Health England, secondo cui nel Paese si contano 3.424 casi legati alla variante, contro i 1.313 di giovedì 13 maggio.\r\n</p><p tabindex=\"0\">\r\n\"In una settimana in Gran Bretagna la variante indiana è diventata predominate arrivando al 75% delle infezioni. Il problema è che va a trovare un substrato di persone che non sono straordinariamente protette ma solo blandamente perché si è scelto di fare, azzardando, una prima dose di vaccino a tutti. Così cominciano ad emergere contagi in chi è vaccinato. Questo ci dice di come all\'inizio la Gran Bretagna, che sembrava essere uscita da una situazione difficile con buoni risultati, dopo un mese rischia di trovarsi in una situazione compromessa. La scelte della politica devono essere supportate dalle evidenze scientifiche\". Lo ha affermato Walter Ricciardi, ordinario di Igiene generale e applicata all\'Università Cattolica e consigliere scientifico del ministro della Salute, protagonista di una lezione speciale del nuovo master in Comunicazione sanitaria dell\'Università Cattolica, dal titolo \'Comunicare la salute durante la pandemia. Verità, fake news ed etica dell\'informazione\'. \r\n</p><p tabindex=\"0\">\r\nNegli ultimi mesi \"ho deciso di parlare solo con il ministro Speranza per consigliare il Governo e scrivere su \'Avvenire\' - ha precisato Ricciardi - Non c\'è possibilità di uscire dalla pandemia senza l\'intervento dei governi e la collaborazione tra Stati. C\'è chi ha gestito bene l\'emergenza con lockdown tempestivi e il blocco della mobilità che impedisce al virus di muoversi perché è trasportato dalle persone. Un esempio virtuoso è stata la Nuova Zelanda, che ha ben fatto anche nella comunicazione alla popolazione. Il primo ministro era spesso in televisione a spiegare quello che stava accadendo\". L\'incontro è promosso dall\'Alta Scuola di Economia e Management dei Sistemi sanitari (Altems) e dall\'Alta Scuola in Media, Comunicazione e Spettacolo (Almed).  \"C\'è chi dice - sostiene - che abbia perso la faccia perché oggi le cose vanno meglio, ma come si fa a dirlo? Sono morte 70mila persone nella seconda ondata, se avessimo fatto un lockdown ad ottobre e poi a febbraio avremmo evitato questi decessi. Ci sono stati 130 mila morti, 60mila nella prima ondata e 70mila nella seconda. Non scherziamo! Sono famiglie distrutte, anziani che ci hanno lasciato, la memoria del Paese. E ci sono media che scotomizzano tutto questo\".\r\n</p><p tabindex=\"0\">\r\nI viaggiatori in arrivo in Francia dalla Gran Bretagna dovranno isolarsi in quarantena per impedire la diffusione della variante indiana del Covid nel Paese transalpino. Lo ha annunciato il portavoce del governo francese, Gabriel Attal, sottolineando che Parigi adottera\' \"misure simili\" a quelle tedesche. Da domenica, i viaggiatori britannici in arrivo in Germania devono fare una quarantena di due settimane a prescindere dal risultato negativo del tampone. In Francia la misura e\' gia\' in vigore questa misura per coloro che provengono da alcuni Paesi, tra i quali Brasile, India e Sudafrica.\r\n</p><p tabindex=\"0\">\r\nLa Germania richiederà la quarantena a chi arriva dalla Gran Bretagna dove c\'è una forte diffusione della variante indiana. La decisione dopo che l\'istituto Robert Koch ha cambiato la classificazione del Regno Unito e l\'ha identificata come un\' \"area di mutazione delle varianti\" del Covid-19. A partire da domenica, chiunque arriva dal Regno Unito dovrà sottoporsi a un periodo di quarantena di due settimane, anche se riuscira\' a mostrare un test negativo. ', 846802, '2021-05-31 16:27:23', 0, 0, '/apolato/assets/article_images/5651965484444.webp', 'Boris Johnson saluta mentre indossa una mascherina', 1),
(878560, 'Cartelle esattoriali, stop fino al 30 giugno: le novità su pagamenti e scadenze', 'Il decreto Sostegni bis ha rinviato nuovamente le scadenze di cartelle e pagamenti bloccati dall\'8 marzo 2020. C\'è tempo fino al 2 agosto per pagare', 'I pagamenti delle cartelle in scadenza dall’8 marzo 2020 sono sospesi fino al 30 giugno 2021. Il versamento delle somme dovute dovrà essere effettuato entro il mese successivo, quindi il 31 luglio, ma coincidendo con il sabato, la scadenza ultima è il 2 agosto. Non è necessario il pagamento in un’unica soluzione. Può essere richiesta anche una rateizzazione, presentando la domanda entro il 31 luglio 2021. L’Agenzia delle Entrate Riscossione (Ader) ricorda anche che chi non aveva una dilazione in corso alla data dell’8 marzo 2020 può chiedere entro la fine di quest’anno di rateizzare il suo debito senza dover pagare prima gli importi rimasti in sospeso, come invece veniva imposto in precedenza.</p><p tabindex=\"0\">\r\nGli obblighi di accantonamento derivanti dai pignoramenti effettuati prima del 19 maggio 2020 – data di entrata in vigore del decreto Rilancio – su salari, pensioni e altre indennità legate al lavoro restano sospesi fino al 30 giugno 2021. Fino alla fine di giugno, dunque, non ci sarà alcun recupero coattivo. Escluse per quel periodo anche le misure cautelari come fermi amministrativi ed ipoteche. Dal 1 luglio verranno ristabiliti gli obblighi. Sospese fino al 30 giugno anche le verifiche di inadempienza delle Pubbliche amministrazioni e delle società che sono prevalentemente partecipate dallo Stato.\r\n</p><p tabindex=\"0\">\r\nNovità anche sulle condizioni che determinano la decadenza del beneficio, cioè della dilazione: per le domande inoltrate durante tutto il 2021, la decadenza subentra dopo dieci rate non pagate anziché dopo cinque. Ma torneranno a dimezzarsi per chi presenterà richiesta di rateizzazione da gennaio 2022. Aumenta, inoltre, la soglia entro la quale non c’è l’obbligo di dimostrare lo stato di difficoltà: da 60mila euro passa a 100mila euro.</p><p tabindex=\"0\">\r\nL’Agenzia parla anche della sanatoria dei debiti fino a 5mila euro contenuti nelle cartelle emesse tra il 2000 ed il 2010. Viene confermato che l’efficacia della cancellazione del carico a ruolo resta posticipata all’emanazione di un apposito decreto del ministero dell’Economia e delle Finanze. Questo dovrebbe avvenire il 21 giugno 2021, quindi fino a quella data i carichi restano tali. Nel frattempo, il Fisco controllerà i dati dei contribuenti morosi che, per avere diritto alla cancellazione del debito, devono aver dichiarato nel 2019 un reddito imponibile inferiore a 30mila euro. In sintesi: almeno fino al 21 giugno, resta sospesa ogni azione di recupero dei debiti in questione, indipendentemente dal reddito del contribuente.', 846803, '2021-05-31 16:43:42', 0, 0, '/apolato/assets/article_images/agenzia-entrate-169179.660x368.jpg', 'Foto del logo di Agenzia delle Entrate', 1),
(878561, 'ececw', 'cwecewc', 'ecwecwce', 846802, '2021-06-01 14:30:18', 0, 0, '', '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `nome` varchar(20) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`nome`, `descrizione`, `img`) VALUES
('Covid', 'Tutto l\'essenziale per tenersi aggiornati sulla pandemia', '/apolato/img/covid_cat.jpeg'),
('Economia', 'Borsa, Criptovalute e molto altro', '/apolato/img/economy_cat.jpeg'),
('Gossip', 'Tutti i pettegolezzi sulle star e i personaggi di rilievo', '/apolato/img/gossip_cat.jpeg'),
('Mondo', 'Le principali notizie provenienti da tutto il mondo', '/apolato/img/world_cat.jpeg'),
('Politica', 'Le ultime notizie su elezioni, leggi e politica', '/apolato/img/politics_cat.jpeg'),
('Scienze', 'Stai al passo con i tempi grazie alla sezione dedicata a scienze e tecnologia', '/apolato/img/science_cat.jpeg'),
('Spettacolo', 'Nuovi film, musica, libri e teatro, c\'è tutto ciò che cerchi', '/apolato/img/spett_cat.jpeg'),
('Sport', 'Calcio, Basket, Tennis e tutto il meglio dello sport internazionale', '/apolato/img/sport_cat.jpeg');

-- --------------------------------------------------------

--
-- Struttura della tabella `cat_art`
--

CREATE TABLE `cat_art` (
  `ID_art` int(6) NOT NULL,
  `nome_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cat_art`
--

INSERT INTO `cat_art` (`ID_art`, `nome_cat`) VALUES
(878549, 'Covid'),
(878559, 'Covid'),
(878553, 'Economia'),
(878560, 'Economia'),
(878555, 'Gossip'),
(878556, 'Gossip'),
(878552, 'Mondo'),
(878554, 'Mondo'),
(878559, 'Mondo'),
(878561, 'Mondo'),
(878554, 'Politica'),
(878558, 'Politica'),
(878550, 'Scienze'),
(878557, 'Scienze'),
(878551, 'Spettacolo'),
(878555, 'Spettacolo'),
(878546, 'Sport'),
(878548, 'Sport');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `ID_art` int(6) NOT NULL,
  `ID_com` int(6) NOT NULL,
  `autore` int(6) NOT NULL,
  `testo` varchar(10000) NOT NULL,
  `data_pub` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(846802, 'Andrea', 'Polato', 'andrea@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/apolato/img/male_icon.png'),
(846803, 'Giosuè', 'Calgaro', 'giosue@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/apolato/img/male_icon.png'),
(846804, 'Tommaso', 'Allegretti', 'tommaso@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/apolato/img/male_icon.png'),
(846805, 'Matteo', 'Miotello', 'matteo@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/apolato/img/male_icon.png'),
(846806, 'Utente', 'Standard', 'user@user.it', 'ee11cbb19052e40b07aac0ca060c23ee', 'usr', '/apolato/img/female_icon.png'),
(846808, 'admin', 'admin', 'admin@admin.it', '21232f297a57a5a743894a0e4a801fc3', 'adm', '/apolato/img/genderfluid_icon.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `voto`
--

CREATE TABLE `voto` (
  `utente` int(6) NOT NULL,
  `articolo` int(6) NOT NULL,
  `up` tinyint(1) DEFAULT 0,
  `down` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `autore` (`autore`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `cat_art`
--
ALTER TABLE `cat_art`
  ADD PRIMARY KEY (`nome_cat`,`ID_art`),
  ADD KEY `ID_art` (`ID_art`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`ID_com`),
  ADD KEY `autore` (`autore`),
  ADD KEY `ID_art` (`ID_art`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`utente`,`articolo`),
  ADD KEY `articolo` (`articolo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=878572;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `ID_com` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530774;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=846809;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`autore`) REFERENCES `utente` (`ID`) ON DELETE CASCADE;

--
-- Limiti per la tabella `cat_art`
--
ALTER TABLE `cat_art`
  ADD CONSTRAINT `cat_art_ibfk_2` FOREIGN KEY (`ID_art`) REFERENCES `articolo` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cat_art_ibfk_3` FOREIGN KEY (`nome_cat`) REFERENCES `categoria` (`nome`) ON DELETE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_5` FOREIGN KEY (`ID_art`) REFERENCES `articolo` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `commento_ibfk_6` FOREIGN KEY (`autore`) REFERENCES `utente` (`ID`) ON DELETE CASCADE;

--
-- Limiti per la tabella `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `voto_ibfk_4` FOREIGN KEY (`articolo`) REFERENCES `articolo` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `voto_ibfk_5` FOREIGN KEY (`utente`) REFERENCES `utente` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
