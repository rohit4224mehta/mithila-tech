// size and quantity model button js 

let selectedSize = null;
let currentQuantity = 1;
const maxStock = 7;

function selectSize(button) {
  document.querySelectorAll('.size-button').forEach(btn => btn.classList.remove('selected'));
  button.classList.add('selected');
  selectedSize = button.innerText;
}

function increaseQuantity() {
  if (currentQuantity < maxStock) {
    currentQuantity++;
    updateQuantityDisplay();
  }
}

function decreaseQuantity() {
  if (currentQuantity > 1) {
    currentQuantity--;
    updateQuantityDisplay();
  }
}

function updateQuantityDisplay() {
  document.getElementById('quantity').innerText = currentQuantity;
  const stockNotice = document.getElementById('stock-notice');
  stockNotice.innerText = `${maxStock - currentQuantity} left`;
}



// wishlist js start 
app.delete('/remove-from-wishlist/:id', (req, res) => {
  const productId = req.params.id;

  // Logic to remove the item from the wishlist in the database
  // Example:
  // WishlistModel.removeItem(productId, (err) => {
  //     if (err) return res.status(500).send('Error removing item');
  //     res.send('Item removed from wishlist');
  // });

  res.send(`Item ${productId} removed from wishlist`);
});
// wishlist js end


// contact page js strat 

// Validate form on submit
document.getElementById('contactForm').addEventListener('submit', function (event) {
  if (!this.checkValidity()) {
      event.preventDefault(); // Prevent form submission if validation fails
      event.stopPropagation();
  }
  this.classList.add('was-validated'); // Add Bootstrap validation styles
});

// Additional custom validation (optional)
document.getElementById('email').addEventListener('input', function () {
  const email = this.value;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
      this.setCustomValidity('Please enter a valid email address.');
  } else {
      this.setCustomValidity('');
  }
});

// contact page js end


// register page js start 

$(document).ready(function() {
  $.validator.addMethod("filesize", function(value, element, param) {
      if (element.files[0]) {
          return element.files[0].size <= param;
      }
  }, "filesize cannot be greater than {0} KB.");
  $('#form1').validate({
      rules: {
          fn: {
              required: true,
              minlength: 3,
              maxlength: 50,
              lettersonly: true
          },
          email: {
              required: true,
              email: true
          },
          pswd: {
              required: true,
              minlength: 8,
              maxlength: 20,
              pattern: "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#%&])[a-zA-Z0-9!@#$%&]{8,20}$/"
          },
          gender: {
              required: true,
          },
          'game[]': {
              required: true,
          },
          f1: {
              required: true,
              accept: "image/*",
              filesize: 250 * 1024
          },
          cpswd: {
              required: true,
              equalTo: "#pwd"
          }
      },
      messages: {
          fn: {
              required: "Fullname is required.",
              minlength: "Fullname should be at least 3 characters long.",
              maxlength: "Fullname should not exceed 50 characters.",
              lettersonly: "Fullname should only contain letters."
          },
          email: {
              required: "Email is required.",
              email: "Please enter a valid email address."
          },
          pswd: {
              required: "Password is required.",
              minlength: "Password should be at least 8 characters long.",
              maxlength: "Password should not exceed 20 characters.",
              pattern: "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (!@#$%&)."
          },
          gender: {
              required: "Gender is required."
          },
          'game[]': {
              required: "Game is required."
          },
          f1: {
              required: "Please select an image file.",
              accept: "Only image files (jpg, png, gif) are allowed.",
              filesize: "Image file size cannot be greater than 250kb."
          },
          cpswd: {
              required: "Confirm Password is required.",
              equalTo: "Passwords do not match."
          }
      },
      errorElement: "div",
      errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          if (element.attr('name') == "gender") {
              error.insertAfter('#gender-error');
          } else if (element.attr('name') == "game[]") {
              error.insertAfter('#game-error');
          } else {
              error.insertAfter(element);
          }
      },
      highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid').addClass('is-valid');
      }
  });
});

// register page js end