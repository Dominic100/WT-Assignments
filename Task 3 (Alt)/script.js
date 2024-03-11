document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.querySelector("#carousel_slide");
    const leftSection = document.createElement("div");
    const rightSection = document.createElement("div");
    const dynamicPost = document.querySelector('.navbar-brand');

    document.addEventListener('mousemove', function(e) {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;

        const red = Math.round(255 * x);
        const green = Math.round(255 * y);
        const blue = 150;

        const color = `rgb(${red}, ${green}, ${blue})`;
        dynamicPost.style.color = color;
    });

    leftSection.classList.add("left-section");
    rightSection.classList.add("right-section");

    carousel.parentElement.insertBefore(leftSection, carousel);
    carousel.parentElement.insertBefore(rightSection, carousel.nextSibling);

    const updateBackground = () => {
        const activeIndex = Array.from(carousel.querySelectorAll('.carousel-item')).findIndex(item => item.classList.contains('active'));
        const activeImage = carousel.querySelector(`.carousel-item:nth-child(${activeIndex + 1}) img`);
        if (activeImage) {
            const imageUrl = activeImage.getAttribute("src");
            leftSection.style.backgroundImage = `url(${imageUrl})`;
            rightSection.style.backgroundImage = `url(${imageUrl})`;
        }
    };

    carousel.addEventListener("slid.bs.carousel", updateBackground);

    updateBackground();

    fetch('blog-data.json')
        .then(response => response.json())
        .then(data => {
            const blogPostsRow = document.getElementById('blogPostsRow');

            data.forEach(blogPost => {
                const col = document.createElement('div');
                col.classList.add('col-md-4', 'mb-4');

                const card = document.createElement('div');
                card.classList.add('card');

                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');

                cardBody.innerHTML = `
                    <h5 class="card-title">${blogPost.title}</h5>
                    <p class="card-text">${blogPost.content.substring(0, 100)}...</p>
                    <a href="blog-post.html?id=${blogPost.id}" class="btn btn-primary">Read More</a>
                `;

                card.appendChild(cardBody);

                col.appendChild(card);

                blogPostsRow.appendChild(col);
            });
        })
        .catch(error => console.error('Error fetching blog data:', error));
});

