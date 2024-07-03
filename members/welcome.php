<?php
session_start(); // Start the session

// Include necessary PHP files for session management and database connection
// Assuming you have included files here for session handling and database connection

// Fetch user information from session
if (isset($_SESSION['user_row'])) {
    $user_row = $_SESSION['user_row'];
    $userFullName = $user_row['fname'] . ' ' . $user_row['lname'];
} else {
    // Handle case where user session data is not set
    $userFullName = ""; // Example fallback value
}

// Sample event data (replace with actual dynamic data if available)

$events = [
    [
        'title' => 'Aid the Families in Manyara',
        'image' => 'donate-4.jpg',
        'goal' => '$50,000',
        'amount_raised' => '$25,000',
        'description' => 'Help us provide essential aid to families in Manyara.'
    ],
    [
        'title' => 'Help Building Schools in Tarime',
        'image' => 'hands.jpg',
        'goal' => '$100,000',
        'amount_raised' => '$75,000',
        'description' => 'Support the construction of schools in Tarime for better education.'
    ],
    [
        'title' => 'Make the Children in Kibaha Smile',
        'image' => 'playing.jpg',
        'goal' => '$30,000',
        'amount_raised' => '$10,000',
        'description' => 'Provide happiness and educational resources to children in Kibaha.'
    ],
    [
        'title' => 'Support Window Initiative',
        'image' => 'window.jpg',
        'goal' => '$20,000',
        'amount_raised' => '$5,000',
        'description' => 'Contribute to initiatives aimed at improving community windows.'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Charity Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- AOS Library CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet"
        integrity="sha512-M/b0B08JKpFUpWkPjPZ0lEYeD4TZoDZ88GAlu1JLz6X3oM4/Whi5MOA9Uk7DlOgubK9rO6gV+G4bC8g9QInKdA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <style>
    /* General styles */
body {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

.jumbotron {
    background-color: #2e77d0;
    color: #fff;
    padding: 3rem 2rem;
    text-align: center;
    border-radius: 0;
    margin-bottom: 30px;
}

.jumbotron a.btn {
    margin-right: 10px;
    background-color: #fff;
    color: #2e77d0;
    border: 2px solid #fff;
    padding: 10px 20px;
    border-radius: 25px;
    text-transform: uppercase;
    font-weight: bold;
    transition: all 0.3s ease;
}

.jumbotron a.btn:hover {
    background-color: #2e77d0;
    color: #fff;
}

/* Custom Card styles */
.custom-card {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border: none;
    transition: transform 0.3s ease;
    border-radius: 10px;
}

.custom-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
}

.custom-card h2 {
    font-weight: bold;
    color: #2e77d0;
    margin-bottom: 15px;
}

.custom-card p {
    font-size: 1.1rem;
    line-height: 1.6;
}

/* Event Card styles */
.event-card {
    margin-bottom: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    border-radius: 10px;
    overflow: hidden;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
}

.event-card .card-img-top {
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.event-card:hover .card-img-top {
    transform: scale(1.05);
}

/* Progress Bar */
.progress {
    height: 10px;
    margin-bottom: 10px;
    background-color: #f3f3f3;
    border-radius: 5px;
}

.progress-bar {
    height: 100%;
    border-radius: 5px;
}

/* Team Section */
#our-team-section .card {
    margin: 20px 0;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#our-team-section .card-body {
    padding: 20px;
}

#our-team-section img {
    width: 100%;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

#our-team-section img:hover {
    transform: scale(1.05);
}

/* Additional Tweaks */
.about-us-card {
    position: sticky;
    top: 0;
    z-index: 3;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-bottom: 20px;
    padding: 20px;
}

.about-us-card.sticky {
    transform: translateY(0);
}

/* Carousel Images */
.carousel-inner img {
    width: 100%;
    height: auto;
}

        .contact-info {
            text-align: center;
            margin-top: 20px;
        }

        .contact-info img {
            width: 30px;
            height: auto;
            margin-right: 10px;
            transition: transform 0.3s ease-out;
        }

        .contact-info img:hover {
            transform: scale(1.2);
        }
        .overlay {
    background-image: linear-gradient(to right, rgba(90, 100, 232, 0.9), rgba(84, 96, 234, 0.9));
    width: 100%;
    height: 100%;
    z-index: 1;
    position: relative;
    padding: 110px 0;
}
.section-bg {
    background-size: cover;
    position: relative;
    background-position: left;
    z-index: 0;
    padding: 0;
    min-height: auto;
    overflow: hidden;
}
.contact-form {
    position: relative;
    padding: 45px 0 45px 60px;
}

.contact-form:before {
    position: absolute;
    content: '';
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    border-radius: 6px;
    background: #ffffff;
    box-shadow: 10px 40px 40px rgba(0,0,0,.2);
    pointer-events: none;
    right: auto;
    width: 100vw;
}
.particles-js-canvas-el {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 1;
}
.contact-form input {
    border: 0;
    background: transparent;

    display: block;
    width: 100%;
    min-height: 50px;
    padding: 11px 0;
    font-size: 16px;
    font-weight: 600;
    line-height: 27px;

    background-color: transparent;
    background-image: none;
    border-radius: 0;
    -webkit-appearance: none;
    transition: .3s ease-in-out;
    border: 2px solid transparent;
    border-bottom-color: rgba(0,0,0,.1);
}

.contact-form textarea {
    border: 0;
    background: transparent;
    display: block;
    width: 100%;
    min-height: 50px;
    padding: 11px 0;
    font-size: 16px;
    font-weight: 600;
    line-height: 27px;

    background-color: transparent;
    background-image: none;
    border-radius: 0;
    -webkit-appearance: none;
    transition: .3s ease-in-out;
    border: 2px solid transparent;
    border-bottom-color: rgba(0,0,0,.1);
}
.contact-form input::placeholder {
  color:#222;
}
.contact-form textarea::placeholder {
  color:#222;

}
.contact-form input {
    margin-bottom: 30px;
    font-size: 16px;
    font-weight: 600;
    height: 55px;
}
.contact-form input:hover, .contact-form input:focus{
    outline: none;
    box-shadow: none;
    background: transparent;
    border: 2px solid transparent;
    border-bottom-color: rgb(254, 132, 111);

}
.contact-form textarea:hover, .contact-form textarea:focus{
  background: transparent; 
    outline: none;
  box-shadow: none;
     border: 2px solid transparent;
    border-bottom-color: rgb(254, 132, 111);

}


.taso-btn {
    background-color: #fff;
    margin: 25px 0;
    color: #214dcb;
    -webkit-box-shadow: 0px 10px 30px 0px rgba(255, 255, 255, 0.32);
    box-shadow: 0px 10px 30px 0px rgba(255, 255, 255, 0.17);
}
.contact-info {
    padding: 0 30px 0px 0;
}

h2.contact-title {
    font-size: 35px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 30px;
}

.contact-info p {
    color: #ececec;
}

ul.contact-info {
    margin-top: 30px;
}

ul.contact-info li {
    margin-bottom: 22px;
}



ul.contact-info span {
    font-size: 20px;
    line-height: 26px;
}
ul.contact-info li {
    display: flex;
    width: 100%;
}

.info-left {
    width: 10%;
}

.info-left i {
    width: 30px;
    height: 30px;
    line-height: 30px;
    font-size: 30px;
    color: #ffffff;
}

.info-right h4 {
    color: #fff;
    font-size: 18px;
}
.contact-page .info-left i{
color: #FE846F;
}
.btn {
display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-family: 'Poppins', sans-serif;
    padding: 10px 30px 10px;
    font-size: 17px;
    line-height: 28px;
    border: 0px;
    border-radius: 10px;
    -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    -o-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
.btn-big {
    color: #ffffff;
    -webkit-box-shadow: 0px 5px 20px 0px rgba(45, 45, 45, 0.47843137254901963);
    box-shadow: 2px 5px 10px 0px rgba(45, 45, 45, 0.19);
    color: #fff !important;
    margin-right: 20px;
    background: #FE846F;
    transition: .2s;
    border: 2px solid #FE846F;
    margin-top: 50px;
}

@media only screen and (max-width: 767px) {
.contact-form {
    padding: 30px;
}
.contact-form:before {
    width: 100%;
}

}
.navbar {
    background-color: #007bff; /* Blue background */
    padding: 10px 0;
    position: sticky;
    top: 0;
    z-index: 1000; /* Ensure it stays on top */
}

.navbar .navbar-brand,
.navbar .nav-link {
    color: #fff; /* White text */
    font-size: 18px;
    padding: 10px 15px;
    transition: opacity 0.5s ease-out;
    font-weight: bold; /* Bold text */
}

.navbar .nav-link:hover {
    opacity: 0.8; /* Hover opacity */
}

    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Compassion Connect</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about-us">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#events">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#donations">Donate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="charityCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#charityCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#charityCarousel" data-slide-to="1"></li>
        <li data-target="#charityCarousel" data-slide-to="2"></li>
        <li data-target="#charityCarousel" data-slide-to="3"></li>
        <li data-target="#charityCarousel" data-slide-to="4"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/charity.jpg" class="img-fluid" alt="Charity Image">
        </div>
        <div class="carousel-item">
            <img src="images/hands.jpg" class="img-fluid" alt="Charity Image">
        </div>
        <div class="carousel-item">
            <img src="images/carousel-1.jpg" class="img-fluid" alt="Carousel Image 1">
        </div>
        <div class="carousel-item">
            <img src="images/carousel-2.jpg" class="img-fluid" alt="Carousel Image 2">
        </div>
        <div class="carousel-item">
            <img src="images/carousel-3.jpg" class="img-fluid" alt="Carousel Image 3">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#charityCarousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#charityCarousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="custom-card about-us-card sticky" id="about-us">
                    <div class="card-body">
                        <h2 class="card-title">About Us</h2>
                        <p class="card-text">
                        Our mission is to connect compassionate individuals with local charities that are making a real difference. We aim to support various causes, from education to environmental sustainability. By fostering a strong network of volunteers and donors, we strive to amplify the efforts of these organizations and create a lasting impact


                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <h1 class="display-4">Welcome, <?php echo $userFullName; ?>!</h1>
                    <p class="lead">Join us in making a difference.</p>
                    <hr class="my-4">
                    <p>Explore our ongoing campaigns and contribute to a cause you care about.</p>
                    <a class="btn btn-primary btn-lg" href="#events" role="button">View Campaigns</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="custom-card" id="events">
                    <div class="card-body">
                        <h2 class="card-title">Charity Campaigns</h2>
                        <p class="card-text">
                        Join us and participate in various campaigns organized by our charity partners. Each campaign is designed to address specific issues and needs, allowing you to support the causes that matter most to you. Learn about the goals, beneficiaries, and progress of each campaign
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($events as $event) : ?>
                
            <div class="col-lg-6">
                <div class="card event-card">
                    <img src="images/<?php echo $event['image']; ?>" class="card-img-top" alt="<?php echo $event['title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $event['title']; ?></h5>
                        <p class="card-text"><?php echo $event['description']; ?></p>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: <?php echo (intval(str_replace('$', '', $event['amount_raised'])) / intval(str_replace('$', '', $event['goal']))) * 100; ?>%"
                                aria-valuenow="<?php echo (intval(str_replace('$', '', $event['amount_raised'])) / intval(str_replace('$', '', $event['goal']))) * 100; ?>"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="card-text">
                            Raised: <?php echo $event['amount_raised']; ?> | Goal: <?php echo $event['goal']; ?>
                        </p>
                        <!-- Share buttons -->
                        <div class="share-buttons">
                            <!-- Replace # with actual sharing functionality links -->
                            <a href="#" class="btn btn-info mr-2">Share</a>
                        </div>
                        <a href="donations.php" class="btn btn-primary">Donate</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="container">
        <!-- New Picture Card -->
        <div class="card" id="staff">
            <div class="card-body">
                <h2>Our Team</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <img src="images/staff.jpg" class="img-fluid" alt="Team Picture">
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="custom-card" id="donations">
                    <div class="card-body">
                        <h2 class="card-title">Donations</h2>
                        <p class="card-text">
                            Your generous donations enable us to continue supporting charitable causes.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-bg" style="background-image: url(https://i.ibb.co/9p3Cnk9/slider-2.jpg);"  data-scroll-index="7">
          <div class="overlay pt-100 pb-100 ">
            <div class="container">
               <div class="row">
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="contact-info">

                            <h2 class="contact-title">Have Any Questions?</h2>
                            <p>Lorem ipsum is a dummy text used to replace text in some areas just for the purpose of an example. It can be used in publishing and graphic design. The lorem ipsum text is usually a section of a Latin text by Cicero with words altered, added and removed to make it nonsensical.</p>
                            <ul class="contact-info">
                                <li>
                                  <div class="info-left">
                                      <i class="fas fa-mobile-alt"></i>
                                  </div>
                                  <div class="info-right">
                                      <h4>+255692997249</h4>
                                  </div>
                                </li>
                                <li>
                                  <div class="info-left">
                                      <i class="fas fa-at"></i>
                                  </div>
                                  <div class="info-right">
                                      <h4>cc@gmail.com</h4>
                                  </div>
                                </li>
                                <li>
                                  <div class="info-left">
                                      <i class="fas fa-map-marker-alt"></i>
                                  </div>
                                  <div class="info-right">
                                      <h4>11333 Mwaikibaki road, Dar es salaam</h4>
                                  </div>
                                </li>-
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                            <div class="contact-form">
                                        <!--Contact Form-->
                                        <form id='contact-form' method='POST'><input type='hidden' name='form-name' value='contactForm' />
                                            <div class="row">
                                               <div class="col-md-12">
                                                  <div class="form-group">
                                                     <input type="text" name="name" class="form-control" id="first-name" placeholder="Enter Your Name *" required="required">
                                                  </div>
                                               </div>
                                               <div class="col-md-12">
                                                  <div class="form-group">
                                                     <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email *" required="required">
                                                  </div>
                                               </div>

                                               <div class="col-md-12">
                                                  <div class="form-group">
                                                       <textarea rows="4" name="message" class="form-control" id="description" placeholder="Enter Your Message *" required="required"></textarea>
                                                  </div>
                                               </div>
                                                <div class="col-md-12">
                                                    <!--contact button-->
                                                    <button  class="btn-big btn btn-bg">
                                                        Send  <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                    </div>
               </div>
           </div>
              </div>
        </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy2FZfNI4vEwaHc4zJKt02h6taRF0txlX2"
        crossorigin="anonymous"></script>
    <!-- AOS Library JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-yW7M2WWR6FLHjJvCez5uHDuF0Mz7oD9Cskw0JX1AZ9r85Ea4GQ2z0L/H1EQdlDjG27qKaMB6kZ+RInUa2oW9Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Initialize AOS Library -->
    <script>
        AOS.init();
    </script>
</body>

</html>

