# 🐾 Pawleeze — Pet Adoption Site

> **Course:** ITP 303 — Full Stack Web Development  
> **Repo:** [kdvasquez/itp303-projects](https://github.com/kdvasquez/itp303-projects)  
> **Status:** ✅ Complete

Hello! Welcome to the documentation for my first Full Stack project, Pawleeze — a pet adoption site that brings together the new technologies I picked up in my Full Stack Web Development class.

---

## 📋 Table of Contents
1. [Problem & Solution](#problem--solution)
2. [Architecture Overview](#architecture-overview)
3. [Database Design](#database-design)
4. [Core Features](#core-features)
5. [How to Run](#how-to-run)
6. [What I Learned](#what-i-learned)
7. [Future Enhancements](#future-enhancements)

---

## Problem & Solution

**Problem:** Pet lovers need a lightweight system that lists adoptable pets and allows prospective adopters to express interest.

**Solution:** Pawleeze is a pet adoption site for dog and cat lovers. Users can log in, browse adoptable pets, add them to a cart, submit new pets for listing, and edit or remove them from the system.

---

## Architecture Overview

**Key Files:** `login.php`, `shop.php`, `add_pet.php`, `remove_pet.php`, `cart.html`, `edit_pet.php`, `edit_confirmation.php`, `logout.php`

```
root/
├── public/
│   ├── login.php
│   ├── shop.php
│   ├── cart.html
│   ├── edit_pet.php
│   ├── edit_confirmation.php
│   ├── logout.php
│   ├── shared.css
│   ├── about.html
│   └── img/
└── kdvasquez_pets_db.sql
```

---

## Database Design

Source data includes 20 preloaded pets and user-submitted entries.

<img width="2827" height="1237" alt="Image" src="https://github.com/user-attachments/assets/e5d872b5-70db-4a04-a2a0-5c2e0d3a798f" />

---

## Core Features

### 5.1 Login with Session Handling
<img width="617" height="322" alt="Image" src="https://github.com/user-attachments/assets/1aa18fde-9176-4ddd-b008-bd2166a79371" />
Login Page

```php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('Location: shop.php');
    exit();
}
if ($_POST['inputName'] == 'Susie' && ...) {
    $_SESSION['logged_in'] = true;
    $_SESSION['inputName'] = $_POST['inputName'];
    header('Location: shop.php');
    exit();
}
```

→ Sessions track login state and display the username across pages. Unauthorized users cannot access `shop.php` without logging in.

---

### 5.2 Form Validation (Client-Side)

Form fields are validated in JavaScript before submission:

```javascript
const regexName = /^[A-Z][a-z]*$/
const EMAIL_REGEX = /^(([^<>()[\]\\.,;:\s@"]+...)\.[a-zA-Z]{2,})$/

if (!regexName.test(name)) showError("Invalid First Name")
if (!email.endsWith("usc.edu")) showError("Must be USC email")
```

→ Client-side validation improves UX and mirrors back-end checks.

---

### 5.3 How to Navigate Pawleeze

- User **"Susie Poodle"** logs in via `login.php`
- Redirected to `shop.php` — the main gallery listing all pets
- Pets display as cards with image, details, and add/remove buttons
- Users can:
  - Add a pet to cart (JavaScript DOM manipulation)
  - Remove a pet from cart
  - Submit a new pet via form on the left column (AJAX + PHP)
  - Edit or delete submitted pets (AJAX for remove)
  - Navigate to `cart.html` and rename a pet before adoption
  - Click **"Adopt Now!"** to complete the flow and return to login
 
<img width="638" height="362" alt="Image" src="https://github.com/user-attachments/assets/7623409f-1019-4fb0-a63a-35f8d2dbde6b" />
Susie’s View Upon Successful Log In


<img width="650" height="345" alt="Image" src="https://github.com/user-attachments/assets/ecc0e487-3846-4674-9c36-1585c90f1ff3" />
Guest User View Without Logging In


---

### 5.4 Adding Pets via Form (AJAX)

The form on the left side of `shop.php` lets users submit pets for adoption. Breed, Gender, and Type options are dynamically populated from the database.

```javascript
document.getElementById('addPet').addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    fetch('add_pet.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('Added Pet, Yay');
        document.getElementById('addPet').reset();
    });
});
```

Server logic in `add_pet.php`:

```php
$name     = $_POST['inputName'];
$breed_id = $_POST['inputBreed'];
$sql = "INSERT INTO pets (pet_name, breed_id, gender_id, age, type_id)
        VALUES ('$name', '$breed_id', '$gender_id', '$age', '$type_id')";
```
<img width="629" height="337" alt="Image" src="https://github.com/user-attachments/assets/30016a24-dcdb-4992-a847-e583654026f2" />
Adoption Form to Add “Lilo” to Cart


<img width="622" height="244" alt="Image" src="https://github.com/user-attachments/assets/8eedaab9-9a96-4e78-8c08-7d296a1b68d2" />
“Lilo” Pet Added to Database and onto Gallery

---

### 5.5 Dynamic DOM Updates (Gallery)

Newly added pets are rendered dynamically on the page without a full reload. JavaScript builds the gallery card with name, image, and control buttons.

---

### 5.6 Cart Functionality

- Clicking **"Add to Cart"** clones a template into the cart list
- Cart data is persisted in `localStorage`
- Items can be removed or renamed before checkout

```javascript
clone.querySelector('.remove-btn').addEventListener('click', function(event) {
    cartItems.splice(index, 1);
    updateLocalStorage(cartItems);
    event.target.closest('li').remove();
});
```

→ Clicking **"Adopt Now!"** redirects back to `login.php` with a confirmation message.
On `login.php`, PHP starts a session and checks login credentials against hardcoded demo values.
<img width="630" height="327" alt="Image" src="https://github.com/user-attachments/assets/e80e3a1a-0c45-4092-ad29-35a7e1d4e0ef" />
Susie’s Cart View

---

### 5.7 Removing a Pet (AJAX)

When clicking "Remove", JavaScript sends a request to `remove_pet.php` to delete the pet from the database:

```javascript
let formData = new FormData();
formData.append('pet_name', petName);
fetch('remove_pet.php', {
    method: 'POST',
    body: formData
});
```

Server logic:

```php
$sql = "DELETE FROM pets WHERE pet_name = '$petName'";
```

---

### 5.8 Editing a Pet (`edit_pet.php`)

- Redirects to error page if user is not logged in or `pet_id` is missing
- Retrieves existing pet details from the database via GET parameter
- Displays a Bootstrap form pre-filled with current pet data

```php
$sql = "SELECT * FROM pets WHERE pet_id = $pet_id";
// ...
<input type="text" name="inputName" value="<?php echo $pet['name']; ?>">
```

---

### 5.9 Updating a Pet (`edit_confirmation.php`)

- Accepts POST data from the edit form
- Validates all required fields: name, breed, gender, type, and optionally age
- Performs an UPDATE query using the provided `pet_id`

```php
$sql = "UPDATE pets
        SET name = '$pet_name',
            breed_id = $breed_id,
            gender_id = $gender_id,
            age = $age,
            type_id = $type_id
        WHERE pet_id = $pet_id;";
```

→ Empty fields trigger a server-side error message.

---

### 5.10 Logging Out

`logout.php` destroys the PHP session and shows a confirmation message:

```php
session_start();
session_destroy();
```

→ Clears all session data and provides links to return to login or shop.

---

## How to Run

1. Clone the repo:
```bash
git clone https://github.com/kdvasquez/itp303-projects.git
cd itp303-projects/final_project
```

2. Import the database:
```bash
mysql -u root -p < kdvasquez_pets_db.sql
```

3. Update database credentials in your PHP files if needed

4. Serve with a local PHP server (e.g. XAMPP, MAMP, or PHP built-in):
```bash
php -S localhost:8000 -t public/
```

5. Open `http://localhost:8000/login.php` and log in as:
   - **Username:** Susie
   - **Password:** *(as configured in login.php)*

---

## What I Learned

| Concept | Explanation |
|---|---|
| **POST & GET** | HTTP methods to send data: GET retrieves data, POST sends data securely in the request body |
| **Sessions** | Server-side variables that persist across page loads — used for login state via `session_start()` and `$_SESSION` |
| **AJAX** | JavaScript's way of making async HTTP requests via `fetch()`, letting pages update content without reloading |
| **SQL** | Structured query language to store, query, and update pet data — includes SELECT, INSERT, UPDATE, DELETE |
| **CRUD** | Create, Read, Update, Delete — core database operations implemented across the app |
| **Form Validation** | Both client-side (JavaScript) and server-side (PHP) checks to ensure input is valid and secure |
| **LocalStorage** | Browser storage to persist cart data across page reloads |
| **Bootstrap** | CSS framework for responsive, mobile-friendly layouts and forms with minimal custom CSS |

---

## Future Enhancements

- [ ] Database-authenticated login
- [ ] Image uploads for new pets
- [ ] Email confirmation for adoption
- [ ] Admin dashboard for review and moderation
- [ ] Use `pet_id` instead of `pet_name` for all database operations (more reliable)

---

*Thanks for taking the time to read the documentation for Pawleeze! Have a great day. 🐶🐱*
