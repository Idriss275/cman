<?php
$get_id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM event WHERE id = '$get_id'");
$row = mysqli_fetch_array($query);
?>

<form method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label" for="inputEmail">Event Title</label>
        <div class="controls">
            <input type="text" name="title" id="inputEmail" value="<?php echo $row['Title']; ?>" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Description</label>
        <div class="controls">
            <textarea name="content" id="inputPassword" required><?php echo $row['content']; ?></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Date</label>
        <div class="controls">
            <input type="date" name="date" id="inputPassword" value="<?php echo $row['Date']; ?>" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="control_number">Control Number</label>
        <div class="controls">
            <input type="text" name="control_number" id="control_number" value="<?php echo $row['control_number']; ?>" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="event_image">Event Image</label>
        <div class="controls">
            <input type="file" name="event_image" id="event_image">
            <?php if ($row['image_url']) { ?>
                <img src="<?php echo $row['image_url']; ?>" alt="Event Image" style="max-width: 100px;">
            <?php } ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" name="update" class="btn btn-success"><i class="icon-save icon-large"></i> Update</button>
        </div>
    </div>
</form>

<?php
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $control_number = $_POST['control_number'];
    $image_url = $row['image_url'];

    // Handle image upload
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
        $image_tmp = $_FILES['event_image']['tmp_name'];
        $image_name = $_FILES['event_image']['name'];
        $image_size = $_FILES['event_image']['size'];
        $image_type = $_FILES['event_image']['type'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_ext = array("jpg", "jpeg", "png", "gif");

        if (in_array($image_ext, $allowed_ext)) {
            $image_url = "uploads/" . uniqid() . "." . $image_ext;
            move_uploaded_file($image_tmp, $image_url);
        } else {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
        }
    }

    mysqli_query($conn, "UPDATE event SET Title='$title', content='$content', Date='$date', control_number='$control_number', image_url='$image_url' WHERE id='$get_id'") or die(mysqli_error($conn));
    echo "<script>window.location = 'edit_event.php?id=$get_id';</script>";
}
?>
