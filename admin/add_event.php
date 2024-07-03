<form method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td style="color: #003300; font-weight: bold; font-size: 16px">Add Event Here:</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><input type="text" name="title" placeholder="Title"></td>
        </tr>
        <tr>
            <td><input type="date" name="date" placeholder="Date"></td>
        </tr>
        <tr>
            <td>
                <textarea name="content" placeholder="Description" class="text"></textarea>
            </td>
        </tr>
        <tr>
            <td><input type="file" name="image"></td>
        </tr>
        <tr>
            <td><input type="text" name="control_number" placeholder="Control Number"></td>
        </tr>
        <tr>
            <td><input type="submit" name="send" value="SAVE"></td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['send'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $control_number = $_POST['control_number'];

    // File upload
    $image_url = "";
    if (isset($_FILES['image'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploads/' . $image_name;

        // Move the uploaded image to the 'uploads' folder
        if (move_uploaded_file($image_tmp_name, $image_folder)) {
            $image_url = $image_folder;
        }
    }

    $qry = "INSERT INTO event (Title, Date, content, image_url, control_number) VALUES ('$title', '$date', '$content', '$image_url', '$control_number')";
    $result = mysqli_query($conn, $qry) or die(mysqli_error($conn));

    if ($result == TRUE) {
        echo "<script type='text/javascript'>
                window.location = ('events.php');
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Message Not Sent. Try Again');
              </script>";
    }
}
?>
