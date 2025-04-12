<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Slideshow Styles */
        .slideshow-container {
            width: 95%;
            max-width: 1600px;
            height: 750px;
            margin: 30px auto;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.15);
            background-color: #ddd; /* Background while images load */
            min-height: 750px;
        }

        .slideshow-container img.slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out, visibility 0s linear 1s;
            z-index: 0;
        }

        .slideshow-container img.slide.active {
            opacity: 1;
            visibility: visible;
            transition: opacity 1s ease-in-out;
            z-index: 1;
        }

        /* Responsive adjustment for ultra wide screens */
        @media (min-width: 1800px) {
            .slideshow-container {
                height: 850px;
            }
        }

        /* Gallery Styles */
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            padding: 20px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .gallery div {
            flex: 1 1 300px;
            max-width: 400px;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            position: relative;
            background-color: #eee;
        }

        .gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease, opacity 0.4s ease;
            opacity: 0.95;
        }

        .gallery img:hover {
            transform: scale(1.05);
            opacity: 1;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 10px;
            color: #333;
            font-size: 28px;
        }
    </style>
</head>
<body>

    <!-- Slideshow Section -->
    <div class="slideshow-container">
        <img class="slide" src="images/gal11.jpg" alt="Slide 2">
        <img class="slide" src="images/gal12.jpg" alt="Slide 3">
        <img class="slide" src="images/gal13.jpg" alt="Slide 4">
    </div>

    <!-- Gallery Section -->
    <h2>Gallery</h2>
    <div class="gallery">
        <?php
        $images = [
            'images/gal1.jpg', 'images/gal2.jpg', 'images/gal3.jpg', 'images/gal4.jpg',
            'images/gal5.jpg', 'images/gal6.jpg', 'images/gal7.jpg', 'images/gal8.jpg',
        ];

        foreach ($images as $img) {
            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $img)) {
                echo "<div><img src='$img' alt='Gallery Image' loading='lazy'></div>";
            }
        }
        ?>
    </div>

    <!-- Slideshow Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.slideshow-container .slide');
            const slideCount = slides.length;
            let currentSlide = 0;

            function showSlide(indexToShow) {
                if (indexToShow >= 0 && indexToShow < slideCount) {
                    slides.forEach((slide, index) => {
                        slide.classList.toggle('active', index === indexToShow);
                    });
                } else {
                    console.error("Invalid slide index:", indexToShow);
                }
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slideCount;
                showSlide(currentSlide);
            }

            if (slideCount > 0) {
                showSlide(currentSlide);
                setInterval(nextSlide, 3000);
            } else {
                console.warn("No slides found.");
            }
        });
    </script>

</body>
</html>
