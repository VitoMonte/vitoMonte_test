<form action="#" method="post">
    <? if ($error != null): ?>
        Ошибка: <b style="color:red"><?=$error?></b><br><br>
    <? endif ?>
    <div>
        <label for="nick">Введите НИК</label>
        <input type="text" name="login"  value="<?=$login?>" placeholder="nick" />
    </div>
    <div>
        <label for="password">Введите пароль</label>
        <input type="password" name="password"  value="" />
    </div>
    <div>
        <label for="day">Введите дату рождения</label>
        <select name="day">
            <?for ($i=1; $i<=31; $i++) :?>
            <option><?=$i?></option>
            <?endfor?>
        </select>
        <select name="mounth">
            <?for ($i=1; $i<=12; $i++) :?>
                <option><?=$i?></option>
            <?endfor?>
        </select>
        <select name="year" value="Год">
            <?for ($i=date('Y', time()); $i>=1850; $i--) :?>
                <option><?=$i?></option>
            <?endfor?>
        </select>
    </div>
    <div>
        <input type="submit" name="signUp" value="Зарегистрироваться" />
        <input type="button" value="На главную"
               onClick="location.href='index.php'" />
    </div>
</form>