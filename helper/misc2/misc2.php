<?php

class misc2 extends config{
    
    public function mysqlConfig(){
		
       
		$servername = "localhost";
		$username = "devavv";
		$password = "vvinWIN@2019";
		$dbname = "abocarz";
		
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        return $conn;

		
	}
        
    public function get_value($table,$where,$id,$return){
            $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM ".$table." where ".$where."='$id'");
            $row = mysqli_fetch_array($query);
            return $row[$return];
    }
    public function get_value_limit($table,$where,$id,$where2,$id2,$return,$orderby,$asc){
        //echo "SELECT * FROM ".$table." where ".$where."='$id' and ".$where2."='$id2' order BY ".$orderby." ".$asc."";
            $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM ".$table." where ".$where."='$id' and ".$where2."='$id2' order BY ".$orderby." ".$asc."");
            $row = mysqli_fetch_array($query);
            return $row[$return];
    }
	
}
?>