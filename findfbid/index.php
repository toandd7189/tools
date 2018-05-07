<?php
if (isset($_POST['url'])) {
	$ch = curl_init();
	$url = 'https://findmyfbid.com';
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type' => 'application/json']);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['url'=> $_POST['url']]));
	curl_setopt($ch, CURLOPT_URL, $url);

	$result = curl_exec($ch);
	curl_close($ch);
	$uid = '';
	if (isset(json_decode($result)->id))
		$uid = json_decode($result)->id;
}

?>

<form method="POST">
	<label>Facebook URL: </label>
	<input type="text" name="url" />
	<input type="submit" name="submit" value="getID" />
</form>
<?php if (! empty($uid)) : ?>
	<div class="result">
		<label>Your FB ID : <?php echo $uid ?></label>
	</div>
<?php endif; ?>