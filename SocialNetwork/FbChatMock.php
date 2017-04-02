<?php
session_start();


class FbChatMock {

  // Holds the database connection
  private $dbConnection;
  
  //----- Database connection details --/
  //-- Change these to your database values
  
  private $_dbHost = 'localhost';
  
  private $_dbUsername = 'u679748943_chatt';
  
  private $_dbPassword = 'chatterbox';
  
  public $_databaseName = 'u679748943_chatt';
  
  //----- ----/

  /**
   * Create's the connection to the database and stores it in the dbConnection
   */
  public function __construct() {
    $this->dbConnection = new mysqli($this->_dbHost, $this->_dbUsername, 
        $this->_dbPassword, $this->_databaseName);

    if ($this->dbConnection->connect_error) {
      die('Connection error.');
    }
  }

  /**
   * Get the list of messages from the chat
   * 
   * @return array
   */
  public function getMessages($name) {
    $messages = array();
    $query ="select * from ".$_SESSION["uname"]."_chat_table where (`f`='".$_SESSION["uname"]."' and `t`='$name') or (`f`='$name' and `t`='".$_SESSION["uname"]."') order by send_on";
    // Execute the query
    $resultObj = $this->dbConnection->query($query);
	if(!$resultObj){
		echo "Query Failed";
	}
    // Fetch all the rows at once.

      $no=$resultObj->num_rows;
    while ($row = $resultObj->fetch_assoc()) {
      $messages[] = $row;
    }
    return $messages;
  }

  /**
   * Add a new message to the chat table
   * 
   * @param Integer $userId The user who sent the message
   * @param String $message The Actual message
   * @return bool|Integer The last inserted id of success and false on faileur
   */
  public function addMessage($from,$to,$message) {
    $addResult = false;
    
    // Escape the message with mysqli real escape
    $cMessage = $this->dbConnection->real_escape_string($message);
    
    $query = "INSERT INTO ".$from."_chat_table values ('$from','$to','$message',TIMESTAMPADD(MINUTE,330,NOW()))";

    $result = $this->dbConnection->query($query);
    
    if ($result !== false) {
      // Get the last inserted row id.
      $addResult = $this->dbConnection->insert_id;
    } else {
      echo $this->dbConnection->error;
    }
    
 $query = "INSERT INTO ".$to."_chat_table values ('$from','$to','$message',TIMESTAMPADD(MINUTE,330,NOW()))";

    $result = $this->dbConnection->query($query);
    
    if ($result !== false) {
      // Get the last inserted row id.
      $addResult = $this->dbConnection->insert_id;
    } else {
      echo $this->dbConnection->error;
    }
    return $addResult;
  }

public function addImage($userId, $image_name){
    $addResult = false;
    
    $cUserId = (int) $userId;
    // Escape the message with mysqli real escape
    $cimage_name = $this->dbConnection->real_escape_string($image_name);
   	$query = "INSERT INTO `chat`(`user_id`, `file`, `sent_on`)
		VALUES ('$cUserId', '$cimage_name', TIMESTAMPADD(MINUTE,330,NOW()))";
	
    $result = $this->dbConnection->query($query);
    
    if ($result !== false) {
      // Get the last inserted row id.
      $addResult = $this->dbConnection->insert_id;
    } else {
      echo $this->dbConnection->error;
    }
    
    return $addResult;
  } 
}	