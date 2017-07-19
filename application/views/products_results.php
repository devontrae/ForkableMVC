<?php 
$page_data = $this->vars;

	# Pagination code
	$total_pages = $page_data->page_count;
	$curr_page = $page_data->curr_page;
	$page_display = array();
	$search_query = $page_data->search_query;
	$pagination_base = $page_data->pagination_base;
	$page_title = $page_data->title;
	$terms = $page_data->terms;
	
	if($total_pages < 10) {
		for($x=1;$x<($total_pages);$x++) {
			$page_display[] = $x;
		}
	} else {

	# We have more than 9 pages, so we will need to make them all fit
	# Lets find out our break points. Always show the first page
	$page_display[] = 1;

	if($curr_page <= 4) {
		# We're gonna show all 5 first pages
		for($x=2;$x<5;$x++) {
			$page_display[] = $x;
		}

		# If we aren't on page 5, show page 5
		$page_display[] = 5;

		# Now show elipsis
		$page_display[] = 0;
	} else {
		# How many do we have until we get to the last page?
		$pages_left = $total_pages - $curr_page;

		# If the current pages left is less than 7, lets show all the final pages
		if($pages_left < 4) {
			$page_display[] = 2;
			$page_display[] = 0;
			for($x=($total_pages - 4); $x < ($total_pages - 1); $x++) {
				$page_display[] = $x;
			}
		} else {

			# Show elipses
			$page_display[] = 0;

			# Show 1 page before, and 1 page after curr page
			$page_display[] = $curr_page - 1;
			# Always show the current page
			$page_display[] = $curr_page;
			$page_display[] = $curr_page + 1;

			# Show elipses
			$page_display[] = 0;
		}
	}

	# Always show the last 2 pages
	$page_display[] = $total_pages - 1;
	$page_display[] = $total_pages;
}

if($curr_page < ($total_pages - 1))
	$next_page = $curr_page + 1;
else
	$next_page = 0;

if($curr_page > 1)
	$prev_page = $curr_page - 1;
else
	$prev_page = 0;
	
?>

<div id="products_results">
		<div id="catagory_titlebar-wrap" class="catagory_titlebar-wrap">
			<h1 class="catagory_titlebar-title">
				<?=$page_title?>
			</h1>
			
			<div id="catagor_mobile-search_bar" class="catagory_mobile_class">
				<form action="productsearch.php" method="GET">
					<input type="text" value="<?=$this->vars->terms?>" name="terms" id="product_search_input" onClick="$(this).val('');" />
					<a id="product_search_go" onClick="submitSearch();">Go</a>
				</form>
			</div>
			<div class="catagory_titlebar-pagination-wrap">
				<ul class="catagory_titlebar-pagination-pages_list">

				<?php
					$display_holder = array();
					$total_display = count($page_display);
					$x = 0;
					
					#echo $total_display;
					foreach($page_display as $page_num) {
						$display_holder[($total_display - $x)] = $page_num;
						#echo $display_holder[$total_display - $x];
						$x++;
					}
					
					$page_display = $display_holder;
				
					for($x=1; $x <= $total_display; $x++) {
						$page_num = $display_holder[$x];
						
					#foreach($page_display as $page_num) {
						if($page_num != 0) {
							$active = '';
							if($page_num == $curr_page)
								$active = " active";
				?>
					<li class="catagory_titlebar-pagination-link_wrap">
						<a class="catagory_titlebar-pagination-link<?=$active?>" href="/products<?=$pagination_base?>/<?=$page_num?>"><?=$page_num?></a>
					</li>
				<?php	} else {
				?>
					<li class="catagory_titlebar-pagination-link_wrap">
						<a class="catagory_titlebar-pagination-link" href="#">...</a>
					</li>
				<?php
						}
					}
				?>
					<!-- 
					<li class="catagory_titlebar-pagination-link_wrap">
						<a class="catagory_titlebar-pagination-link" href="#">...</a>
					</li>
					-->
				</ul>
				
				<?php if($prev_page != 0) { ?>
					<a class="catagory_titlebar-pagination-back" href="/products<?=$pagination_base?>/<?=$prev_page?>">Back</a>
				<?php } ?>

				<?php if($next_page != 0) { ?>
					<a class="catagory_titlebar-pagination-next" href="/products<?=$pagination_base?>/<?=$next_page?>">Next</a>
				<?php } ?>
			</div>
		</div>
		<div id="products_results-product_listing-wrap">
			<ul id="products_results-products_list">
				<?php
					$products = $page_data->products_data;

					foreach($products as $product) { 
						$x = $product['product_id'];
						$product_name = $product['product_name'];
						$product_markdown = $product['product_markdown'];
						$product_show_markdown = $product['product_show_markdown'];
						$product_price = $product['product_price'];
						$product_photo = $product['product_img_path'];
						
					?>
				<li id="products_results-product_li-<?=$x;?>" class="products_results-product_li">
					<a href="/products/view/<?=$x?>" title="<?=$product_name?>" class="product_results-product_link">
						<div class="products_results-product_wrap">
							<div class="product_results-product_image-wrap">
								<?php if($product_photo == "")
										$product_photo = "/assets/product_img/photo_not_available.png";
								?>
								<img src="<?=$product_photo?>" class="product_results-product_image" alt="<?=$product_name?>" />
							</div>
							<div class="product_results-product_name">
								<?=$product_name?>
							</div>
							<div class="product_results-product_price">
								<?php if($product_show_markdown == 1) { ?><span class="product_results-product_price-markdown">$<?=$product_markdown?></span><?php } ?>
								<span class="product_results-product_price-final">$<?=$product_price?></span>
							</div>
						</div>
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>

		<div id="catagory_titlebar-wrap-bottom" class="catagory_titlebar-wrap">
			<h1 class="catagory_titlebar-title">
				<?=$page_title?>
			</h1>
			
			
			<div class="catagory_titlebar-pagination-wrap">
				<ul class="catagory_titlebar-pagination-pages_list">

				<?php
					$display_holder = array();
					$total_display = count($page_display);
					$x = 0;
					
					#echo $total_display;
					foreach($page_display as $page_num) {
						$display_holder[($total_display - $x)] = $page_num;
						#echo $display_holder[$total_display - $x];
						$x++;
					}
					
					$page_display = $display_holder;
				
					for($x=1; $x <= $total_display; $x++) {
						$page_num = $display_holder[$x];
						
					#foreach($page_display as $page_num) {
						if($page_num != 0) {
							$active = '';
							if($page_num == $curr_page)
								$active = " active";
				?>
					<li class="catagory_titlebar-pagination-link_wrap">
						<a class="catagory_titlebar-pagination-link<?=$active?>" href="/products<?=$pagination_base?>/<?=$page_num?>"><?=$page_num?></a>
					</li>
				<?php		} else {
				?>
					<li class="catagory_titlebar-pagination-link_wrap">
						<a class="catagory_titlebar-pagination-link" href="#">...</a>
					</li>
				<?php
						}
					}
				?>
					<!-- 
					<li class="catagory_titlebar-pagination-link_wrap">
						<a class="catagory_titlebar-pagination-link" href="#">...</a>
					</li>
					-->
				</ul>
				
				<?php if($prev_page != 0) { ?>
					<a class="catagory_titlebar-pagination-back" href="/products<?=$pagination_base?>/<?=$prev_page?>">Back</a>
				<?php } ?>

				<?php if($next_page != 0) { ?>
					<a class="catagory_titlebar-pagination-next" href="/products<?=$pagination_base?>/<?=$next_page?>">Next</a>
				<?php } ?>
			</div>
		</div>
	</div>
