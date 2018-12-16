<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

 
	$cat_qry="SELECT * FROM tbl_category ORDER BY category_name";
	$cat_result=mysqli_query($mysqli,$cat_qry); 
	
	if(isset($_POST['submit']))
	{

		$count = count($_FILES['wallpaper_image']['name']);
		for($i=0;$i<$count;$i++)
		{ 
			 $albumimgnm=rand(0,99999)."_".$_FILES['wallpaper_image']['name'][$i];
			 
       //Main Image
			 $tpath1='categories/'.$_POST['cat_id'].'/'.$albumimgnm;			 
       $pic1=compress_image($_FILES["wallpaper_image"]["tmp_name"][$i], $tpath1, 80);
	 
			 //Thumb Image 
			 $thumbpath='categories/'.$_POST['cat_id'].'/thumbs/'.$albumimgnm;				
       $thumb_pic1=create_thumb_image($tpath1,$thumbpath,'400','400');   			
					   
			 $date=date('Y-m-j');								
				 
          
		        $data = array( 
					    'cat_id'  =>  $_POST['cat_id'],
					    'image_date'  =>  $date,
					    'image'  =>  $albumimgnm
					    );		

		 		$qry = Insert('tbl_wallpaper',$data);	

 	     }			

		$_SESSION['msg']="10";
 
		header( "Location:add_wallpaper.php");
		exit;	

		 
	}
	
	  
?>
<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Add Wallpaper</div>
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
                    <label class="col-md-3 control-label">Category :-</label>
                    <div class="col-md-6">
                      <select name="cat_id" id="cat_id" class="select2" required>
                        <option value="">--Select Category--</option>
          							<?php
          									while($cat_row=mysqli_fetch_array($cat_result))
          									{
          							?>          						 
          							<option value="<?php echo $cat_row['cid'];?>"><?php echo $cat_row['category_name'];?></option>	          							 
          							<?php
          								}
          							?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Wallpaper Image :-
                    <p class="control-label-help">(Recommended resolution: 600x900 or 640x960 or 480x720 or 680x1024)</p>
                    </label>
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
