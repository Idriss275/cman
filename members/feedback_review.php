<?php
session_start(); // Start the session

// Include necessary PHP files for session management and database connection
// Assuming you have included files here for session handling and database connection

// Function to fetch reviews from the database
function fetchReviews() {
    // Replace with your database connection code
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch reviews (adjust query based on your table structure)
    $sql = "SELECT * FROM reviews ORDER BY created_at DESC";
    $result = $conn->query($sql);

    // Check if there are reviews
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars($row['feedback']) . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No reviews yet.</p>'; // Display if no reviews found
    }

    $conn->close();
}

// Include header and navigation
include('header.php'); // Replace with your header file name

// Ensure CSS and JS are linked from the main welcome page
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback & Reviews - Charity Management System</title>
    <!-- Link to Bootstrap CSS (use the same version as in your welcome page) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
        crossorigin="anonymous">
    <!-- Link to AOS Library CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet"
        integrity="sha512-M/b0B08JKpFUpWkPjPZ0lEYeD4TZoDZ88GAlu1JLz6X3oM4/Whi5MOA9Uk7DlOgubK9rO6gV+G4bC8g9QInKdA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link to your custom CSS (copy styles from your welcome page) -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional styles specific to feedback_reviews.php */
        /* You can add specific styles for your feedback and reviews page here */
    </style>
</head>

<body>

    <!-- Navigation Bar (include from header.php or create inline) -->
    <?php include('navbar.php'); ?> <!-- Replace with your navigation bar file or create inline -->

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Feedback & Reviews</h2>
                        <p class="card-text">
                            Share your experience and thoughts about our charity. Your feedback helps us improve!
                        </p>

                        <!-- Example Form (replace with your actual feedback form) -->
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label for="name">Your Name:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?php echo isset($_SESSION['user_row']) ? ($_SESSION['user_row']['fname'] . ' ' . $_SESSION['user_row']['lname']) : 'Guest'; ?>"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="feedback">Your Feedback:</label>
                                <textarea class="form-control" id="feedback" name="feedback" rows="4"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </form>

                        <!-- Display Existing Reviews -->
                        <div class="mt-4">
                            <h4>Existing Reviews</h4>
                            <?php fetchReviews(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
