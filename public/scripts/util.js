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

//validazione form
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

function testRegArea(x) {
  /*var i = document.getElementById("icon_err");*/
  var n = document.getElementById("name_err");
  var s = document.getElementById("surn_err");
  var m = document.getElementById("mail_err");
  /*var u = document.getElementById("aka_err");*/
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
        if (x.value.trim() == '' || !x.checkValidity())
            return false;
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
    document.querySelector('input[name=pic_sel]').removeAttribute("required");
    name.removeAttribute("pattern");
    name.removeAttribute("required");
    surn.removeAttribute("pattern");
    surn.removeAttribute("required");
    email.removeAttribute("pattern");
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

// funzioni estetiche, con JS disattivato nessuna funzionalità viene a mancare
/* ---- nasconde il pulsante "torna su" e lo mostra solo dopo aver fatto scroll verticale ---- */
window.onload = function () {
    hideBtn()
};
window.onscroll = function () {
    scrollFunction()
};

window.onload = function () {
  showError();
}

function scrollFunction() {
    mybutton = document.getElementById("myBtn");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

function hideBtn() {
    document.getElementById("myBtn").style.display = "none";
}
