CREATE TABLE utente
(
    ID       int(6),
    nome     varchar(30) NOT NULL,
    cognome  varchar(30) NOT NULL,
    email    varchar(50) NOT NULL,
    password char(128)   NOT NULL,
    permesso char(3)     NOT NULL, /*adm, usr*/
    img_path varchar(255),
    PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE articolo
(
    ID        int(6),
    titolo    varchar(126)   NOT NULL,
    descrizione varchar(300) NOT NULL,
    testo     varchar(10000) NOT NULL,
    autore    int(6) NOT NULL,
    data_pub  datetime,
    upvotes   int(7) NOT NULL,
    downvotes int(7) NOT NULL,
    img_path  varchar(255),
    alt_img   varchar(255),
    PRIMARY KEY (ID),
    FOREIGN KEY (autore) REFERENCES utente (ID)
) ENGINE=InnoDB;

CREATE TABLE categoria
(
    nome        varchar(20),
    descrizione varchar(255),
    img varchar(255),
    PRIMARY KEY (nome)
) ENGINE=InnoDB;

CREATE TABLE cat_art
(
    ID_art   int(6),
    nome_cat varchar(20),
    PRIMARY KEY (nome_cat, ID_art),
    FOREIGN KEY (nome_cat) REFERENCES categoria (nome),
    FOREIGN KEY (ID_art) REFERENCES articolo (ID)
) ENGINE=InnoDB;

CREATE TABLE commento
(
    ID_art    int(6) NOT NULL,
    ID_com    int (6) NOT NULL,
    autore    int(6) NOT NULL,
    testo     varchar(10000) NOT NULL,
    data_pub  datetime       NOT NULL,
    upvotes   int(7),
    downvotes int(7),
    PRIMARY KEY (ID_art, ID_com),
    FOREIGN KEY (ID_art) REFERENCES articolo (ID),
    FOREIGN KEY (autore) REFERENCES utente (ID)
) ENGINE=InnoDB;



INSERT INTO utente (ID, nome, cognome, email, password, permesso, img_path)
VALUES ('716989', 'Andrea', 'Polato', 'andrea@admin.com', '/*hash(admin)*/', 'adm', '/*path*/'),
       ('846787', 'Tommaso', 'Allegretti', 'tommaso@admin.com', '/*hash(admin)*/', 'adm', '/*path*/'),
       ('456468', 'Matteo', 'Miotello', 'matteo@admin.com', '/*hash(admin)*/', 'adm', '/*path*/'),
       ('125333', 'Giosuè', 'Calgaro', 'giosue@admin.com', '/*hash(admin)*/', 'adm', '/*path*/'),
       ('218796', 'Utente', 'Standard', 'utente@user.com', '/*hash(user)*/', 'adm', '/*path*/');



INSERT INTO articolo (ID, titolo, testo, autore, data_pub, upvotes, downvotes, img_path)
VALUES ('123548',
        'Scontro sul Recovery plan, il cdm slitta di quattro ore e comincia alle 13. Bellanova: "Iv non vota un testo al buio"',
        'La giornata, per il governo, parte in salita. Il consiglio dei ministri sulla governance del Recovery plan, inizialmente previsto alle 9, slitta di ben quattro ore e comincia alle 13. Un ritardo dovuto alle resistenze di Italia viva sulla cabina di regia che dovrà gestire gli stanziamenti del Recovery fund. "209 miliardi non sono un fatto privato - afferma la ministra dell''Agricoltura Teresa Bellanova, capodelegazione di Iv al governo - Ho ricevuto alle 2 di stanotte un testo, senza avere il tempo di un approfondimento puntuale. Una pratica inaccettabile e discutibilissima, soprattutto se è in gioco il futuro del Paese. Equivale a chiedere di votare al buio. Italia Viva non lo ritiene possibile". E poi aggiunge su Facebook: "Non abbiamo alcun bisogno di strutture parallele, che esautorano Ministri, Ministeri e Parlamento, accentrando e spostando altrove il cuore del processo, decisivo per l''Italia dei prossimi 10 anni". Sulla stessa linea la ministra della famiglia Elena Bonetti di Iv: "Inaccettabile task force come struttura parallela. Ci sono italiani che hanno perso il lavoro e noi ci preoccupiamo di questo e non di moltiplicare poltrone e consulenze. C''è una sanità che ha bisogno di investimenti, lo sanno le persone che stanno soffrendo negli ospedali e quindi il Mes deve essere usato".A testimoniare il clima di tensione, le parole del ministro per il Sud, Giuseppe Provenzano: "Chi si assume questa responsabilità ne trarrà le conseguenze". E poi: "Già abbiamo Orban che ci sta creando problemi, se anche qualcuno nella maggioranza per motivi di visibilità mette a rischio questa enorme opportunità del recovery fund non va bene".<br>+CHAR(13)A quanto si apprende, oggi dovrebbe arrivare il via libera alla bozza dello schema di aggiornamento del piano, ovvero la strutturazione in missioni, componenti e progetti mentre per la partita della struttura di governance, su cui come detto si registra il dissenso dei renziani, si ipotizza un nuovo consiglio dei ministri mercoledì sera.',
        '716989', '2020-12-07 12:30:57', ' 0', ' 0', ' null'),
       ('878541', 'Gualtieri esclude un nuovo blocco dei licenziamenti dopo marzo. Plauso di Bonomi',
        'Il governo non ha in programma una proroga del divieto di licenziamento dopo le nuove settimane di cassa integrazione straordinaria, che avranno termine alla fine di marzo. Lo afferma il ministro dell''Economia Roberto Gualtieri, nel corso di un intervento a Sky TG24. "Stiamo lavorando per evitare una terza ondata per evitare che le festività diventino momento di propagazione del  contagio, siamo fiduciosi sui passi avanti sul fronte dei vaccini. - precisa il ministro - Tutto questo ci porta auspicabilmente ad escludere di dover prolungare ulteriormente le misure straordinarie".<br>+CHAR(13)Gualtieri fa notare che il governo ha dovuto praticare la flessbilità e la capacità di adeguarsi a eventi, ad imparare a fare le cose in pochissimo tempo, ad affrontare una situazione inedita. E conclude: "I segnali sul fronte economico sono tali da far pensare che a marzo la ripresa sarà già avviata".<br>+CHAR(13)Gli intenti del governo vanno nella direzione voluta da Confindustria: nel corso della stessa trasmissione di Sky Tg24, ''Live in Courmayeur'', il presidente Carlo Bonomi ha espresso l''auspicio che a partire da marzo il governo non rinnovi il blocco dei licenziamenti, perchè "questo sarebbe un vero segnale di ripresa per la nostra economia".<br>+CHAR(13)Non rinnovare il blocco, spiega Bonomi, "vuol dire che abbiamo superato la fase più acuta della crisi e possiamo far ripartire il Paese". E del resto il blocco non ha messo in salvo tutti i lavoratori, precisa il leader di Confindustria:  "Già oggi abbiamo perso mezzo milione di posti di lavoro da inizio pandemia, le stime al 31 marzo ci parlano di un milione di posti di lavoro. Speriamo di essere smentiti".',
        '846787', '2020-12-04 17:17:05', ' 0', ' 0', ' null'),
       ('144688', 'Basket, un nuovo record all''asta per Jordan: 320mila dollari per una maglia del 1984',
        'Il prezzo più alto di sempre per una divisa di Michael Jordan. Una sua maglia dei Chicago Bulls indossata nel 1984, infatti, è stata venduta a un''asta tenutasi a Beverly Hills alla cifra record di 320mila dollari e, secondo Julien''s Auctions che ha organizzato l''asta, la vendita ha stabilito un nuovo primato mondiale per una maglia dell''ex stella del basket Nba.<br>+CHAR(13)Non è, però, la prima volta che qualcosa appartenente ad Air Jordan raggiunga cifre esorbitanti. L''ultima pochi mesi fa quando, dopo la messa in onda del documentario ''The Last Dance'', un''altra maglia, una jersey nera usata contro i Detroit Pistons nell''aprile del 1997 in una serata non particolarmente fortunata per Michael con soli 18 punti, era stata battuta a 288mila dollari. Prima ancora il primato era detenuto da un''altra maglia, quella del Dream Team di Barcellona 1992, venduta alla “modica” cifra di 216mila dollari.<br>+CHAR(13)Ma se la maglia del 1984 di MJ ha portato sopra la soglia dei 300mila dollari il primato per una divisa, cosa dire delle Air Jordan usate (e firmate!) nel 1985? 560mila dollari, la cifra più alta mai pagata per un paio di scarpe, oscurando un altro record per un altro paio di scarpe, quelle indossate dallo stesso Jordan alle Olimpiadi del 1984 a Los Angeles vendute per “appena” 190.373 dollari. Una cifra quasi irrisoria in confronto a quella da oltre mezzo milioni di dollari che all''epoca sembrava comunque enorme, anche in confronto al precedente primato: 104.765 dollari per le scarpe indossate dall''ex Chicago nel famoso ''flu game'' del 1997 nello Utah. Cifre assurde che comunque fanno capire l''importanza che Michael Jordan ha avuto per milioni di amanti della pallacanestro sparsi in tutto il mondo e che ancora continua ad avere.',
        '456468', '2020-12-06 05:02:44', ' 0', ' 0', ' null'),
       ('156612', 'Coppola riscrive Il Padrino 3 dall''inizio alla fine',
        'Francis Ford Coppola riscrive dall''inizio al finale uno dei suoi film più discussi. Trent''anni dopo esser stato scorticato dalla critica all''uscita del "Padrino-Parte Terza", il regista americano si prepara a distribuire in un numero limitato di sale e in home video il "director''s cut" del terzo e ultimo episodio della celebre trilogia.<br>+CHAR(13)Per il ritorno alla ribalta a partire da questo fine settimana, Coppola ha modificato anche il titolo. "Mario Puzo''s The Godfather Coda: The Death of Michael Corleone" rende omaggio allo scrittore e co-sceneggiatore ripristinando quello scelto da entrambi e che fu invece cambiato dalla Paramount per richiamare il successo delle prime due pellicole. L''81enne regista ha fatto ritocchi ovunque per chiarire la trama imperniata sui temi della mortalità e della redenzione. In Italia sarà disponibile dal 10 dicembre con Universal Pictures Home Entertainment in DVD e Bluray.<br>+CHAR(13)"Coda" comincia adesso andando "in medias res" con la scena in cui Michael Corleone (Al Pacino) negozia un prestito multimilionario con la Banca Vaticana, mentre alla fine, anziché far morire l''anziano Padrino, il nuovo montaggio lo mostra vecchio ma vivo: "Quando i siciliani ti augurano ''Cent''anni''...significa ''lunga vita''...E un siciliano non dimentica mai", si legge sullo schermo prima dei titoli di coda. Il nuovo finale lascia Michael Corleone in un ''purgatorio'' di sua totale creazione: "Lasciare Michael in vita è la vera tragedia", ha commentato Al Pacino dando, assieme a Diane Keaton (la moglie di Michael, Kay Adams), il suo imprimatur al "director''s cut".<br>+CHAR(13)I primi due "Padrini", usciti nel 1972 e 1974, hanno collezionato nove Oscar e quasi un miliardo di dollari di incassi. "Parte Terza, con sette nomination ma nessuna statuetta e un box office di 136 milioni, è sempre stato considerato la cenerentola della trilogia. Coppola era stato tirato per i capelli nell''impresa dopo i flop di "Cotton Club" e il musical "Un Sogno Lungo Un Giorno". "Avevo bisogno di soldi per uscire da una crisi in cui avevo perso quasi tutto", ha spiegato il regista al New York Times. La Paramount premeva per uscire nelle sale per Natale 1990. Coppola rispettò gli impegni, ma al debutto del film la critica fu spietata: "Non solo una delusione, ma un fallimento di proporzioni tali che spezza il cuore", scrisse il Washington Post.<br>+CHAR(13)Non solo Coppola fu preso di mira. Le recensioni dell''epoca attaccarono soprattutto la recitazione amatoriale della figlia Sofia, scelta in corsa per il ruolo di Mary, la figlia di Michael, al posto di Wynona Ryder che all''ultimo momento aveva dato forfait. "Colpirono Sofia con il proiettile che era destinato a me", ha commentato con il New York Times il regista, evocando una delle ultime scene del film in cui Mary viene uccisa da un sicario mandato dalla mafia sui gradini del Teatro Massimo di Palermo.',
        '125333', '2020-11-27 21:53:01', ' 0', ' 0', ' null');



INSERT INTO categoria (nome, descrizione)
VALUES ('Sport', 'Calcio, Basket, Tennis e tutto il meglio dello sport internazionale'),
       ('Politica', 'Le ultime notizie su elezioni, leggi e politica'),
       ('Gossip', 'Tutti i pettegolezzi sulle star e i personaggi di rilievo'),
       ('Scienze', 'Stai al passo con i tempi grazie alla sezione dedicata a scienze e tecnologia'),
       ('Economia', '/*description*/'),
       ('Spettacolo', 'Nuovi film, musica, libri e teatro, c''è tutto ciò che cerchi'),
       ('Mondo', 'Le principali notizie sui paesi esteri'),
       ('Covid', 'Tutto l''essenziale per tenersi aggiornati sulla pandemia');



INSERT INTO cat_art (ID_art, nome_cat)
VALUES ('123548', 'Covid'),
       ('123548', 'Politica'),
       ('123548', 'Economia'),
       ('878541', 'Covid'),
       ('878541', 'Economia'),
       ('144688', 'Sport'),
       ('156612', 'Spettacolo');



INSERT INTO commento (ID_art, autore, testo, data_pub, upvotes, downvotes)
VALUES ('144688', '218796', 'Wow! Anch''io ne vorrei una', '2020-12-07 15:47:00', '0', '0');
