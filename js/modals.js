//  === MODAL FUNCTIONS ===

$(function () {
  // === Open Login Modal ===
  $("#loginBtn").on("click", function () {
    $("#loginModal").fadeIn(200).css("display", "flex");
  });

  // === Close Modals when clicking background ===
  $(".modal-overlay").on("click", function (e) {
    if ($(e.target).is(".modal-overlay")) {
      $(this).fadeOut(200);
    }
  });

  // Login form via AJAX
    $('#loginForm').on('submit', function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
      url: 'misc/login_handler.php',
      method: 'POST',
      data: form.serialize(),
      dataType: 'json'
    }).done(function (res) {
      if (res.success) {
        // If a redirect was set, go there; otherwise reload to update session state
        var redirect = $('#loginRedirect').val();
        if (redirect && redirect.length > 0) {
          window.location.href = redirect;
        } else {
          alert(res.message || 'Login successful');
          location.reload();
        }
      } else {
        alert(res.message || 'Login failed');
      }
    }).fail(function () {
      alert('Login request failed — try again.');
    });
  });

  // Signup form via AJAX
  $('#signupForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url: 'misc/signup_handler.php',
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json'
    }).done(function (res) {
      if (res.success) {
        alert(res.message || 'Account created');
        // you can auto-login by calling the login endpoint or reload
        location.reload();
      } else {
        alert(res.message || 'Signup failed');
      }
    }).fail(function () {
      alert('Signup request failed — try again.');
    });
  });

  // === Switch from Login -> Sign Up ===
  $("#openSignup").on("click", function (e) {
    e.preventDefault();
    $("#loginModal").fadeOut(150, function () {
      $("#signupModal").fadeIn(200).css("display", "flex");
    });
  });

  // === Switch from Sign Up -> Login ===
  $("#backToLogin").on("click", function (e) {
    e.preventDefault();
    $("#signupModal").fadeOut(150, function () {
      $("#loginModal").fadeIn(200).css("display", "flex");
    });
  });

  // === Login Form Validation ===
  $("#loginForm").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
      email: "Please enter a valid email address",
      password: "This field is required",
    }
    // submitHandler: function (form) {
    //   alert("Login successful (demo)");
    //   form.reset();
    //   $("#loginModal").fadeOut(200);
    // },
  });

  // === Sign Up Form Validation ===
  $("#signupForm").validate({
    rules: {
      username: {
        required: true,
        minlength: 3,
      },
      password: {
        required: true,
        minlength: 6,
      },
      retypePassword: {
        required: true,
        equalTo: "#password",
      },
    },
    messages: {
      username: "Please enter at least 3 characters",
      password: "Please enter at least 6 characters",
      retypePassword: "This password does not match",
    },
    // submitHandler: function (form) {
    //   alert("Account created successfully (demo)");
    //   form.reset();
    //   $("#signupModal").fadeOut(200);
    // },
  });

  // === Restrict invalid characters for Username ===
  $("#username").on("keypress", function (e) {
    const key = String.fromCharCode(e.which);
    const valid = /^[a-zA-Z0-9_]+$/;
    if (!valid.test(key)) e.preventDefault();
  });

  //Contact Form Validation:
  $("#contact").validate({
    rules: {
      name: {
        required: true,
        minlength: 5,
      },
      email: {
        required: true,
        email: true,
      },
      messages: {
        required: true,
      },
    },
    messages: {
      name: "Please enter at least 3 characters",
      email: "Please enter a valid email!",
      messages: "Please input something!",
    },
    // submitHandler: function (form) {
    //   alert("Thank you for sharing your thoughts with us!");
    //   e.preventDefault();
    // },
  })
});

// === Logout function ===
$("#logoutBtn").on("click", function () {
  $.ajax({
    url: "./misc/logout_handler.php",
    method: "POST",
    dataType: "json"
  }).done(function (res) {
    alert(res.message || "Logged out successfully");
    location.reload();
  }).fail(function () {
    alert("Logout failed — try again.");
  });
});

