<pre>
<?php
	/*	
	$connect = mysql_connect('localhost','root','pass','link');
	$table_updates = mysql_db_query('mactimeline_old','SELECT * FROM product_updates',$connect);
	while ($update = mysql_fetch_object($table_updates)) {
	  $update->product_update_id = 60 + $update->product_update_id; 
	  mysql_db_query("mactimeline","INSERT INTO node (nid,vid,type,title,uid,created,changed,comment) VALUES ($update->product_update_id,$update->product_update_id,'update',\"".htmlentities(strip_tags($update->description),ENT_QUOTES,'UTF-8')."\",1,'".strtotime($update->creation_date)."','".strtotime($update->creation_date)."',2)",$connect);
	  mysql_db_query("mactimeline","INSERT INTO node_revisions (nid,vid,uid,title,timestamp) VALUES ($update->product_update_id,$update->product_update_id,1,\"".htmlentities(strip_tags($update->description),ENT_QUOTES,'UTF-8')."\",'".strtotime($update->creation_date)."')",$connect);
	  mysql_db_query("mactimeline","INSERT INTO content_field_date (nid,vid,field_date_value) VALUES ($update->product_update_id,$update->product_update_id,'".date('c',strtotime($update->update_date))."')",$connect);
	  //mysql_db_query("mactimeline","INSERT INTO content_field_date (nid,vid,field_date_value,field_date_timezone,field_date_offset) VALUES ($update->product_update_id,$update->product_update_id,'".date('c',strtotime($update->update_date))."','America/Los_Angeles','-25200')",$connect);
	  mysql_db_query("mactimeline","INSERT INTO content_type_update (nid,vid,field_related_product_nid,field_update_type_value) VALUES ($update->product_update_id,$update->product_update_id,$update->product_id,$update->update_type_id)",$connect);
	  print_r($update->product_update_id.'<br>');	  	 
	}


	$table_products = mysql_db_query('mactimeline_old','SELECT * FROM products',$connect);
	while ($product = mysql_fetch_object($table_products)) {
	  mysql_db_query("mactimeline","INSERT INTO node (nid,vid,type,title,uid,status,created,changed) VALUES ($product->product_id,$product->product_id,'product','".$product->product_name."',1,$product->is_active,'".time()."','".time()."')",$connect);
	  mysql_db_query("mactimeline","INSERT INTO node_revisions (nid,vid,uid,title,timestamp) VALUES ($product->product_id,$product->product_id,1,'".$product->product_name."','".time()."')",$connect);
	  mysql_db_query("mactimeline","INSERT INTO term_node (nid,vid,tid) VALUES ($product->product_id,$product->product_id,$product->category_id)",$connect);
	  mysql_db_query("mactimeline","INSERT INTO content_type_product (nid,vid,field_product_url_url) VALUES ($product->product_id,$product->product_id,'".$product->url."')",$connect);
	  
	  print "INSERT INTO node (nid,vid,type,title,uid,status,created,changed) VALUES ($product->product_id,$product->product_id,'product','".$product->product_name."',1,$product->is_active,'".time()."')<br/>";
	  print "INSERT INTO node_revisions (nid,vid,uid,title,timestamp) VALUES ($product->product_id,$product->product_id,1,'".$product->product_name."','".time()."')<br/>";
	  print "INSERT INTO term_node (nid,vid,tid) VALUES ($product->product_id,$product->product_id,$product->category_id)<br/>";
	  print "INSERT INTO content_type_product (nid,vid,field_product_url_url) VALUES ($product->product_id,$product->product_id,'".$product->url."')<br/><br/>";
	}	
	*/
?>
</pre>