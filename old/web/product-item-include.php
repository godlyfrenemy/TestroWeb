<div class="product-item">
	<img src="uploads/<?=$res_assoc['image_url']?>">
	<div>
		<center><h3>
			<?=$res_assoc['name']; if($res_assoc['forsale']) echo "<b style='color: red;'> %</b>"?>		
		</h3><p onclick="show_product_card(this)">Детальніше</p></center>
		<p class="product-item-descr" style="display: none;"><?=$res_assoc['description']?></p>
		<p class="product-item-os" style="display: none;"><?=$res_assoc['os']?></p>
	</div>
</div>