 <?php 
 class Database
 {
  private $server = 'localhost';
  private $user   = 'root';
  private $pass   = '';
  private $db     = 'chatroom';
  private $pdo; 

  public function __construct()
  {
       $this->db_connect();
  }

  public function db_connect()
  {
  	$this->pdo = null;
    try{
        $this->pdo = new PDO("mysql:host=".$this->server.";dbname=".$this->db, $this->user, $this->pass);
       	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(!$this->pdo){
        	return false;
        }	
    }catch(PDOException $e){
       echo $e->getMessage();
    }
  }



  /*-----------Common Insert Data----------*/
     public function insert($query){
       $insert_row = $this->pdo->prepare($query);
       $insert_row->execute();
         if($insert_row){
           return $insert_row;
           exit();
         }
     }
  /*-----------Common Insert Data----------*/



/*-----------Common Select Method----------*/
	 public function select($query){
	   $select_row = $this->pdo->prepare($query);
	   $select_row->execute();
       if($select_row->rowCount() > 0){ 
       // Alt count -> count($select_row);
       	 return $select_row->fetchAll(PDO::FETCH_ASSOC);
       }
	 }
/*-----------Common Select Method----------*/




  /*-----------Common Update Data----------*/
     public function update($query){
       $update_row = $this->pdo->prepare($query);
       $update_row->execute();
         if($update_row){
           return $update_row;
           exit();
         }
     }
  /*-----------Common Update Data----------*/
 


  /*-----------Common delete Data----------*/
     public function delete($query){
       $delete_row = $this->pdo->prepare($query);
       $delete_row->execute();
         if($delete_row){
           return $delete_row;
         }
     }
  /*-----------Common delete Data----------*/


 
 /*------------ Login -------------*/
public function login($user, $pass){
    try{
          $sql   = "SELECT * FROM user WHERE email=:user";
          $stmt  = $this->pdo->prepare($sql);
          $stmt->bindParam(":user", $user);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
            foreach($result as $row){
             if(password_verify($pass, $row['pass'])){
                $_SESSION['unique_id']  = $row['unique_id'];
                $_SESSION['email']      = $row['email'];
                $_SESSION['username']   = $row['username'];
                
                //login active status
                $id =  $_SESSION['unique_id'];
                $update = $this->pdo->prepare("UPDATE user SET status='Active' WHERE unique_id='$id'");
                $update->execute();

                echo "<script>window.location='index.php';</script>";
             }else{
              echo "<div class='alert alert-danger'>Incorrect Password</div>";
             }
            } 
           }else{
            echo "<div class='alert alert-danger'>Incorrect Email!</div>";
           }
          }catch(PDOException $e){
            echo $e->getMessage();
      }
  }
  /*------------ Login ------------*/

}
?>



