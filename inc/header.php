	<header>	<!-- Header Section -->
		<nav class="navbar navbar-default navbar-fixed-top">	<!-- Nav Section -->
			<div class="container clearfix"> 	<!-- Nav Container -->
				
				<!-- Include the navbar branding, toggle menu and search box -->
				<div>
					<a class="navbar-brand" href="index.php" aria-labelledby="myt-home-link">
						<span class="sr-only">Top Navigation Organisation Logo</span>
						<img id="myt-home-link" class="img-responsive" alt="Picture of MyT URCSA logo" 
							 src="assets/mytLogo53x51.jpeg" />
					</a>
				</div>
				<div id="search-btn-div" class="toggle-search btn btn-default">
					<span class="sr-only">Top Navigation Search Button</span>
					<a href="#search-box"><i id="search-button" class="glyphicon glyphicon-search"></i></a>
				</div>
				<div class="navbar-header myt-cen-txt">
					<span class="sr-only">Top Navigation</span>
					<button type="button" class="navbar-toggle" data-toggle="collapse" 
						data-target="#myt-navbar-collapse">
							<span class="sr-only">Toggle Top Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="myt-white-font"><b>MENU</b></span>
					</button>
				</div>
				<!-- Toggable Search box -->
				<div id="search-box" class="search-box-hide pull-right">	
					<form style="margin-top: 5px" action="search.php" role="search">
						<div class="form-group has-feedback has-feedback-right form-row">
							<div class="col-auto">
								<input id="search-box-input" type="search" name="search" size="15" 
									class="form-control" placeholder="Type & Search" aria-label="Search">
								<i class="glyphicon glyphicon-search form-control-feedback"></i>
							</div>
						</div>
					</form>
				</div> <!-- End Toggable Search box -->	
					
				<div class="collapse navbar-collapse" id="myt-navbar-collapse">		<!-- MenuBar Section -->
					<ul class="nav navbar-nav" role="menubar" itemscope itemtype="http://www.schema.org/SiteNavigationElement">
						<li <?php if( ($header_flag == 'index') || $header_flag == 'privacy' ) echo 'class="active"'; ?> 
							role="menuitem" aria-labelledby="homeLink">
							<a itemprop="url" href="index.php">
							<span itemprop="name" id="homeLink">Home</span></a></li>
						<li <?php if($header_flag == 'about') echo 'class="active"'; ?> 
							role="menuitem" aria-labelledby="aboutus-link">
							<a itemprop="url" href="about.php" aria-labelledby="aboutus-link">
								<span itemprop="name" id="aboutus-link">About us</span>
							</a>
						</li>
						<li <?php if($header_flag == 'gallery') echo 'class="active"'; ?>
							role="menuitem" aria-labelledby="homeLink">
							<a itemprop="url" href="galleries.php" aria-labelledby="gallery-link">
								<span id="gallery-link" itemprop="name">Gallery</span></a></li>
						<li <?php if( ($header_flag == 'ministries') || ($header_flag == 'cwm') 
										|| ($header_flag == 'cwl') || ($header_flag == 'cmm') 
										|| ($header_flag == 'cym') || ($header_flag == 'choir') 
										|| ($header_flag == 'youth') || ($header_flag == 'sunday_school') )
								  { echo 'class="dropdown active"'; } ?>
							role="menuitem" aria-labelledby="ministries-link" aria-haspopup="true">
							<a itemprop="url" href="ministries.php" class="dropdown-toggle" data-toggle="dropdown" aria-labelledby="ministries-link">
								<span id="ministries-link" itemprop="name">Ministries</span><b class="caret"></b>
							</a>   
							<ul class="dropdown-menu" role="menu">
								<li <?php if($header_flag == 'cwm') echo 'class="active"'; ?>
									role="menuitem"><a href="mytcwm.php" aria-labelledby="cwm-link">
									<span id="cwm-link">CWM</span></a></li>
								<li <?php if($header_flag == 'cwl') echo 'class="active"'; ?>
									role="menuitem"><a href="#" aria-labelledby="cwl-link">
									<span id="cwl-link">CWL</span></a></li>										
								<li <?php if($header_flag == 'cmm') echo 'class="active"'; ?>
									role="menuitem"><a href="mytcmm.php" aria-labelledby="cmm-link">
									<span id="cmm-link">CMM</span></a></li>
								<li <?php if($header_flag == 'cym') echo 'class="active"'; ?>
									role="menuitem"><a href="mytcym.php" aria-labelledby="cym-link">
									<span id="cym-link">CYM</span></a></li>
								<li <?php if($header_flag == 'choir') echo 'class="active"'; ?>
									role="menuitem"><a href="choir.php" aria-labelledby="choir-link">
									<span id="choir-link">Choir</span></a></li>
								<li <?php if($header_flag == 'youth') echo 'class="active"'; ?>
									role="menuitem"><a href="mytyouth.php" aria-labelledby="myt-youth-link">
									<span id="myt-youth-link">Youth</span></a></li>
								<li <?php if($header_flag == 'sunday_school') echo 'class="active"'; ?>
									role="menuitem"><a href="sundayschool.php" aria-labelledby="sunday-school-link">
									<span id="sunday-school-link">Sunday School</span></a></li>									
							</ul>									
						</li>										
						<li <?php if( ($header_flag == 'congregation') || ($header_flag == 'calendar')
										|| ($header_flag == 'announcements') 
										|| ($header_flag == 'events') || ($header_flag == 'committees') || ($header_flag == 'academic') 
										|| ($header_flag == 'communications') || ($header_flag == 'finance') 
										|| ($header_flag == 'health') || ($header_flag == 'outreach') )
								  { echo 'class="dropdown active"'; } ?> 
							role="menuitem" aria-labelledby="congregation-link" aria-haspopup="true">
							<a itemprop="url" href="congregation.php" class="dropdown-toggle" data-toggle="dropdown" aria-labelledby="congregation-link">
								<span id="congregation-link" itemprop="name">Congregation</span><b class="caret"></b>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li <?php if($header_flag == 'announcements') echo 'class="active"'; ?> 
									role="menuitem"><a href="announcements.php" aria-labelledby="announcement-link">
									<span id="announcement-link">Announcements</span></a></li>
								<li <?php if($header_flag == 'events') echo 'class="active"'; ?>
									role="menuitem"><a href="event.php" aria-labelledby="events-link">
									<span id="events-link">Events</span></a></li>
								<li <?php if($header_flag == 'calendar') echo 'class="active"'; ?> 
									role="menuitem"><a href="calendar.php" aria-labelledby="calendar-link">
									<span id="calendar-link">Calendar</span></a></li>	
								<li <?php if($header_flag == 'youthSkills') echo 'class="active"'; ?> 
									role="menuitem"><a href="mytSkills.php" aria-labelledby="skills-link">
									<span id="skills-link">Skills Audit</span></a></li>										
								<li <?php if( ($header_flag == 'congregation') || ($header_flag == 'committees') || ($header_flag == 'academic')  
												|| ($header_flag == 'communications') || ($header_flag == 'finance')  || ($header_flag == 'health') 
												|| ($header_flag == 'outreach') 
											) { echo 'class="active"';} ?>
									role="menuitem"><a href="congregation.php#committees" aria-labelledby="committees-link">
									<span id="committees-link">Committees</span></a></li>
								<li <?php if($header_flag == 'wards') echo 'class="active"'; ?> 
									role="menuitem"><a href="wards.php" aria-labelledby="wards-link">
									<span id="wards-link">Wards</span></a></li>
							</ul>
						</li>
						<li <?php if($header_flag == 'vacancy') echo 'class="active"'; ?> 
							role="menuitem">
							<a href="vacancy.php" aria-labelledby="vacancy-link">
								<span id="vacancy-link">Vacancies</span></a></li>
						<!-- <li role="menuitem"><a href="unavailable.php" aria-labelledby="donations-link">
							<span id="donations-link">Donations</span></a></li> -->
						<li <?php if($header_flag == 'contact') echo 'class="active"'; ?> 
							role="menuitem">
							<a itemprop="url" href="#" data-toggle="modal" data-target="#myt-contact-modal" 
								aria-labelledby="contact-us-link">
								<span id="contact-us-link" itemprop="name">Contact us</span></a></li>
					</ul>
				</div>		<!-- End MenuBar Section -->
			</div>			<!-- End Nav Container -->
		</nav>  			<!-- End Nav Section -->
	</header>				<!-- End Header Section -->			