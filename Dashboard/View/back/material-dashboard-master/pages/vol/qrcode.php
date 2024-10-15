<?php
// Votre code PHP pour récupérer les valeurs des inputs
$id_RES = '454';
$id_vol = '1254';
$date_reservation_vol = '5254';
$nb_place = '554';

// Génération du contenu du QR code
$qr_content = "ID Réservation: $id_RES, ID Vol: $id_vol, Date: $date_reservation_vol, Nombre de places: $nb_place";
?>

<!-- HTML pour afficher le QR code -->
<div id="qr-code-container"></div>

<!-- Inclure la bibliothèque html5-qrcode -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
// Fonction pour générer le QR code
function generateQRCode(content) {
    const qrCode = new Html5Qrcode("qr-code-container");
    qrCode.encodeText(content, "qr-code-output", {
        width: 250,
        height: 250
    });
}

// Appel de la fonction avec le contenu du QR code
generateQRCode("<?php echo $qr_content; ?>");
</script>
