<?php
defined('MYAAC') or die('Direct access not allowed!');
?>
<form method="post" action="<?php echo BASE_URL; ?>?characters" style="margin-bottom:0;">
	<div class="searchchar">
		<div class="searchchar_header">Search Character</div>
		<div class="searchchar_content">
			<input type="text" class="searchchar_input" name="name" maxlength="29" placeholder="Character name">
			<button type="submit" class="searchchar_button">Search</button>
		</div>
	</div>
</form>
