<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
session_start();
?>

<html>
	<head>
		<title>Home Page</title>
	</head>

	<body>
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
		?>
		<div class="hero-unit">
			<h1>Welcome and all that stuff</h1>
			<p>
				All about what this website site does and how it changes your
				life
			</p>
			<p>
				<button class="btn btn-primary btn-large" onclick="GetStarted()">
					<i class="icon-camera icon-white"> </i> Get Started
				</button>
			</p>
		</div>

		<div class="container">
			<div class="row-fluid">
				<div class="span8">
					<p>
						Manchester United Football Club is an English professional
						football club, based in Old Trafford, Greater Manchester, that
						plays in the Premier League.Founded as Newton Heath LYR Football
						Club in 1878, the club changed its name to Manchester United in
						1902 and moved to Old Trafford in 1910. Manchester United have won
						many trophies in English football, including a record 20 League
						titles, a record 11 FA Cups,[3] four League Cups and a record 19
						FA Community Shields. The club has also won three European Cups,
						one UEFA Cup Winners' Cup, one UEFA Super Cup, one
						Intercontinental Cup and one FIFA Club World Cup. In 1998–99, the
						club won a Treble of the Premier League, the FA Cup and the UEFA
						Champions League, an unprecedented feat for an English club.
					</p>

					<div class="row-fluid">
						<div class="span4">
							<h4>Idea</h4>
							<p>
								Understand the complete idea behind this web site
							</p>
							<a href="#" class="btn btn-success">Understand</a>
						</div>
						<div class="span4">
							<h4>Partners</h4>
							<p>
								Get the list of the <a href="#">partners here</a>
							</p>
						</div>
						<div class="span4">
							<h4>Support</h4>
							<p>
								You can come forward and donate us few dollars for some
								beer!
							</p>
						</div>
					</div>

				</div>
				<div class="span4">
					<ul class="nav nav-list well">
						<li>
							<p>
								This is an amazing time pass faggot.
								<?php echo $_SESSION['codenameDSusername']; ?>
							</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>
