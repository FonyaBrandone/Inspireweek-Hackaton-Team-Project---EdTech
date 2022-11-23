<div class="dropdown" >
        <button class="btn dropdown-toggle text-white justify-content-start align-items-start" data-bs-toggle="dropdown">
         <i class="fa fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu mb-4">
            <li><a class="dropdown-item" style="color: #021867;" href="#">Edit Profile</a></li>
            <li><a class="dropdown-item" style="color: #021867;" href="#">Change Password</a></li>
            <li><a class="dropdown-item" style="color: #021867;" href="?action=logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
        </ul>
        </div>

<div class="sidebar-wrapper mb-4">
      <div class="card">
       <div class="card-header">
       <div class="message-to d-flex">
          <?php 
             $sql = "SELECT * FROM user WHERE unique_id='$id'";
             $res = $db->select($sql);
             if($res){
             foreach($res as $user){ ?>
             <img src="<?php echo $user['img']; ?>"> 
             <?php
             $type_role = $user['roles'];
             if($type_role == 'user'){
                $xyz = 'Mentors';
             }else{
                $xyz = 'Students';
             }
             ?>
             <i class="fa fa-circle"></i>
             <h6><?php echo $user['username']; ?></h6>
             <p>
                <?php
                 if($user['status'] == "Active"){
                     echo "Active Now";
                 }else{
                     echo "Offline";
                 } 
                ?> 
             </p>
          <?php } } ?>
       </div>
       <!-- <a href="?action=logout"><i class="fa fa-sign-out"></i> Logout</a> -->


       </div>
       <div class="card-body">
       <div class="user-list-box">
            <ul>
              <?php 
               $query  = "SELECT * FROM user WHERE unique_id != '$id' && roles != '$type_role'";
               $result = $db->select($query);
               if($result){

               foreach($result as $list){ ?>
                
                <li>
                    <a href="chat.php?sender=<?php echo $id; ?>&receiver=<?php echo $list['unique_id']; ?>" class="d-flex align-items-center">
                        <img src="<?php echo $list['img']; ?>">
                        <?php 
                         if($list['status'] == "Active"){
                            echo "<i class='fa fa-circle'></i>";
                         }else{
                             echo "<i class='fa fa-circle offline'></i>";
                         }
                        ?>
                        <h6><?php echo $list['username']; ?></h6>
                    </a>
                </li>
                <?php } } ?>   
            </ul>   
        </div>
       </div>
      </div>
    </div>