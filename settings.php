<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");
	 
	
	$qry="SELECT * FROM tbl_settings where id='1'";
  $result=mysqli_query($mysqli,$qry);
  $settings_row=mysqli_fetch_assoc($result);

 

  if(isset($_POST['submit']))
  {

    

    $img_res=mysql_query("SELECT * FROM tbl_settings WHERE id='1'");
    $img_row=mysql_fetch_assoc($img_res);
    

    if($_FILES['app_logo']['name']!="")
    {        

            unlink('images/'.$img_row['app_logo']);   

            $app_logo=$_FILES['app_logo']['name'];
            $pic1=$_FILES['app_logo']['tmp_name'];

            $tpath1='images/'.$app_logo;      
            copy($pic1,$tpath1);


              $data = array(      
                
              'app_name'  =>  $_POST['app_name'],
              'app_logo'  =>  $app_logo,  
              'app_description'  => addslashes($_POST['app_description']),
              'app_version'  =>  $_POST['app_version'],
              'app_author'  =>  $_POST['app_author'],
              'app_contact'  =>  $_POST['app_contact'],
              'app_email'  =>  $_POST['app_email'],   
              'app_website'  =>  $_POST['app_website'],
              'app_privacy_policy'  =>  $_POST['app_privacy_policy'],
              'app_developed_by'  =>  $_POST['app_developed_by']                     

              );

    }
    else
    {
  
                $data = array(

                'app_name'  =>  $_POST['app_name'],
                'app_description'  => addslashes($_POST['app_description']),
                'app_version'  =>  $_POST['app_version'],
                'app_author'  =>  $_POST['app_author'],
                'app_contact'  =>  $_POST['app_contact'],
                'app_email'  =>  $_POST['app_email'],   
                'app_website'  =>  $_POST['app_website'],
                'app_developed_by'  =>  $_POST['app_developed_by']               

                  );

    } 

    $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
 

      if ($settings_edit > 0)
      {

        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;

      }   
 
  }


  if(isset($_POST['api_submit']))
  {

        $data = array(

                'api_latest_limit'  =>  $_POST['api_latest_limit'],
                'api_cat_order_by'  =>  $_POST['api_cat_order_by'],
                'api_cat_post_order_by'  =>  $_POST['api_cat_post_order_by'],
                'api_gif_post_order_by'  =>  $_POST['api_gif_post_order_by']
                  );

    
      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
 

      if ($settings_edit > 0)
      {

        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;

      }   
 
  }

  if(isset($_POST['app_pri_poly']))
  {

        $data = array(
                'app_privacy_policy'  =>  $_POST['app_privacy_policy'] 
                  );

    
      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
 

      if ($settings_edit > 0)
      {

        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;

      }   
 
  }



?>
 
	 <div class="row">
      <div class="col-md-12">
        <div class="card">
		  <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Settings</div>
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
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#app_settings" aria-controls="app_settings" role="tab" data-toggle="tab">App Settings</a></li>
                <li role="presentation"><a href="#api_settings" aria-controls="api_settings" role="tab" data-toggle="tab">API Settings</a></li>
                <li role="presentation"><a href="#api_privacy_policy" aria-controls="api_privacy_policy" role="tab" data-toggle="tab">App Privacy Policy</a></li>
                
            </ul>
          
           <div class="tab-content">
              
              <div role="tabpanel" class="tab-pane active" id="app_settings">	  
                <form action="" name="settings_from" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_name" id="app_name" value="<?php echo $settings_row['app_name'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Logo :-</label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="app_logo" id="fileupload">
                         
                        	<?php if($settings_row['app_logo']!="") {?>
                        	  <div class="fileupload_img"><img type="image" src="images/<?php echo $settings_row['app_logo'];?>" alt="image" /></div>
                        	<?php } else {?>
                        	  <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="image" /></div>
                        	<?php }?>
                        
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Description :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="app_description" id="app_description" class="form-control"><?php echo $settings_row['app_description'];?></textarea>

                      <script>CKEDITOR.replace( 'app_description' );</script>
                    </div>
                  </div>
                  <div class="form-group">&nbsp;</div>                 
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Version :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_version" id="app_version" value="<?php echo $settings_row['app_version'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Author :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_author" id="app_author" value="<?php echo $settings_row['app_author'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Contact :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_contact" id="app_contact" value="<?php echo $settings_row['app_contact'];?>" class="form-control">
                    </div>
                  </div>     
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_email" id="app_email" value="<?php echo $settings_row['app_email'];?>" class="form-control">
                    </div>
                  </div>                 
                   <div class="form-group">
                    <label class="col-md-3 control-label">Website :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_website" id="app_website" value="<?php echo $settings_row['app_website'];?>" class="form-control">
                    </div>
                  </div>                   
                  <div class="form-group">
                    <label class="col-md-3 control-label">Developed By :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_developed_by" id="app_developed_by" value="<?php echo $settings_row['app_developed_by'];?>" class="form-control">
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
              
              <div role="tabpanel" class="tab-pane" id="api_settings">   
                <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Latest Limit:-</label>
                    <div class="col-md-6">
                       
                      <input type="number" name="api_latest_limit" id="api_latest_limit" value="<?php echo $settings_row['api_latest_limit'];?>" class="form-control"> 
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Category List Order By:-</label>
                    <div class="col-md-6">
                       
                        
                        <select name="api_cat_order_by" id="api_cat_order_by" class="select2">
                          <option value="cid" <?php if($settings_row['api_cat_order_by']=='cid'){?>selected<?php }?>>ID</option>
                          <option value="category_name" <?php if($settings_row['api_cat_order_by']=='category_name'){?>selected<?php }?>>Name</option>
              
                        </select>
                        
                    </div>
                   
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Category Wallpaper Order:-</label>
                    <div class="col-md-6">
                       
                        
                        <select name="api_cat_post_order_by" id="api_cat_post_order_by" class="select2">
                          <option value="ASC" <?php if($settings_row['api_cat_post_order_by']=='ASC'){?>selected<?php }?>>ASC</option>
                          <option value="DESC" <?php if($settings_row['api_cat_post_order_by']=='DESC'){?>selected<?php }?>>DESC</option>
              
                        </select>
                        
                    </div>
                   
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">GIF Order:-</label>
                    <div class="col-md-6">
                       
                        
                        <select name="api_gif_post_order_by" id="api_gif_post_order_by" class="select2">
                          <option value="ASC" <?php if($settings_row['api_gif_post_order_by']=='ASC'){?>selected<?php }?>>ASC</option>
                          <option value="DESC" <?php if($settings_row['api_gif_post_order_by']=='DESC'){?>selected<?php }?>>DESC</option>
              
                        </select>
                        
                    </div>
                   
                  </div>
                  
                
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="api_submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
               </form>
              </div>

              <div role="tabpanel" class="tab-pane" id="api_privacy_policy">   
                <form action="" name="api_privacy_policy" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Privacy Policy :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="app_privacy_policy" id="privacy_policy" class="form-control"><?php echo $settings_row['app_privacy_policy'];?></textarea>

                      <script>CKEDITOR.replace( 'privacy_policy' );</script>
                    </div>
                  </div>
                  
                
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="app_pri_poly" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
               </form>
              </div> 

            </div>   

          </div>
        </div>
      </div>
    </div>

        
<?php include("includes/footer.php");?>       
