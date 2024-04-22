document.addEventListener("DOMContentLoaded", function() {
    const heading = document.getElementById('color-changing-heading');
    const colors = ['#FF5733', '#FFC300', '#DAF7A6', '#FF5733', '#C70039', '#FF5733']; // List of colors to cycle through
    let colorIndex = 0;

    function changeColor() {
        heading.style.color = colors[colorIndex]; // Change the text color
        colorIndex = (colorIndex + 1) % colors.length; // Move to the next color index
        setTimeout(changeColor, 2000); // Call changeColor again after 2 seconds
    }

    changeColor(); // Start the color-changing process


});

function searchBlogs() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        const headerText = card.querySelector('.card-header').textContent.toLowerCase();
        if (headerText.includes(searchQuery)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}