// Sample data for demonstration
const movieData = [
    { title: "Black Panther", imageUrl: "poster-1.jpg", trailerUrl: "https://youtu.be/Nf5oxsFs1XE?si=Rxz5bZuL8S-ATOyF" },
    { title: "Avatar the wave of water ", imageUrl: "poster-2.jpg", trailerUrl: "https://youtu.be/YoqUr5sLWMQ?si=DZiiJchgYZZ7UJCy" },
    { title: "Johnny English Reborn", imageUrl: "poster-3.jpg", trailerUrl: "https://youtu.be/U7LhoPRj3l4?si=HoZmaZ1F-5MEXFLs" },
    { title: "Transformers", imageUrl: "poster-4.jpg", trailerUrl: "https://youtu.be/LhsPVALU3RE?si=cZmNhlm2cefTNItZ" },
    { title: "MACBETCH", imageUrl: "poster-5.jpg",trailerUrl: "https://youtu.be/E3Pzx7tUsQQ?si=Cm4ayORoZA0pxDA7" },
    { title: "Assassin's Creed ", imageUrl: "poster-6.jpg",trailerUrl: "https://youtu.be/UVM5sGXlFrs?si=Yv57AqaDU1INNRaR"},
    { title: "Come Home", imageUrl: "poster-7.jpg",trailerUrl: "https://youtu.be/IVBXvNrRTTc?si=6Z5U9CkY79SHw-8E"},
    { title: "Fast&Furious 8", imageUrl: "poster-8.jpg",trailerUrl: "https://youtu.be/mQPnldHrNZQ?si=6RtjlpN0MzOvY0jB"},
    { title: "Captin America", imageUrl: "poster-9.jpg",trailerUrl: "https://youtu.be/gj5oWzp3tyU?si=oRHflnmBbIRBYU2P"},
    { title: "Spider Man No Way Home", imageUrl: "poster-10.jpg",trailerUrl: "https://youtu.be/S8ZUtWTuHT4?si=C-xJrbf9QomDvgi1"},
    // Add more items here
];

/**
 * Function to populate a content row with movie posters.
 * @param {string} containerId - The ID of the HTML container element (e.g., 'trending-now').
 * @param {Array<Object>} data - The array of movie objects.
 */
function populateRow(containerId, data) {
    const container = document.getElementById(containerId);

    data.forEach((movie, index) => {
        // Create the poster div
        const poster = document.createElement('div');
        poster.classList.add('poster-item');
        
        // Use an inline style for the background image (for simplicity)
        // In a real application, you'd use a robust image source.
        poster.style.backgroundImage = `url('./posters/${movie.imageUrl}')`;
        poster.setAttribute('title', movie.title); // Title for accessibility/hover

        // Make poster clickable: open specific trailer if provided, otherwise default to YouTube
        poster.style.cursor = 'pointer';
        poster.addEventListener('click', () => {
            const url = movie.trailerUrl ? movie.trailerUrl : 'https://www.youtube.com';
            window.open(url, '_blank');
        });

        container.appendChild(poster);
    });
}

// Call the function for each row
// Using the same data for both rows for this simple example.
populateRow('trending-now', movieData);
populateRow('critically-acclaimed', movieData.slice(2, 10)); // Display a different subset

// Note: You would need to create a folder named 'posters' and save images 
// like 'poster-1.jpg', 'poster-2.jpg', etc., inside it for this to fully work visually.