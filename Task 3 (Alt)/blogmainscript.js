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

    const cardData = [
        {
            header: "Tomb Raider (2013) - Gameplay Mechanics",
            body: "https://i0.wp.com/nasilemaktech.com/wp-content/uploads/2013/03/2013-03-11-22_27_39-tomb-raider.png",
            footer: "Gameplay",
            class: "card1",
            date: "2023-05-15"
        },
        {
            header: "Tomb Raider (2013) - Survival Elements",
            body: "https://images.immediate.co.uk/production/volatile/sites/3/2023/03/Tomb-Raider-games-in-order-53cb2ac.jpg?quality=90&resize=980,654",
            footer: "Survival",
            class: "card2",
            date: "2023-07-20"
        },
        {
            header: "Player Count Plummets in 'Suicide Squad: Kill the Justice League (2024)'",
            body: "https://static.toiimg.com/thumb/resizemode-4,width-1280,height-720,msid-107259199/107259199.jpg",
            footer: "Player Count",
            class: "card3",
            date: "2024-01-10"
        },
        {
            header: "Does Batman: Arkham Knight (2015) Hold Up?",
            body: "https://cdn.vox-cdn.com/thumbor/UCNXs0XwX6WPPzMM3IGzuF5H1y0=/471x0:3927x2304/1280x854/cdn.vox-cdn.com/uploads/chorus_image/image/46660972/game-offline-Batman-Arkham-Knight-chinh-thuc-chao-ban-season-pass-02.0.0.jpg",
            footer: "Gameplay",
            class: "card4",
            date: "2023-11-25"
        },
        {
            header: "Unleashing Prehistoric Power: Far Cry Primal (2016)",
            body: "https://cdn1.epicgames.com/larkspur/offer/FCP_UCS17665_Store_Landscape_2560x1440-2560x1440-7d928100112e95b33030b81c65e632d3.jpg",
            footer: "Survival",
            class: "card5",
            date: "2023-08-30"
        },
        {
            header: "Is Edward Kenway the best Assassin in the franchise?",
            body: "https://i0.wp.com/play3r.net/wp-content/uploads/2015/11/as.jpg?fit=2048%2C1110&ssl=1",
            footer: "Player Count",
            class: "card6",
            date: "2024-03-05"
        }
    ];

    const cardContainer = document.getElementById('cardContainer');

    let currentRow;

    cardData.forEach((data, index) => {
        if (index % 3 === 0) {
            currentRow = document.createElement('div');
            currentRow.classList.add('row', 'mt-3');
            cardContainer.appendChild(currentRow);
        }

        const cardColumn = document.createElement('div');
        cardColumn.classList.add('col-md-4', 'mt-3');

        const cardDiv = document.createElement('div');
        cardDiv.classList.add('card', data.class);
        cardDiv.style.borderColor = "black";
        cardDiv.style.width = "100%";
        cardDiv.style.height = "60%";

        const header = document.createElement('div');
        header.classList.add('card-header');
        header.textContent = data.header;
        header.style.backgroundColor = "#FF5722";
        header.style.color = "black";
        header.style.fontFamily = "DOOMFont, sans-serif";
        header.style.fontSize = "25px";
        header.style.height = "40px";

        const body = document.createElement('div');
        body.classList.add('card-body');
        const image = document.createElement('img');
        image.src = data.body;
        image.classList.add('card-img-top');
        body.appendChild(image);
        body.style.backgroundColor = "black";
        image.style.height = "350px";

        const footer = document.createElement('div');
        footer.classList.add('card-footer');
        footer.textContent = data.footer;
        footer.style.backgroundColor = "#9C27B0";
        footer.style.color = "black";
        footer.style.fontFamily = "DOOMFont, sans-serif";
        footer.style.fontSize = "25px";
        footer.style.height = "40px";
        footer.setAttribute('data-date', data.date);

        const button = document.createElement('button');
        button.textContent = 'Read More';
        button.classList.add('btn', 'btn-primary');
        button.style.fontFamily = "DOOMFont, sans-serif";
        button.style.fontSize = "25px";
        button.style.fontStretch = "extra-expanded";
        button.style.height = "40px";
        button.style.borderRadius = "0";
        button.style.backgroundColor = "black";
        button.style.color = "white";
        button.style.borderColor = "black";
        button.addEventListener('mouseover', function () {
            button.style.backgroundColor = "#D3D3D3";
            button.style.color = "black";
        });
        button.addEventListener('mouseout', function () {
            button.style.backgroundColor = "black";
            button.style.color = "white";
        });
        button.addEventListener('click', function () {
            window.location.href = `blogpage.html?id=${index + 1}`;
        });

        cardDiv.appendChild(header);
        cardDiv.appendChild(body);
        cardDiv.appendChild(footer);
        cardDiv.appendChild(button);

        cardColumn.appendChild(cardDiv);

        currentRow.appendChild(cardColumn);
    });
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

function filterByCategory(category) {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        const footerText = card.querySelector('.card-footer').textContent.toLowerCase();
        if (footerText.includes(category.toLowerCase())) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function sortByDate() {
    const cardContainer = document.getElementById('cardContainer');
    cardContainer.classList.add('justify-content-center');
    const cards = Array.from(cardContainer.querySelectorAll('.card'));
    const originalWidth = cards[0].offsetWidth;
    cards.sort((a, b) => {
        const dateA = new Date(a.querySelector('.card-footer').getAttribute('data-date'));
        const dateB = new Date(b.querySelector('.card-footer').getAttribute('data-date'));
        return dateB - dateA;
    });
    cards.forEach(card => {
        cardContainer.appendChild(card);
        card.style.width = originalWidth + 'px';
    });
}

function sortByCategory() {
    const cardContainer = document.getElementById('cardContainer');
    const cards = Array.from(cardContainer.querySelectorAll('.card'));
    const originalWidth = cards[0].offsetWidth;
    cards.sort((a, b) => {
        const categoryA = a.querySelector('.card-footer').textContent.toLowerCase();
        const categoryB = b.querySelector('.card-footer').textContent.toLowerCase();
        return categoryA.localeCompare(categoryB);
    });
    cards.forEach(card => {
        cardContainer.appendChild(card);
        card.style.width = originalWidth + 'px';
    });
}