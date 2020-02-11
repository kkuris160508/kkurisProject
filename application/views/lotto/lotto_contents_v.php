
<table>
    <tr>

    <?php foreach ($views as $num) : ?>

        <p style="font-weight:bold"><?php echo $num -> IDX;?>회차</p>

        <td style="border: 1px solid #4297d7"><?php echo $num -> num_1;?></td>
        <td style="border: 1px solid #4297d7"><?php echo $num -> num_2;?></td>
        <td style="border: 1px solid #4297d7"><?php echo $num -> num_3;?></td>
        <td style="border: 1px solid #4297d7"><?php echo $num -> num_4;?></td>
        <td style="border: 1px solid #4297d7"><?php echo $num -> num_5;?></td>
        <td style="border: 1px solid #4297d7"><?php echo $num -> num_6;?></td>

    <?php endforeach;?>
    </tr>
</table>
<?php
    echo "내가 뽑은 번호 : ";
    for($i = 0; $i < 6; $i++){
        echo $lottoVal[$i]." ";
    }

    echo "<br> 맞춘 갯수 : ".$lottoCnt;
    echo "<br> 맞춘 번호 : ";
    for($j = 0; $j < 6; $j++){
        echo $matchNum[$j]." ";
    }

?>
