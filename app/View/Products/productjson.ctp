<?php
	$items=array();
	$i=0;
	foreach($products as $product){
			/**$imageurl = $this->Html->image(array ( 'controller' =>
							'productimages' , 'action' => 'mostrarimagenthumbs' ,
							$product['Product']['id']),
							array ( 'title' =>$product['Product']['descripcion'] ));		**/
			if($product[0]['imagenes'] > 0)				
				$imageurl = '/productimages/mostrarimagenthumbs/'.$product['Product']['id'];
			else
				$imageurl='/img/noimage.png';
							
            $items['items'][$i]=array("name"=>$product['Product']['descripcion'],
				"quantity"=> 1,
				"price"=>$product['Productsdetail']['precio'],
				"thumb"=>$imageurl,
				"allowChangeQuantity"=>true,
				"description"=>$product['Productsdetail']['details'],
				"id"=> $product['Product']['id'],
				"url"=> "/view/".$product['Productsdetail']['id']);		
			$i++;			
	}
echo json_encode($items);	
?>