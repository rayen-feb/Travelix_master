function validateForm()
{
    console.log("validateForm called !");
    var company = document.getElementById('company').value;
    var departure_city = document.getElementById('departure_city').value;
    var destination_city = document.getElementById('destination_city').value;
    var check_in= document.getElementById('check_in').value;
    var check_out= document.getElementById('check_out').value;
    var amount = document.getElementById('amount').value;
    var id = document.getElementById('id').value;





    var companyError = document.getElementById('companyError');
    var departure_cityError = document.getElementById('departure_cityError');
    var destination_cityError = document.getElementById('destination_cityError');
    var check_inError = document.getElementById('check_inError');
    var check_outError = document.getElementById('check_outError');
    var amountError = document.getElementById('amountError');
    var idError = document.getElementById('idError');




    var isValid = true ;

    if(company.length < 5)
    {
        companyError.innerHTML= "company must be at least 5 characters";
        isValid = false;
    }else
    {
        companyError.innerHTML = "";
    }


    if(departure_city.trim() === "")
    {
        departure_city.innerHTML= "departure city  is required";
        isValid = false;
    
    } else
    {
        departure_cityError.innerHTML = "";
    }
    
    if(destination_city.trim() === "")
    {
        destination_city.innerHTML= "destination city  is required";
        isValid = false;
    
    } else
    {
        destination_cityError.innerHTML = "";
    }

    if(check_in.trim() === "")
    {
        check_inError.innerHTML = "check in  is required";
        isValid = false;
    } 
    else if(check_in.length >11)
    {
        check_in.innerHTML = "check in not valid ";
        isValid = false;
    }  
    else 
    {
        check_inError.innerHTML = "";
    } 


    
    if(check_out.trim() === "")
    {
        check_outError.innerHTML = "check  out   is required";
        isValid = false;
    } 
    else if(check_out.length >11)
    {
        check_out.innerHTML = "check  out  not valid ";
        isValid = false;
    }  
    else 
    {
        check_outError.innerHTML = "jh";
    } 

    return isValid;
}
    
