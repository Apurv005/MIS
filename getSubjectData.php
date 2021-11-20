<?php

include "connection2.php";
$status = $_GET['status'];
$val = $_GET['br'];
if($status == "true"){
    if(isset($val)){
        $query = "SELECT DISTINCT sem FROM data group by sem";
        $result = mysqli_query($conn, $query);
            ?>
            <option selected disabled>Select Semester</option>
            <?php
        while ($data = mysqli_fetch_row($result)) {
            foreach($data as $sd){
            ?>
                <option value="<?php echo $sd; ?>" ><?php echo $sd; ?></option>
                <?php
            }
        }
    }
}
else{
    $sem = $_GET['sem'];
    // echo $sem;
    // echo $val;
    $frameWork = array();

    $query2 = "select * from data where sem = $sem AND BR_NAME = '$val'";
    $result2 = mysqli_query($conn, $query2);
    echo $query2;
    if($query2 != ''){
        echo "IF";
        while ($data = mysqli_fetch_array($result2)) {
        $total = $data[196];
        $name_idx = 31;
        for ($i = 0; $i < $total; $i++) {
            array_push($frameWork,$data[$name_idx++]);
        }
        break;
    }
    }
    else{
        echo "No dAra";
    }
    if(!empty($frameWork)){
        $i =1 ;
        ?>
            <option selected disabled>Select Branch</option>
        <?php
        foreach($frameWork as $fVal){
            ?>
            <option value="SUB<?php echo $i; ?>GR" ><?php echo $fVal; ?></option>
            <?php 
            // echo "<option value='SUB$iGR'>$fVal</option>";
            // It is Original: // echo "<option value='$fVal'> $fVal </option>";
            $i++;
        }
    }
    else{
        echo "<option> No Data Found </option>";
    }

}
// if()
    // switch($val){
    //     case 1:
    //         foreach($frameWork as $fVal){
    //             echo "<option value='$val'> $fVal </option>";
    //         }
    //     break;
    //     case 3:
    //         foreach($frameWork as $fVal){
    //             echo "<option value='$val'> $fVal </option>";
    //         }
    //     break;
    //     default: echo "No data is not found..";
    // }
?>