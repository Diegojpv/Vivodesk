// ===================================== Inventory JS ===================================== //
// this file contains all the JavaScript logic for managing the inventory system,
// including adding, selling, deleting, and editing items, as well as searching through the inventory.

// ----------------------------------- Add Item Logic ----------------------------------- //
const addItemForm = document.getElementById('add-item-form');

addItemForm.addEventListener('submit', function(event) {
    event.preventDefault();
    // Add item submission logic here
    const formData = new FormData(addItemForm);
    formData.append('addItem', 'true');
    fetch('../../src/inventory/addItem.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success-item-added") {
            alert("Item added successfully!");
            window.location.reload();
        } else {
            alert("Unexpected response: " + data);
        }
    });
});

// ----------------------------------- Sell Item Logic ----------------------------------- //

const sellItemForms = document.querySelectorAll('.sell-item-form');

sellItemForms.forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const itemId = form.querySelector('input[name="item_id"]').value;
        const sellQuantity = parseInt(form.querySelector('input[name="sellQuantity"]').value);
        const buyerName = form.querySelector('input[name="buyerName"]').value.trim();
        const availableStock = parseInt(form.querySelector('input[name="availableStock"]').value);
        const itemPrice = parseFloat(form.querySelector('input[name="itemPrice"]').value);

        if (sellQuantity <= 0 || isNaN(sellQuantity)) {
            alert('Please enter a valid quantity to sell.');
            return;
        } else if (sellQuantity > availableStock) {
            alert('Insufficient stock available.');
            return;
        } else if (buyerName.length === 0) {
            alert('Please enter the buyer\'s name.');
            return;
        }
        // Add sell item submission logic here
        const formData = new FormData(form);
        formData.append('sellItem', 'true');
        fetch('../../src/inventory/sellItem.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === "success-item-sold") {
                alert("Item sold successfully!");
                window.location.reload();
            } else {
                alert("Unexpected response: " + data);
            }
        });
    });
});

// ----------------------------------- Delete Item Logic ----------------------------------- 

function deleteInventoryItem(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        const formData = new FormData();
        formData.append('item_id', itemId);
        formData.append('deleteItem', 'true');
        fetch('../../src/inventory/deleteItem.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === "success-item-deleted") {
                alert("Item deleted successfully!");
                window.location.reload();
            } else {
                alert("Unexpected response: " + data);
            }
        });
    }
}

// ----------------------------------- Edit Item Logic ----------------------------------- //
const editItemToggle = document.querySelectorAll('.edit-item-checkbox');

editItemToggle.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
    const editForm = checkbox.closest('.inventory-item-card');
    const editItemInputs = editForm.querySelectorAll('.item-card--stock, .item-card--price, .item-card--description');
    if (this.checked){
        editItemInputs.forEach(inputs => inputs.readOnly = false)
    } else {
        editItemInputs.forEach(inputs => inputs.readOnly = true)
    }
    });
});

// We handle the form submission to save the edited item data.
const editItemForm = document.querySelectorAll('.item-info-form');

editItemForm.forEach(form => {
    form.addEventListener('submit', (event) => {
    event.preventDefault();
    const itemId = form.querySelector('.item-card--id').value;
    const inputEditStock = form.querySelector('.item-card--stock').value;
    const inputEditPrice = form.querySelector('.item-card--price').value;
    const inputEditDescription = form.querySelector('.item-card--description').value;

    if (isNaN(inputEditStock) || parseInt(inputEditStock) < 0) {
        alert('Please enter a valid stock quantity (0 or more).');
        return;
    }

    if (isNaN(inputEditPrice) || parseFloat(inputEditPrice) < 0) {
        alert('Please enter a valid price (0 or more).');
        return;
    }

    const formData = new FormData(form);
    formData.append('editItem', 'true');
    fetch('../../src/inventory/editItem.php', {
        method: 'POST',
        body: formData
    }) .then (response => response.text())
        .then (data => {
        if (data === 'success-item-updated') {
            alert('Item updated successfully!');
            window.location.reload();
        } else {
            alert('Unexpected response: ' + data);
        }
    });
})
});

// =================================== Search Items Logic =================================== //
const searchInput = document.getElementById('search-input');

searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase();
    const itemCards = document.querySelectorAll('.inventory-item-card');
    itemCards.forEach(card => {
        const itemName = card.querySelector('.item-card--name').textContent.toLowerCase();
        if (itemName.includes(query)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});