function validerFormulaire() {
    var nom_offre = document.getElementById("nom_offre").value;
    var date_debut = document.getElementById("date_debut").value;
    var date_fin = document.getElementById("date_fin").value;

    if (nom_offre.trim() === "") {
        alert("Veuillez saisir le nom du pack.");
        return false;
    }
    if (date_debut.trim() === "") {
        alert("Veuillez sélectionner une date de début.");
        return false;
    }
    if (date_fin.trim() === "") {
        alert("Veuillez sélectionner une date de fin.");
        return false;
    }

    // Conversion des dates en objets Date
    var debut = new Date(date_debut);
    var fin = new Date(date_fin);

    // Comparaison des dates
    if (fin <= debut) {
        alert("La date de fin doit être ultérieure à la date de début.");
        return false;
    }

    return true;
}
function valider_reservation() {
    var nombrePlaces = document.getElementById("nombrePlaces").value;
    var source = document.getElementById("source").value;
    var paiement = document.getElementById("paiement").value;

    if (nombrePlaces.trim() === "") {
        alert("Veuillez saisir le nombre de places .");
        return false;
    }
    if (source.trim() === " ") {
        alert("Veuillez sélectionner un source.");
        return false;
    }
    if (paiement.trim() === "") {
        alert("Veuillez sélectionner une option pour paiement.");
        return false;
    }
    return true ; 
    
}
