<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner" style="background-color: #008ce8;border: none;">
	<div class="container">
		<div class="navbar-header">
			<a href="index.php?page=accueil" class="navbar-brand" style="padding:0;"><img src="images/cubbyhole150.png" height="50px"/></a>
		</div>
		<!--<form class="navbar-form navbar-left" role="search" style="opacity: 0.5;">
			<div class="input-group" style="width: 400px;margin-left:170px;">
				<input type="text" class="form-control" id="formsearch" onkeyup="rechercher();" autocomplete="off">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</form>-->
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="index.php?page=profil" style="color: rgba(255,255,255,0.7);padding:auto;font-size: 18px;"><?php echo $_SESSION['user']; ?>&nbsp;<span class="glyphicon glyphicon-user"></span></a>
			</li>
			<li>
				<a href="index.php?page=invitation" style="color: rgba(255,255,255,0.7);padding:auto;font-size: 18px;"><span class="glyphicon glyphicon-send" title='send invitation'></span></a>
			</li>
			<li>
				<a href="index.php?page=deco" style="color: rgba(255,255,255,0.7);padding:auto;font-size: 18px;"><span class="glyphicon glyphicon-eject" title='disconnect'></span></a>
			</li>
		</ul>
	</div>
</header>

<!--<div id="listerecherche" style="z-index: 50; width: 400px; position: fixed; top:50px; left: 34%; display: none;">

</div>-->