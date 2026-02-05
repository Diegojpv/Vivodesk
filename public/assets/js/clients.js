// ================================= Clients Section JS ================================= //
// Here you will find the logic for the customer section features. 

// ------------------------ Add client form functionality ------------------------ //
const inputPhone = document.querySelector('input[name="clientPhone"]');
const inputEmail = document.querySelector('input[name="clientEmail"]'); 
const inputName = document.querySelector('input[name="clientName"]');
// Prevent letters in phone input
inputPhone.addEventListener('input', (event) => {
    event.target.value = event.target.value.replace(/[a-zA-Z]/g, '');
});

    const addClientForm = document.getElementById('add-client-form');
    addClientForm.addEventListener('submit', (event) => {
    event.preventDefault();
    if (inputPhone.value.length > 20 ) {
        alert('Please enter a valid phone number with fewer than 20 digits.');
        return;
    }

    if (inputEmail.value.length > 100 ) {
        alert('Please enter a valid email address with fewer than 100 characters.');
        return;
    }

    if (inputName.value.length > 80 ) {
        alert('Please enter a valid name with fewer than 80 characters.');
        return;
    }
    // Submit the form data via Fetch API
    const formData = new FormData(addClientForm);
    formData.append('addClient', 'true');
    fetch('../../src/clients/addClient.php', {
        method: 'POST',
        body: formData
    }) .then (response => response.text())
        .then (data => {
        if (data === 'success-client-added') {
            alert('Client added successfully!');
            window.location.reload();
        } else {
            alert('Error adding client: ' + data);
        }
    });
});

// -----------------------------------  Expand client details ----------------------------------- //
const detailToggles = document.querySelectorAll('.details-toggle');
// We assign a function to the checkbox that inserts a class into the customer card being selected so that we can style it in CSS and display more information.
detailToggles.forEach(toggle => {
    toggle.addEventListener('change', function(event) {
        const clientCard = this.closest('.client-card');

        if (this.checked) {
            clientCard.classList.add('client-card__expanded');
        } else {
            clientCard.classList.remove('client-card__expanded');
            editToggles.forEach(editToggle => {
                editToggle.checked = false;
            })
        }
    });
});

// ----------------------------------- Search clients functionality ----------------------------------- //
const inputSearch = document.getElementById('search');

// We detect when a word is typed in the input and execute the function.
inputSearch.addEventListener('keyup', function(event) {
    const clientCards = document.querySelectorAll('.client-card');
    // We get the value typed and convert it to lowercase to make the search case insensitive.
    const searchTerm = event.target.value.toLowerCase();
    // We go through all the client cards and check if the name contains the search term.
    clientCards.forEach(function(card) {
        const clientName = card.querySelector('.card--content input[name="clientName"]').value.toLowerCase();
        // If it contains it, we show the card; if not, we hide it.
        if (clientName.includes(searchTerm)) {
            card.style.display = 'flex'; 
        } else {
            card.style.display = 'none';
        }
    });
});

// ------------------------------------- Address textarea scroll ----------------------------------- //

// Prevent Enter key from creating new lines in address textareas

const addressTextarea = document.querySelectorAll('.client-card__address');
addressTextarea.forEach(textarea => {
textarea.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});
});

const formAddressTextarea = document.querySelector('.form-client__address');
formAddressTextarea.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});

// ------------------------------------- Edit client functionality ----------------------------------- //
const editToggles = document.querySelectorAll('.edit-toggle');
const editClientInputs = document.querySelectorAll('.card--content input, .card--content textarea');

// We assign a function to the checkbox that enables the input fields for editing.

editToggles.forEach(toggle => {
    toggle.addEventListener('change', function(event) {
    if (this.checked) {
        editClientInputs.forEach(input => input.readOnly = false);
    } else {
        editClientInputs.forEach(input => input.readOnly = true);
    }
});
});

// We handle the form submission to save the edited client data.
const editPhone = document.querySelectorAll('input[name="clientPhone"]');
 const editClientForm = document.querySelectorAll('.card--content');

    editPhone.forEach(input => {
        input.addEventListener('input', (event) => {
        event.target.value = event.target.value.replace(/[a-zA-Z]/g, '');
    });
});

editClientForm.forEach(form => {
    form.addEventListener('submit', (event) => {
    event.preventDefault();

    const inputEditName = form.querySelector('.client-card__name').value;
    const inputEditPhone = form.querySelector('.client-card__phone').value;
    const inputEditEmail = form.querySelector('.client-card__email').value;

    if (inputEditPhone.length > 20 ) {
        alert('Please enter a valid phone number with fewer than 20 digits.');
        return;
    }

    if (inputEditEmail.length > 100 ) {
        alert('Please enter a valid email address with fewer than 100 characters.');
        return;
    }

    if (inputEditName.length > 80 ) {
        alert('Please enter a valid name with fewer than 80 characters.');
        return;
    }

    const formData = new FormData(form);
    formData.append('editClient', 'true');
    fetch('../../src/clients/editClient.php', {
        method: 'POST',
        body: formData
    }) .then (response => response.text())
        .then (data => {
        if (data === 'success-client-updated') {
            alert('Client updated successfully!');
            window.location.reload();
        } else {
            alert('Error updating client: ' + data);
        }
    });
});
});

// ------------------------------------- Delete client functionality ----------------------------------- //
function deleteClient(clientId) {
    if (confirm('Are you sure you want to delete this client? This action cannot be undone.')) {
        let deleteUrl = `../../src/clients/deleteClient.php?clientId=${clientId}`;
        fetch(deleteUrl, {
            method: 'GET'
    }) .then (response => response.text())
        .then (data => {
        if (data === 'success-client-deleted') {
            alert('Client deleted successfully!');
            window.location.reload();
        } else {
            alert('Error deleting client: ' + data);
        }
    });
}
}
