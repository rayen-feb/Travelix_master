function validate()
{
    console.log("validateForm called !");
    var name = document.getElementById('Name').value;
    var type_unit = document.getElementById('type_unit').value;
    var price = document.getElementById('price').value;

    var nameError = document.getElementById('nameError');
    var type_unitError = document.getElementById('type_unitError');
    var priceError = document.getElementById('priceError');

    var isValid = true ;

    if(name.trim() === "")
    {
        NameError.innerHTML= "this field is required";
        isValid = false;
    }else
    {
        NameError.innerHTML = "";
    }


    if(type_unit.trim() === "")
    {
        type_unitError.innerHTML= "this field is required";
        isValid = false;
    }else
    {
        type_unitError.innerHTML = "";
    }

    if(price.isInteger()===false)
    {
        priceError.innerHTML= "this field is must be a number";
        isValid = false;
    }else
    {
        priceError.innerHTML = "";
    }

    return isValid;
}

