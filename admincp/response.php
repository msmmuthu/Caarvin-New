<?php
session_start();
/* Database connection start */
$servername = "localhost";
		$username = "devavv";
		$password = "vvinWIN@2019";
		$dbname = "jobbvin";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysql_connect_error());

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
		1 => 'pic_request', 
		2 => 'pic_ads_id',
		3 => 'pic_title',
		4 => 'categories_name',
		5 => 'pic_user_fullname',
		6 => 'user_refer',
		7 => 'pic_post_city',
		9 => 'addpost_status',
		10 => 'pic_postdate'
		
		
		
				
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



	
	$sql ="SELECT pic_ads_id, pic_request, pic_ads_id, addpost_id, ad_image_url, pic_title, categories_name, pic_user_fullname, pic_user_email, pic_user_mobile, user_refer, pic_add_town, pic_add_taluk, pic_post_city, pic_id, addpost_status, pic_postdate,pic_category,pic_validity,pic_validity_auto,
(@row:=@row+1) AS ROW FROM (SELECT @row := 0) r, pic_addpost
LEFT JOIN (
pic_addpost_images, pic_categories, pic_user
) ON ( pic_addpost_images.ad_image_order = 1 AND pic_addpost_images.addpost_id = pic_addpost.pic_ads_id
AND pic_categories.categories_id = pic_addpost.pic_category
AND pic_user.user_email = pic_addpost.pic_user_email ) ";
	
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}

	
	if($columns[$params['order'][0]['column']] == 'ROW')
	$params['order'][0]['dir'] = 'DESC';

 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
	
	//$sqlRec .=  " ORDER BY pic_id DESC  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


	$totalRecords = mysqli_num_rows($queryTot);
	//$sql1 ="SET @count:=0;";
//mysql_query($sql1);
	

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
		if($row[1]==0){ $row[1]="Post"; } else { $row[1]="Request"; } 
		$row[2] = $row['pic_ads_id'];
		$row[3]="<a href='../media/".$row['ad_image_url']."' target='_blank'><img class='img_tbl'  src='../media/small/".$row['ad_image_url']."'/></a><br />".$row['pic_title']."";
		$row[4] = $row['categories_name'];
		$row[5] = $row['pic_user_fullname']."</br>".$row['pic_user_email']."</br>".$row['pic_user_mobile'];
		$row[6] = $row['user_refer'];
		$row[7] = $row['pic_add_town']."</br>".$row['pic_add_taluk']."</br>".$row['pic_post_city']." District";
		$row[8] = "<div class='link_href'><a href='index.php?action=view&module=Ads&post=picture&id=".$row['pic_id']."'>Picture</a></div><div class='link_href'><a href='index.php?action=view&module=Ads&post=tagform&id=".$row['pic_id']."'>Tags</a></div>";
		
		if($row[15]==1){ $row[8] .= "<div class='link_href'><a href='javascript:void(0)' id=".$row['pic_id']." name='0' onclick=\"updateAjaxAds(this,'request');\">Cancel</a></div>"; $row[9]="Approved"; } else { $row[8] .= "<div class='link_href'><a  href='javascript:void(0)' id=".$row['pic_id']." name='1' onclick=\"updateAjaxAds(this,'request');\">Accept</a></div>"; $row[9]="Requested";} 
		if($row[15]==1){ $row[8] .= "<div class='link_href'><a href='javascript:void(0)' id=".$row['pic_id']." onclick=\"updateAjaxAds2(this,'act');\">Deactive</a></div>"; } else { $row[8] .= "<div class='link_href'><a href='javascript:void(0)' id=".$row['pic_id']." onclick=\"updateAjaxAds2(this,'deact');\">Active</a></div>"; }
		//$row[8] .= "<div class='link_href'><a href='index.php?action=view&module=Ads&post=edit&sub=".$row['pic_category']."&id=".$row['pic_ads_id']."'>Edit</a></div>";
		
		$row[8] .= "<div class='link_href'><a href='javascript:void(0)' id=".$row['pic_ads_id']." onclick=\"updateAjaxAds2(this,'deleterefund');\" >Delete & Refund</a></div><div class='link_href'><a href='javascript:void(0)' id=".$row['pic_ads_id']." onclick=\"updateAjaxAds2(this,'delete');\">Delete</a></div>";
		
		$row[10] = date('d-M-Y', strtotime($row['pic_postdate']));
		
		
		
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

<?php
function validityfn($id){
  $cat_query = mysql_query("SELECT * FROM `pic_validity` where pic_validity_id=1");
  $row = mysql_fetch_array($cat_query);
  ?>
  <label> <?php echo $row['pic_validity_label']; ?>
  <input type="radio" name="dates" id="radio" value="<?php echo $row['pic_validity_date']; ?>" />
  </label>
  <label> <?php 
  $cat_query1 = mysql_query("SELECT * FROM `pic_addpost` where pic_ads_id=$id");
  $row1 = mysql_fetch_array($cat_query1);
  ?>
  <label>
  Custom Date
  </label>
  <input name="dates" type="text" id="choose_validity" style="width:100%;" size="30" value="<?php echo $row1['pic_validity']; ?>">
  <?php
  
}
?>
	