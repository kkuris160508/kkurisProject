
<?php foreach ($views as $num) : ?>

    <p style="font-weight:bold">
    <?php echo $num -> IDX;?>회차

    <?php echo $num -> num_1;?>
    <?php echo $num -> num_2;?>
    <?php echo $num -> num_3;?>
    <?php echo $num -> num_4;?>
    <?php echo $num -> num_5;?>
    <?php echo $num -> num_6;?>
    </p>

<?php endforeach;?>

<?php
    echo "내가 뽑은 번호 : ";
    for($i = 0; $i < 6; $i++){
        echo $lottoVal[$i]." ";
    }
?>
