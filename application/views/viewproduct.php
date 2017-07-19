<?php
	$product = $this->vars;
?>

<div id="viewproduct_page-wrap">
	<div id="viewproduct_page-content" class="conform_this">
		<?php 
			include(VIEWS.'products_search_sidebar.php');
		?>
		<div id="viewproduct_page-product_wrap">
			<h1 class="viewproduct_page-product_title"><?=$product->product_name;?></h1>
			<div class="viewproduct_page-product_image-container">
				<?php
					if($product->product_img_path == "")
						$product_photo = "/assets/product_img/photo_not_available.png";
					else
						$product_photo = $product->product_img_path;
				?>
				<img src="<?=$product_photo?>" class="viewproduct_page-product_image" title="Green Chinese Hookah" alt="Green Chinese Hookah" />
				
				<div id="viewproduct_page-product-price_wrap">
					<?php
						if($product->product_show_markdown == 1) {
					?>
						<div id="viewproduct_page-product-onsale">
							was $<?=$product->product_markdown?>!
						</div>
					<?php } ?>
						<div id="viewproduct_page-product-price">
					$<?=$product->product_price?>
					</div>
				</div>
			</div>

			<div class="viewproduct_page-product_description_container">
				<h4 class="viewproduct_page-product_description-heading">Description</h4>

				<div class="viewproduct_page-product_description-details">
					<!-- Handwritten Details go here -->
					<p><?=$product->product_description;?></p>
				</div>
			</div>
		</div>
	</div>
</div>
