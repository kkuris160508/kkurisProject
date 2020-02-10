
<table>
    <tr>

    <?php foreach ($views as $num) : ?>

        <p style="font-weight:bold">
        <?php echo $num -> IDX;?>회차

        <td><?php echo $num -> num_1;?></td>
        <td><?php echo $num -> num_2;?></td>
        <?php echo $num -> num_3;?>
        <?php echo $num -> num_4;?>
        <?php echo $num -> num_5;?>
        <?php echo $num -> num_6;?>
        </p>

    <?php endforeach;?>
    </tr>
</table>
<?php
    echo "내가 뽑은 번호 : ";
    for($i = 0; $i < 6; $i++){
        echo $lottoVal[$i]." ";
    }
?>
