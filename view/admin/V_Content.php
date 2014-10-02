<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header"><a class="navbar-brand" href="#">CubbyHole</a></div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php?page=dashboard">Dashboard</a></li>
				<li><a href="index.php?page=deco">Déconnexion</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li <?php if(!isset($_GET['display'])) echo 'class="active"'; ?>><a href="index.php?page=dashboard">Overview</a></li>
				<li <?php if(isset($_GET) and $_GET['display'] == 'plans') echo 'class="active"'; ?>><a href="index.php?page=dashboard&display=plans">Gestion des Plans</a></li>
				<li <?php if(isset($_GET) and $_GET['display'] == 'usersStats') echo 'class="active"'; ?>><a href="index.php?page=dashboard&display=usersStats">Stats Utilisateurs</a></li>
				<li <?php if(isset($_GET) and $_GET['display'] == 'charts') echo 'class="active"'; ?>><a href="index.php?page=dashboard&display=charts">Graphes</a></li>
			</ul>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<?php
			if(isset($_GET["display"])){
				$display = $_GET["display"];
			}
			else {
				$display = "";
			}

			switch($display) {
				case "dashboard":
					include_once("./control/admin/C_Accueil.php");
					break;
				case "plans":
					include_once("./control/admin/C_Plans.php");
					break;
				case "updatePlan":
					include_once("./control/admin/C_UpdatePlan.php");
					break;
				case "usersStats":
					include_once("./control/admin/C_UsersStats.php");
					break;
				case "charts":
					include_once("./control/admin/C_Charts.php");
					break;
				default:
				include_once("./control/admin/C_Accueil.php");
			}
			?>
		</div>
	</div>
</div>