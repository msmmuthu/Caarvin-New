<?php

class dashboard extends config{

	public function main(){
	$userid = $_SESSION['fm']['portal']['userid'];
	?>
   

   

    
      <div class="container-fluid">
        <h3 class="mt-4">Welcome to admin portal</h3>
      </div>
    

  

      <?php $this->footer(); ?>

        
    <?php
	}
        public function header() {
            
        }
        
        public function footer() {
            ?>
      
      <?php
        }
	
	 
}
?>