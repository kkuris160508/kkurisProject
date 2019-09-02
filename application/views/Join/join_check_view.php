<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member</title>
</head>
<body>
<?php //echo $result = $this->debug->debug_var($accountInfo);?>
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
        <tr>
            <td><?php echo $accountTB->ID;?></td>
            <td><?php echo $accountTB->PW;?></td>
            <td><?php echo $accountTB->EMAIL;?></td>
        </tr>
    </tbody>
</table>
</body>
</html>