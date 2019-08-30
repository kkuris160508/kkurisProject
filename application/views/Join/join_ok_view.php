<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($accountTB as $ID => $PW) :?>
        <tr>
            <td><?=$ID?></td>
            <td><?=$PW?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>