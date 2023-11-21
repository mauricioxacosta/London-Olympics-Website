<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width"/>
  <title>London 2012 Olympics Results</title>
  <link rel="stylesheet" type="text/css" href="design.css">
</head>

<body>
  <!-- Header section with Light/Dark mode toggle button-->
  <header>
    <h1>London 2012 Olympics Results</h1>
	<button id="mode-toggle">Toggle Light/Dark Mode</button>
  </header>
  
  <!-- Introduction section with video -->
  <section id="introduction" class="column">
	<div class="text-column">
	  <p>The London 2012 Olympics was a major international multi-sport event held in London, United Kingdom from July 27 to August 12, 2012. It was the first time the city hosted the Summer Olympics since 1948.</p>
	  <p>There were over 10,000 athletes from 204 National Olympic Committees who competed in 26 sports and 39 disciplines. The opening ceremony, directed by Danny Boyle, was a spectacular display of British history and culture that was watched by an estimated one billion people worldwide.</p>
	  <p>Some of the standout performances included Usain Bolt winning three gold medals in athletics, Michael Phelps becoming the most decorated Olympian of all time with 22 medals, and Great Britain winning 29 gold medals to finish third in the medal table.</p>
	  <p>The London 2012 Olympics were praised for their sustainability efforts and the legacy they left behind, with many of the venues and facilities still being used for sports and events today.</p>
	</div>
	<div class="video-column">
	  <iframe width="560" height="315" src="https://www.youtube.com/embed/1AS-dCdYZbo" title="YouTube video player" frameborder="20" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
	</div>
  </section>
  
  <!-- Countdown section -->
  <section id="countdown">
    <p></p>
  </section>
  
  <!-- Slideshow section -->
  <section id="slideshow"></section>
  
  <!-- Navigation section -->
  <nav>
    <form method="post" action="results.php">
      <div class="container">
        <!-- Input section -->
        <div class="input-column">
          <h2>Please input two countries that you desire to compare:</h2>
          <label for="country1">Country 1 ISO ID:</label>
          <input type="text" name="country1" id="country1" required>
          <label for="country2">Country 2 ISO ID:</label>
          <input type="text" name="country2" id="country2" required>
          <label for="ranking-criteria">Ranking criteria:</label>
          <select name="ranking_criterion" id="ranking_criterion">
            <option value="general">General Information</option>
            <option value="gold">Gold medals</option>
            <option value="cyclists">Number of cyclists</option>
            <option value="avg_age">Average age of cyclists</option>
          </select>
          <input type="submit" value="Submit">
        </div>
      </div>
    </form>
  </nav>
  
  <!-- Script section -->
  <script src="script.js"></script>
  
  <!-- Footer section -->  
  <footer>
    <div class="footer-container">
      <div class="footer-column">
        <h3>About Us</h3>
        <p>We are a team of sports enthusiasts who created this website to share information about the cyclists that participated in the London 2012 Olympics.</p>
      </div>
      <div class="footer-column">
        <h3>Contact Us</h3>
        <p>Email: comaa3.sci-project.lboro.ac.uk</p>
      </div>
    </div>
    <div class="copyright">
      <p>&copy; 2023 LoughboroughUniversity.com</p>
    </div>
  </footer>
  
</body>

</html>
