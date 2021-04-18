<?php
if (!isset($_SESSION)) {
    session_start();
}
?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">


    <?php
    if (isset($_SESSION['is_admin'])) {
        ?>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Admin Tools</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="/admin_category_page.php">
                    <span data-feather="file-text"></span>
                    Admin Category Page
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin_product_page.php">
                    <span data-feather="file-text"></span>
                    Admin Product Page
                </a>
            </li>

        <?php } ?>



        <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Categories</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <?php
                $categories = getCategoryList($conn);
                foreach ($categories as $row) {
                    echo '<li class = "nav-item">
                  <a class = "nav-link" href =/browse_products.php?category_name=' . urlencode($row['category_name']) . '>'
                    . $row['category_name'] .
                    '</a>
                 </li>';
                }
                ?>

            </ul>
        </div>
</nav>