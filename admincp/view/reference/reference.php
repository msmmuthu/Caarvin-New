<?php
class reference extends config{

	public function form(){ ?>
	
    <div class="container">
    
    <div class="row">
        <div class="col-12 pt-4">
            <h4>Set Reference</h4>
		<style type="text/css">
        #rows tr>th{
        padding:5px;
        border-style:solid;
        border-width:thin;
        border-color:#999999;
        }
        #rows tr>td{
        padding:5px;
        border-style:solid;
        border-width:thin;
        border-color:#999999;
        }
        a{
        text-decoration:none;
        }
        </style>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="cat_pri" id="cat_pri" method="post" >
            <table class="table" id="rows" width="100%" border="0">
            <tr>
            <td ><strong>User ID</strong></td>
            <td >
            <?php 
            $id = $_REQUEST['id'];
            $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_user` WHERE user_id=$id");
            $row = mysqli_fetch_array($query);
			$user_refer = $row['user_refer'];
            ?>
                <input class="form-control" type="text" name="userid" id="userid" disabled="disabled"  value="PA00<?php echo $row['user_id']; ?>" />
            <input type="hidden" name="action" value="model" />
            <input type="hidden" name="module" value="reference" />
            <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>" />
            </td>
            </tr><tr>
            <td ><strong>Reference ID</strong></td>
            <td >
            
    
            <select class="selectpicker" data-live-search="true" name="referid">
            <?php 
            $id = $_REQUEST['id'];
            $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_user`");
            while($row = mysqli_fetch_array($query)){
            ?>
            <option value="PA00<?php echo $row['user_id']; ?>" data-tokens="PA00<?php echo $row['user_id']; ?>">PA00<?php echo $row['user_id']; ?> - <?php echo $row['user_email']; ?></option>
            <?php
			}
			?>
            </select>

            
            </td></tr><tr>
            <td colspan="2"><input type="submit" name="save" id="save" value="Submit" class="btn btn-primary" ></td></tr>
            </table>
        </form>
    </div>
    </div>
    </div>
	
    <?php
    }
	
}
?>
