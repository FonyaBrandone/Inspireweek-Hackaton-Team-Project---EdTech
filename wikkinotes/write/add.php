<?php
session_start();
include '../connect.php';
$mymail = $_SESSION['email'];
if (isset($_POST['save'])) {
    $subject = $_POST['subject'];
    $topic = $_POST['topic'];
    $content = $_POST['note'];
    $mail = $mymail;

    $sql = "INSERT INTO wikkinote(subjects,topic,content,user_email) VALUES('$subject', '$topic', '$content', '$mail');";
    $result = mysqli_query($con, $sql);
    if (!$result) { ?>
        <script>
            alert('Sorry, an error occured: <?php echo mysqli_error($con); ?>');
        </script>"
    <?php
        die(mysqli_error($con));
    } else { ?>
        <script>
            alert('Notes successfully Saved!');
        </script>"
<?php }
}
?>