# itp303-projects

A collection of web development projects completed for ITP 303 (Full-Stack Web Development). Projects progress from static HTML/CSS pages to dynamic PHP-driven web applications with database integration.

---

## Repository Structure

### `assignment_01` — HTML Resume
A personal resume built in pure HTML. Covers basic document structure, semantic elements, and content organization.

- `resume.html` — Static resume page

---

### `assignment_02` — Personal Interest Page
A simple single-page website about a personal interest, built with HTML.

- `interest.html` — Static interest/hobby page

---

### `assignment_03` — Styled Pages with CSS & Custom Font
Expands on the interest page with shared CSS styling and a photo gallery. Introduces a custom font and a separate stylesheet applied across multiple pages.

- `interest.html` — Interest page with applied styles
- `gallery.html` — Photo gallery page
- `shared.css` — Shared stylesheet used across both pages
- `fonts/raindrops.ttf` — Custom font used in the design

---

### `assignment_04` — CSS Layout & Styling
Further styling of the interest page, focused on CSS layout techniques.

- `interest.html` — Interest page with more advanced CSS styling

---

### `assignment_05` — HTML Form
A standalone HTML form page, covering form elements, input types, labels, and basic form structure.

- `form.html` — HTML form with various input fields

---

### `assignment_06` — Bootstrap Page (Paris)
A multi-section webpage built using Bootstrap, featuring icon fonts from the Open Iconic library. The Paris theme suggests a travel or informational layout.

- `paris1.html` — Bootstrap-styled page
- `lib/font/` — Open Iconic icon font assets (CSS + font files)

---

### `assignment_07` — Movie Page
A styled webpage about a movie, likely using Bootstrap or custom CSS for layout and design.

- `movie.html` — Movie information/showcase page

---

### `assignment_10` — PHP CRUD Application
A full PHP web application implementing Create, Read, Update, and Delete (CRUD) operations, likely backed by a MySQL database. Covers form handling, server-side logic, and multi-page PHP workflows.

- `main.php` — Main landing/listing page
- `add_form.php` — Form to add a new record
- `add_confirmation.php` — Confirmation page after adding
- `edit_form.php` — Form to edit an existing record
- `edit_confirmation.php` — Confirmation page after editing
- `delete.php` — Handles record deletion
- `details.php` — Displays details for a single record
- `search_form.php` — Search input form
- `search_results.php` — Displays filtered search results

---

### `assignment_m1` — Milestone 1: Site Proposal
A mockup/proposal for the final project site, presenting the planned layout and design through static images.

- `proposal.html` — Project proposal page
- `img/` — Mockup screenshots (Page1–4) and a color palette reference image

---

### `assignment_m2` — Milestone 2: Static Site Mockup
Static HTML/CSS mockups for the final project's front-end, including a shop, cart, and login page.

- `shop.html` — Product listing page mockup
- `cart.html` — Shopping cart page mockup
- `login.html` — Login page mockup
- `shared.css` — Shared stylesheet across all mockup pages

---

### `final_project` — Full-Stack Pet Shop
A complete full-stack web application for a pet shop. Users can browse pets, add them to a cart, and log in. Admins can add, edit, and remove pet listings. Backed by a MySQL database.

- `shop.php` — Main product listing page (dynamic, pulls from DB)
- `login.php / logout.php` — User authentication
- `add_pet.php` — Form and logic to add a new pet listing
- `edit_pet.php` — Edit an existing pet listing
- `edit_confirmation.php` — Confirmation after editing
- `remove_pet.php` — Deletes a pet listing
- `cart.html` — Shopping cart page
- `about.html` — About page
- `shared.css` — Sitewide stylesheet
- `kdvasque_pets_db (1).sql` — MySQL database schema and seed data
- `img/db.jpeg` — Supporting image asset
