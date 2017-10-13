<?php 
 global $wpdb;
   
 $querystr = "SELECT * FROM wp_myplugin";
 echo $querystr; 

 $storeData = $wpdb->get_results($querystr, OBJECT);
 
?>

<table style="border:1px solid">
    <tr>
	   <th>ID</th>
	   <th>Store Url</th>
	   <th>Product Image Url</th>
	</tr>
	 
	     <?php foreach($storeData as $k=>$v){ ?>
		 <tr>
	     <td><?php echo $v->id;?></td>
		 <td><?php echo $v->storeUrl;?></td>
		 <td><?php echo $v->productImageFloder;?></td>
		 </tr>
		 <?php } ?>
	 

</table>