<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member</title>
</head>
<body>
<?php //echo $result = $this->debug->debug_var($accountTB);?>
<?php //echo $result;?>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>PW</th>
        <th>EMAIL</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($accountTB as $item) : ?>
        <tr>
            <td><?=$item->ID?></td>
            <td><?=$item->PW?></td>
            <td><?=$item->EMAIL?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
</body>
</html>