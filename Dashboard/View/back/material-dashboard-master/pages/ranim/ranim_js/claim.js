document.addEventListener("DOMContentLoaded", function() {
    var talwinElements = document.getElementsByClassName("talwin");
    
    for (var i = 0; i < talwinElements.length; i++) {
        var talwin = talwinElements[i];

        if (talwin.textContent === "Non traitée") {
            talwin.style.color = "red";
        } else if (talwin.textContent === "Traitée") {
            talwin.style.color = "green";
        } 
    }

   
});



/***************************************** */
function filterTable(inputValue) {
    var filter = inputValue.toLowerCase();
    var table = document.getElementById("ContactTable");
    var rows = table.getElementsByTagName("tr");

    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var numeroCell = row.cells[0]; // num
        var etatCell = row.cells[5]; // etat mawjoud fil colone 6
        var date = row.cells[4]; // num
        var user = row.cells[1]; // num
        var email = row.cells[2]; // num

       // var nameCell = row.cells[1]; // name mawjoud fil colone 1
       // var prenomCell = row.cells[2]; // prenom mawjoud fil colone 2
       // var emailCell = row.cells[3]; // email mawjoud fil colone 3
        var sujetCell = row.cells[3]; // sujet mawjoud fil colone 4

        // Check if any of the cells contain the filter value
        var containsFilter = (
            (etatCell && etatCell.textContent.trim().toLowerCase().includes(filter)) ||
            (numeroCell && numeroCell.textContent.trim().toLowerCase().includes(filter)) ||
            (date && date.textContent.trim().toLowerCase().includes(filter)) ||
            //(nameCell && nameCell.textContent.trim().toLowerCase().includes(filter)) ||
            (user && user.textContent.trim().toLowerCase().includes(filter)) ||
            (email && email.textContent.trim().toLowerCase().includes(filter)) ||
            (sujetCell && sujetCell.textContent.trim().toLowerCase().includes(filter))
        );

        if (containsFilter) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    }
}
