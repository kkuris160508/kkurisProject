<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member</title>
</head>
<body>
<h1>가입완료</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>EMAIL</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($accountTB as $data) :?>
        <tr>
            <td><?=$data->ID?></td>
            <td><?=$data->EMAIL?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<meta http-equiv="refresh" content="5;URL='http://34.80.199.17/Join/main/'">
</body>
</html>

