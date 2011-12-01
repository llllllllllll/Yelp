{include file='header.tpl'}
<body>
{$sScriptCrossDomain}
	<div id="PG_{$PLUGIN_NAME}_Setup_mainContainer">
		<div id="PG_{$PLUGIN_NAME}_successMsg"></div>	
		<table class="table_input_vr" cellspacing="0" border="1">
			<colgroup>
				<col width="115px">
				<col width="*">
			</colgroup>
			<tbody>
				<tr><th colspan="2">Plugin ID : <span id="PG_{$PLUGIN_NAME}_PG_NAME">{$PLUGIN_NAME}</span></th></tr>
				<tr>
					<th>Paypal Account:</th>
					<td><input type="text" name="PG_{$PLUGIN_NAME}_paypal_acct" id="PG_{$PLUGIN_NAME}_paypal_acct" value="{$paypal_acct}" /></td>
				</tr>
				<tr>
					<th>Currency</th>
					<td>
						<select name="PG_{$PLUGIN_NAME}_currency" id="PG_{$PLUGIN_NAME}_currency">
							{section name=x start=1 loop={$TOTAL_CURRENCY} step=1}
								<option value="{$CURRENCY_SHORT_{$smarty.section.x.index}}" {if {$CURRENCY_SHORT_{$smarty.section.x.index}} eq {$currency}}selected{/if}>{$CURRENCY_NAME_{$smarty.section.x.index}}</option>
							{/section}
						</select>
					</td>
				</tr>
				<tr><th><h3>Optional Settings</h3></th></tr>
				<tr>
					<th>Amount</th>
					<td><input type="text" name="PG_{$PLUGIN_NAME}_amount" id="PG_{$PLUGIN_NAME}_amount" value="{$amount}" /></td>
				</tr>
				<tr>
					<th>Page Style</th>
					<td><input type="text" name="PG_{$PLUGIN_NAME}_pagestyle" id="PG_{$PLUGIN_NAME}_pagestyle" value="{$page_style}" /></td>
				</tr>
				<tr>
					<th>Return Page</th>
					<td><input type="text" name="PG_{$PLUGIN_NAME}_returnpage" id="PG_{$PLUGIN_NAME}_returnpage" value="{$return_page}" /></td>
				</tr>
				<tr><th><h3>Defaults</h3></th></tr>
				<tr>
					<th>Purpose</th>
					<td><input type="text" name="PG_{$PLUGIN_NAME}_purpose" id="PG_{$PLUGIN_NAME}_purpose" value="{$purpose}" /></td>
				</tr>
				<tr>
					<th>Reference</th>
					<td><input type="text" name="PG_{$PLUGIN_NAME}_reference" id="PG_{$PLUGIN_NAME}_reference" value="{$reference}" /></td>
				</tr>
				<tr><th><h3>Donation Button</h3></th></tr>
				<tr>
					<th>Select Button</th>
					<td id="PG_{$PLUGIN_NAME}_imgbtn_td">
						<select name="PG_{$PLUGIN_NAME}_imgbtn" id="PG_{$PLUGIN_NAME}_imgbtn">
							<option value="small"		{if {$button_image} eq "small"}selected{/if}>Small</option>
							<option value="medium"	{if {$button_image} eq "medium"}selected{/if}>Medium</option>
							<option value="large"		{if {$button_image} eq "large"}selected{/if}>Large</option>
							<option value="custom"	{if {$button_image} neq "small" AND {$button_image} neq "medium" AND {$button_image} neq "large" AND {$RECORD_COUNT} eq 1}selected{/if}>Custom</option>
						{if {$button_image} neq "small" or {$button_image} neq "medium" or {$button_image} neq "large"}
							<input type="hidden" name="PG_{$PLUGIN_NAME}_CDimgbtn" id="PG_{$PLUGIN_NAME}_CDimgbtn" value="{$button_image}" />
						{/if}
						</select>
					</td>
				</tr>
				<tr>
					<th>Title</th>
					<td><input type="text" name="PG_{$PLUGIN_NAME}_title" id="PG_{$PLUGIN_NAME}_title" value="{$title}" /></td>
				</tr>
				<tr>
					<th>Text</th>
					<td><input type="text" name="PG_{$PLUGIN_NAME}_text" id="PG_{$PLUGIN_NAME}_text" value="{$text}" /></td>
				</tr>
				<tr>
					<th>See the total donations: </th>
					<td>
						<a class="btn_add_new btn_width_st2" href="https://www.paypal.com" target="_blank"><span>Total</span></a>
					</td>
				</tr>
				<tr>
					<td>
						<a class="btn_apply" id="PG_{$PLUGIN_NAME}_save">Save</a>
					</td>
				</tr>
			</tbody>
		</table>
		<!--Hidden values-->
		<input type="hidden" name="PG_{$PLUGIN_NAME}_getter" id="PG_{$PLUGIN_NAME}_getter" value="{$getterPhp}" />
		<input type="hidden" name="PG_{$PLUGIN_NAME}_PG_BASE_PATH" id="PG_{$PLUGIN_NAME}_PG_BASE_PATH" value="{$PG_BASE_PATH}" />
	</div>
</body>
</html>












