let errorMessage = "";
function validateForm(number) {
    const formName = document.getElementsByName(`form_${number}`);

    let emailError = validateEmail(number);
    if(!emailError){
        errorMessage = "Invalid email address.";
    }

    let passwordError = validatePassword();
    if(!passwordError){
        errorMessage = "Password must be at least 6 characters.";
    }

    if(!emailError && passwordError){
        formName.submit();
    }else{
        alert(errorMessage);
    }

}

function validateEmail(number){
    const formName = document.getElementsByName(`form_${number}`);
    const email = document.getElementById("email").value;
    var emailAddress = formName.email.value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    var valid = emailAddress.search(emailPattern);
    // Validate email
    if(valid != 0){
        return false;
    }else{
        return true;
    }
}

function validatePassword(){
    // Validate password
    const password = document.getElementById("password").value;
    if (password.length < 6) {
        return false;
    }else{
        return true;
    }
}