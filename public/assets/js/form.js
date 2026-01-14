// ============================ Javascript code for form handling ============================

// This script handles the login and new user registration forms, including input validation and communication with the server via fetch API. 


const input = document.querySelectorAll('.form-input > input');

// Remove spaces from input fields
input.forEach(inputElement => {
    inputElement.addEventListener('input', function() {
        this.value = this.value.replace(/\s/g, '');
    });
});

// ============================ Login form handling ============================

const logInButton = document.getElementById('log-in__button');
const formLogIn = document.getElementById('form__log-in');

logInButton.addEventListener('click', function(event) {
    event.preventDefault();

    // we assign constants to the values entered in the inputs
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if(username == "" || password == "") {
        alert('Please fill in all fields.');
        return;
    }

    // we create a FormData object to send the data to the server
    const keepSignedIn = document.getElementById('log-in__signed-in').checked;
    const logInData = new FormData(formLogIn);
    // We append the function name and the keep-signed-in value to the FormData object
    logInData.append('function', 'logInUser');
    logInData.append('keep-signed-in', keepSignedIn);

    fetch("../src/users.php",{ 
        method: 'POST', 
        body: logInData
    })
    // We receive the fetch promise and process it into text.
    .then(response => response.text())
    // with data we verify what is printed in the php and show the corresponding alert.
    .then(data => {
        if(data.trim() === 'success') {
            alert('Login successful!');
            window.location.reload();
        } else if (data.trim() === 'incorrect-pass') {
            alert('Login failed: Incorrect password.');
        } else if (data.trim() === 'already-logged') {
            alert('You cannot log in without first logging out of your current session.');
        }
        else {
            alert('Login failed: User does not exist.');
        }
    });
    // We reset the form after submission
    formLogIn.reset();
});

// ============================ New user registration form handling ============================

const newUserButton = document.getElementById('new-user__button');
const formNewUser = document.getElementById('form__new-user');

newUserButton.addEventListener('click', function(event) {
    event.preventDefault();

    const newUsername = document.getElementById('new-username').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (newUsername == "" || newPassword == "" || confirmPassword == "") {
        alert('Please fill in all fields.');
        return;
    }

    if (newUsername.length > 25) {
        alert('Username must be 25 characters or less.');
        return;
    }

        // We assign rules to the password for greater security.
    if (newPassword.length < 8 || newPassword.length > 128) {
        alert('Password must be between 8 and 128 characters.');
        return;
    }

    if (newPassword !== confirmPassword) {
        alert('Passwords do not match.');
        return;
    }

    // We create a FormData object to send the data to the server
    const newUserData = new FormData(formNewUser);
    newUserData.append('function', 'createNewUser');

    const keepSignedInNew = document.getElementById('create-user__signed-in').checked;
    newUserData.append('keep-signed-in', keepSignedInNew);

    // As with the login, we send the data to the server and wait for its response to process the result.
    fetch("../src/users.php", {
        method: 'POST',
        body: newUserData
    }) .then(response => response.text())
    .then(data => {
        if (data.trim() === 'success-create') {
            alert('User created successfully!');
            window.location.reload();
        } else if (data.trim() === 'user-exists') {
            alert('Username already exists.');
        } else if (data.trim() === 'already-logged') {
            alert('You cannot create a new user while logged in. Please log out first.');
        } 
        else {
            alert('User creation failed.');
        } 
    });
    formNewUser.reset();
});


