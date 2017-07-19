<script type="text/javascript" src="/assets/js/sidebar.js"></script>

<div id="products_search">
		<div id="products_title">
			<h1>PRODUCTS CATALOG</h1>
		</div>
		<div id="products_search_bar">
			<form action="productsearch.php" method="GET">
				<input type="text" value="<?=$this->vars->terms?>" id="product_search_input" name="terms" onClick="$(this).val('');" />
				<a id="product_search_go" onClick="submitSearch();">Go</a>
			</form>
			<p id="products_search_instructions">
				Search for tags, products and phrases
			</p>
		</div>
		<div id="products_catagories-wrap">
			<ul id="products_catagories-list">
				
			</ul>
		</div>
	</div>