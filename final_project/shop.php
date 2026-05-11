<?php 
session_start();
$host = "303.itpwebdev.com";
$user = "kdvasque_db_user";
$pass = "ITP303SPRING!";
$db = "kdvasque_pets_db";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// Fetch breeds from the database
$breed_query = "SELECT * FROM breeds";
$breed_result = mysqli_query($conn, $breed_query);

// Fetch genders from the database
$gender_query = "SELECT * FROM genders";
$gender_result = mysqli_query($conn, $gender_query);

// Fetch types from the database
$type_query = "SELECT * FROM types";
$type_result = mysqli_query($conn, $type_query);

// Reset the data pointers for the result sets
mysqli_data_seek($breed_result, 0);
mysqli_data_seek($gender_result, 0);
mysqli_data_seek($type_result, 0);

// Check if the user is logged in and get their name
// $userName = isset($_SESSION['inputName']) ? $_SESSION['inputName'] : "";
if (isset($_SESSION['inputName'])) {
  $userName = $_SESSION['inputName'];
} else {
  $userName = ""; // or any default value you prefer
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Put up dogs or cats for adoption and adopt your own pet">
  <link rel="stylesheet" href="shared.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Adoption Site</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .gallery-item {
      width: calc(33.33% - 20px); /* Three columns with some margin between */
      margin: 10px;
    }
    .img-fluid {
        height: 300px;
        width: 300px;
    }
    .navbar{
      padding-bottom: 200px;
    }
    .navbar-nav .nav-link.active {
      font-weight: bold;
      color: yellow;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="login.php"><strong>Pawleeze</strong></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="shop.php"><strong>Shop</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.html"><strong>Cart</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html"><strong>About</strong></a>
          </li>
        </ul> 
      </div>
    </div>
  </nav> <!--.navbar-->

  <!-- Gallery -->
  <div class="container mt-4">
    <div class="row">
      <!-- User Profile -->
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">User Profile</h5>

            <?php if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) : ?>
              <a class="text-center p-2 ml-auto" href="login.php">Login</a>
              <?php echo "Want to log in?"; ?>

            <?php else : ?>               
            <p class="card-text">Welcome, <?php echo $userName; ?>!</p>
            <a class="text-center p-2 ml-auto" href="logout.php">Logout</a>
            <?php echo "Bye, world!"; ?>
            <?php endif; ?>
          </div>
        </div>
        <h2>My Cart</h2>
        <p>Click "Cart" on navbar to checkout! </p>
        <ul id="cart-items">
          <!-- Cart list will be displayed here -->
          <template id="cart-item-template">
            <li>Name: <span class="pet-name"></span>, Details: <span class="pet-details"></span>
                <button class="btn btn-danger btn-sm remove-btn">Remove</button>
            </li>
          </template>
        </ul>
        <hr>
        <h2>Up for Adoption</h2>
        <p>Have a pet you'd like someone to adopt? Fill out the form below to add to our database! </p>
        
        <form id="addPet">
          <div class="mb-2">
            <label for="inputName" class="col-sm-4 form-label">Name: </label>
            <input type="text" class="form-control mb-1" id="inputName" name="inputName" placeholder="Susana">

            <label for="inputBreed" class="col-sm-4 form-label">Breed: </label>
            <select id="inputBreed" name="inputBreed" class="form-select mb-1">
                <option value="">Select Breed</option>
                    <?php
                      // Loop through breed options
                      while ($row = mysqli_fetch_assoc($breed_result)) {
                        echo "<option value='" . $row['breed_id'] . "'>" . $row['breed'] . "</option>";
                      }
                    ?>
            </select>
            <!-- <input type="text" class="form-control mb-1" id="inputBreed" name="inputBreed" placeholder="Bulldog"> -->

            <label for="inputGender" class="col-sm-4 form-label">Gender: </label>
            <select id="inputGender" name="inputGender" class="form-select mb-1">
                  <option value="">Select Gender</option>
                  <?php 

                    //Loop through breed options 
                    while ($row = mysqli_fetch_assoc($gender_result)) {
                      echo "<option value='" . $row['gender_id'] . "'>" . $row['gender'] . "</option>";
                    }
                  ?>
            </select> 
            <!-- <input type="text" class="form-control mb-1" id="inputGender" name="inputGender" placeholder="Female"> -->
            <label for="inputAge" class="col-sm-4 form-label">Age: </label>
            <input type="text" class="form-control mb-1" id="inputAge" name="inputAge" placeholder="3">
            <label for="inputType" class="col-sm-4 form-label">Type: </label>
            <select id="inputType" name="inputType" class="form-select mb-1">
                  <option value="">Select Type</option>
                  <?php 

                    //Loop through breed options 
                    while ($row = mysqli_fetch_assoc($type_result)) {
                      echo "<option value='" . $row['type_id'] . "'>" . $row['type'] . "</option>";
                    }
                  ?>
            </select> 
          </div>
          <button type="submit">Add Pet</button>
        </form>
        <ul id="up-for-adoption">
      
        </ul>
        
      </div>
      <!-- Image Gallery -->
      <div class="col-lg-9">
        <div class="row">
          <!-- Hard-coded images -->
          <div class="col-md-4 gallery-item">
            <img src="https://i.pinimg.com/564x/92/2a/88/922a88894fb69ec8d6360931a767bc4b.jpg" alt="Pet 1" class="img-fluid">
              <ul>
                <li>Name: Conan</li>
                <li>Breed: Corgi</li>
                <li>Gender: Male </li>
                <li>Age: 3</li>
                <li>Type: Dog</li>
              </ul>
            

            <button onclick="addtoCart('Conan')" type="button" class="btn btn-primary">Add to Cart</button>
          </div>
          <div class="col-md-4 gallery-item">
            <img src="https://i.pinimg.com/564x/ee/2a/71/ee2a7149341c2b23ae2e9c7358ec247d.jpg" alt="Pet 2" class="img-fluid">
          
              <ul>
                <li>Name: Vannesa</li>
                <li>Breed: Ragdoll</li>
                <li>Gender: Female </li>
                <li>Age: 1</li>
                <li>Type: Cat</li>
              </ul>
            
            <button onclick="addtoCart('Vannesa')" type="button" class="btn btn-primary">Add to Cart</button>
          </div>
          <div class="col-md-4 gallery-item">
            <img src="https://i.pinimg.com/564x/d8/6d/0c/d86d0cfbfef122ad5c0f6e47a7544719.jpg" alt="Pet 3" class="img-fluid">
            
              <ul>
                <li>Name: Sandy</li>
                <li>Breed: Ragdoll</li>
                <li>Gender: Female </li>
                <li>Age: 7</li>
                <li>Type: Dog</li>
              </ul>
            
            <button onclick="addtoCart('Sandy')" type="button" class="btn btn-primary">Add to Cart</button>
          </div>
        </div>
        <div class="row">
            <div class="col-md-4 gallery-item">
                <img src="https://i.pinimg.com/564x/6f/fa/f8/6ffaf8c2710fd265371e38a6b5434540.jpg" alt="Pet 4" class="img-fluid">
                
                  <ul>
                    <li>Name: Tom</li>
                    <li>Breed: German Shepherd</li>
                    <li>Gender: Male</li>
                    <li>Age: 8</li>
                    <li>Type: Dog</li>
                </ul>
                
                <button onclick="addtoCart('Tom')" type="button" class="btn btn-primary">Add to Cart</button>
              </div>
              <div class="col-md-4 gallery-item">
                <img src="https://i.pinimg.com/564x/0d/4a/63/0d4a63bd814e28e9a855b45141b6f871.jpg" alt="Product 5" class="img-fluid">
                
                  <ul>
                    <li>Name: Ausie</li>
                    <li>Breed: Austrailian Shepherd</li>
                    <li>Gender: Male</li>
                    <li>Age: 10</li>
                    <li>Type: Dog</li>
                  </ul>
                
                <button onclick="addtoCart('Ausie')" type="button" class="btn btn-primary">Add to Cart</button>
              </div>
              <div class="col-md-4 gallery-item">
                <img src="https://i.pinimg.com/736x/2a/ae/09/2aae09cf42143bb1926502690e31b1b5.jpg" alt="Product 6" class="img-fluid">
                
                  <ul>
                    <li>Name: Cone</li>
                    <li>Breed: Exotic Shorthair</li>
                    <li>Gender: Male</li>
                    <li>Age: 7</li>
                    <li>Type: Cat</li>
                  </ul>
                
                <button onclick="addtoCart('Cone')" type="button" class="btn btn-primary">Add to Cart</button>
              </div>
        </div>

        <div class="row">
            <div class="col-md-4 gallery-item">
                <img src="https://i.pinimg.com/564x/d5/81/07/d581070b764525dffa93413e8a2ae486.jpg" alt="Product 7" class="img-fluid">
                <ul>
                    <li>Name: SuSu </li>
                    <li>Breed: Shih Tzu</li>
                    <li>Gender: Female</li>
                    <li>Age: 7</li>
                    <li>Type: Dog</li>
                </ul>
                
                <button onclick="addtoCart('SuSu')" type="button" class="btn btn-primary">Add to Cart</button>
              </div>
              <div class="col-md-4 gallery-item">
                <img src="https://i.pinimg.com/564x/62/50/1f/62501fd0365e2ab8abeb0347ad3800ed.jpg" alt="Product 8" class="img-fluid">
                
                  <ul>
                    <li>Name: Susie</li>
                    <li>Breed: Poodle</li>
                    <li>Gender: Female</li>
                    <li>Age: 7</li>
                    <li>Type: Dog</li>
                  </ul>
                
                <button onclick="addtoCart('Conan')" type="button" class="btn btn-primary">Add to Cart</button>
              </div>
              <div class="col-md-4 gallery-item">
                <img src="https://i.pinimg.com/564x/02/6a/ba/026aba80bd59772b67a514d9b9f5844a.jpg" alt="Product 9" class="img-fluid">
                
                  <ul>
                    <li>Name: Henry</li>
                    <li>Breed: Chihuahua, Dog</li>
                    <li>Gender: Male</li>
                    <li>Age: 7</li>
                    <li>Type: Dog </li>
                  </ul>
                
                <button onclick="addtoCart('Henry')" type="button" class="btn btn-primary">Add to Cart</button>
              </div>             
      </div>

    </div>
      
    </div> <!--.row-->
  </div> <!--.container-->
  
  <script>
    document.getElementById('addPet').addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    fetch('add_pet.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Log the response from add_pet.php
        alert('Added Pet, Yay');
        document.getElementById('addPet').reset(); // Reset the form
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

    document.getElementById('addPet').addEventListener('submit', function(event) {
      event.preventDefault()
      let name = document.getElementById('inputName').value 
      let breed = document.getElementById('inputBreed').value 
      let age = document.getElementById('inputAge').value 
      let gender = document.getElementById('inputGender').value 
      let type = document.getElementById('inputType').value 
    
      let newPet = {
        name: name,
        breed: breed, 
        gender: gender,
        age: age,  
        type: type 
      };
      addPettoGal(newPet);
      alert('Added Pet, Yay');
      document.getElementById('addPet').reset();

    });
    // <button onclick="removePet('${pet.name}')" type="button" class="btn btn-danger">Remove</button>

    function addPettoGal(pet) {
      let petMark = `
          <div class="col-md-4 gallery-item">
            <img src="https://i.pinimg.com/564x/1a/98/9f/1a989fdeb54d8a7ba2f412d67f73c8ef.jpg" alt="${pet.name}" class="img-fluid">
            <p> 
              <ul> 
              <li>Name: ${pet.name}</li>
              <li>Breed: ${pet.breed}</li>
              <li>Gender: ${pet.gender}</li>
              <li>Age: ${pet.age}</li>
              <li>Type: ${pet.type}</li>
              </ul>
            </p>
            <button onclick="addtoCart('${pet.name}', '${pet.breed}', '${pet.gender}', '${pet.age}', '${pet.type}')" type="button" class="btn btn-primary">Add to Cart</button>
            <button onclick="removePet(this)" type="button" class="btn btn-danger">Remove</button>
            <button onclick="editPet('${pet.name}', '${pet.breed}', '${pet.gender}', '${pet.age}', '${pet.type}', '${pet.pet_id}')" type="button" class="btn btn-warning">Edit</button>

          </div> `; 
            let gallery = document.querySelector('.col-lg-9')
            let lastGalItem = gallery.lastElementChild;
            lastGalItem.insertAdjacentHTML('beforeend', petMark)
    }
    
    // Function to add a new item to the cart
    function addtoCart(petName, petDetails) {
        // Clone the template content
        var template = document.getElementById('cart-item-template');
        var clone = template.content.cloneNode(true);

        // Update the cloned item with pet details
        clone.querySelector('.pet-name').textContent = petName;
        clone.querySelector('.pet-details').textContent = petDetails;

        // Add event listener to remove button
        clone.querySelector('.remove-btn').addEventListener('click', function() {
            // Remove the corresponding item when the remove button is clicked
            clone.remove();
            // Update local storage with the modified cart items
            updateLocalStorage();
        });

        // Append the cloned item to the cart list
        var cartList = document.getElementById('cart-items');
        cartList.appendChild(clone);

        // Update local storage with the added item
        updateLocalStorage();
        alert('Added pet to cart, yay!');
    }

    //Updates local storage with current cart items
    function updateLocalStorage() {
        var cartItems = [];
        var cartList = document.getElementById('cart-items').querySelectorAll('li');

        //Get cart item details and add to the cartItems array
        cartList.forEach(function(item) {
            var name = item.querySelector('.pet-name').textContent;
            var details = item.querySelector('.pet-details').textContent;
            cartItems.push({ name: name, details: details });
        });

        // Store cart items in local storage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
    }

    // Add event listener to the parent element of the remove buttons
    document.getElementById('cart-items').addEventListener('click', function(event) {
    // Check if the clicked element is a remove button
    if (event.target && event.target.classList.contains('remove-btn')) {
        // Get the parent li element of the clicked remove button
        var listItem = event.target.closest('li');
        
        // Remove the corresponding item
        listItem.remove();
        
        // Update local storage with the modified cart items
        updateLocalStorage();
        
    }
    alert('Pet removed!');
});

function removePet(button) {
    // Find the parent container of the button
    let petContainer = button.closest('.gallery-item');
    if (petContainer) {
        // Remove the parent container if found
        petContainer.remove();

        // Get the pet name from the image alt attribute
        let petName = petContainer.querySelector('img').alt;

        // Send an AJAX request to the PHP script to remove the pet from the database
        let formData = new FormData();
        formData.append('pet_name', petName);

        fetch('remove_pet.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Log the response from remove_pet.php
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    alert('Pet removed successfully!');
}

// Function to edit pet details
function editPet(name, breed, gender, age, type, petId) {
    // Display a form or modal with fields pre-filled with current pet details
    // Allow user to edit and submit the form
    // Send an AJAX request to update the pet details in the database
    alert('Editing pet details...');
}
  </script>

</body>
</html>
s