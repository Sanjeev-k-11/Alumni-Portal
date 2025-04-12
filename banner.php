<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image Slider</title>
  <style>
    .slider {
        position: relative;
        width: 100%;
        height: 400px;
        overflow: hidden;
    }

    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .slide.active {
      opacity: 1;
      z-index: 1;
    }

    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: top;
      transform: scale(1.1);
    }
  </style>
</head>
<body>

<div class="slider">
  <div class="slide active">
    <img src="images/lpurank.png" alt="LPU Alumni Association">
  </div>
  <div class="slide">
    <img src="images/placement.jpg" alt="LPU Alumni Association">
  </div>
  <div class="slide">
    <img src="images/worldrank.jpg" alt="LPU Alumni Association">
  </div>
</div>

<script>
  const slides = document.querySelectorAll('.slide');
  let currentSlide = 0;

  function showNextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }

  setInterval(showNextSlide, 4000);
</script>

</body>
</html>
