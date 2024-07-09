<!DOCTYPE html>
<html lang="en">
    <?php
        include "connection.php";
    ?>
<body>
    <form action="proses_login.php" method="POST">
        <div class="container mt-1">
            <h1>Halaman Login</h1>
            <label for="username">Username : </label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password : </label><br>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>