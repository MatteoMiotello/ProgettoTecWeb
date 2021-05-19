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
  if (x.className === "mob_srch"){
    x.className += " resp_srch";
  } else {
    x.className = "mob_srch";
  }
}

//validazione form
String.prototype.trim = function() {
  return this.replace(/^\s+|\s+$/g, "");
}

function testArea(x){
  if(x.value.trim()==''){
    if(x === document.getElementById("titolo_art"))
      x.setCustomValidity("Inserisci un titolo");
    else {
      document.getElementById("titolo_art").setCustomValidity("");
      if(x === document.getElementById("descr_art"))
        x.setCustomValidity("Inserisci una descrizione");
      else {
        document.getElementById("descr_art").setCustomValidity("");
        x.setCustomValidity("Inserisci il testo");
      }
    }
    return false;
  }
  else{
    document.getElementById("testo_art").setCustomValidity("");
    return true;
  }
}

/* ---- Scrivi il tuo articolo ---- */
function validateForm(){
  var titolo = document.getElementById("titolo_art");
  var desc = document.getElementById("descr_art");
  var testo = document.getElementById("testo_art");
  if(!testArea(titolo) || !testArea(desc) || !testArea(testo)){
    return false;
  }
  else return true;
}

// funzioni estetiche, con JS disattivato nessuna funzionalità viene a mancare
/* ---- nasconde il pulsante "torna su" e lo mostra solo dopo aver fatto scroll verticale ---- */
window.onload = function() {hideBtn()};
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  mybutton = document.getElementById("myBtn");
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function hideBtn(){
  document.getElementById("myBtn").style.display = "none";
}

/*function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}*/
