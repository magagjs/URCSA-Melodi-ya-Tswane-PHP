<?php 
	$shareText = '';		// text to display on share window pop-up
	
	if($header_flag=='index')
		$shareText = 'Melodi ya Tshwane Website Welcome';
	if($header_flag=='announcements')
		$shareText = 'Melodi ya Tshwane Announcements';
	if($header_flag=='events')
		$shareText = 'Melodi ya Tshwane Events';	
	if($header_flag=='calendar')
		$shareText = 'Melodi ya Tshwane Calendar';
	if($header_flag=='choir')
		$shareText = 'Melodi ya Tshwane Choir';
	if($header_flag=='academic')
		$shareText = 'Melodi ya Tshwane Academic Committee';	
	if($header_flag=='communications')
		$shareText = 'Melodi ya Tshwane Communications Committee';
	if($header_flag=='finance')
		$shareText = 'Melodi ya Tshwane Finance Committee';	
	if($header_flag=='health')
		$shareText = 'Melodi ya Tshwane Health Committee';
	if($header_flag=='outreach')
		$shareText = 'Melodi ya Tshwane Outreach Committee';			
	if($header_flag=='ministries')
		$shareText = 'Melodi ya Tshwane Ministries';	
	if($header_flag=='cmm')
		$shareText = 'Melodi ya Tshwane CMM Ministry';
	if($header_flag=='cwl')
		$shareText = 'Melodi ya Tshwane CWL Ministry';
	if($header_flag=='cwm')
		$shareText = 'Melodi ya Tshwane CWM Ministry';		
	if($header_flag=='cym')
		$shareText = 'Melodi ya Tshwane CYM Ministry';
	if($header_flag=='youth')
		$shareText = 'Melodi ya Tshwane Youth';
	if($header_flag=='sunday_school')
		$shareText = 'Melodi ya Tshwane Sunday School';
	if($header_flag=='wards')
		$shareText = 'Melodi ya Tshwane Wards';

?>
<aside id="share-button-bottombar" class="myt-cen-txt" aria-labelledby="share-buttons">
	<p id="share-buttons">Share&nbsp;
		<span id="share-title" style="display:none"><?php echo $shareText;?></span>
		<i id="facebook-share" class="fab fa-facebook"></i>&nbsp;
		<i id="twitter-share" class="fab fa-twitter-square"></i>&nbsp;
		<!-- Javascript to add whatsapp share button on iOS & Andriod ONLY -->
		<script>
		if( navigator.userAgent.match(/iPhone|iPad|iPod|Android|J2ME|Windows Phone|BB|BlackBerry/i) )
			document.write('<i id="whatsapp-share" class="fab fa-whatsapp"></i>&nbsp;');
		</script>
		<i id="mail-share" class="fas fa-envelope"></i> &nbsp;
	</p> 
</aside>