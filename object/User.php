<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table = "users";
 
    // object properties
    public $id;
    public $name;
    public $password;
    public $email;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    public function read(){
    	$sql = "select * from users";
    	$stmt = $this->conn->prepare($sql);
    	$stmt->execute();
    	return $stmt;
    }
    public function rowCount(){
    	$sql = "select count(*) from users";
    	$stmt = $this->conn->prepare($sql);
    	$stmt->execute();
    	return $stmt;
    }
    public function create(){
    	
    	// query to insert record
    	$query = "INSERT INTO users(name,email,password) VALUES(:name, :email, :password)"; //, created=:created
    	
    	// prepare query
    	$stmt = $this->conn->prepare($query);
    	
    
    	// sanitize
    	//$this->id=htmlspecialchars(strip_tags($this->id));
    	$this->name=htmlspecialchars(strip_tags($this->name));
    	$this->email=htmlspecialchars(strip_tags($this->email));
    	$this->password=htmlspecialchars(strip_tags($this->password));
    	//$this->created_at=htmlspecialchars(strip_tags($this->created));
    	
    	//echo 1;
    	//var_dump($this->name);
    	//var_dump($this->email);
    	//var_dump($this->password);
    	// bind values
    	//$stmt->bindParam(":id", $this->id);
    	$stmt->bindParam(":name", $this->name);
    	$stmt->bindParam(":email", $this->email);
    	$stmt->bindParam(":password", $this->password);
    	//$stmt->bindParam(":created", $this->created);
    	//echo 2;
    	// execute query
    	//var_dump($stmt);
    	if($stmt->execute()){
    		//echo 3;
    		return true;
    		//exit();
    	}
    	
    	return false;
    	
    }
    
    function update(){
    	
    	// update query
    	$query = "UPDATE
                " . $this->table . "
            SET
                name = :name,
                password = :password,
                email = :email
            WHERE
                id = :id";
    	
    	// prepare query statement
    	$stmt = $this->conn->prepare($query);
    	
    	// sanitize
    	$this->name=htmlspecialchars(strip_tags($this->name));
    	$this->email=htmlspecialchars(strip_tags($this->email));
    	$this->password=htmlspecialchars(strip_tags($this->password));
    	$this->id=htmlspecialchars(strip_tags($this->id));
    	
    	// bind new values
    	$stmt->bindParam(':name', $this->name);
    	$stmt->bindParam(':email', $this->email);
    	$stmt->bindParam(':password', $this->password);
    	$stmt->bindParam(':id', $this->id);
    	
    	// execute the query
    	if($stmt->execute()){
    		return true;
    	}
    	
    	return false;
    }
	
    function delete(){
    	
    	// delete query
    	$query = "DELETE FROM " . $this->table . " WHERE id = ?";
    	
    	// prepare query
    	$stmt = $this->conn->prepare($query);
    	
    	// sanitize
    	$this->id=htmlspecialchars(strip_tags($this->id));
    	
    	// bind id of record to delete
    	$stmt->bindParam(1, $this->id);
    	
    	// execute query
    	if($stmt->execute()){
    		return true;
    	}
    	
    	return false;
    	
    }
 	
    function readOne(){
    	
    	// query to read single record
    	$query = "SELECT * FROM " . $this->table . " WHERE  id = ? LIMIT 0,1";
    	
    	// prepare query statement
    	$stmt = $this->conn->prepare( $query );
    	
    	// bind id of user to be updated
    	$stmt->bindParam(1, $this->id);
    	
    	// execute query
    	$stmt->execute();
    	
    	// get retrieved row
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	
    	// set values to object properties
    	$this->name = $row['name'];
    	$this->email = $row['email'];
    	$this->password = $row['password'];
    	
    }
    
}
?>