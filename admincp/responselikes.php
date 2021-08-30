<?php
session_start();
/* Database connection start */
$servername = "localhost";
		$username = "devavv";
		$password = "vvinWIN@2019";
		$dbname = "jobbvin";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>

<?php
	 
	// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

 
	
	//define index of column
	$columns = array( 
	
		0 => 'ROW',
		1 => 'likes_product_id', 
		2 => 'pic_title',
		3 => 'likes_cus_name',
		4 => 'likes_cus_email',
		5 => 'likes_cus_mobile',
		6 => 'contact_no'
		
		
				
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( pic_addpost.pic_ads_id LIKE '".$params['search']['value']."%' OR pic_addpost.pic_title LIKE '".$params['search']['value']."%' ) ";    
		
	}
	
	if(empty($params['search']['value'])){
	
	//$where .=" where pa.pic_ads_id=pai.addpost_id and pa.pic_category=pc.categories_id and pa.pic_user_email=pu.user_email";
	$where .="";
	
	}

	// getting total number records without any search
	
	
	
	//$sql = "SELECT pic_ads_id,pic_request,pic_ads_id,addpost_id,ad_image_url,pic_title,categories_name,pic_user_fullname,pic_user_email,pic_user_mobile,user_refer,pic_add_town,pic_add_taluk,pic_post_city,pic_id,addpost_status,pic_postdate FROM `pic_addpost` as pa,`pic_addpost_images` as pai,`pic_categories` as pc,`pic_user` as pu";<br />



	
	$sql ="SELECT (@row:=@row+1) AS ROW,like_id,likes_product_id,likes_cus_id,likes_cus_name,likes_cus_mobile,likes_cus_email,likes_ads_user_id,contact_no,pic_title,pic_ads_id FROM (SELECT @row := 0) r, pic_likes LEFT JOIN ( pic_addpost ) ON ( pic_likes.likes_product_id = pic_addpost.pic_ads_id) where pic_addpost.pic_ads_id!=''";
	
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
	
	//$sqlRec .=  " ORDER BY pic_id DESC  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


	$totalRecords = mysqli_num_rows($queryTot);
	//$sql1 ="SET @count:=0;";
//mysqli_query($sql1);
	

	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");


	//iterate on results row and create new index array of data
	$z=1;
	while( $row = mysqli_fetch_array($queryRecords) ) { 
	
	$adsids = $row['pic_ads_id'];
	
	$pic_validity_auto = $row['pic_validity_auto'];
	if($pic_validity_auto==1){
		$pic_validity_auto_str="checked";
	}
	else{
		$pic_validity_auto_str="";
	}
	
	$pic_validity = $row['pic_validity'];
	
		$row[0]=$row['ROW'];
		$row[1]=$row['likes_product_id'];
		$row[2]=$row['pic_title'];
		$row[3]=$row['likes_cus_name'];
		$row[4]=$row['likes_cus_email'];
		$row[5]=$row['likes_cus_mobile'];
		$row[6]=$row['contact_no'];
		
		$data[] = $row;
		$z++;
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
	
	
?>

