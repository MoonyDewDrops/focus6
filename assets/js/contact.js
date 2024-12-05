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


// alles checken zodat de pop up pas nadat alles is ingevult in beeld
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

    // Controleer de captcha
    const captchaInput = document.getElementById("captcha");
    const captchaError = document.getElementById("captchaError");
    if (!captchaInput.value.trim()) {
        showError(captchaInput, captchaError, "Los de som op.");
        isValid = false;
    } else {
        hideError(captchaInput, captchaError);
    }

    // Als het formulier niet geldig is verzend hij niet
    if (!isValid) {
        e.preventDefault();
    } else {
        // Als alle validatie lukt laat hij de pop-up zien
        alert("Bedankt! We nemen zo snel mogelijk contact met u op.");
    }
});

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}