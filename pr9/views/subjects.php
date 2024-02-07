<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <nav>
        <a href="/">Students</a>
        <a href="/index.php/subjects">Predmeti</a>
        <a href="/index.php/uspishnist">Uspishnist</a>
    </nav>
    <br>
    <form action="/index.php/subjects/addSubject" method="POST">
        <input type="text" name="name" placeholder="Name" required /><br>
        <br>
        <input type="submit" value="Отправить" />
    </form>

    <hr>

    <?php if ($subjects) { ?>
        <form method="POST" action="/index.php/subjects/actions">
            <table>
                <tr>
                    <th>Имя</th>
                    <th>Действия</th>
                </tr>
                <?php foreach ($subjects as $s) { ?>
                    <tr>
                        <td><input type="text" name="name[<?php echo $s['id']; ?>]" placeholder="Name" required class="post" value="<?php echo $s['name']; ?>"/></td>
                        <td>
                            <button type="submit" name="update" value="<?php echo $s['id']; ?>">Update</button>
                            <button type="submit" name="delete" value="<?php echo $s['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    <?php } ?>
</body>
</html>
