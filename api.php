<?php include("includes/connection.php");
 	  include("includes/function.php"); 	
	
	$file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
 	 
	if(isset($_GET['cat_list']))
 	{
 		$jsonObj= array();
		
		$cat_order=API_CAT_ORDER_BY;


		$query="SELECT cid,category_name,category_image FROM tbl_category ORDER BY tbl_category.".$cat_order."";
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			//Wallpaper count
			$query_wall = "SELECT COUNT(*) as num FROM tbl_wallpaper WHERE cat_id='".$data['cid']."'";
	        $total_wall = mysqli_fetch_array(mysqli_query($mysqli,$query_wall));
	        $total_wall = $total_wall['num'];	

			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_image'] = $file_path.'images/'.$data['category_image'];
			$row['category_image_thumb'] = $file_path.'images/thumbs/'.$data['category_image'];

			$row['total_wallpaper'] = $total_wall;
			 

			array_push($jsonObj,$row);
		
		}

		$set['HD_WALLPAPER'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
	else if(isset($_GET['cat_id']))
	{
		$post_order_by=API_CAT_POST_ORDER_BY;

		$cat_id=$_GET['cat_id'];	

		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_wallpaper
		LEFT JOIN tbl_category ON tbl_wallpaper.cat_id= tbl_category.cid 
		where tbl_wallpaper.cat_id='".$cat_id."' ORDER BY tbl_wallpaper.id ".$post_order_by."";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
 			$row['wallpaper_image'] = $file_path.'categories/'.$data['cat_id'].'/'.$data['image'];
 			$row['wallpaper_image_thumb'] = $file_path.'categories/'.$data['cat_id'].'/thumbs/'.$data['image']; 
 			$row['total_views'] = $data['total_views'];

			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_image'] = $file_path.'images/'.$data['category_image'];
			$row['category_image_thumb'] = $file_path.'images/thumbs/'.$data['category_image'];
			 

			array_push($jsonObj,$row);
		
		}

		$set['HD_WALLPAPER'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

		
	}	 
	else if(isset($_GET['latest']))
	{
		//$limit=$_GET['latest'];	 

		$limit=API_LATEST_LIMIT;

		$jsonObj= array();	
 
		$query="SELECT * FROM tbl_wallpaper
		LEFT JOIN tbl_category ON tbl_wallpaper.cat_id= tbl_category.cid 
		ORDER BY tbl_wallpaper.id DESC LIMIT $limit";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
 			$row['wallpaper_image'] = $file_path.'categories/'.$data['cat_id'].'/'.$data['image'];
 			$row['wallpaper_image_thumb'] = $file_path.'categories/'.$data['cat_id'].'/thumbs/'.$data['image'];
 			$row['total_views'] = $data['total_views']; 

			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_image'] = $file_path.'images/'.$data['category_image'];
			$row['category_image_thumb'] = $file_path.'images/thumbs/'.$data['category_image'];
			 

			array_push($jsonObj,$row);
		
		}

		$set['HD_WALLPAPER'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

	}	
	else if(isset($_GET['wallpaper_id']))
	{
		  
				 
		$jsonObj= array();	

		$query="SELECT * FROM tbl_wallpaper WHERE id='".$_GET['wallpaper_id']."'";
		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
 			$row['wallpaper_image'] = $file_path.'categories/'.$data['cat_id'].'/'.$data['image'];
 			$row['wallpaper_image_thumb'] = $file_path.'categories/'.$data['cat_id'].'/thumbs/'.$data['image']; 
 			$row['total_views'] = $data['total_views'];
 

			array_push($jsonObj,$row);
		
		}

		$view_qry=mysqli_query($mysqli,"UPDATE tbl_wallpaper SET total_views = total_views + 1 WHERE id = '".$_GET['wallpaper_id']."'");
 

		$set['HD_WALLPAPER'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
 

	}
	else if(isset($_GET['gif_list']))
 	{
 		$jsonObj= array();
		
		$gif_order=API_GIF_POST_ORDER_BY;


		$query="SELECT * FROM tbl_wallpaper_gif ORDER BY id $gif_order";
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 

			$row['id'] = $data['id'];			 
			$row['gif_image'] = $file_path.'images/animation/'.$data['image'];
			$row['total_views'] = $data['total_views'];

			 

			array_push($jsonObj,$row);
		
		}

		$set['HD_WALLPAPER'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
 	else if(isset($_GET['gif_id']))
	{
		  
				 
		$jsonObj= array();	

		$query="SELECT * FROM tbl_wallpaper_gif WHERE id='".$_GET['gif_id']."'";
		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 
			$row['id'] = $data['id'];			 
			$row['gif_image'] = $file_path.'images/animation/'.$data['image'];
 			$row['total_views'] = $data['total_views'];
 

			array_push($jsonObj,$row);
		
		}

		$view_qry=mysqli_query($mysqli,"UPDATE tbl_wallpaper_gif SET total_views = total_views + 1 WHERE id = '".$_GET['gif_id']."'");
 

		$set['HD_WALLPAPER'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
 

	}
	else 
	{
		$jsonObj= array();	

		$query="SELECT * FROM tbl_settings WHERE id='1'";
		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 
			$row['app_name'] = $data['app_name'];
			$row['app_logo'] = $data['app_logo'];
			$row['app_version'] = $data['app_version'];
			$row['app_author'] = $data['app_author'];
			$row['app_contact'] = $data['app_contact'];
			$row['app_email'] = $data['app_email'];
			$row['app_website'] = $data['app_website'];
			$row['app_description'] = $data['app_description'];
			$row['app_developed_by'] = $data['app_developed_by'];

			$row['app_privacy_policy'] = $data['app_privacy_policy'];

 

			array_push($jsonObj,$row);
		
		}

		$set['HD_WALLPAPER'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
	}		
	 
	 
?>