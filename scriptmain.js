// script.js

// Function to validate form data
function validateForm() {
    // Get form elements
    var age = document.getElementById("age");
    var height = document.getElementById("height");
    var weight = document.getElementById("weight");
    var issues = document.getElementById("issues");
    var goals = document.getElementById("goals");

    // Validate form data
    if (age.value == "" || height.value == "" || weight.value == "") {
        alert("Please fill in all required fields.");
        return false;
    }

    if (isNaN(age.value) || isNaN(height.value) || isNaN(weight.value)) {
        alert("Please enter valid numbers for age, height, and weight.");
        return false;
    }

    if (issues.value == "" || goals.value == "") {
        alert("Please fill in issues and goals.");
        return false;
    }

    // If all fields are valid, submit the form
    return true;
}

// Add event listener to form submission
document.getElementById("user-data-form").addEventListener("submit", function(event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});