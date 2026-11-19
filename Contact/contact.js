const contactForm = document.querySelector("#contact-form");
const feedback = document.querySelector("#form-feedback");
const requiredFields = ["nom", "prenom", "email", "objet", "message"];

function showFieldError(field, message) {
    const input = document.getElementById(field);
    const error = document.getElementById(`${field}-error`);

    input.classList.toggle("invalid", Boolean(message));
    input.setAttribute("aria-invalid", message ? "true" : "false");
    error.textContent = message;
}

function validateField(field) {
    const input = document.getElementById(field);
    const value = input.value.trim();
    let message = "";

    if (requiredFields.includes(field) && !value) {
        message = "Ce champ est obligatoire.";
    }
    else if (field === "email" && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
        message = "Veuillez saisir une adresse e-mail valide.";
    }
    else if (field === "message" && value.length > 0 && value.length < 10) {
        message = "Votre message doit contenir au moins 10 caractères.";
    }

    showFieldError(field, message);
    return !message;
}

["nom", "prenom", "email", "objet", "message"].forEach((field) => {
    const input = document.getElementById(field);
    input.addEventListener("blur", () => validateField(field));
    input.addEventListener("input", () => {
        if (input.classList.contains("invalid")) {
            validateField(field);
        }
    });
});

document.getElementById("telephone").addEventListener("blur", (event) => {
    const value = event.target.value.trim();
    const message = value && !/^[+()\d\s.-]{7,20}$/.test(value) ? "Veuillez vérifier le numéro saisi." : "";
    showFieldError("telephone", message);
});

contactForm.addEventListener("submit", (event) => {
    event.preventDefault();
    const valid = ["nom", "prenom", "email", "objet", "message"].map(validateField).every(Boolean);
    const phone = document.getElementById("telephone");
    const phoneValue = phone.value.trim();
    const phoneValid = !phoneValue || /^[+()\d\s.-]{7,20}$/.test(phoneValue);

    if (!phoneValid) {
        showFieldError("telephone", "Veuillez vérifier le numéro saisi.");
    }

    if (!valid || !phoneValid) {
        feedback.textContent = "Veuillez corriger les champs indiqués avant de continuer.";
        feedback.className = "form-feedback error";
        const firstInvalid = contactForm.querySelector(".invalid");
        if (firstInvalid) {
            firstInvalid.focus();
        }
        return;
    }

    feedback.textContent = "Le formulaire est valide. Pour envoyer réellement ce message, il faudra connecter un service d'envoi ou un backend.";
    feedback.className = "form-feedback success";
});

document.querySelectorAll(".faq-item").forEach((item) => {
    item.addEventListener("toggle", () => {
        if (item.open) {
            document.querySelectorAll(".faq-item").forEach((otherItem) => {
                if (otherItem !== item) {
                    otherItem.open = false;
                }
            });
        }
    });
});

const menuToggle = document.querySelector(".menu-toggle");
const mainNav = document.querySelector("#main-nav");

menuToggle.addEventListener("click", () => {
    const isOpen = mainNav.classList.toggle("open");
    menuToggle.setAttribute("aria-expanded", String(isOpen));
    menuToggle.setAttribute("aria-label", isOpen ? "Fermer le menu" : "Ouvrir le menu");
});

document.querySelector("#newsletter-form").addEventListener("submit", (event) => {
    event.preventDefault();
    const input = document.querySelector("#newsletter-email");
    const result = document.querySelector("#newsletter-feedback");

    if (!input.checkValidity()) {
        input.reportValidity();
        return;
    }

    result.textContent = "Adresse vérifiée. L'inscription sera activée lorsque la newsletter sera connectée.";
});

document.querySelector("#current-year").textContent = new Date().getFullYear();
