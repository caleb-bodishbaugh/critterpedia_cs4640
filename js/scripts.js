function setDefaultDateandTime() {
    // creating new Date object which is intialized to current date and time
    var date = new Date();
    // Sets date input to current date by default, user can change if they wish
    document.getElementById('inputDate').valueAsDate = date;
    
    // Date object contains time as well, looking for string of format "HH:MM" to feed to time input box
    var time = function(date) {
        var hour = date.getHours();
        var min = date.getMinutes();
    
        // properly format the hour and minute if one digit
        if (hour < 10) hour = '0' + hour; 
        if (min < 10) min = '0' + min;

        // add colon for proper formatting
        return hour + ":" + min;
    };

    // Sets time input to current time by default, user can change if they wish
    document.getElementById('inputTime').value = time(date);
}

function checkPatternUsername(str) { 
   // test if str matches the username pattern in the signup help text (4-16 characters, letters numbers only)
   var pattern = new RegExp("[0-9a-z]{4,16}");
   var match_test = pattern.test(str.toLowerCase());
   return match_test;
}

function checkPatternPassword(str) { 
   // test if str matches the password pattern in the signup help text (8-20 characters, letters numbers only)	
   var pattern = new RegExp("[0-9a-zA-Z]{8,20}");
   var match_test = pattern.test(str);
   return match_test;
}

function checkRegistration() {   
    /* var error_msg = ""; */
    var number_error = 0;
    

    var passwordsMatch = (str1, str2) => {
        return str1 === str2;
    }

    var username = document.getElementById("newUsername");      
    if (!checkPatternUsername(username.value)) {
        number_error++;
        document.getElementById("newUsername").value = username.value;
        document.getElementById("msg_usr").innerHTML = "Make sure your username meets the length requirements and does not contain any spaces or special characters!";
    }   
    else 
        document.getElementById("msg_usr").innerHTML = "";
     
    var password = document.getElementById("inputNewPassword");
    if (!checkPatternPassword(password.value)) {
        number_error++;
        document.getElementById("inputNewPassword").value = password.value;
        document.getElementById("msg_pwd").innerHTML = "Make sure your password meets the length requirements and does not contain any spaces or special characters!";
    }   
    else 
        document.getElementById("msg_pwd").innerHTML = "";  
    
    var confirm_password = document.getElementById("confirmPassword");
    if (!passwordsMatch(password.value, confirm_password.value)) {
        number_error++;
        document.getElementById("confirmPassword").value = confirm_password.value;
        document.getElementById("msg_pwd_confirm").innerHTML = "Make sure your passwords match!";
    }
    else 
        document.getElementById("msg_pwd_confirm").innerHTML = "";  


    if (number_error > 0)
    {
        /* document.getElementById("msg").innerHTML = "Please fix the following fields and submit again: " + error_msg; */
        return false;
    }
    else     // Data types and values are acceptable, format looks OK; form can be submitted.
        return true; 

}

function checkSearchName() {
    var msg = document.getElementById("msg_name");      
    if (this.value.length > 25)     	  
       msg.innerHTML = "Input too long";
    else
       msg.innerHTML = "";
}

function checkPassword() {
    var pwd = document.getElementById("inputPassword");
    if (pwd.value === "password123") {
        return true;
    }

    else {
        return false;
    }
}

function checkEmail() {
    var email = document.getElementById("inputEmail");
    if (email.value === "cbb3jn@virginia.edu") {
        return true;
    }

    else {
        email.value = email.value;
        return false;
    }
}

function validateLogin() {
    var msg = document.getElementById("msg_pwd");
    if (!checkEmail() || !checkPassword()) {
        msg.innerHTML = "Username or password is incorrect.";
        return false;
    }

    else {
        msg.innerHTML = "";
        return true;
    }
}