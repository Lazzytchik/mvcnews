<form class="authorization" action="/auth/logout" method="post">
    <h2>Привет, <?php echo $_SESSION['username'] ?>!<h2>
    <input type="submit" class="submit" name="submit" value="Выйти">
</form>