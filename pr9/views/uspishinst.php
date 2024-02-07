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
        <a href="/index.php/uspishinst">Uspishnist</a>
    </nav>
    <br>
    <form action="/index.php/uspishinst/add" method="POST">
        <select name="sid">
            <option value="">---</option>
            <?php if ($students) { ?>
                <?php foreach ($students as $s) { ?>
                    <option value="<?php echo $s['id'];?>"><?php echo $s['name'];?></option>
                <?php } ?>
            <?php } ?>
        </select>
        <br>
        <select name="pid">
            <option value="">---</option>
            <?php if ($subjects) { ?>
                <?php foreach ($subjects as $s) { ?>
                    <option value="<?php echo $s['id'];?>"><?php echo $s['name'];?></option>
                <?php } ?>
            <?php } ?>
        </select>
        <br>
        <input type="number" name="mark" placeholder="Mark" required /><br>
        <br>
        <input type="submit" value="Отправить" />
    </form>

    <hr>

    <?php if ($uspishinst) { ?>
        <form method="POST" action="/index.php/uspishinst/actions">
            <table>
                <tr>
                    <th>Имя</th>
                    <th>Предмет</th>
                    <th>Оценка</th>
                    <th>Действия</th>
                </tr>
                <?php foreach ($uspishinst as $u) { ?>
                    <tr>
                        <td>
                            <select name="sid[<?php echo $u['id']; ?>]">
                                <option value="">---</option>
                                <?php if ($students) { ?>
                                    <?php foreach ($students as $s) { ?>
                                        <option value="<?php echo $s['id'];?>" <?php if($u['sid']==$s['id']) echo 'selected';?>><?php echo $s['name'];?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>   
                        </td>
                        <td>
                            <select name="pid[<?php echo $u['id']; ?>]">
                                <option value="">---</option>
                                <?php if ($subjects) { ?>
                                    <?php foreach ($subjects as $s) { ?>
                                        <option value="<?php echo $s['id'];?>" <?php if($u['pid']==$s['id']) echo 'selected';?>><?php echo $s['name'];?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type="number" name="mark[<?php echo $u['id']; ?>]" placeholder="Mark" required class="post" value="<?php echo $u['mark']; ?>"/></td>
                        <td>
                            <button type="submit" name="update" value="<?php echo $u['id']; ?>">Update</button>
                            <button type="submit" name="delete" value="<?php echo $u['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    <?php } ?>
</body>
</html>
