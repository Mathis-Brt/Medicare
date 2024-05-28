// Ouvrir le modal de création de compte
function openCreateAccountModal() {
    var modal = document.getElementById("createAccountModal");
    modal.style.display = "block";
}

// Fermer le modal de création de compte
function closeCreateAccountModal() {
    var modal = document.getElementById("createAccountModal");
    modal.style.display = "none";
}

// Ouvrir le modal de connexion
function openLoginModal() {
    var modal = document.getElementById("loginModal");
    modal.style.display = "block";
}

// Fermer le modal de connexion
function closeLoginModal() {
    var modal = document.getElementById("loginModal");
    modal.style.display = "none";
}

// Empêcher la propagation des événements au clic en dehors des modals
window.onclick = function(event) {
    var createModal = document.getElementById("createAccountModal");
    var loginModal = document.getElementById("loginModal");
    if (event.target == createModal) {
        createModal.style.display = "none";
    }
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
}