<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");
 
	
	if(isset($_POST['submit']))
	{

		$count = count($_FILES['wallpaper_image']['name']);
		for($i=0;$i<$count;$i++)
		{ 
			 $albumimgnm=rand(0,99999)."_".$_FILES['wallpaper_image']['name'][$i];
			  
			 $tpath1='images/animation/'.$albumimgnm;	
       $pic1=$_FILES['wallpaper_image']['tmp_name'][$i];   
         
       copy($pic1,$tpath1);
	  
          
		        $data = array( 					    
					    'image'  =>  $albumimgnm
					    );		

		 		$qry = Insert('tbl_wallpaper_gif',$data);	

 	     }			

		$_SESSION['msg']="10";
 
		header( "Location:add_wallpaper_animation.php");
		exit;	

		 
	}
	
	  
?>
<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Add GIF</div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
               	 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                	<?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?>	
              </div>
            </div>
          </div>
          <div class="card-body mrg_bottom"> 
            <form action="" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
 
              <div class="section">
                <div class="section-body">
                    
                  <div class="form-group">
                    <label class="col-md-3 control-label">GIF Image :-</label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="wallpaper_image[]" value="" id="fileupload" multiple required>
                       <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="category image" /></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>       
