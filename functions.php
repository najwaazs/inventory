<?php
    function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';
    }
?>