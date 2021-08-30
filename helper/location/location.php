<?php

class location extends config{

	
	
    public function taluk(){ ?>
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
	
	<script type="text/javascript">
              
		$('#hint').bind('keydown', function () {
			var ts = $("#taluk_select").val();
			var ct= $("#city_header").val();
			
			$("#hint").autocomplete({
			source:'gethint.php?ts='+ts+'&ct='+ct+'',
			minLength:1
			});
		});

        </script>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<!--<label for="city_header">Choose Taluk</label>-->
<div class="form-label-group">
<select  class="form-control select_city" style="width:100%;"  name="taluk_select" id="taluk_select" >
<option value="0" selected>Select Taluk</option>
<?php
//$location_query = mysqli_query($this->mysqlConfig(),"select DISTINCT city2  from pic_geometric where city1='".$_POST['value_city']."' order by lan,lon ASC");
$location_query = mysqli_query($this->mysqlConfig(),"select DISTINCT city2  from pic_geometric where city1='".$_POST['value_city']."' order by city2 ASC");
while($row = mysqli_fetch_object($location_query)){
?>
<option  value="<?php echo $row->city2; ?>"> <?php echo $row->city2; ?> </option>
<?php } ?>
</select>
</div>
<!--<label for="city_header">Company Address</label>-->
<div class="form-group">

<input id="hint" autocomplete="off" class="form-control" style="margin-top: 6px;width:100%;" type="text" name="town"  required placeholder="Enterrrrrrr Town Name.." />

</div>
<input id="set_loc_btn" class="btn btn-primary" type="submit" name="setlocation"  value="Set Location"  />
    <div id="loading-image-location" style="display:none;text-align: center;background: rgba(255, 255, 255, 0.81);border-radius: 5px;margin: 0px -10px;position: absolute;width: 210px;height: 119px;">
				<img src="css/images/circel.gif">
				</div>
				
                               
				
    <?php
	}
	
	public function talukAll(){ ?>
	<div class="col-2">
                                    <div class="search-title">Select Taluk *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
                                    <select class="form_txt"  name="taluk_select" id="taluk_select" >
				<option value="0" selected>Select</option>
				<?php
				
				$location_query = mysqli_query($this->mysqlConfig(),"select DISTINCT city2  from pic_geometric where city1='".$_POST['value_city']."' order by lan,lon ASC");
				
				while($row = mysqli_fetch_object($location_query)){
				?>
				
				<option  value="<?php echo $row->city2; ?>"> <?php echo $row->city2; ?> </option>
				
				<?php } ?>
				</select>

                                        

                                    </div>
                                    <div class="space_10"></div>
                                    <div class="col-2">
                                    
                                    <div class="rows">
                                    <input type="text" name="town" class="form_txt" required placeholder="Town" />
                                    

                                        

                                    </div>
                                </div>
                                </div>
    <?php
	}
		
}
?>