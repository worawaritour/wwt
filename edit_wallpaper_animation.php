<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

 
  $qry="SELECT * FROM tbl_wallpaper_gif where id='".$_GET['wallpaper_id']."'";
  $result=mysqli_query($mysqli,$qry);
  $row=mysqli_fetch_assoc($result);
	
	if(isset($_POST['submit']))
	{

    		if($_FILES['wallpaper_image']['name']!="")
        { 


    			 $albumimgnm=rand(0,99999)."_".$_FILES['wallpaper_image']['name'];
       
           //Main Image
           $tpath1='images/animation/'.$albumimgnm;   
           $pic1=$_FILES['wallpaper_image']['tmp_name'];   
         
           copy($pic1,$tpath1);
       
           
              
    		        $data = array( 
    					    'image'  =>  $albumimgnm
    					    );		

    		 		 
             $qry=Update('tbl_wallpaper_gif', $data, "WHERE id = '".$_POST['wallpaper_id']."'");
         }
         else
         {

              $_SESSION['msg']="15";
 
              header( "Location:edit_wallpaper_animation.php?wallpaper_id=".$_POST['wallpaper_id']);
              exit; 

         }
 			

		$_SESSION['msg']="11";
 
		header( "Location:edit_wallpaper_animation.php?wallpaper_id=".$_POST['wallpaper_id']);
		exit;	

		 
	}
	
	  
?>
<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Edit GIF</div>
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
              <input  type="hidden" name="wallpaper_id" value="<?php echo $_GET['wallpaper_id'];?>" />

              <div class="section">
                <div class="section-body">
                    
                  <div class="form-group">
                    <label class="col-md-3 control-label">Wallpaper Image :-</label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="wallpaper_image" id="fileupload" required>
                       <?php if($row['image']!="") {?>
                            <div class="fileupload_img"><img type="image" src="images/animation/<?php echo $row['image'];?>" alt="wallpaper image" /></div>
                          <?php } else {?>
                           <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="category image" /></div>
                          <?php }?>
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
