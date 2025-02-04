// script.js

const form = document.getElementById('registration-form');

form.addEventListener('submit', (e) => {
    e.preventDefault();

    const height = document.getElementById('height').value;
    const weight = document.getElementById('weight').value;
    const age = document.getElementById('age').value;
    const gender = document.getElementById('gender').value;
    const healthIssues = document.getElementById('health-issues').value;
    const fitnessGoals = document.getElementById('fitness-goals').value;
    const dietaryPreferences = document.getElementById('dietary-preferences').value;

    // Send the data to your server or database
    console.log({
        height,
        weight,
        age,
        gender,
        healthIssues,
        fitnessGoals,
        dietaryPreferences
    });
});