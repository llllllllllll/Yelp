{include file='header.tpl'}
<body>
	<div id="PG_{$PLUGIN_NAME}_Front_mainContainer">
	<div id="PG_{$PLUGIN_NAME}">
		<h1>Yelp</h1>
		<ul class="PG_{$PLUGIN_NAME}_nav">
			<li><a href="#" class="on">Food</a></li>
			<li><a href="#" class="off">Shopping</a></li>
			<li><a href="#" class="off">Pets</a></li>
		</ul>
	
		<div class="PG_{$PLUGIN_NAME}_content_wrap">
			<ul class="PG_{$PLUGIN_NAME}_contentnews">
				<li>
					<span><img src="images/pg_tree_p.gif" alt="Plus sign" style="display:none" /><img src="images/pg_tree_m.gif" alt="Minus sign" style="display:visible" /></span>
					<div class="PG_{$PLUGIN_NAME}_content">
						<p class="PG_{$PLUGIN_NAME}_title">{$title_1}</p>
						<div class="PG_{$PLUGIN_NAME}_rating">26 reviews</div>
						<p class="PG_{$PLUGIN_NAME}_content_desc">San Francisco</p>
						<p class="PG_{$PLUGIN_NAME}_content_desc">Neighborhood: <a href="#">Mission</a></p>
						<p class="PG_{$PLUGIN_NAME}_content_desc">Category: <a href="#">Food Delivery Services</a></p>
						<p class="PG_{$PLUGIN_NAME}_toggle_content" style="display:visible">	
							<a href="#"><img src="images/pg_yelp_img1.jpg" alt="" /></a>
							Problem #1: Out of beer after 11pm in fancy hotel downtown with no nearby open liquor stores.   Solution: TCB  Problem #2: Missed lunch at the SFGH caf and craving Rhea's. Solution: TCB  In both of the above instances, I was amazed by their fast friendly service and reasonable prices.  Tipping these guys is key- they are fast and work hard.  I'd recommend TCB for any of your random delivery needs...
						</p>
					</div>
					<p><a href="" class="PG_{$PLUGIN_NAME}_more">more</a></p>
				</li>
			{section name=x start=2 loop={$row_count} step=1}
				<li>
					<span><img src="images/pg_tree_p.gif" alt="Plus Sign" style="display:visible" /><img src="images/pg_tree_m.gif" alt="Minus Sign" style="display:none" /></span>
					<div class="PG_{$PLUGIN_NAME}_content">
						<p class="PG_{$PLUGIN_NAME}_title">{$title_{$smarty.section.x.index}}</p>
						<div class="PG_{$PLUGIN_NAME}_rating">70 reviews</div>
						<p class="PG_{$PLUGIN_NAME}_content_desc">San Francisco</p>
						<p class="PG_{$PLUGIN_NAME}_content_desc">Neighborhood: <a href="#">North Beach/Telegraph Hill</a></p>
						<p class="PG_{$PLUGIN_NAME}_content_desc">Category: <a href="#">Bakeries</a></p>
						<p class="PG_{$PLUGIN_NAME}_toggle_content" style="display:none">	
							<a href="#"><img src="images/pg_yelp_img1.jpg" alt="" /></a>
							Problem #1: Out of beer after 11pm in fancy hotel downtown with no nearby open liquor stores.   Solution: TCB  Problem #2: Missed lunch at the SFGH caf and craving Rhea's. Solution: TCB  In both of the above instances, I was amazed by their fast friendly service and reasonable prices.  Tipping these guys is key- they are fast and work hard.  I'd recommend TCB for any of your random delivery needs...
						</p>
					</div>
					<p><a href="" class="PG_{$PLUGIN_NAME}_more" style="display:none">more</a></p>
				</li>
			{/section}
			</ul>
		</div>
	</div>
	</div>
	<span id="PG_PG_NAME" style="visibility: hidden">{$PLUGIN_NAME}</span>
</body>
</html>
