<?php
       $session = true;
       if( session_status() === PHP_SESSION_DISABLED  ) {
           $session = false;
       }
   
       if(! $session) {
           echo "<p class='err'>Sessioni disabilitate, impossibile proseguire.";
           exit();
       }
   
       session_start();
?>
<!doctype html>

<html lang="it">

    <head>
        <? include "file_suppl/meta.html"; ?>
        <title> HomePage </title>
        <link rel="stylesheet" type="text/css" href="file_suppl/vista.css">
    </head>

    <body class='grid-container'>
        <h1 class='theHeader'>HomePage</h1>
        <?php require "file_suppl/navmenu.php"; ?>
        <?php require "file_suppl/info_utente.php"; ?>
        <main class="theMain">
            <p>In questa pagina &egrave; presentata l'offerta formativa dei vari corsi di laurea. </p>
            <p class='shortcut'>Collegamenti rapidi:</p>
            <p> <a href='#ing' class='shortcut'> Ingegneria </a> </p>
            <ul class='shortcut'>
                <li> <a href='#inf' class='shortcut'> Ingegneria Informatica </a> </li>
                <li> <a href='#ges' class='shortcut'> Ingegneria Gestionale </a> </li>
            </ul>
            <p> <a href='#arch' class='shortcut'> Architettura </a> </p>
            <ul class='shortcut'>
                <li> <a href='#urb' class='shortcut'> Architettura Urbanistica </a> </li>
                <li> <a href='#res' class='shortcut'> Architettura per il Restauro </a> </li>
            </ul>

            <a id='ing'> </a>
            <h2 class="centered underlined">Settore dell'ingegneria</h2>

            <div class='contenitoreCorso'>
            <a id='inf'></a>
            <h3 class='centered'>Ingegneria Informatica (INF)</h3>
            <p>Guardando al futuro, a dieci anni da oggi, quali saranno le tecnologie che pervaderanno la nostra vita e quali saranno le idee che rivoluzioneranno l’uso di tali tecnologie a supporto del cittadino e della societ&agrave;?</p>

            <p>Diventerai Ingegnere/a informatico/a, figura professionale in grado di operare nei settori della progettazione, ingegnerizzazione, sviluppo, esercizio, manutenzione e sicurezza di applicazioni ed impianti informatici, di sistemi di elaborazione delle informazioni e di sistemi informativi complessi.</p>
            <h4>Cosa imparerai</h4>

            <p>All’atto dell’immatricolazione sceglierai uno specifico orientamento tra i sette diversi percorsi di specializzazione previsti:</p>
            <ul>
                <li><p>SOFTWARE: </p><p>La formazione &egrave; orientata alla progettazione e gestione di sistemi informativi aziendali quale supporto all'organizzazione e ai bisogni dell'azienda. Particolare attenzione viene posta alla gestione e all'organizzazione di progetti software di dimensioni elevate, ovvero di progetti che coinvolgono numerosi programmatori per lunghi periodi di tempo. In tale ambito ci si concentra su problematiche di vario tipo, quali la correzione e la manutenzione del prodotto ottenuto.</p></li>
                <li><p>AUTOMATION AND INTELLIGENT CYBER-PHYSICAL SYSTEMS: </p><p>Approfondirai gli aspetti legati al progetto nonch&eacute; all'analisi teorica e sperimentale di modelli mediante predizione, controllo e diagnostica dei meccanismi interni. Inoltre, conoscerai gli aspetti legati alla logistica e al governo della mobilit&agrave; di veicoli, persone e cose, con attenzione tanto al dominio applicativo quanto agli aspetti di automazione e di gestione di base.</p></li>
                <li><p>GRAFICA E MULTIMEDIA:</p><p> Propone lo studio delle moderne tecniche di modellazione e rendering, introduce le architetture hardware dei sistemi grafici e dispositivi per la grafica interattiva, la realt&agrave; virtuale e il videogaming, e insegna a progettare ambienti interattivi e real-time. Insegna inoltre le tecniche di rappresentazione, compressione e trasmissione di segnali audio e video.</p></li>
                <li><p>ARTIFICIAL INTELLIGENCE AND DATA ANALYTICS:</p><p> La formazione cura gli aspetti tecnologici e teorici legati all'analisi di grosse moli di dati e fornisce le conoscenze relative agli algoritmi di machine learning, deep learning e intelligenza artificiale per l'analisi dei dati. Particolare attenzione &egrave; dedicata agli aspetti teorici e matematici alla base delle tecniche di analisi dei dati, alle tecnologie per la trattazione di big data, ai sistemi di elaborazione distribuiti e agli algoritmi ed alle tecniche di intelligenza artificiale e di deep learning.</p></li>
                <li><p>CYBERSECURITY:</p><p> &Egrave; dedicato alla progettazione e valutazione degli aspetti legati alla sicurezza informatica con riferimento agli aspetti tecnologici e teorici necessari per la comprensione delle debolezze dei sistemi IT e la loro protezione, inclusi gli aspetti tecnici ed organizzativi della protezione dei sistemi IT e le tecniche matematiche di crittografia alla base di molte soluzioni di sicurezza. Inoltre, conoscerai le tecniche sperimentali ed analitiche per valutare il grado di sicurezza di un sistema esistente.</p></li>
                <li><p>COMPUTER NETWORKS AND CLOUD COMPUTING:</p><p> Completerai le conoscenze sullo sviluppo di software in ambienti distribuiti e “cloud” e la valutazione delle prestazioni di sistemi distribuiti. Approfondirai lo sviluppo di software in ambienti distribuiti, la valutazione delle prestazioni di sistemi distribuiti, lo sviluppo di applicazioni e servizi avanzati su reti locali e geografiche. Particolare attenzione viene riservata alla comunicazione, alla sincronizzazione e all'interazione tra i prodotti applicativi e i componenti hardware, alla progettazione di reti aziendali e data center, nonch&eacute; all'analisi di sistemi di comunicazione basati sulle pi&ugrave; moderne tecnologie.</p></li>
                <li><p>EMBEDDED SYSTEMS: </p><p>&Egrave; dedicato alla progettazione automatica di sistemi digitali complessi. Apprenderai le metodologie di descrizione dell'hardware ed il loro uso nell'ambito di sistemi automatici di sintesi, le tecniche di ottimizzazione per migliorare le prestazioni del prodotto finale. Approfondirai problematiche legate alla correttezza e all'affidabilit&agrave; del prodotto finale analizzando l'impatto delle varie tecniche di verifica e di ottimizzazione.</p></li>
            </ul>
            <p>Il percorso formativo &egrave; articolato secondo quattro livelli di insegnamenti:</p>
            <ul>
                <li>insegnamenti obbligatori;</li>
                <li>insegnamenti qualificanti per i diversi orientamenti;</li>
                <li>insegnamenti a scelta;</li>
                <li>insegnamenti a crediti liberi.</li>
            </ul>
            <p>Il primo anno &egrave; dedicato agli insegnamenti obbligatori relativi ai settori dell'architettura degli elaboratori, della programmazione di sistema, della tecnologia delle basi di dati, dell'ingegneria del software, delle tecnologie e servizi di rete e della sicurezza dei sistemi informatici, mentre a partire dal secondo anno ti concentrerai sugli insegnamenti specifici dell’orientamento scelto.</p>

            <p>Al termine del percorso dovrai superare una prova finale che prevede lo svolgimento, la preparazione e la discussione della tesi di laurea magistrale.</p>
            <h4>Come lo imparerai</h4>

            <p>Alcuni degli orientamenti sono tenuti in lingua inglese, altri invece sono in lingua italiana. I corsi obbligatori si possono frequentare, a scelta dello studente o della studentessa in italiano o in inglese.</p>

            <p>Imparerai attraverso lezioni frontali, esercitazioni in aula e in laboratori informatici, e di tipo sperimentale, incluse attivit&agrave; condotte in modo autonomo o organizzate in gruppi di lavoro.</p>

            <p>Potrai scegliere di svolgere un tirocinio presso aziende del settore, come parte della tesi di laurea magistrale. Potrai inoltre seguire periodi di studio all’estero conseguendo un doppio titolo di laurea.</p>
            <h4>Cosa potrai fare dopo</h4>

            <p>Potrai accedere al mondo del lavoro come Ingegnere/a informatico/a trovando principalmente occupazione nelle imprese manifatturiere e di servizi, pubbliche e private, grandi, medie o piccole, riconducibili all’area dell'ingegneria informatica, dell’automazione, elettronica, gestionale, delle telecomunicazioni, scegliendo fra diverse figure professionali:</p>
            <ul>
                <li><p>ANALISTA E PROGETTISTA DI SICUREZZA:</p><p> In grado di analizzare i rischi di un sistema IT o di una specifica applicazione; definire, supervisionare e gestire un’architettura di sicurezza per proteggere dati e/o i sistemi dai rischi;</p></li>
                <li><p>PROGETTISTA DI SISTEMI DISTRIBUITI, DI RETE E CLOUD:</p><p> In grado di progettare e realizzare sistemi informatici complessi basati su calcolatori e dispositivi interconnessi in rete, quali sistemi aziendali, sistemi di operatori di telecomunicazioni e service provider, sistemi IoT (Internet of Things);</p></li>
                <li><p>PROGETTISTA IN AMBITO COMPUTER GRAPHICS E MULTIMEDIA:</p><p> In grado di progettare e realizzare sistemi e applicazioni grafiche e multimediali che soddisfano vincoli di interattivit&agrave; e piattaforme per lo sviluppo di contenuti multimediali off-line;</p></li>
                <li><p>PROGETTISTA APPLICAZIONI SOFTWARE:</p><p>In grado di definire l'architettura e progetta, a partire dalle specifiche, sistemi software complessi. Inoltre, l'ingegnere informatico pianifica e gestisce il progetto di sviluppo del prodotto o servizio software;</p></li>
                <li><p>PROGETTISTA DI SISTEMI DI CONTROLLO E AUTOMAZIONE INDUSTRIALE INTELLIGENTI:</p><p> Responsabile della modellazione, dell'ottimizzazione e del controllo sia di applicazioni complesse sia dei processi produttivi di fabbrica con particolare attenzione all'integrazione tra la dinamica dei processi fisici e gli aspetti di computazione/comunicazione/controllo propri della cosiddetta quarta rivoluzione industriale;</p></li>
                <li><p>PROGETTISTA DI SISTEMI EMBEDDED:</p><p>In grado di progettare, a partire dalle specifiche, sistemi hardware/software tipicamente realizzati su un supporto hardware dedicato in grado di garantire il rispetto dei vincoli specifici dell'applicazione considerata;</p></li>
                <li><p>PROGETTISTA DI SISTEMI INFORMATICI PER APPLICAZIONI DI INTELLIGENZA ARTIFICIALE E ANALISI DEI DATI:</p><p>In grado di progettare sistemi e processi informatici per l’estrazione, la trasmissione sicura, la memorizzazione, la visualizzazione e l’analisi di grandi moli di dati eterogenei, sviluppare e implementare metodologie per la realizzazione dei processi di analisi dei dati, ma anche utilizzare algoritmi di machine learning e intelligenza artificiale per effettuare analisi sui dati, modelli predittivi e ottimizzazione di processi.</p></li>
            </ul>
            </div>
            <div class='contenitoreCorso'>
            <a id='ges'> </a>
            <h3 class='centered'>Ingegneria Gestionale (GES)</h3>
            <p>Il corso di Laurea offre la possibilit&agrave; di caratterizzare la propria formazione relativa alle capacit&agrave; di gestione operativa delle risorse dell’impresa lungo due filoni culturali: il primo relativo alla conoscenza dei processi produttivi e delle relazioni con fornitori e clienti; il secondo focalizzato sulla analisi dei flussi informativi aziendali e la valutazione e gestione di progetti di innovazione organizzativa e tecnologica attraverso le Information and Communication Technologies (ICT). </p> 

            <p>Diventerai ingegnere gestionale di primo livello, una tipologia ambivalente di ingegnere, focalizzata sia sulle tecnologie di gestione ed organizzazione di sistemi complessi, sia orientata alla gestione e conduzione di sistemi logistici e di produzione.</p>
            <h4>Cosa imparerai</h4>

            <p>L'obiettivo &egrave; la formazione di una tipologia ambivalente di ingegnere, sia focalizzata sulle tecnologie di gestione ed organizzazione di sistemi complessi, sia orientata alla gestione e conduzione di sistemi logistici e di produzione. </p>

            <p>Ne consegue che, oltre alle discipline di base comuni a tutti i corsi di laurea in ingegneria, durante il Corso di Laurea, il futuro ingegnere gestionale sviluppa competenze specifiche multidisciplinari per affrontare le principali problematiche di pianificazione e controllo delle attivit&agrave; produttive di beni e servizi e delle relative implicazioni organizzative.</p>

            <p>Il percorso formativo offre una robusta conoscenza matematica-statistica pensata per fornire parte dei metodi utili a risolvere le principali problematiche di pianificazione e controllo delle attivit&agrave; produttive di beni e servizi e le relative implicazioni organizzative. A tale base si aggiunge un corpo di insegnamenti organizzato su due filoni culturali: </p>
            <ul>
                <li>la conoscenza dei processi produttivi e delle relazioni con fornitori e clienti;</li>
                <li>l'analisi dei flussi informativi aziendali e la valutazione e gestione di progetti di innovazione organizzativa e tecnologica attraverso le Information and Communication Technologies (ICT).</li>
            </ul>

            <p>In aggiunta, sceglierai in alternativa di abbinare una preparazione nei due seguenti domini:</p>
            <ul>
                <li>la gestione delle ICT (Information Communication Technology), e dei sistemi informativi in particolare, per il supporto delle principali attivit&agrave; aziendali (amministrazione e contabilit&agrave;, vendite, pianificazione e controllo della produzione e dei flussi logistici); </li>
                <li>la gestione dei flussi logistici, la progettazione degli impianti industriali e delle principali tecnologie di produzione.</li>
            </ul>
            <p>Al termine del percorso dovrai sostenere una prova finale, eventualmente in lingua inglese con riferimento ad un problema specifico affrontato durante l’eventuale partecipazione al tirocinio in azienda o relativo agli insegnamenti seguiti.</p>

            <h4>Cosa potrai fare dopo</h4>

            <p>Gli studenti di entrambi le classi di laurea, L-8 e L-9, possono scegliere di continuare gli studi con un Corso di Laurea Magistrale. </p>

            <p>Generalmente si considerano ambiti di riferimento per la classe L-8: i processi di innovazione tecnologica, l'analisi e la gestione dei sistemi informativi in un'organizzazione, sia essa un'impresa privata o un ente pubblico mentre per la Classe L-9 si considerano gli ambiti dell'ingegneria di processo, della gestione dei flussi logistici interni ed esterni (distribuzione e approvvigionamento).</p>

            <p>Il Consiglio di Ingegneria Gestionale fa anche riferimento alla classificazione prevista da EUCIP (European Certification of Information Professionals) che offre la possibilit&agrave; di  scegliere tra 2 possibili sbocchi:</p>
            <ul>
                <li><p>SPECIALISTA NEI FLUSSI LOGISTICI E NELLA GESTIONE OPERATIVA DELLA PRODUZIONE DI BENI E SERVIZI</p><p>Opera con funzioni tecniche in una delle seguenti aree: gestione delle tecnologie e dei sistemi di produzione, miglioramento dei processi produttivi, logistica interna ed esterna, controllo della qualit&agrave; e controllo di gestione;</p></li>
                <li><p>ESPERTO IN SISTEMI INFORMATIVI PER LA GESTIONE AZIENDALE</p><p>Analizza i processi dell’impresa per identificare i requisiti di soluzioni innovative per la gestione aziendale attraverso sistemi informativi. Ricopre un ruolo di interfaccia tra management aziendale, utilizzatori e sviluppatori delle soluzioni informatiche; supporta la progettazione e la manutenzione evolutiva di soluzioni ICT per attivit&agrave; aziendali relative alla pianificazione e al controllo economico ed operativo della produzione, alla logistica interna ed esterna, al marketing e alla gestione delle relazioni con i clienti.</p></li>
            </ul>
            </div>
            <a id='arch'></a>
            <h2 class="centered underlined">Settore dell'architettura</h2>
            <div class='contenitoreCorso'>
            <a id='urb'></a>
            <h3 class='centered'>Architettura Urbanistica (URB) </h3>
            <p>L’obiettivo principale del Corso di Laurea &egrave; la formazione di un laureato che possieda:</p>
            <ul>
                <li>adeguate conoscenze nei campi della storia dell'architettura e dell'edilizia, degli strumenti e delle forme della rappresentazione, degli aspetti metodologico-operativi della matematica e delle altre scienze di base e capacit&agrave; di utilizzare tali conoscenze per interpretare e descrivere i problemi dell'architettura e dell'edilizia;</li>
                <li>adeguate conoscenze degli aspetti metodologico-operativi relativi agli ambiti disciplinari caratterizzanti il corso di studio e capacit&agrave; di identificare, formulare e risolvere i problemi dell'architettura e dell'edilizia utilizzando metodi, tecniche e strumenti aggiornati;</li>
                <li>adeguate conoscenze degli aspetti riguardanti la fattibilit&agrave; tecnica ed economica, il calcolo dei costi e il processo di produzione e di realizzazione dei manufatti architettonici ed edilizi, nonch&eacute; gli aspetti connessi alla loro sicurezza;</li>
                <li>capacit&agrave; di utilizzare le tecniche e gli strumenti della progettazione dei manufatti architettonici ed edilizi; </li>
                <li>capacit&agrave; di comunicare efficacemente, in forma scritta e orale, in almeno una lingua dell'Unione Europea, oltre l'italiano. </li>
            </ul>

            <p>Il piano di studi del Corso di Laurea &egrave; conforme alle disposizioni del D.M. 270/2004, e pertanto i laureati triennali in Architettura presso il Politecnico di Torino saranno in possesso dei crediti formativi che costituiscono il requisito indispensabile per l'accesso ai corsi di laurea magistrale in classe LM-4 miranti alla formazione dell'architetto e dell'ingegnere edile-architetto, ai sensi delle direttiva 85/384/CEE; previo il superamento dell’Esame di Stato, poi, potranno iscriversi all’Albo professionale degli Architetti, sezione B, settore A (architetto junior) e svolgere la libera professione.</p>


            <p>I laureati triennali in Architettura potranno svolgere attivit&agrave; professionali in diversi ambiti, concorrendo e collaborando alle attivit&agrave; di programmazione, progettazione e attuazione degli interventi di organizzazione e trasformazione dell'ambiente costruito alle varie scale. Oltre che nella libera professione e nelle attivit&agrave; di consulenza, essi potranno esercitare tali competenze presso enti, aziende pubbliche e private, societ&agrave; di ingegneria e architettura, industrie di settore e imprese di costruzione.</p>
            </div>
            <div class='contenitoreCorso'>
            <a id='res'> </a>
            <h3 class='centered'>Architettura per il Restauro (RES) </h3>
            <p>Il corso di Laurea Magistrale in Architettura per il Restauro e la Valorizzazione del Patrimonio risponde ad una domanda consolidata e in continua evoluzione tanto sul piano professionale quanto su quello della ricerca, anche in sede europea. Questa domanda impone di formare competenze professionali in grado di gestire adeguatamente la complessit&agrave; del progetto di tutela e valorizzazione del patrimonio nei diversi ambiti e alle diverse scale, finalizzando le competenze a operazioni di restauro, trasformazione e rifunzionalizzazione dell'ambiente fisico e del paesaggio. I laureati magistrali acquisiscono, inoltre, una formazione culturale che consente loro di affrontare con coscienza e competenza gli aspetti estetici, funzionali, strutturali, tecnico-costruttivi, gestionali, economici, sociali ed ambientali.<p>

            <p>L’obiettivo del corso di LM &egrave; formare un architetto declinato alla conservazione, valorizzazione, gestione, promozione del patrimonio. Il percorso formativo &egrave; volto ad assicurare tutti gli strumenti conoscitivi necessari per lo svolgimento della professione di architetto capace di gestire l'intero processo progettuale in un'ottica di tutela e valorizzazione, interagendo e coordinando anche le altre figure professionali coinvolte.</p>

            <p>Il Corso di laurea magistrale in Architettura per il Restauro e Valorizzazione del patrimonio &egrave; da ritenersi la naturale evoluzione (nonch&eacute; l’adeguamento normativo) del Corso di Laurea Specialistico in Architettura per il Restauro e la Valorizzazione, attivato dall’allora Facolt&agrave; di Architettura 2 del Politecnico di Torino, a partire dall’a.a. 2000-2001. &egrave; su questa base e, in particolare, con l’esperienza maturata in questi anni che, a partire dall’a.a. 2010-2011 &egrave; stato attivato l’attuale Corso di Laurea Magistrale.</p>
            <p>Il percorso si articola attraverso insegnamenti monodisciplinari, atelier tematici, workshop e seminari, visite di studio, attivit&agrave; di tirocinio e/o stage in Italia e all’estero. Gli insegnamenti sono finalizzati all’acquisizione delle conoscenze teoriche, all’applicazione sui temi progettuali e all’aggiornamento del dibattito contemporaneo. Gli atelier applicano idonee metodologie progettuali e propongono soluzioni utilizzando strumenti tradizionali e innovativi; hanno un carattere interdisciplinare e comprendono workshop e seminari.</p>

            <p>L’obiettivo dell’intero percorso biennale &egrave; la formazione di un architetto con particolari competenze nell'ambito del restauro e della valorizzazione del patrimonio architettonico e paesaggistico, dovendo rispondere alle urgenze della tutela e del restauro. Oggi sono richieste dal mercato del lavoro, in campo internazionale, figure professionali attente a procedure, saperi, materiali e differenti culture, con particolare e raffinata attitudine a gestire le situazioni di rischio e di sostenibilit&agrave;, oltre che le strategie di conoscenza e di procedure sostenibili all'accesso ai beni culturali.</p>

            <p>Per "patrimonio" s'intende quell'insieme di beni che sono "testimonianze aventi valore di civilt&agrave;"; il focus degli studi, intorno al quale gravitano tutte le discipline opportunatamente declinate, &egrave;, quindi, la totalit&agrave; del patrimonio architettonico e urbano, diffuso e concentrato, antico e moderno, ambientale e paesaggistico. L'obiettivo del corso di studi &egrave; la formazione di un architetto che possieda mature capacit&agrave; per la conoscenza, conservazione, valorizzazione, gestione, promozione del patrimonio; obiettivo raggiunto attraverso un articolato e complesso percorso progettuale che si dipana per il biennio e che vuole integrare le irriproducibili valenze culturali dei beni con le aggiornate ragioni economiche e sociali del loro contesto di inserimento.</p>
            <p>Il sistema italiano, basato sulla consolidata tradizione disciplinare della tutela, rappresenta un fattore di attrazione e di competitivit&agrave; nel panorama internazionale, avendo maturato negli anni competenze nell'ambito della tutela, della conservazione e della valorizzazione. Il modello formativo presenta marcate peculiarit&agrave; disciplinari anche nel campo della gestione e promozione del patrimonio culturale.</p>
            
            <p>Il modello formativo intende assicurare tutti gli strumenti esplorativi e critici necessari per lo svolgimento della professione di architetto, nella quale si integrano conoscenze e competenze nel campo della progettazione e gestione dei beni e dei "sistemi" culturali alle diverse scale. Ci&ograve; comporta l'acquisizione di capacit&agrave; a collaborare con altre figure professionali dei settori dell'architettura, dell'ingegneria, della chimica per il restauro, della valorizzazione economica, della comunicazione.</p>
            <ul>
                <li>Al centro del percorso formativo &egrave; il progetto di qualit&agrave;, inteso sia come valorizzazione della realt&agrave; esistente sia come creazione del patrimonio del futuro, attraverso la gestione delle complessit&agrave; proprie delle attivit&agrave; progettuali. Questo implica un approccio integrale al tema del patrimonio, dove la sapienza tecnica e culturale del costruire si coniuga con l'educazione estetica, le scienze economiche e sociali, le strategie della gestione e comunicazione. </li>
                <li>Al centro del percorso magistrale &egrave; il progetto, declinato molti ambiti disciplinari che contribuiscono a comporre un variegato quadro di competenze; la progettazione &egrave; intesa sia come esperienza conoscitiva (individuazione, analisi, valutazione critica dell’esistente) finalizzata alla tutela, valutazione, comunicazione, sia come approccio alle diverse scale: dal singolo edificio alla citt&agrave;, al paesaggio, al patrimonio diffuso. Gli atelier sviluppano la complessit&agrave; del patrimonio architettonico e paesaggistico e approfondiscono i campi specifici della conservazione e valorizzazione, attraverso strumenti tecnici e gestione dei dati che forniscono l’indispensabile supporto all’individuazione, alla conoscenza, alle scelte progettuali e di gestione, alla programmazione e comunicazione.</li>
            </ul>
            <p>Il corso di studi &egrave; interamente erogato in lingua italiana. Ogni anno accoglie studenti Erasmus (il corso ha relazioni con oltre 40 universit&agrave; in Europa) ed esiste la possibilit&agrave; di avviare percorsi di studio per ottenere il double degree con universit&agrave; della Colombia, Cile, Brasile.</p>
            </div>
        </main>
        <footer class="ft theFooter">
            <p> Pagina corrente: home.php </p>
            <? include "file_suppl/author.html"; ?>
        </footer>
    </body>


</html>