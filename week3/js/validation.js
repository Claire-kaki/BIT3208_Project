document.addEventListener("DOMContentLoaded", function() {
    // Select the HTML input elements
    const loginForm = document.getElementById("loginForm");
    const passwordInput = document.getElementById("adminPassword");
    const strengthFeedback = document.getElementById("passwordStrength");
    const productNameInput = document.getElementById("prod_name");
    const livePreviewTitle = document.getElementById("livePreviewTitle");

    // Task 2: DOM Manipulation - Live Text Preview System
    productNameInput.addEventListener("input", function() {
        if (productNameInput.value.trim() === "") {
            livePreviewTitle.textContent = "New Product Preview";
        } else {
            livePreviewTitle.textContent = productNameInput.value;
        }
    });

    // Task 1: Input Handling - Live Password Strength Checker
    passwordInput.addEventListener("input", function() {
        const password = passwordInput.value;
        if (password.length === 0) {
            strengthFeedback.textContent = "";
        } else if (password.length < 6) {
            strengthFeedback.textContent = "❌ Weak (Must be 6+ characters)";
            strengthFeedback.style.color = "red";
        } else {
            strengthFeedback.textContent = "💪 Strong Password Security";
            strengthFeedback.style.color = "green";
        }
    });

    // Task 1: Form Validation System on Submit
    loginForm.addEventListener("submit", function(event) {
        const email = document.getElementById("adminEmail").value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Verify Email Format
        if (!emailRegex.test(email)) {
            event.preventDefault(); // Stop form from sending data
            alert("⚠️ Invalid Email Format! Please ensure you include an '@' and a domain.");
            return false;
        }

        // Verify Password Length
        if (passwordInput.value.length < 6) {
            event.preventDefault(); // Stop form from sending data
            alert("⚠️ Access Blocked: Your password is too short!");
            return false;
        }
    });
});