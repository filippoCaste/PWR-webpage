function clearForm(mat, pas) {
    "use strict";
    document.getElementById(mat).value="";
    document.getElementById(pas).value="";
    console.log("arrivato qui");
}

function validateLoginForm(formObj) {
    
    // Regular Expression per la verifica lato client dell'utente che vuole inserire la matricola: se la matricola
        // comincia con r o s (rispettivamente responsabile e studente) allora puo' procedere, altrimenti
        // viene richiesto che venga inserita una matricola valida. Dopo la prima lettera, la matricola può
        // contenere solamente cifre numeriche in numero non precisato, ma almeno 1.

        // questo controllo ha lo scopo di verificare che i dati inseriti non siano dannosi, oltre che per evitare
        // di effettuare operazioni inutili al server.
    let re = /^([rs]{1})([\d]+)$/;
    
    let matr = formObj.mtrcl.value; 
    let psw = formObj.password.value; // vanno aggiunti controlli?

    if(matr == "") {
        // se l'utente lascia il campo matricola vuoto, viene bloccato.
        window.alert("Inserire una matricola per continuare.");
        return false;
    }

    if(psw == "") {
        // la psw contiene almeno un carattere, e pertanto se non e' inserita dall'utente viene bloccato gia' lato client.
        window.alert("Inserire la password e riprovare.");
        return false;
    }

    if(! re.test(matr)) {
        // se matricola non soddisfacente, avviso utente e restituisco false alla funzione di validazione.
        window.alert("La matricola può iniziare con r o s.");
        return false;
    } else {
        return true;
    }
}

function validateCorso(formObj) {
    "use strict";
    let nome = formObj.nome.value;
    let cid = formObj.cid.value;
    let cdl = formObj.cdl.value;
    let cfu = formObj.cfu.value;
    let h = formObj.h.value;

    if(! /^(([a-zA-Z\è\ò\à\ì\é\ù\d])([\s])?){10,40}$/.test(nome)) {
        window.alert('Inserire un nome di corso valido.');
        return false;
    }

    if(! /^[\d]{1,2}$/.test(h) || ( parseInt(h)>90 || parseInt(h) < 9 ) ) {
        window.alert('Il numero di ore inserite non è valido. Deve essere un numero compreso tra 9 e 90.');
        return false;
    }

    if(! /^[\d]{1,2}$/.test(cfu) || (parseInt(cfu) > 10 || parseInt(cfu) < 1)) {
        window.alert('Il numero di cfu inserito non è valido. Deve essere un numero compreso tra 1 e 10.');
        return false;
    }

    if(! /^[\d]{2}[A-Z]{2}$/.test(cid)) {
        window.alert('Il codice del corso inserito non è valido. Deve essere composto da due cifre numeriche e due lettere maiuscole.');
        return false;
    }

    if(!(cdl==="INF" || cdl === "GES" || cdl === "RES" || cdl === "URB")) {
        window.alert('Il corso di laurea che hai inserito non esiste. Scegline uno tra i quattro esistenti: INF, GES, RES, URB.');
        return false;
    }
    
    return true;
}