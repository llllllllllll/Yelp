{include file='header.tpl'}
<body>
	<div id="PG_{$PLUGIN_NAME}_Front_mainContainer">
	<div id="PG_{$PLUGIN_NAME}">
		<h1>Yelp</h1>
		<ul class="PG_{$PLUGIN_NAME}_nav">
			{section name=x start=0 loop=3 step=1}
				{if {$smarty.section.x.index} eq 0}
					<li><a href="{$ctrgy_{$smarty.section.x.index}_link}" class="on">{$ctrgy_{$smarty.section.x.index}}</a></li>
				{else}
					<li><a href="{$ctrgy_{$smarty.section.x.index}_link}" class="off">{$ctrgy_{$smarty.section.x.index}}</a></li>
				{/if}
			{/section}
		</ul>
	
		<div class="PG_{$PLUGIN_NAME}_content_wrap">
			<ul class="PG_{$PLUGIN_NAME}_contentnews">
				<li>
					<span><img src="images/pg_tree_p.gif" alt="Plus Sign" style="display:visible" /><img src="images/pg_tree_m.gif" alt="Minus Sign" style="display:none" /></span>
					<div class="PG_{$PLUGIN_NAME}_content">
						<p class="PG_{$PLUGIN_NAME}_title">Title</p>
						<div class="PG_{$PLUGIN_NAME}_rating">70 reviews</div>
						<ol id="PG_{$PLUGIN_NAME}_business-description">
							<li class="PG_{$PLUGIN_NAME}_content_desc">San Francisco</li>
							<li class="PG_{$PLUGIN_NAME}_content_desc">Neighborhood:<a href="/search?cflt=restaurants&find_loc=SOMA%2C+San+Francisco%2C+CA">SOMA</a></li>
							<li class="PG_{$PLUGIN_NAME}_content_desc">Categories:<a href="/c/sf/desserts">Desserts</a>,<a href="/c/sf/gluten_free">Gluten-Free</a></li>
						</ol>
						<p class="PG_{$PLUGIN_NAME}_toggle_content" style="display:none">	
							<a href="#"><img src="images/pg_yelp_img1.jpg" alt="" /></a>
							Problem #1: Out of beer after 11pm in fancy hotel downtown with no nearby open liquor stores.   Solution: TCB  Problem #2: Missed lunch at the SFGH caf and craving Rhea's. Solution: TCB  In both of the above instances, I was amazed by their fast friendly service and reasonable prices.  Tipping these guys is key- they are fast and work hard.  I'd recommend TCB for any of your random delivery needs...
						</p>
					</div>
					<p><a href="" class="PG_{$PLUGIN_NAME}_more" style="display:none">more</a></p>
				</li>
				<li>
					<span><img src="images/pg_tree_p.gif" alt="Plus Sign" style="display:visible" /><img src="images/pg_tree_m.gif" alt="Minus Sign" style="display:none" /></span>
					<div class="PG_{$PLUGIN_NAME}_content">
						<p class="PG_{$PLUGIN_NAME}_title">Title</p>
						<div class="PG_{$PLUGIN_NAME}_rating">70 reviews</div>
						<ol id="PG_{$PLUGIN_NAME}_business-description">
							<li class="PG_{$PLUGIN_NAME}_content_desc">San Francisco</li>
							<li class="PG_{$PLUGIN_NAME}_content_desc">Neighborhood:<a href="/search?cflt=restaurants&find_loc=SOMA%2C+San+Francisco%2C+CA">SOMA</a></li>
							<li class="PG_{$PLUGIN_NAME}_content_desc">Categories:<a href="/c/sf/desserts">Desserts</a>,<a href="/c/sf/gluten_free">Gluten-Free</a></li>
						</ol>
						<p class="PG_{$PLUGIN_NAME}_toggle_content" style="display:none">	
							<a href="#"><img src="images/pg_yelp_img1.jpg" alt="" /></a>
							Problem #1: Out of beer after 11pm in fancy hotel downtown with no nearby open liquor stores.   Solution: TCB  Problem #2: Missed lunch at the SFGH caf and craving Rhea's. Solution: TCB  In both of the above instances, I was amazed by their fast friendly service and reasonable prices.  Tipping these guys is key- they are fast and work hard.  I'd recommend TCB for any of your random delivery needs...
						</p>
					</div>
					<p><a href="" class="PG_{$PLUGIN_NAME}_more" style="display:none">more</a></p>
				</li>
				<li>
					<span><img src="images/pg_tree_p.gif" alt="Plus Sign" style="display:visible" /><img src="images/pg_tree_m.gif" alt="Minus Sign" style="display:none" /></span>
					<div class="PG_{$PLUGIN_NAME}_content">
						<p class="PG_{$PLUGIN_NAME}_title">Title</p>
						<div class="PG_{$PLUGIN_NAME}_rating">70 reviews</div>
						<ol id="PG_{$PLUGIN_NAME}_business-description">
							<li class="PG_{$PLUGIN_NAME}_content_desc">San Francisco</li>
							<li class="PG_{$PLUGIN_NAME}_content_desc">Neighborhood:<a href="/search?cflt=restaurants&find_loc=SOMA%2C+San+Francisco%2C+CA">SOMA</a></li>
							<li class="PG_{$PLUGIN_NAME}_content_desc">Categories:<a href="/c/sf/desserts">Desserts</a>,<a href="/c/sf/gluten_free">Gluten-Free</a></li>
						</ol>
						<p class="PG_{$PLUGIN_NAME}_toggle_content" style="display:none">	
							<a href="#"><img src="images/pg_yelp_img1.jpg" alt="" /></a>
							Problem #1: Out of beer after 11pm in fancy hotel downtown with no nearby open liquor stores.   Solution: TCB  Problem #2: Missed lunch at the SFGH caf and craving Rhea's. Solution: TCB  In both of the above instances, I was amazed by their fast friendly service and reasonable prices.  Tipping these guys is key- they are fast and work hard.  I'd recommend TCB for any of your random delivery needs...
						</p>
					</div>
					<p><a href="" class="PG_{$PLUGIN_NAME}_more" style="display:none">more</a></p>
				</li>
				<li>
					<span><img src="images/pg_tree_p.gif" alt="Plus Sign" style="display:visible" /><img src="images/pg_tree_m.gif" alt="Minus Sign" style="display:none" /></span>
					<div class="PG_{$PLUGIN_NAME}_content">
						<p class="PG_{$PLUGIN_NAME}_title">Title</p>
						<div class="PG_{$PLUGIN_NAME}_rating">70 reviews</div>
						<ol id="PG_{$PLUGIN_NAME}_business-description">
							<li class="PG_{$PLUGIN_NAME}_content_desc">San Francisco</li>
							<li class="PG_{$PLUGIN_NAME}_content_desc">Neighborhood:<a href="/search?cflt=restaurants&find_loc=SOMA%2C+San+Francisco%2C+CA">SOMA</a></li>
							<li class="PG_{$PLUGIN_NAME}_content_desc">Categories:<a href="/c/sf/desserts">Desserts</a>,<a href="/c/sf/gluten_free">Gluten-Free</a></li>
						</ol>
						<p class="PG_{$PLUGIN_NAME}_toggle_content" style="display:none">	
							<a href="#"><img src="images/pg_yelp_img1.jpg" alt="" /></a>
							Problem #1: Out of beer after 11pm in fancy hotel downtown with no nearby open liquor stores.   Solution: TCB  Problem #2: Missed lunch at the SFGH caf and craving Rhea's. Solution: TCB  In both of the above instances, I was amazed by their fast friendly service and reasonable prices.  Tipping these guys is key- they are fast and work hard.  I'd recommend TCB for any of your random delivery needs...
						</p>
					</div>
					<p><a href="" class="PG_{$PLUGIN_NAME}_more" style="display:none">more</a></p>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<input type="hidden" name="PG_PG_NAME" id="PG_PG_NAME" value="{$PLUGIN_NAME}" />
	<input type="hidden" name="PG_{$PLUGIN_NAME}_getter" id="PG_{$PLUGIN_NAME}_getter" value="{$getterPhp}" />
	<input type="hidden" name="PG_{$PLUGIN_NAME}_basepath" id="PG_{$PLUGIN_NAME}_basepath" value="{$PG_BASE_PATH}" />
	<input type="hidden" name="PG_{$PLUGIN_NAME}_records_exist" id="PG_{$PLUGIN_NAME}_records_exist" value="{$records_exist}" />
</body>
</html>
