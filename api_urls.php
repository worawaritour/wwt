<?php include("includes/header.php");

$file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
?>
<div class="row">
      <div class="col-sm-12 col-xs-12">
     	 	<div class="card">
		        <div class="card-header">
		          Example API urls
		        </div>
       			    <div class="card-body no-padding">
         		
         			 <pre><code class="html"><b>Latest Wallpaper</b><br><?php echo $file_path."api.php?latest"?><br><br><b>Category List</b><br><?php echo $file_path."api.php?cat_list"?><br><br><b>Wallpaper list by Cat ID</b><br><?php echo $file_path."api.php?cat_id=1"?><br><br><b>Single Wallpaper</b><br><?php echo $file_path."api.php?wallpaper_id=3"?><br><br><b>GIF Image List</b><br><?php echo $file_path."api.php?gif_list"?><br><br><b>Single GIF Image</b><br><?php echo $file_path."api.php?gif_id=2"?><br><br><b>App Details</b><br><?php echo $file_path."api.php"?></code></pre>
       		
       				</div>
          	</div>
        </div>
</div>
    <br/>
    <div class="clearfix"></div>
        
<?php include("includes/footer.php");?>       
