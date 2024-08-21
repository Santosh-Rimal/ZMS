// document.addEventListener("DOMContentLoaded", function() {

    //   var form = document.getElementById("myForm");

    //   // Validate email
    //   var emailInput = document.querySelector("input[name='email']");
    //   emailInput.addEventListener("input", function() {
    //     var emailRegex = /^[a-zA-Z0-9]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
    //     if (emailRegex.test(emailInput.value)) {
    //       emailInput.style.borderColor = "green";
    //       document.getElementById('email').innerHTML="";
    //     } else {
    //       emailInput.style.borderColor = "red";
    //       document.getElementById('email').innerHTML="Email is not valid";
    //     }
    //   });

    //   var password = document.querySelector("input[name='password']");
    //   password.addEventListener("input", function() {
    //     if (password.value.length>=8) {
    //       password.style.borderColor = "green";
    //       document.getElementById('password').innerHTML="";
    //     } else {
    //       password.style.borderColor = "red";
    //       document.getElementById('password').innerHTML="Password should contain at least 8 charater";
    //     }
    //   });

    //   // Form submission event
    //   form.addEventListener("submit", function(e) {
    //     if (
    //       emailInput.style.borderColor === "red" ||
    //       phoneInput.style.borderColor === "red" ||
    //       password.style.borderColor === "red" ||
    //       cpassword.style.borderColor === "red" ||
    //       addressInput.style.borderColor === "red"
    //     ) {
    //       e.preventDefault();  // Stop the form from submitting
    //       alert("Please correct the highlighted fields before submitting.");
    //     }
    //   });

    // });


{/* // function validateForm() { */}
//     var nameInput = document.getElementById('name');
//     var emailInput = document.getElementById('email');
//     var passwordInput = document.getElementById('password');
//     var confirmPasswordInput = document.getElementById('cpassword');
    
//     var name = nameInput.value.trim();
//     var email = emailInput.value.trim();
//     var password = passwordInput.value;
//     var confirmPassword = confirmPasswordInput.value;
    
//     // Reset previous error messages
//     nameInput.setCustomValidity('');
//     emailInput.setCustomValidity('');
//     passwordInput.setCustomValidity('');
//     confirmPasswordInput.setCustomValidity('');

//     // Validate name (at least 4 characters and only letters)
//     if (name.length < 4 || !/^[a-zA-Z]+$/.test(name)) {
//         nameInput.setCustomValidity('Name should be at least 4 characters long and contain only letters.');
//     }

//     // Validate email (custom pattern)
//     var emailPattern = /^[^\s@-][^\s@]*@[^\s@]+\.[^\s@]+$/;
//     if (!emailPattern.test(email)) {
//         emailInput.setCustomValidity('Invalid email format.');
//     }

//     // Validate password (at least 6 characters)
//     if (password.length < 6) {
//         passwordInput.setCustomValidity('Password must be at least 6 characters long.');
//     }

//     // Validate confirm password (matches password)
//     if (confirmPassword !== password) {
//         confirmPasswordInput.setCustomValidity('Passwords do not match.');
//     }
// } script