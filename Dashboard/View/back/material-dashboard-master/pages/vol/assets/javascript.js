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

    if(username.length < 5)
    {
        usernameError.innerHTML= "Username must be at least 5 characters";
        isValid = false;
    }else
    {
        usernameError.innerHTML = "";
    }

/*
    if(email.trim() === "")
    {
        emailError.innerHTML= "Email is required";
        isValid = false;
    } else if(!/\S+@\S+\.\S+/.test(email))
    {
        emailError.innerHTML = "Email must be valid";
        isValid = false ;
    } else
    {
        emailError.innerHTML = "";
    }

    if(password.trim() === "")
    {
        passwordError.innerHTML = "Password is required";
        isValid = false;
    } 
    else if(password.length < 8)
    {
        passwordError.innerHTML = "Password must be at least 8 characters";
        isValid = false;
    }  
    else if(!/[A-Z]/.test(password))
    {
        passwordError.innerHTML = "Password must contain an UpperCase !";
        isValid = false;
    }
    else if(!/[a-z]/.test(password))
    {
        passwordError.innerHTML = "Password must contain an LowerCase !";
        isValid = false;
    } else 
    {
        passwordError.innerHTML = "";
    } */

    return isValid;
}
function togglePasswordVisibility() {
    console.log("hello yosra");
    var passwordInput = document.getElementById('password');
    var icon = document.querySelector('.toggle-password i');

   if (passwordInput.type === "password") {
    passwordInput.type = "text";
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
    } else {
    passwordInput.type = "password";
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
        }
    }
