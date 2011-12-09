{include file='header.tpl'}
<body id="PG_{$PLUGIN_NAME}_body">
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
			<div id="PG_Yelp_ajaxloader">
				<img src="{$PG_BASE_PATH}/images/ajax-loader_yelp.gif">
			</div>
		</div>
	</div>
	</div>
	<input type="hidden" name="PG_PG_NAME" id="PG_PG_NAME" value="{$PLUGIN_NAME}" />
	<input type="hidden" name="PG_{$PLUGIN_NAME}_getter" id="PG_{$PLUGIN_NAME}_getter" value="{$getterPhp}" />
	<input type="hidden" name="PG_{$PLUGIN_NAME}_basepath" id="PG_{$PLUGIN_NAME}_basepath" value="{$PG_BASE_PATH}" />
	<input type="hidden" name="PG_{$PLUGIN_NAME}_records_exist" id="PG_{$PLUGIN_NAME}_records_exist" value="{$records_exist}" />
	<input type="hidden" name="PG_{$PLUGIN_NAME}_def_location" id="PG_{$PLUGIN_NAME}_def_location" value="{$default_location}" />
	<input type="hidden" name="PG_{$PLUGIN_NAME}_template" id="PG_{$PLUGIN_NAME}_template" value="{$template}" />
</body>
</html>
