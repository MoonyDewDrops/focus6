const naam = document.getElementById("naam");
const email = document.getElementById("email");
const bericht = document.getElementById("bericht");
const form = document.getElementById("form");

const naamError = document.getElementById("naamError");
const emailError = document.getElementById("emailError");
const berichtError = document.getElementById("berichtError");

// E-mail validatie regex
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Reset foutmeldingen bij het laden van de pagina
naamError.innerText = "";
emailError.innerText = "";
berichtError.innerText = "";

// Functie om foutmeldingen te tonen
function showError(inputElement, errorElement, message) {
    errorElement.innerText = message;
    inputElement.classList.add('error');
}

// Functie om foutmeldingen te verbergen
function hideError(inputElement, errorElement) {
    errorElement.innerText = '';
    inputElement.classList.remove('error');
}

// Formulier submit event
form.addEventListener("submit", (e) => {
    let isValid = true;

    // Controleer de naam
    if (!naam.value.trim()) {
        showError(naam, naamError, "Naam is verplicht");
        isValid = false;
    } else {
        hideError(naam, naamError);
    }

    // Controleer de e-mail
    if (!email.value.trim()) {
        showError(email, emailError, "Email is verplicht");
        isValid = false;
    } else if (!emailRegex.test(email.value)) {
        showError(email, emailError, "Voer een geldig e-mailadres in.");
        isValid = false;
    } else {
        hideError(email, emailError);
    }

    // Controleer het bericht
    if (!bericht.value.trim()) {
        showError(bericht, berichtError, "Bericht is verplicht");
        isValid = false;
    } else if (bericht.value.length < 10) {
        showError(bericht, berichtError, "Bericht moet minimaal 10 tekens bevatten.");
        isValid = false;
    } else {
        hideError(bericht, berichtError);
    }

    // Als er een fout is, voorkom het verzenden van het formulier
    if (!isValid) {
        e.preventDefault();
    }
});

// Dynamische foutmeldingen tijdens invoeren (input event)
naam.addEventListener('input', () => {
    if (naam.value.trim()) {
        hideError(naam, naamError);
    } else {
        showError(naam, naamError, "Naam is verplicht");
    }
});

email.addEventListener('input', () => {
    if (emailRegex.test(email.value)) {
        hideError(email, emailError);
    } else {
        showError(email, emailError, "Voer een geldig e-mailadres in.");
    }
});

bericht.addEventListener('input', () => {
    if (bericht.value.length >= 10) {
        hideError(bericht, berichtError);
    } else {
        showError(bericht, berichtError, "Bericht moet minimaal 10 tekens bevatten.");
    }
});

function myFunction() {
    var txt;
    if (confirm("Press a button!")) {
      txt = "You pressed OK!";
    } else {
      txt = "You pressed Cancel!";
    }
    document.getElementById("demo").innerHTML = txt;
  }