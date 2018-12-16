<?php include("includes/header.php");

$qry_cat="SELECT COUNT(*) as num FROM tbl_category";
$total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
$total_category = $total_category['num'];

$qry_wallpaper="SELECT COUNT(*) as num FROM tbl_wallpaper";
$total_wallpaper = mysqli_fetch_array(mysqli_query($mysqli,$qry_wallpaper));
$total_wallpaper = $total_wallpaper['num'];

$qry_wallpaper_gif="SELECT COUNT(*) as num FROM tbl_wallpaper_gif";
$total_wallpaper_gif = mysqli_fetch_array(mysqli_query($mysqli,$qry_wallpaper_gif));
$total_wallpaper_gif = $total_wallpaper_gif['num'];

?>       


         
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_category.php" class="card card-banner card-green-light">
        <div class="card-body"> <i class="icon fa fa-sitemap fa-4x"></i>
          <div class="content">
            <div class="title">Categories</div>
            <div class="value"><span class="sign"></span><?php echo $total_category;?></div>
          </div>
        </div>
        </a> 
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_wallpaper.php" class="card card-banner card-yellow-light">
        <div class="card-body"> <i class="icon fa fa-image fa-4x"></i>
          <div class="content">
            <div class="title">Wallpaper</div>
            <div class="value"><span class="sign"></span><?php echo $total_wallpaper;?></div>
          </div>
        </div>
        </a> 
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_wallpaper.php" class="card card-banner card-blue-light">
        <div class="card-body"> <i class="icon fa fa-leaf fa-4x"></i>
          <div class="content">
            <div class="title">GIF</div>
            <div class="value"><span class="sign"></span><?php echo $total_wallpaper_gif;?></div>
          </div>
        </div>
        </a> </div>
      
     
    </div>

        
<?php include("includes/footer.php");?>       
