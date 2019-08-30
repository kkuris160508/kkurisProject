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
    <?php foreach($accountTB as $id => $name) :?>
        <tr>
            <td><?=$id?></td>
            <td><?=$name?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>