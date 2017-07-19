<?php
	$posts = json_decode($this->vars);
	#print_r($posts);
?>
<style>
	.essynoir-blog-post-slideshow-current {
    width: 100%;
    background-repeat: no-repeat;
}

.essynoir-blog-post-slideshow {
    width: 100%;
    position: relative;
}
.essynoir-blog-post-slideshow-current {
    height: 100px;
    width: 100%;
    position: absolute;
    top: 0px;
    background-size: cover;
    background-position: 0px -35px;
}

.essynoir-blog-post-slideshow {}

h3.essynoir-post-head-title {
    position: absolute;
    width: 100%;
    font-size: 12px;
    z-index: 100;
    height: 100%;
    top: 0px;
    left: 0px;
    text-align: center;
    
}

li.essynoir-post {
    float: left;
    position: relative;
    width: 200px;
    margin-left: 40px;
    height: 150px;
}

.essynoir-post-head-date {
    display: none;
}

.essynoir-blog-post-slideshow {
    width: 100% !important;
    height: 100px !important;
    position: absolute !important;
}

#pageTitleYes {
    font-size: 32px;
    text-align: center;
    padding-top: 6px;
    position: absolute;
    width: 100%;
}

ul#essynoir-posts {
    padding-top: 62px;
}


</style>
<div id="essynoir-posts-wrap">
	<h3 id="pageTitleYes">BLOG</h3>
	<ul id="essynoir-posts">
	<?php
		$z = 0;
		if(!$posts->items) {
			?>
			<div id="no_posts">No posts meet your search criteria.</div>
			<?php
		} else {
		foreach($posts->items as $post) {
			#print_r($post);
			
	?>
		<li class="essynoir-post"><a href="/blog/post/<?=$post->id?>">
			<div class="essynoir-post-head">
				<h3 class="essynoir-post-head-title">
					<?php echo strtoupper($post->title); ?>
				</h3>
				<div class="essynoir-post-head-date">
					09/21/2015
				</div>
			</div>
			<div class="essynoir-blog-post-slideshow">
				<div class="essynoir-blog-post-slideshow-current essynoir-blog-post-slideshow-current-<?=$z?>"></div>
			</div>
			<div class="essynoir-post-content essynoir-post-content-<?=$z?>" style="display: none">
				<?php echo $post->content; ?>
			</div>
			
			<script>
				var images = $('.essynoir-post-content-<?=$z?> img').toArray();		
				var imges = $('.essynoir-post-content-<?=$z?> img').get();
				for(x=0;x<images.length;x++) {
					if(x==0) $('.essynoir-blog-post-slideshow-current-<?=$z?>').css('background-image', 'url("'+images[x].src+'")');
				}
			</script>
			</a>
		</li>
		<?php $z++; } } ?>
	</ul>
	<div id="essynoir-posts-pagination">
		<?php if($posts->prev) { ?>
		<div class="essynoir-posts-pagination" id="essynoir-posts-pagination-prev">
			<a href="<?=$posts->prev?>">BACK</a>
		</div>
		<?php }
		if($posts->next) { ?>
		<div class="essynoir-posts-pagination" id="essynoir-posts-pagination-next">
			<a href="<?=$posts->next?>">NEXT</a>
		</div>
		<?php } ?>
	</div>
</div>