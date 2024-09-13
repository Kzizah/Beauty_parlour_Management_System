// Wait for the DOM to be fully loaded before running the script
document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signupForm');
    
    signupForm.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        
        // Check if passwords match
        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            e.preventDefault();  // Prevent form from submitting
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
        console.log("Login page loaded");
    });
    
});
