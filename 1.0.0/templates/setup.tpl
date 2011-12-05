{include file='header.tpl'}
<body>
<!--{$sScriptCrossDomain}-->
	<div id="PG_{$PLUGIN_NAME}_Setup_mainContainer">
	<!-- message box -->
	<div id="PG_{$PLUGIN_NAME}_successMsg"></div>	
			
			<h3 class="PG_{$PLUGIN_NAME}_PGname_title">Yelp</h3>
			<h3>Settings</h3>
			<p class="require"><span class="neccesary">*</span> Required</p>
			<!-- input area -->			

			<table border="1" cellspacing="0" class="table_input_vr">
			<colgroup>
				<col width="115px" />
				<col width="*" />
			</colgroup>
			<tr>
				<th><label for="show_html_value">Shows Rows</label></th>
				<td>
					<input type="radio" class="fix input_rdo" id="PG_{$PLUGIN_NAME}_def_general" name="PG_{$PLUGIN_NAME}_def_general" />General<br />
					<input type="radio" class="fix input_rdo" id="PG_{$PLUGIN_NAME}_def_specific" name="PG_{$PLUGIN_NAME}_def_general" />Specific	
				</td>
			</tr>
			<tr>
				<th>Category</th>
				<td class="PG_{$PLUGIN_NAME}_move">
					<p><a href="#"><img src="images/u131_original.png" alt="" /></a><a href="#"><img src="images/u137_original.png" alt="" /></a></p>
					<select title="select rows" class="rows PG_{$PLUGIN_NAME}_menu" id="show_html_value" size="2">
						<option>Restaurants</option>
						<option>Food</option>
						<option>Nightlife</option>
						<option>Shopping</option>
						<option>Beauty and Spas</option>
						<option>Arts &amp; Entertainment</option>
						<option>Active Life</option>
						<option>Health and Medical</option>
						<option>Hotels &amp; Travel</option>
						<option>Local Services</option>
						<option>Home Services</option>
						<option>Automotive</option>
						<option>Local Flavor</option>
						<option>Pets</option>
						<option>Public Services &amp; Government</option>
						<option>Education</option>
						<option>Professional Services</option>
						<option>Real Estate</option>
						<option>Mass Media</option>
						<option>Financial Services</option>
						<option>Religious Organizations</option>
					</select>
					<p>The category displayed up to 3 on this site.</p>
				</td>
			</tr>
			<tr>
				<th><label for="show_html_value">Shows Rows</label></th>
				<td>
					<span class="neccesary">*</span> <input id="text" class="fix" type="text" maxlength="255" value="5"/>
				</td>
			</tr>
			<tr>
				<th>Template</th>
				<td class="PG_{$PLUGIN_NAME}_move">			
					<!-- Select form The image List -->
					<div id="image_list_wrap">	
						<input type="radio" name="plugin_select_image" class="input_rdo" checked="checked" onclick="image_list()" /> <label class="lbl_rgt">Blue</label>
						<input type="radio" name="plugin_select_image" class="input_rdo" checked="checked" onclick="image_list()" /> <label class="lbl_rgt">Gray</label>
						<p class="PG_{$PLUGIN_NAME}_image">
							<img src="images/u128_original.png" alt="" />
							<img src="images/u126_original.png" alt="" />
						</p>						
					</div>
				</td>
			</tr>
			</table>
			<div class="tbl_lb_wide_btn">
				<a href="" class="btn_apply" title="Save changes" id="PG_{$PLUGIN_NAME}_save">Save</a>
				<a class="add_link" title="Reset to default">Reset to Default</a>
			</div>
	</div>
	<input type="hidden" name="PG_PG_NAME" id="PG_PG_NAME" value="{$PLUGIN_NAME}" />
</body>
</html>












