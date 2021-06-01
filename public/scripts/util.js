// mostra menu da mobile
function menuToggle() {
    var x = document.getElementById("hd");
    if (x.className === "mob_nav") {
        x.className += " responsive";
    } else {
        x.className = "mob_nav";
    }
}

// mostra barra di ricerca da mobile
function searchToggle() {
    var x = document.getElementById("search_mobile");
    if (x.className === "mob_srch") {
        x.className += " resp_srch";
    } else {
        x.className = "mob_srch";
    }
}

/* ---- validazione form ---- */
String.prototype.trim = function () {
    return this.replace(/^\s+|\s+$/g, "");
}

function testFormArea(x) {
    var t = document.getElementById("titl_err");
    var d = document.getElementById("desc_err");
    var tx = document.getElementById("text_err");
    if (x.value.trim() == '') {
        switch (x) {
          case document.getElementById("titolo_art"):
            t.style.display = "inline-block";
            break;
          case document.getElementById("descr_art"):
            d.style.display = "inline-block";
            break;
          case document.getElementById("testo_art"):
            tx.style.display = "inline-block";
            break;
        }
        return false;
    } else {
      switch (x) {
        case document.getElementById("titolo_art"):
          t.style.display = "none";
          break;
        case document.getElementById("descr_art"):
          d.style.display = "none";
          break;
        case document.getElementById("testo_art"):
          tx.style.display = "none";
          break;
      }
      return true;
    }
}


/* ---- test campi registrazione ---- */
function testRegArea(x) {
  /*var i = document.getElementById("icon_err");*/
  var n = document.getElementById("name_err");
  var s = document.getElementById("surn_err");
  var m = document.getElementById("mail_err");
  var p = document.getElementById("pass_err");

  if (!isValid(x)) {
    switch (x) {
      case document.getElementById("nome"):
        n.style.display = "inline-block";
        break;
      case document.getElementById("cognome"):
        s.style.display = "inline-block";
        break;
      case document.getElementById("email"):
        m.style.display = "inline-block";
        break;
      case document.getElementById("password1"):
        p.style.display = "inline-block";
        break;
      }
      return false;
  } else {
    switch (x) {
      case document.getElementById("nome"):
        n.style.display = "none";
        break;
      case document.getElementById("cognome"):
        s.style.display = "none";
        break;
      case document.getElementById("email"):
        m.style.display = "none";
        break;
      case document.getElementById("password1"):
        p.style.display = "none";
        break;
      }
      return true;
  }
}

/* ---- Scrivi il tuo articolo ---- */
function validateForm() {
    var titolo = document.getElementById("titolo_art");
    var desc = document.getElementById("descr_art");
    var testo = document.getElementById("testo_art");
    titolo.removeAttribute("required");
    desc.removeAttribute("required");
    testo.removeAttribute("required");
    testFormArea(titolo);
    testFormArea(desc);
    testFormArea(testo);
    if (!testFormArea(titolo) || !testFormArea(desc) || !testFormArea(testo)) {
        return false;
    } else return true;
}

function isValid(x) {
    if (x === document.getElementById("email")) {
        var ex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
        if (!ex.test(x.value))
          return false;
    } else {
        x.value = x.value.trim();
        if (x.value == '' || !x.checkValidity()){
          x.removeAttribute("pattern");
          return false;
        }
    }
    return true;
}

function showError() {
    var err = document.getElementById('mail_err');
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    console.log( urlParams.get('error') );
    if (urlParams.get('error') == 1) {
    console.log( 'casadsa' );
        err.style.display = "block";
    }
}

/* ---- Login ---- */
function validateLogin() {
    var email = document.getElementById("email_addr");
    var pass = document.getElementById("pw");

    /* Elimina il messaggio d'errore dal browser, ma se JS viene disabilitato i campi rimangono 'required' */
    email.removeAttribute("required");
    pass.removeAttribute("required");
    /*-----------------------------------------------------------------------------------------------------*/

    var m = document.getElementById("mail_err");
    var p = document.getElementById("pass_err");
    if (email.value.trim() == '' || !email.checkValidity()) {
        email.setCustomValidity("");
        m.style.display = "block";
        if (pass.value.trim() == '') {
            pass.setCustomValidity("");
            p.style.display = "block";
        } else {
            p.style.display = "none";
        }
        return false;
    } else {
        m.style.display = "none";
        if (pass.value.trim() == '') {
            pass.setCustomValidity("");
            p.style.display = "block";
            return false
        }
    }
    m.style.display = "none";
    p.style.display = "none";
    return true;
}


/* ---- Registration ---- */
function validateReg() {
    var chk = document.querySelector('input[name="pic_sel"]:checked');
    var name = document.getElementById("nome");
    var surn = document.getElementById("cognome");
    var email = document.getElementById("email");
    var pass = document.getElementById("password1");
    var pass1 = document.getElementById("password2");

    /* Elimina il messaggio d'errore dal browser, ma se JS viene disabilitato i campi rimangono 'required' */
    document.getElementById("male_icon").removeAttribute("required");
    document.getElementById("female_icon").removeAttribute("required");
    document.getElementById("genderfluid_icon").removeAttribute("required");
    name.removeAttribute("required");
    surn.removeAttribute("required");
    email.removeAttribute("required");
    pass.removeAttribute("required");
    pass1.removeAttribute("required");
    /*-----------------------------------------------------------------------------------------------------*/

    var i = document.getElementById("icon_err");
    var p1 = document.getElementById("pass1_err");

    var t0;
    var t1 = testRegArea(name);
    var t2 = testRegArea(surn);
    var t3 = testRegArea(email);
    var t4 = testRegArea(pass);
    var t5;
    if(t4){
      if (pass.value == pass1.value) {
          p1.style.display = "none";
          t5 = true;
      }
      else{
          p1.style.display = "inline-block";
          t5 = false;
      }
    }
    else {
      t5 = false;
      p1.style.display = "none";
    }
    if(chk != null){
      t0 = true;
      i.style.display = "none";
    }
    else{
      t0 = false;
      i.style.display = "block";
    }
    if (t0 && t1 && t2 && t3 && t4 && t5)
        return true;
    return false;
}

/* ---- Ricerca non vuota ---- */
function validateSearch(x){
  if(x==document.getElementById("search_button")){
    input = document.getElementById("search_bar");
    input.removeAttribute("required");
    if(input.value.trim()==''){
      input.setAttribute("placeholder","Inserisci un termine");
      input.value="";
      input.className="redPh";
      return false;
    }
    else
        return true;
  }
  if(x==document.getElementById("resp_search_button")){
    input = document.getElementById("search_bar_responsive");
    input.removeAttribute("required");
    if(input.value.trim()==''){
      input.setAttribute("placeholder","Inserisci un termine");
      input.value="";
      input.className="redPh";
      return false;
    }
    else
        return true;
  }
  //niente menu_noJS (appunto perchè noJS)
}


/* ---- Cambio password ---- */
function testPwChange(x){
  err1 = document.getElementById("cp_err");
  err2 = document.getElementById("np_err");
  if(x.value==""){
    switch (x) {
      case document.getElementById("curr_pw"):
      err1.style.display = "inline-block";
      break;
      case document.getElementById("new_pw"):
      err2.style.display = "inline-block";
      break;
    }
    return false;
  }else {
    switch (x) {
      case document.getElementById("curr_pw"):
      err1.style.display = "none";
      break;
      case document.getElementById("new_pw"):
      err2.style.display = "none";
      break;
    }
    return true;
  }
}

function validatePwChange(){
  var cPW = document.getElementById("curr_pw");
  var nPW = document.getElementById("new_pw");
  var rPW = document.getElementById("rep_pw");
  var repErr = document.getElementById("rp_err");
  var newErr = document.getElementById("np_err");
  var t1 = testPwChange(cPW);
  var t2 = testPwChange(nPW);
  var t3;
  if(t2 && cPW.value!=nPW.value){
    if (nPW.value == rPW.value) {
        repErr.style.display = "none";
        t3 = true;
    }
    else{
        repErr.style.display = "inline-block";
        t3 = false;
    }
  }
  else {
    t3 = false;
    repErr.style.display = "none";
    newErr.style.display = "inline-block";
  }

  if(t1 && t2 && t3)
    return true;
  return false
}


/* ---- Inserimento Commento ---- */
function validateComm(){
  input = document.getElementById("insert_comment");
  input.removeAttribute("required");
  if(input.value.trim()==''){
    input.setAttribute("placeholder","Inserisci un commento");
    input.value="";
    input.className="redPh";
    return false;
  }
  return true;
}

// funzioni estetiche, con JS disattivato nessuna funzionalità viene a mancare
/* ---- nasconde il pulsante "torna su" e lo mostra solo dopo aver fatto scroll verticale ---- */
window.onload = function () {
    hideElements();
    showError();
};
window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    mybutton = document.getElementById("myBtn");
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        mybutton.style.right = "1em";
    } else {
        mybutton.style.right = "-100em";
    }
};

function hideElements() {
    document.getElementById("myBtn").style.right = "-100em";
    document.getElementById("menu_noJS").style.display = "none";
    document.getElementById("mob_srch_noJS").style.display = "none";
};
