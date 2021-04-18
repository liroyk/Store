        <?php
		
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['email'])) {
            include 'index_logged_out.php';
        } else {
            include 'index_logged_in.php';
        }
        ?>