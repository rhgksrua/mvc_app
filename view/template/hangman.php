<!DOCTYPE html>
<html>
    <head>
        <title>Hangman Solver</title>
    </head>
    <body>
        <h1>Hangman Solver</h1>
        <h2><?= $next ?></h2>
        <p><?php echo isset($regex) ? $regex : '' ?>
        <form action='/php/mvc_app/hangman?test' method='post'>
            <p>
                <label for='word'>Enter word with ? as blanks</label>
                <br />
                <input type='text' name='word' value='<?= $word ?>' />
            </p>
            <p>
                <label for='used'>Enter letters used</label>
                <br/>
                <input type='text' name='used' value='<?= $used ?>' />
            </p>
            <p>
                <input type='submit' value='Submit' />
            </p>
            <p><?= $error ?></p>
        </form>

        <div>
<?php 
foreach ($matches as $word) {
    echo "<span class=\"words\">{$word} </span>";
}
?>
        </div>

    </body>
</html>
