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
        <?php foreach ($members as $member) :?>
            <tr>
                <td><?=$member->id?></td>
                <td><?=$member->name?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-27
 * Time: 오전 10:50
 */
?>