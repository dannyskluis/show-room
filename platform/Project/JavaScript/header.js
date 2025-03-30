let navbar = `<div class="nav_image">
<img src="foto's/goede_logo.png" alt="" width="80px" height="80px" />
</div>

<a href="profile.php" class="nav_profile">
<h4>Profile</h4>
</a>

<div class="nav">
<a href="home.php">
    <h4>Home</h4>
</a>
<a href="projects.php">
    <h4>My Projects</h4>
</a>
<a href="clients.php">
    <h4>My Clients</h4>
</a>
<a href="agenda.php">
    <h4>agenda</h4>
</a>
<a href="logout.php"><h4>Logout</h4></a>
</div>
    `;

document.getElementById("navbar").innerHTML = navbar;