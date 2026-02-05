# Vivodesk - Practical CRM in PHP | JS | HTML | CSS | MySQL

Vivodesk is an open-source project in development that aims to implement a **useful and customizable CRM** using **PHP** and **MySQL**.  
The goal is to learn about servers, databases, and web development while providing the community with a base project that anyone can improve or adapt to their needs.

> ⚠️ Note: The code can be modified and reused freely, but **it cannot be sold**.  
> For any commercial use, terms must be agreed directly with the author.

---

## 📂 Project Structure

- **public/**
  - `index.php` → Main page (home page).
  - **workdesk/** → Folder containing each of the php files for the workdesk sections.
    - `clients.php` → File with the structure of the customer department
    - `navbar.php` → Navigation structure on the workdesk
    - `profile.php` → Structure of the section to modify the user
    - `welcome.php` → Welcome page to the workdesk
    - `inventory.php` → File containing the inventory system structure
  - **assets/**
    - **css/**
      - `clients.css` → Styles for the customer section 
      - `index.css` → Styles for the home page.
      - `fonts.css` → Font imports.
      - `navbar.css` → Styles for navigating in the workdesk
      - `profile.css` → Styles for user personalization page
      - `welcome.css` → Styles for the welcome page
      - `inventory.css` → Styles for the inventory page
    - **js/**
      - `index.js` → Logic for visual effects and home page buttons.
      -`clients.js` → Logic for customer management and section features
      -`form.js` → Logic for user registration forms
      -`profile.js` → Logic for updating user data
      -`inventory.js` → Logic for sending forms and editing inventory data
    - **fonts/** → Fonts used in the project.
    - **images/** → Graphic resources for the home page.

- **src/**
  - **clients/**
    - `addClient.php` → Add clients to the database 
    - `editClient.php` → Edit customer data in the database
    -`deleteClient.php` → Delete the customer from the database
  - **inventory/**
    - `addItem.php` → Add products to the database
    - `deleteItem.php` → Delete the products from the database
    - `editItem.php` → Edit products data in the database
    - `sellItem.php` →  Add the sales data to the sales table in the database.
  - `db.php` → Database connection using PDO (MySQL).
  - `logout.php` → Logout logic.
  - `verification.php` → Access verification for the dashboard (This file has been modified to improve security.).
  - `users.php` → Logic for login and account creation.
  - `delete.php` → Contains the deletion of user data from the database.
  - `updateUser.php` → Change the user data in the database with the new entries in the profile section.

---

## ⚙️ Requirements

- PHP >= 7.4  
- MySQL  
- Local server (XAMPP recommended)  
- JavaScript for interface logic and effects

---

## 🚀 Current status

- Account system implemented (registration, login, access verification, logout).
- Home page with basic styles, fonts, and visual effects.
- Functional dashboard for the work desktop
- User update system implemented (change name, delete user, assign roles and data)
- Customer system implemented (add customers, assign information to each customer)
- Complete and functional inventory system
- Sales records for your products

---

## 🔮 Upcoming updates

- Services system.  
- Service assignment.  
- Improvements in security and scalability.
-  Improvements in the visual section and better responsive design
- Notifications

---

## 🔄 Versions 

- Vivodesk V0.7 (Current)
- Vivodesk V0.4 
- Vivodesk V0.1

---

## 🤝 Contributions

This project is open to the community.  
If you want to help improve the code, add new features, or adapt it to your needs, you are welcome!  
You can submit **pull requests** or open **issues** for suggestions.

---

## 📜 License

This project is distributed under a custom license:

- You may use, modify, and share the code freely for personal, educational, or community purposes.  
- **Selling or using it for commercial purposes without prior authorization from the author is not allowed.**  
- For commercial use, please contact the author to agree on terms.  
- The software is provided *“as is”*, without any warranty of any kind.  

© 2026 Diegojpv - Vivodesk
