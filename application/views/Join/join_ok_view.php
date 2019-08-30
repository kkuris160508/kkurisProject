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
        <th>PW</th>
        <th>EMAIL</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($accountTB as $data) :?>
        <tr>
            <td><?=$data->ID?></td>
            <td><?=$data->PW?></td>
            <td><?=$data->EMAIL?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>