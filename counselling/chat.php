<?php
   include_once 'lib/session.php';
   session::checkSession();

   if(!isset($_GET['sender']) && $_GET['receiver'] == null){
     echo "<script>window.location='index.php';</script>";
   }else{
      $sender   = $_GET['sender'];
      $receiver = $_GET['receiver'];
   }
?>
<!-- Getting Sender & Receiver Id through hidden inputs -->
<input type="hidden" id="receive" value="<?php echo $receiver; ?>"> 
<input type="hidden" id="send" value="<?php echo $sender; ?>">
<!-- Getting Sender & Receiver Id through hidden inputs -->

<?php  require_once 'inc/header.php'; ?>
 <section class="container">
  <div class="main-wrapper" style="height: 380px;">
  <div class="row">
   <div class="col-xl-4">
   <!-- Dynamic Sidebar -->
    <?php include_once 'inc/sidebar.php'; ?>
   <!-- Dynamic Sidebar -->
   </div>
   <div class="col-xl-8 mt-5">
    <div class="right-panel mb-4">
     <div class="card">
      <div class="card-header"  style="background-color: rgb(35, 35, 63); color: white;">
       <div class="message-to d-flex ">
       <?php 
          $query  = "SELECT * FROM user WHERE unique_id='$receiver'";
          $result = $db->select($query);
          if($result){
          foreach($result as $active_user){ ?>
          <img src="<?php echo $active_user['img']; ?>"> 
          <?php 
            if($active_user['status'] == "Active"){
              echo "<i class='fa fa-circle'></i>";
            }else{
                echo "<i class='fa fa-circle offline'></i>";
            }
          ?>
          <h6><?php echo $active_user['username']; ?></h6>
          <?php 
            if($active_user['status'] == "Active"){
              echo "<p>Active</p>";
            }else{
              echo "<p>Offline</p>";
            }
          ?>
          <?php } } ?>
       </div>
      </div>
      <div class="card-body">
       <div class="chat-wrapper">
        <div class="chat-body">
          <div id="chat_load"></div>
          <script type="text/javascript">
           $(function(){
            const receive = $('#receive').val(); 
            const send    = $('#send').val(); 
            const dataStr = 'receive='+receive+'&send='+send;
             setInterval(function(){
              $.ajax({
                type:'GET',
                url:'response/chat_loader.php',
                data:dataStr,
                success:function(e){
                  $('#chat_load').html(e);
                }
              });   
             }, 100);
           });
          </script>
        </div> 
        <div class="type-chats">
          <form method="POST" id="chatForm">
           <textarea id="message" style="resize:none;" placeholder="Enter your Message..." class="form-control mb-3"></textarea>
           <button onclick="return chat_validation()" class="btn btn-sm btn-info text-light"> Send</button>
          </form>
          <div id="msg"></div>  
          <script type="text/javascript">
           function chat_validation(){
            const textmsg = $('#message').val();
            const receive = $('#receive').val(); 
            const send    = $('#send').val(); 

            if(textmsg == ""){
             alert('Type Message....');
             return false;
            }
            const datastr = 'message='+textmsg+'&receive='+receive+'&send='+send;
             $.ajax({
              url:'response/chatlog.php',
              type:'POST',
              data:datastr,
              success:function(e){
                $('#msg').html(e);
              }
              
            });
            document.getElementById('chatForm').reset();
              //scroll to see latest message automatically:
              $(".chat-body").scrollTop($(".chat-body")[0].scrollHeight);
            return false;
           }
          </script>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  </div>
 </section>
<?php  require_once 'inc/footer.php'; ?>