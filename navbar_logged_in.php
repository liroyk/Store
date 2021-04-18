<?php
if (!isset($_SESSION)) {
    session_start();
}
?>


<?php
if (isset($_SESSION['is_admin'])) {
    ?>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow navbar-expand-lg">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">Store</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="/logout.php">Log Out</a>
            </li>
        </ul>
    </nav>

    <?php
} else {
    ?>


    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow navbar-expand-lg">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">Store</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="/purchase_history.php">Purchase History</a>
            </li>
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="account_settings.php">Account Settings</a>
            </li>
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="/logout.php">Log Out</a>
            </li>
        </ul>
    </nav>

<?php } ?>