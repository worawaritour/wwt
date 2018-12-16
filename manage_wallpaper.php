<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	
	   //Get all Wallpaper 
	
      $tableName="tbl_wallpaper";   
      $targetpage = "manage_wallpaper.php"; 
      $limit = 10; 
      
      $query = "SELECT COUNT(*) as num FROM $tableName";
      $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
      $total_pages = $total_pages['num'];
      
      $stages = 3;
      $page=0;
      if(isset($_GET['page'])){
      $page = mysqli_real_escape_string($mysqli,$_GET['page']);
      }
      if($page){
        $start = ($page - 1) * $limit; 
      }else{
        $start = 0; 
        } 
      
     $quotes_qry="SELECT * FROM tbl_wallpaper
                  LEFT JOIN tbl_category ON tbl_wallpaper.cat_id= tbl_category.cid 
                  ORDER BY tbl_wallpaper.id DESC LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$quotes_qry); 
	 

  if(isset($_GET['wallpaper_id']))
  { 

    $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_wallpaper WHERE id=\''.$_GET['wallpaper_id'].'\'');
    $img_res_row=mysqli_fetch_assoc($img_res);

    if($img_res_row['image']!="")
      {
        unlink('categories/'.$img_res_row['cat_id'].'/'.$img_res_row['image']);
        unlink('categories/'.$img_res_row['cat_id'].'/thumbs/'.$img_res_row['image']);
      }
 
    Delete('tbl_wallpaper','id='.$_GET['wallpaper_id'].'');
    
    $_SESSION['msg']="12";
    header( "Location:manage_wallpaper.php");
    exit;
    
  }  

?>
                
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Wallpaper</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                
                <div class="add_btn_primary"> <a href="add_wallpaper.php">Add Wallpaper</a> </div>
              </div>
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
          <div class="col-md-12 mrg-top">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>                  
                  <th>Category</th>
                  <th>Wallpaper Image</th>
                  <th>Wallpaper Views</th>
                  <th class="cat_action_list">Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php	
						$i=0;
						while($row=mysqli_fetch_array($result))
						{					
				?>
                <tr>                 
                  <td><?php echo $row['category_name'];?></td>
                  <td><span class="category_img"><img src="categories/<?php echo $row['cat_id'];?>/thumbs/<?php echo $row['image'];?>" /></span></td>
                  <td><?php echo $row['total_views'];?></td>
                  <td><a href="edit_wallpaper.php?wallpaper_id=<?php echo $row['id'];?>" class="btn btn-primary">Edit</a>
                    <a href="?wallpaper_id=<?php echo $row['id'];?>" class="btn btn-default" onclick="return confirm('Are you sure you want to delete this wallpaper?');">Delete</a></td>
                </tr>
                <?php
						
						$i++;
				     	}
				?> 
              </tbody>
            </table>
          </div>
           <div class="col-md-12 col-xs-12">
            <div class="pagination_item_block">
              <nav>
                <?php include("pagination.php");?>                 
              </nav>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>       
