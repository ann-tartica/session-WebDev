$(document).ready(function() {
    // Handle login form
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
             url: 'misc/login_handler.php', // adjust path
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var redirect = $('#loginRedirect').val();
                    if (redirect && redirect.length > 0) {
                        window.location.href = redirect;
                    } else {
                        alert("Login successful!");
                        location.reload(); // ✅ Reload to update navbar session state
                    }
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("An error occurred while logging in.");
            }
        });

    // Handle signup form
    $('#signupForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'misc/signup_handler.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.success) {
                    $('#signupModal').hide();
                    $('#loginModal').show();
                }
            }
        });
    });

    // Modal switching
    $('#openSignup').on('click', function(e) {
        e.preventDefault();
        $('#loginModal').hide();
        $('#signupModal').show();
    });

    $('#backToLogin').on('click', function(e) {
        e.preventDefault();
        $('#signupModal').hide();
        $('#loginModal').show();
    });
});

})();

// === Logout AJAX ===
$(document).on("click", "#logoutBtn", function () {
  $.ajax({
    url: "misc/logout_handler.php",
    method: "POST",
    dataType: "json"
  }).done(function (res) {
    if (res.success) {
      alert(res.message || "Logged out successfully!");
      location.reload();
    } else {
      alert(res.message || "Logout failed.");
    }
  }).fail(function (xhr, status, error) {
    console.error("AJAX error:", status, error);
    alert("Logout request failed — check console.");
  });
});
