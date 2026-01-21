// ================================= PROFILE.JS =================================
// This file contains the JavaScript logic for the profile management page, including input validation, user data updates, account deletion, and logout functionality.

// --------------------------------- INPUT VALIDATION ---------------------------------

const usernameInput = document.getElementById('updateUser');

    usernameInput.addEventListener('input', function() {
    this.value = this.value.replace(/\s/g, '');
});

// --------------------------------- UPDATE USER LOGIC ---------------------------------
const save = document.getElementById('save');
const updateForm = document.getElementById('profileForm');

save.addEventListener('click', (event) => {
    event.preventDefault();
    // We obtain the default values and the changed values to compare them, and if they are the same, we avoid an unnecessary request. 
    const sameUser = document.getElementById('updateUser').defaultValue;
    const updateUser = document.getElementById('updateUser').value;

    const sameRole = document.getElementById('role').defaultValue;
    const role = document.getElementById('role').value;

    const sameBusiness = document.getElementById('business').defaultValue;
    const business = document.getElementById('business').value;

    if( updateUser == sameUser && role == sameRole && business == sameBusiness ){
        alert('Dont exist changes');
        return;
    }

    if (updateUser.length > 25) {
        alert('Username must be 25 characters or less.');
        return;
    }

    if (role.length > 60 || business.length > 60){
        alert('Role and Business must be 60 characters or less.');
        return;
    }
    // If validation passes, we proceed to send the data to the server.
    const updateData = new FormData(updateForm);
        fetch("../../src/updateUser.php",{
            method: 'POST',
            body: updateData
        }) 
        .then(response => response.text())
        .then(data => { // We handle the server response accordingly.
            if (data.trim() == "update-success") {
                alert('Datos guardados con exito')
                window.location.reload()
            } else if (data.trim() == "update-error"){
                alert('Error al guardar datos')
            } else if (data.trim() == "invalid-request"){
                alert('Solicitud invalida')
            } else if (data.trim() == "user-exists"){
                alert('El nombre de usuario ya existe')
            } else if (data.trim().startsWith("Error: ")){
                alert(data.trim());
            }
        }); 
});

// --------------------------------- DELETE ACCOUNT LOGIC ---------------------------------

const deleteAccountBtn = document.getElementById('delete');

deleteAccountBtn.addEventListener('click', (event) => {
    event.preventDefault();
    // Confirmation dialog before proceeding with account deletion.
    if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        const deleteData = new FormData(updateForm);
        // We append a 'delete' parameter to indicate the deletion request.
        deleteData.append('delete', 'true');
        fetch("../../src/delete.php", {
            method: 'POST',
            body: deleteData
        }) .then(response => response.text()) // We handle the server response.
        .then(data => { // We handle the server response accordingly.
            if(data.trim() == "delete-success"){
                alert("Usuario borrado")
                window.location.href = "../index.php"
            } else if (data.trim() == "delete-error"){
                alert("Error al eliminar")
            } else if(data.trim() == "invalid-request") {
                alert("Solicitud invalida")
            } else if (data.trim().startsWith("Error: ")){
                alert(data.trim())
            }
        })
    }
});

// --------------------------------- LOGOUT LOGIC ---------------------------------

const logoutBtn = document.getElementById('logout');
// We add an event detector to the button to send it to the file containing the logout logic.
logoutBtn.addEventListener('click', (event) => {
    event.preventDefault();
    if (confirm('Are you sure you want to logout?')) {
        window.location.href = "../../src/logout.php";
    }
});