Relazione Progetto di Tecnologie Web
-
Anno Accademico 2020/2021



















Composizione Gruppo
Allegretti Tommaso: 1201247 – tommaso.allegretti@unipd.it
Calgaro Giosuè: 
Miotello Matteo: 
Polato Andrea (Referente): 1201205 – andrea.polato.7@studenti.unipd.it




1 Introduzione
Il progetto scelto riguarda la realizzazione del sito web di una testata giornalistica immaginaria, la quale mira ad espandere il proprio bacino d’utenza tramite il coinvolgimento di utenti giovani o dotati di medie capacità informatiche così da essere in grado di destreggiarsi all’interno del sito internet.
Il sito non ha l’unico scopo di raggiungere più utenti possibile ma ha anche l’obiettivo di fornire una valida alternativa alla carta stampata e di far sentire l’utente parte di una community in cui possa esprimersi liberamente e contribuire alla creazione dei contenuti.

L’accesso al sito avviene tramite il seguente link: 
https://tecweb.studenti.math.unipd.it/gicalgar/
Per accedere alle funzionalità di utente generico bisogna effettuare l’accesso con
Indirizzo e-mail utente: user@user.com
Password utente: user
Per accedere alle funzionalità di amministratore/redattore:
Indirizzo e-mail amministratore: andrea@admin.com [o qualsiasi nome dei membri del gruppo]
Password amministratore: admin















2 Progettazione
2.1 Analisi utenza
Destinatari
L'utenza principale sarà composta da persone con un livello medio di conoscenza informatica, capaci di navigare agilmente in internet. L’utente medio è una persona che ricerca informazioni con la consapevolezza di poterle trovare in maniera più diretta in internet rispetto alla ricerca su carta stampata. Il sito è stato quindi sviluppato tenendo sempre a mente che la facilità di navigazione e di ricerca di un articolo devono essere sempre al primo posto, al fine di evitare frustrazione nell’utilizzatore. 
Funzionalità
Sono state individuate tre tipologie di utente: 
- utente generico, che non è registrato al sito o non ha effettuato il login;
- utente registrato, che ha effettuato il login;
- utente amministratore, che possiede privilei rispetto agli altri utenti.

Utente generico: ha la possibilità di navigare il sito, leggere gli articoli, i commenti e i like/dislike ad esso associato; può effettuare ricerche per nome e per categoria.
Utente registrato e che ha effettuato il login: considerando la natura tecnologica dell’utente e il nostro desiderio di coinvolgerlo nelle dinamiche della community, abbiamo deciso di dare la possibilità a tutti gli utenti registrati di votare in modo positivo o negativo un articolo e di commentarlo. Ma non è tutto, i lettori potranno infatti contribuire in prima persona alla creazione degli articoli grazie alla sezione “Scrivi il tuo articolo” composta da una form che prevede l’inserimento testuale di titolo, descrizione, testo dell'articolo e potrà anche scegliere un insieme di categorie più adatte al proprio elaborato, in questo modo il suo contenuto sarà presente in più sezioni e aumenterà la possibilità di essere letto. L'articolo, una volta inviato con successo, verrà sottoposto a revisione da parte dei redattori e, nel caso rispettasse gli standard e le regole della community, potrà sarà accettato e sucessivamente pubblicato. 
Ovviamente per permettere tutto questo c’è la necessità che l’utente si registri, al fine di tracciare l’autore. Questo utente ha la possibilità di accedere ad una pagina personale in cui visualizzare: 
- la propria immagine utente, scelta tra un set predefinito in fase di registrazione
- i propri dati personali come nome, cognome ed email con cui la registrazione è avvenuta
- statistiche utente:
	- numero di like messi
	- numero di like ricevuti ( nel caso in cui l'utente abbia scritto uno o più articoli)
	- numero di articoli scritti
- sezione in cui poter cambiare la password.
- utente amministratore: dovrà essere una persona con conoscenze informatiche di buon livello per gestire con destrezza i vari aspetti del sito, in particolare dovrà essere in grado di utilizzare phpmyadmin per la gestione di alcuni aspetti tecnici non implementati nel sito. L'utente amministratore, oltre a possedere tutte le funzionalità degli altri utenti, avrà a disposizione due link extra nella propria sezione utente, uno con il quale svolgere le normali attività da redattore, quindi scrivere un articolo che, essendo stato scritto da un amministratore, non avrà bisogno di accettazione, e sarà subito disponibile per la lettura. Il form utilizzato ( a differenza del form disponibile per utenti non amministratori ) conterrà all'interno della form una sezione in cui poter inserire un'immagine per l'articolo, e una sezione per l'inserimento dell'attributo alt di quest'ultima. La differenza stà perciò in questa opzione extra di poter inserire un’immagine con corrispettivo campo “alt” per assicurarsi che questa sia accessibile.
Il secondo link presente nella pagina amministratore porterà ad una pagina di gestione degli articoli in cui potrà:
- modificare il contenuto di tutti gli articoli
- eliminare eventuali articoli dal database
- accettare gli articoli spediti dagli utenti registrati. Gli articoli non ancora accettati da un amministratore presenteranno un bottone "Accetta", che, se cliccato, renderà pubblico l'articolo.





2.3 Layout generale del sito
Header
L’header contiene al suo interno il logo della testata, un menù di navigazione (nav), un campo per la ricerca testuale degli articoli. Alla destra troviamo anche una sezione in cui un utente che non ha effettuato l'accesso trova un pulsante con dicitura "Accedi/Registrati", mentre un utente che ha già effettuato il login potrà osservare la propria immagine utente e due pulsanti rispettivamente "Il mio profilo", che se cliccato porta alla pagina profilo dell'utente loggato, e "Esci", con cui l'utente può effettuare il logout da sito. 
Nav
- Home page
- Categorie
- Scrivi il tuo articolo
Alle precedenti opzioni si aggiunge la sezione dell’utente, il cui contenuto dipende dallo stato di login dell’utente.
Se si tratta di un visitatore che non ha effettuato l’accesso apparirà un link:
- Accedi / Registrati
Altrimenti apparirà:
- Il mio profilo
- Esci
- Immagine del profilo
La barra di ricerca è posizionata sul lato destro, ma rimane comunque molto visibile.
Breadcrumps
Il breadcrumb è posizionato sotto l'header e serve a identificare la posizione dell'utente all'interno del sito. L'ultimo campo corrisponde alla pagina corrente e, per evitare link circolari, è un testo.
Body
Per dare un senso di ordine, il body è stato sviluppato in modo da ancorare il footer alla base dello schermo nel caso in cui i contenuti della pagina occupino poco spazio.
 
         Footer ancorato alla base

Footer
Il footer contiene i due badge che certificano l’adesione agli standard HTML5 e CSS3 e l’indirizzo mail degli amministratori.
2.4 Contenuti del sito e sezioni principali
2.4.1 Sezione “Home”
Nella sezione home si trovano due sezioni. La prima contiene gli ultimi articoli pubblicati in ordine decrescente, la seconda è una sezione secondaria e contiene anch’essa gli ultimi articoli pubblicati che però riguardano il Covid.
2.4.2 Sezione “Categorie”
Nella sezione categorie troviamo dei link con al loro interno un tag “<figure>”. In questo modo si veicola l’informazione in duplice modalità: sia con le immagini che con il testo. Il testo è stato curato tramite css per rispecchiare in tutto e per tutto un normale link, al fine di agevolare la comprensione della pagina all’utente.
2.4.3 Sezione “Scrivi il tuo articolo”
In questa sezione gli utenti sono in grado di proporre il proprio articolo alla supervisione dei redattori. Lo sviluppo di questa feature è mirato ad aumentare il senso di coinvolgimento dell’utente finale.
2.4.5 Sezione “Accedi/Registrati”
In questa sezione quello che effettivamente viene visualizzato è un contenitore che consente all’utente di effettuare l’accesso al proprio account. Nel caso in cui egli ne fosse sprovvisto, troverà sotto ai campi di login un pulsante con la dicitura “registrati”.
2.4.6 Sezione “Registrati”
Sezione che prevede la scelta da parte dell’utente delle credenziali d’accesso e della propria immagine del profilo.
2.4.7 Pagina “article_filter”
Una pagina generica che serve a mostrare i risultati delle selezioni dell’utente. Viene usata sia nel caso di ricerca testuale, che in quello di selezione di categoria e per visualizzare gli articoli da gestire.
2.4.8 Pagina “generic_page_article”
Un’altra pagina generica riservata però alla visualizzazione del contenuto degli articoli e delle informazioni aggiuntive correlate, come votazioni, commenti e informazioni sull’autore.




2.5 Suddivisione dei compiti e strategia di sviluppo
In seguito al primo meeting tra i membri del gruppo si è dubito evidenziata la necessità di “templateizzare” il sito. Questa decisione è giustificata dal fatto che la maggior parte delle pagine sono in costante aggiornamento e dipendono dai risultati di una query SQL effettuata su una database in continua evoluzione.
Nella prima fase di sviluppo abbiamo quindi deciso di adottare una strategia di divisione dei compiti nella seguente modalità: due persone si sarebbero occupate di una prima versione completamente statica del sito e le altre due si sono preoccupate di mettere le basi per la gestione del sito lato server.
Nella seconda fase invece il lavoro di entrambi i gruppi avrebbe dovuto fondersi dando vita al sito vero e proprio per poi, infine, procedere con tutti i test del caso.

3 Sviluppo
3.1 Tecnologie utilizzate
HTML5 e CSS3
Abbiamo deciso di utilizzare HTML5 per via della sua semplicità di utilizzo e la presenza di tag semantici in grado di veicolare facilmente informazioni che garantiscono una maggiore accessibilità e usabilità. Il bacino di utenza ci aspettiamo non avrà problemi a navigare sul nostro sito.
In prima battuta è stato utilizzato per costruire tutto il sito e poi sono stati creati dei componenti html/phtml utilizzati dal gestore del template per decidere come costruire la pagina desiderata.
CSS3 invece è stato scelto per la sua semplicità di utilizzo e la vasta gamma di opzioni offerte.
Se ne è fatto un uso intensivo per rendere quando più accattivante possibile il sito e per la creazione di media query atte a renderlo quanto più utilizzabile su qualsiasi tipo di dispositivo.
JavaScript
Abbiamo tentato di utilizzare JavaScript nel modo più intelligente possibile, usandolo si per rendere il sito più bello e fruibile all’utente ma assicurandoci sempre di non intaccare alcuna funzionalità nel caso in cui fosse disabilitato o non supportato dai browser.
Un esempio di questa filosofia è il menù ad hamburger: con JS funzionante fa apparire un menù appena sotto l’header, ma in caso di non utilizzo di JS c’è un menù in fondo alla pagina che viene comunque raggiunto grazie ad un’ancora a id.
Lo stesso si può dire per la validazione delle form, in quanto abbiamo usato tag semantici e l’attributo “pattern” per assicurarci che in caso di non funzionamento di JavaScript vengano comunque eseguiti dei controlli di base, a discapito di un messaggio di errore che ovviamente non può essere personalizzato.
JavaScript viene utilizzato per: 
- mostrare e nascondere la barra di ricerca ed il menù da mobile;
- nascondere il pulsante “torna su” e mostrarlo dopo aver fatto dello scroll verticale;
- validazione form di login, registrazione e invio articoli.
PHP e MySQL
PHP è stato chiaramente utilizzato per la costruzione delle pagine ed è stato preferito in tutti i casi possibili all’utilizzo di codice AJAX: sia per avvantaggiare utenti con hardware molto datato, sia per fare sì che l’utente riesca sempre a ricevere le informazioni desiderate nel caso di non funzionamento di JavaScript.
La lista di azioni che fanno uso di codice PHP comprende:
- Login e registrazione di utenti;
- Inserimento di nuovi articoli da parte di lettori e redattori;
- Accettazione / modifica / eliminazione di articoli da parte dei redattori;
- Validazione supplementare dei dati contenuti nelle form;
- Gestione e tracciamento dell’autenticazione degli utenti.
Le query SQL sono chiaramente associate al codice PHP eseguito e, dove possibile, sono state templatizzate in modo da garantirne un riutilizzo in base ai parametri passati dalle GET/POST.
Per evitare, inoltre, attacchi di tipo SQL Injection, è stata implementata una pulizia del testo scritto dagli utenti.
Atom
Atom è stato estremamente utile nello sviluppo di codice statico grazie ad un autocompletamento dal funzionamento eccellente ma soprattutto grazie al supporto ai plugin. Grazie a questo, è stato possibile installare i tool di validazione HTML e CSS basati sugli standard W3C. Il risultato è stato un codice che dall’inizio alla fine ha sempre rispettato gli standard ed ha agevolato di molto la fase finale di validazione del sito tramite strumenti online.

3.2 Accessibilità
Abbiamo prestato attenzione sin dall’inizio a curare l’accessibilità man mano che proseguivamo nello sviluppo così da evitare quanti più errori possibili nella speranza di rendere il sito facile da usare per qualsiasi categoria d’utenza.
In tutte le pagine è presente una barra di navigazione composta da link alle pagine alla base della gerarchia.
Subito sotto alla barra di navigazione sono state implementate delle breadcrumbs per non dare mai al cliente un senso di confusione e ogni pagina del sito può essere raggiunta in massimo 4 click (esclusa la pagina di gestione degli articoli, raggiungibile in 5 click in quanto può essere visitata solo se si è un amministratore che deve, ovviamente, conoscere bene il sito).
Tutti gli elementi grafici sono dotati di attributo alt nel caso delle immagini e di attributi name e title per quanto riguarda le icone (come la lente d’ingrandimento per la ricerca).
Sempre per quanto riguarda le immagini, i redattori sono istruiti riguardo la necessità di un alt nelle immagini presenti negli articoli e quindi, nel momento della scrittura/modifica dell’articolo, se è presente o viene aggiunta un’immagine è obbligatorio inserire un alt inerente ad essa.
Tutti i link rispettano il codice colore che consente di distinguere tra un link visitato e uno no, sono per di più segnalati i link a pagine esterne al sito e i link che avviano il download di un file.
4 Fase di Testing
4.1 Browser e dispositivi
Per garantire che i risultati dello sviluppo fossero soddisfacenti abbiamo deciso di testare il sito su più browser e su più dispositivi. Siamo anche riusciti a coinvolgere degli amici che ci hanno aiutato molto, prestandoci il loro tempo e la loro disponibilità a navigare sul nostro sito. Per rendere il sito, hostato in locale, accessibile da utenti esterni abbiamo fatto uso del software ngrok, che crea un tunnel a localhost accessibile solo da chi possiede un particolare link che abbiamo condiviso. Il software di base è gratuito e presenta dei limiti di connessioni per minuto, ma ci è stato comunque molto utile per avere un feedback da persone esterne che ci dessero una prospettiva diversa da quella di un informatico.
Il sito è stato testato su vari browser con su pc, sia con javascript attivato che disattivato. Viene riportata di seguito la lista dei browser :
* Chrome x.x.x.x;
* Firefox x.x.x.x;
* Edge x.x.x.x;
* Opera x.x.x.x;
* Safari x.x.x.x;
I test di navigazione sono avvenuti seguendo sempre la stessa scaletta:
* Visita di ogni link disponibile in ogni pagina (escluso per gli articoli, che sono stati presi a piacere per evitare di visitare sempre gli stessi);
* Inserimento di un articolo, sia in veste di lettore e che in quella di redattore;
* Esecuzione dell’accesso al proprio profilo utente, visita della pagina personale, cambio della password, logout;
* In veste di amministratore si ripete il punto precedente e si aggiunge lo step extra riguardante la gestione degli articoli con tanto di modifica, aggiunta ed eliminazione;
* Registrazione di un nuovo utente;
* Ripetizione di tutti i test precedenti con il software NVDA per simulare uno screen reader.
I test sono infine stati ripetuti un’ultima volta tramite dispositivi mobile per simulare l’esperienza d’uso di un cliente in movimento. Qui sotto la lista dei dispositivi utilizzati e relativi browser:
* Huawei P30 – Chrome;
* iPad x – Safari;
* Xiaomi Mi 10 Lite 5G – Chrome;
* ***AGGIUNGERE DISPOSITIVI***

4.2 Test automatici
Per garantire che le scelte prese riguardo ai colori del sito 
