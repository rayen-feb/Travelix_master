function InputControl()
{
    console.log('Input Control form called !!');
    var nbPlaces = document.getElementById('nombrePlaces').value ;
    var source = document.getElementById('source').value ;
    var paiement = document.getElementById('paiement').value ;


    var nbPlacesError = document.getElementById('nbPlaceError');
    var sourceError = document.getElementById('sourceError');
    var paiementError = document.getElementById('paiementError');

    var isValid = true; 

    if(nbPlaces.trim() === "")
    {
        nbPlacesError.innerHTML = "Seats Number is required !!";
        isValid = false ;
    } else if(nbPlaces.length > 10)
    {
        nbPlacesError.innerHTML = "Seats Number must be fewer than 10 seats";
        isValid = false;
    } else 
    {
        nbPlaces.innerHTML = "";
    }
    

    if(source.trim() === "Select choice")
    {
        sourceError.innerHTML="Choose a Source";
        isValid = false;
    } else {
        sourceError.innerHTML= "";
    }

    if(paiement.trim() === "Select choice")
    {
        paiementError.innerHTML="Choose a Payment method";
        isValid = false;
    } else {
        paiementError.innerHTML= "";
    }



    return isValid ;
    
}