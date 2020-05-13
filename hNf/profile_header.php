<h3 class="text-center heading text-body" >Online Exam</h3>
<div style="padding :20px;"></div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container float-right">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Home</a>
            </li>
            <form action="profile.php" method="get">
                <input type="submit" name="sign_out" value="Sign Out" class="nav-link bg-dark border-0 btn">
            </form>

        </ul>
        <h6 class="text-light"><i class="fas fa-user"> </i> <?php echo $_SESSION['full_name']?></h6>
    </div>
</nav>
<div class="gap"></div>
