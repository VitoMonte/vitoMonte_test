<form action="#" method="post">
    <? if ($error != ''): ?>
        Ошибка: <b style="color:red"><?=$error?></b><br><br>
    <? endif ?>
    <div>
        <label for="nick">Login</label>
        <input type="text" name="login"  value="<?=$login?>" />
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password"  value="" />
    </div>
    <div>
        <input type="button" value="Зарегистрироваться"
               onClick="location.href='index.php?name=reg'" />
        <input type="submit" name="signIn" value="Войти" />
    </div>
</form>
