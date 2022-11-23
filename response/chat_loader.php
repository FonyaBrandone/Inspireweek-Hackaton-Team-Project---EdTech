<?php 
  include_once '../config/config.php';
  include_once '../lib/database.php';
  $db = new Database;
?>
<?php 
    $receiver = $_GET['receive'];
    $sender   = $_GET['send'];
    $sql = "SELECT *FROM tbl_message LEFT JOIN user ON user.unique_id = tbl_message.outgoing_msg_id 
    WHERE incoming_msg_id='$receiver' AND outgoing_msg_id='$sender' || outgoing_msg_id='$receiver' AND 
    incoming_msg_id='$sender' ORDER BY msg_id ASC";
    $res = $db->select($sql);
    if($res){
    foreach($res as $msg){ 
    if($receiver == $msg['unique_id']){
    ?>
    <div class="item-group-you d-flex">
        <img src="<?php echo $msg['img']; ?>">
        <div class="text-message-you">
        <?php echo $msg['text_message']; ?>
        </div>
        <p class="time-track-you">
        <?php echo $msg['curr_date'] . $msg['curr_time'] ; ?>
        </p>
    </div>
    <?php }else{ ?>

    <div class="item-group-other d-flex">
        <img src="<?php echo $msg['img']; ?>">
        <div class="text-message-other">
        <?php echo $msg['text_message']; ?>
        </div>
        <p class="time-track-other">
        <?php echo $msg['curr_date'] . $msg['curr_time'] ; ?>
        </p>
    </div> 

    <?php } ?>
    <?php } } ?>