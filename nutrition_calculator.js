// nutrition_calculator.js

// Function to log food and update nutrient totals
function logFood() {
    const foodNameInput = document.getElementById('food-name');
    const servingsInput = document.getElementById('servings');
    
    const foodName = foodNameInput.value.trim();
    const servings = parseInt(servingsInput.value);

    if (foodName && servings > 0) {
        // Create a FormData object to send data via POST
        const formData = new FormData();
        formData.append('food_name', foodName);
        formData.append('servings', servings);

        // Send the data to the server using fetch
        fetch('nutrition_calculator.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Update the nutrient totals displayed on the page
            updateNutrientDisplay(data);
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert('Please enter a valid food name and servings.');
    }
}

// Function to update the nutrient display based on server response
function updateNutrientDisplay(data) {
    const parser = new DOMParser();
    const htmlDoc = parser.parseFromString(data, 'text/html');

    const totalProtein = htmlDoc.querySelector('.nutrient-info span:nth-of-type(1)').textContent;
    const totalCarbs = htmlDoc.querySelector('.nutrient-info span:nth-of-type(2)').textContent;
    const totalFat = htmlDoc.querySelector('.nutrient-info span:nth-of-type(3)').textContent;

    document.getElementById('total-protein').textContent = totalProtein + ' g';
    document.getElementById('total-carbs').textContent = totalCarbs + ' g';
    document.getElementById('total-fat').textContent = totalFat + ' g';

    // Clear input fields
    document.getElementById('food-name').value = '';
    document.getElementById('servings').value = '';
}

// Event listener for the log food button
document.getElementById('log-btn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission
    logFood(); // Call the logFood function
});