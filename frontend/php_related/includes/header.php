<header class="bg-header text-white">
    <nav class="navbar navbar-expand-lg">
      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar1">
        <i class="fas fa-grip-lines"></i>
      </button>
      <div class="navbar-collapse collapse" id="navbar1">
        <ul class="navbar-nav ml-auto">
          <?php if( !isset( $_SESSION['user_id'] ) ) { ?>
          <li class="nav-item ml-auto">
            <a class="nav-link nav-link-secondary" href="registration.php">Register</a>
          </li>
          <li class="nav-item ml-auto">
            <a class="nav-link nav-link-secondary" href="login.php">Login</a>
          </li>
          <?php } else{ ?>
          <li class="nav-item ml-auto">
            <a class="nav-link nav-link-secondary" href="logout.php">Logout</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
		<nav class="navbar navbar-expand-lg navbar-light">
  			
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>

  			<div class="collapse navbar-collapse" id="navbarSupportedContent">
   	 			<ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['admin'])) { ?>
     	 			<li class="nav-item active">
              <a class="nav-link" href="admin/index.php">Home</a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="insert.php">Insert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view.php">View</a>
            </li>
            <?php } else{?>
            <li class="nav-item active">
        			<a class="nav-link" href="index.php">Home</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="insert.php">Insert</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="view.php">View</a>
      			</li>
            <?php } ?>
      			
              
      				
    			</ul>
  			</div>
		</nav>
</header>
