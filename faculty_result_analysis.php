<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
	
    <title>Document</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

        html{
            height: 100%;   
        }
        body {
            height: 100%;   
            background-color: #3e94ec;
            font-family: "Roboto", helvetica, arial, sans-serif;
            font-size: 16px;
            font-weight: 400;
            text-rendering: optimizeLegibility;
            box-sizing: boder-box;
        }
        .containerBody{
            height: 100%;
            margin: 0px 10px;
        }
        div.table-title {
            display: block;
            margin: auto;
            max-width: 600px;
            padding: 5px;
            width: 100%;
        }

        .table-title h3 {
            color: #fafafa;
            font-size: 30px;
            font-weight: 400;
            font-style: normal;
            font-family: "Roboto", helvetica, arial, sans-serif;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
        }


        /*** Table Styles **/

        .table-fill {
            background: white;
            border-radius: 3px;
            border-collapse: collapse;
            height: 320px;
            margin: auto;
            max-width: 600px;
            padding: 5px;
            width: 100%;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            animation: float 5s infinite;
        }

        th {
            color: #D5DDE5;
            ;
            background: #1b1e24;
            border-bottom: 4px solid #9ea7af;
            border-right: 1px solid #343a45;
            font-size: 23px;
            font-weight: 100;
            padding: 24px;
            text-align: left;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            vertical-align: middle;
        }

        th:first-child {
            border-top-left-radius: 3px;
        }

        th:last-child {
            border-top-right-radius: 3px;
            border-right: none;
        }

        tr {
            border-top: 1px solid #C1C3D1;
            border-bottom: 1px solid #C1C3D1;
            color: #666B85;
            font-size: 16px;
            font-weight: normal;
            text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
        }

        tr:hover td {
            background: #4E5066 !important;
            color: #FFFFFF !important;
            border-top: 1px solid #22262e !important;
            ;
        }

        tr:first-child {
            border-top: none;
        }

        tr:last-child {
            border-bottom: none;
        }

        tr:nth-child(odd) td {
            background: #EBEBEB !important;
        }

        tr:nth-child(odd):hover td {
            background: #4E5066 !important;
        }

        tr:last-child td:first-child {
            border-bottom-left-radius: 3px;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius: 3px;
        }

        td {
            background: #FFFFFF;
            padding: 20px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 18px;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #C1C3D1;
        }

        td:last-child {
            border-right: 0px;
        }

        th.text-left {
            text-align: left;
        }

        th.text-center {
            text-align: center;
        }

        th.text-right {
            text-align: right;
        }

        td.text-left {
            text-align: left;
        }

        td.text-center {
            text-align: center;
        }

        td.text-right {
            text-align: right;
        }
        label {
            width: 35%;
        }
        select{
            width: 50%;
        }
        form{
            display: grid;
            grid-template-columns: auto auto auto;
            grid-row-gap: 20px;
        }
        .selectBoxSearch{
            grid-column: 2 / 4;
            /* justify-content: center; */
            /* align-items: center; */
        }
        .searchBtn{
            text-align: center !important;
        display : inline-block;
            /* width: 50% !important; */
        }
        .headingSA{
            text-align: center;
        }
        .btnDownload{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .graph{
            height: 1470px;
            width:100%; 
            margin-bottom: 300px; 
            /* border: 1px solid black; */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            
        }
        .myFooter{
            position: fixed;
            bottom: 0;
            left: 0;
            background-color: #4d4d4d;
            height: 50px;
            color: #fff;
            width: 100%;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<?php
include "faculty_header.php";
include "connection2.php";
$result = "";
?>

<body>
<!-- Start -->
<div class="containerBody">
<h2 class = 'headingSA'>Student Analysis</h2>
    <hr>
    <div class="divSelect">
    <form action="" method = "POST">
        
    <!-- Academic Year: -->
    <div class="selectBox">
    <label for="sAcademic">Select Academic Year: </label>
    <select id="sAcademic" name="sAcademic" onchange="selectedAcademicYear(this.value)" required>
        <option selected disabled>Select Acadamic Year</option>
    <?php 
        $exam_query = "Select AcademicYear from data group by AcademicYear";
        $r = mysqli_query($conn, $exam_query);
            while($d1 = mysqli_fetch_row($r)) {
                echo "<option value='$d1[0]'>$d1[0]</option>";
            }
    ?>
    </select>
    </div>

    <!-- Exam Type: -->
    <div class="selectBox">
    <label for="sExamType">Select Exam Type: </label>
    <select id="sExamType" name="sExamType" onchange="selectedExamType(this.value)" required>
        <option selected disabled>Select Exam Type:</option>
    </select>
    </div>

    <!-- Branch: -->
<div class="selectBox">
    <label for="sBranchType">Select Branch: </label>
    <select id="sBranchType" name="sBranchType" onchange="selectedBrachType(this.value)" required>
        <option selected disabled> Select Branch</option>
    </select>
</div>
    <!-- Semester -->
<div class="selectBox">
    <label for="sSemesterType">Select Semester: </label>
    <select id="sSemesterType" name="sSemesterType" onchange="selectedSemester(this.value)" required>
        <option selected disabled> Select Semester</option>
    </select>
</div>
    <!-- Subject -->
<div class="selectBox">
    <label for="sSubjectType">Select Subject: </label>
    <select id="sSubjectType" name="sSubjectType" onchange= ''>
        <option selected  >Select Subject</option>
    </select>
</div>
    <!-- For Graphing Pupropse Theory / Practical / Total -->
<div class="selectBox">
    <label for="sGradeGraph">Select Grade System: </label>
    <select id="sGradeGraph" name="sGradeGraph" onchange= ''>
        <option selected  disabled>Select Subject</option>
        
            <option value="theory">Theory Grade</option>
            <option value="practical">Practical Grade</option>
            <option value="final">Final Grade</option>
    
    </select>
</div>
    <!-- Pass / Fail: -->
<div class="selectBox">
    <label for="sPassFail">Select Status: </label>
    <select id="sPassFail" name="sPassFail" onchange= ''>
        <option selected value='%'>All</option>
        <option value= "PASS" >Pass</option>
        <option value= "FAIL" >Fail</option>
    </select>
</div>
    <!-- Spi: -->
    <div class="selectBox">
    <label for="sSpiType">Select Spi: </label>
    <select id="sSpiType" name="sSpiType" onchange= ''>
        <option selected value='%'>All</option>
        <option value= "<6" > < 6 </option>
        <option value= "BETWEEN 6 and 7" >6-7</option>
        <option value= "BETWEEN 7 and 8" >7-8</option>
        <option value= "BETWEEN 8 and 9" >8-9</option>
        <option value= "BETWEEN 9 and 10" >9-10</option>
    </select>
</div>
    <!-- Cpi: -->
<div class="selectBox">
    <label for="sCpiType">Select Cpi: </label>
    <select id="sCpiType" name="sCpiType" onchange= ''>
        <option selected value='%'>All</option>
        <option value= "<6" > < 6 </option>
        <option value= "BETWEEN 6 and 7" >6-7</option>
        <option value= "BETWEEN 7 and 8" >7-8</option>
        <option value= "BETWEEN 8 and 9" >8-9</option>
        <option value= "BETWEEN 9 and 10" >9-10</option>
    </select>
</div>
<div class="selectBoxSearch">
    <input type="submit" name="search" value="Search" class="btn wrn-btn col-lg-2 col-md-12 col-sm-12 searchBtn">
        </div>
    </form>
    </div>
    <hr>
    
    <script>
        
        // Exam Type DropDown:
        function selectedAcademicYear(year){
            const ajaxReq2 = new XMLHttpRequest();
            ajaxReq2.open("GET","http://localhost/mis_stage/getStudentDataAjax.php?year="+year+"&status=say",'TRUE');
            ajaxReq2.send();
            ajaxReq2.onreadystatechange = function(){
                if(ajaxReq2.readyState == 4 && ajaxReq2.status == 200){
                    document.getElementById("sExamType").innerHTML = ajaxReq2.responseText;
                }
            }
        }
        // Branch DropDown:
        function selectedExamType(examType){
            const ajaxReq2 = new XMLHttpRequest();
            ajaxReq2.open("GET","http://localhost/mis_stage/getStudentDataAjax.php?et="+examType+"&status=etype",'TRUE');
            ajaxReq2.send();
            ajaxReq2.onreadystatechange = function(){
                if(ajaxReq2.readyState == 4 && ajaxReq2.status == 200){
                    document.getElementById("sBranchType").innerHTML = ajaxReq2.responseText;
                }
            }
        }
        // Semester DropDown:
        function selectedBrachType(branchType){
            let examJS = document.getElementById("sExamType").value;
            // console.log(examJS);
            const ajaxReq2 = new XMLHttpRequest();
            ajaxReq2.open("GET","http://localhost/mis_stage/getStudentDataAjax.php?bt="+branchType+"&status=btype"+"&br="+examJS,'TRUE');
            ajaxReq2.send();
            ajaxReq2.onreadystatechange = function(){
                if(ajaxReq2.readyState == 4 && ajaxReq2.status == 200){
                    document.getElementById("sSemesterType").innerHTML = ajaxReq2.responseText;
                }
            }
        }
        // Subject DropDown:
        function selectedSemester(sem){
            let examJS2 = document.getElementById("sExamType").value;
            console.log(examJS2);
            let branchType = document.getElementById("sBranchType").value;

            const ajaxReq2 = new XMLHttpRequest();
            ajaxReq2.open("GET","http://localhost/mis_stage/getStudentDataAjax.php?sem="+sem+"&status=setype"+"&brType="+branchType+"&exType="+examJS2,'TRUE');
            ajaxReq2.send();
            ajaxReq2.onreadystatechange = function(){
                if(ajaxReq2.readyState == 4 && ajaxReq2.status == 200){
                    document.getElementById("sSubjectType").innerHTML = ajaxReq2.responseText;
                }
            }
        }

        // selectedSemester
    </script>
<?php
                                
function displayRecordOfRegular($conn,$acad,$exat,$branch,$sem,$PassFail,$sSpi,$sCpi,$subCodeFromSql,$SubjectName,$subCode){
    ?>
    <div class="startDisplay">

    <p> <strong> Acadamic Year: </strong> <?php echo $acad; ?></p>
    <p> <strong> Exam Type: </strong> <?php echo $exat; ?></p>
    <p> <strong> Branch: </strong> <?php echo $branch; ?></p>
    <p> <strong> Semester: </strong> <?php echo $sem; ?></p>
    <p> <strong> Subject: </strong> <?php echo $SubjectName; ?></p>
    <p> <strong> Grade System: </strong> <?php if(isset($_POST['sGradeGraph'])){echo $_POST['sGradeGraph'];}else{ echo "NA"; }  ?></p>
    <p> <strong> Status: </strong> <?php if($PassFail == '%') echo "All"; else echo $PassFail; ?></p>
    <!-- <p> <strong> Total Pass: </strong> <?php // global $passCount; echo $passCount; ?> </p>
    <p> <strong> Total Fail: </strong> <?php // global $failCount; echo $failCount; ?> </p> -->
    <p> <strong> Total Pass: </strong> <span class="spanRemPass"></span>
    <p> <strong> Total Fail: </strong> <span class="spanRemFail"></span>
    <p> <strong> Spi: </strong> <?php if($sSpi == '%') echo "All"; else echo $sSpi; ?></p>
    <p> <strong> Cpi: </strong> <?php if($sCpi == '%') echo "All"; else echo $sCpi; ?></p>
    </div>

    <?php
        global $subgreIndex,$subgrmIndex,$subgrthIndex,$subgrvIndex,$subgriIndex,$subgrprIndex,$subgrIndex,$subCount,$enCount,$nameCount,$resCount,$subCodeCount;
    ?>
    <br><br><br>
    <table id="example" class="row-border hover order-column stat-hover table-responsive stat table" style="width:100% !important; margin:auto; margin-bottom:20px; margin-top: -40px; border:1.5px solid #b0abab;">
    <thead class="text-center">
        <tr>
            <th style="font-size: 15px; text-align: center;">Enrollment No.</th>
            <th style="font-size: 15px; text-align: center;">Name</th>
            <th style="font-size: 15px; text-align: center;">Subject-Code</th>
            <th style="width: 20px; font-size: 15px; text-align: center;">TH-ESE</th>
            <th style="font-size: 15px; text-align: center;">TH-PA</th>
            <th style="font-size: 15px; text-align: center;">TH-Total</th>
            <th style="font-size: 15px; text-align: center;">PR-ESE</th>
            <th style="font-size: 15px; text-align: center;">PR-PA</th>
            <th style="font-size: 15px; text-align: center;">PR-Total</th>
            <th style="font-size: 15px; text-align: center;">Subject Grade</th>
            <th style="font-size: 15px; text-align: center;">Status</th>
        </tr>
    </thead>
    <tbody class="text-center">

    <?php
    // echo "Helo"; 
    ;
    // exit();
    if($sSpi == '%' && $sCpi == '%'){
        // echo "if";
        $query = "SELECT * from data WHERE $subCode = $subCodeFromSql AND AcademicYear = '$acad' AND exam = '$exat' AND BR_NAME = '$branch' AND sem = '$sem' AND RESULT LIKE '$PassFail'";
    }
    else if($sSpi == '%'){
        // echo "else if spi";
        $query = "SELECT * from data WHERE $subCode = $subCodeFromSql AND AcademicYear = '$acad' AND exam = '$exat' AND BR_NAME = '$branch' AND sem = '$sem' AND RESULT LIKE '$PassFail' AND CPI $sCpi ";
    }
    else if($sCpi == '%'){
        // echo "else if cpi";
        $query = "SELECT * from data WHERE $subCode = $subCodeFromSql AND AcademicYear = '$acad' AND exam = '$exat' AND BR_NAME = '$branch' AND sem = '$sem' AND RESULT LIKE '$PassFail' AND SPI $sSpi ";
    }
    else{
        // echo "else"; 
        $query = "SELECT * from data WHERE $subCode = $subCodeFromSql AND AcademicYear = '$acad' AND exam = '$exat' AND BR_NAME = '$branch' AND sem = '$sem' AND RESULT LIKE '$PassFail' AND SPI $sSpi AND CPI $sCpi";
        // $query = "SELECT * from data WHERE $subCode = '$subCodeFromSql' AND AcademicYear = '$acad' AND exam = '$exat' AND BR_NAME = '$branch' AND sem = '$sem' ";
    }
    $res = mysqli_query($conn,$query);
    // echo $query;
    // exit();
    // echo $query;
    // echo "<br>".$query ;
    global $finalGradeArray;
    $finalGradeArray = array();
    while ($data = mysqli_fetch_row($res)) {
        $total =  $data[$subCount];
        $col1 = $enCount;
        $col2 = $nameCount;
        $col3 = $subgreIndex;
        $col4 = $subgrmIndex;
        $col5 = $subgrthIndex;
        $col6 = $subgrvIndex;
        $col7 = $subgriIndex;
        $col8 = $subgrprIndex;
        $col9 = $subgrIndex;
        $col10 = $resCount;
        $subCodeCount11 = $subCodeCount;
        // echo $data[$subCodeCount11];
        // exit();

        
        $subCodeInt = substr($subCode, 3, 1);
        // echo $subCodeInt;

        // exit;

        // if( $columnArray[$subCodeCount] == $subCode){
        
        if($PassFail == 'FAIL'){
            for($i = 0; $i < $total; $i++){
                $i1 = $i;
                $i1+=1;
    
                if($i1 == $subCodeInt){
                    if($data[$col3 + $i] == 'FF'){

            ?>
            
            <tr>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;"><b>
                        <?php echo $data[$col1]; ?>
                    </b>
                </td>
                <td style="text-align: center !important; font-size: 12px; width: 18%; vertical-align: middle;">
                <?php  echo $data[$col2];?>
                </td>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                        <?php echo $subCodeFromSql; ?>
                </td>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                <?php echo $data[$col3 + $i]; ?>
    
                </td>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                <?php  echo $data[$col4 + $i];  ?>
    
                </td>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                <?php echo $data[$col5 + $i]; ?>
                    
                </td>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                <?php echo $data[$col6 + $i]; ?>
                    
                </td>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                <?php echo $data[$col7 + $i]; ?>

                </td>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                <?php echo $data[$col8 + $i]; ?>
                    
                </td>
                <td style="font-size: 12px; width: 9%; vertical-align: middle; text-align: center;">
                <?php  array_push($finalGradeArray,$data[$col9 + $i]) ; echo $data[$col9 + $i]; ?>
                    
                </td>
                <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                <?php 
                        if($data[$col9 + $i] == 'FF'){
                            echo "FAIL";
                        }else{
                            echo "PASS";   
                        }
        // echo $data[$col10]; ?>
                </td>
            </tr>
    <?php
        
        }
    }}
        }
        else{

        for($i = 0; $i < $total; $i++){
            $i1 = $i;
            $i1+=1;

            if($i1 == $subCodeInt){
                
        ?>
        
        <tr>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;"><b>
                    <?php echo $data[$col1]; ?>
                </b>
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 18%; vertical-align: middle;">
            <?php  echo $data[$col2];?>
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                    <?php echo $subCodeFromSql; ?>
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col3 + $i]; ?>

            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php  echo $data[$col4 + $i];  ?>

            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col5 + $i]; ?>
                
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col6 + $i]; ?>
                
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col7 + $i]; ?>
                
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col8 + $i]; ?>
                
            </td>
            <td style="font-size: 12px; width: 9%; vertical-align: middle; text-align: center;">
            <?php  array_push($finalGradeArray,$data[$col9 + $i]) ; echo $data[$col9 + $i]; ?>
                
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php 
                    if($data[$col9 + $i] == 'FF'){
                        echo "FAIL";
                    }else{
                        echo "PASS";   
                    }
    // echo $data[$col10]; ?>
            </td>
        </tr>
    <?php
    
    }
    }
        }
    }
    ?>           
    </tbody>
    </table>    
    <hr>
    <div class="btnDownload">
    <button id="csv" class="btn btn-info">Download Report</button>  
    </div>
    <?php
}



function displayRecordOfRemedial($conn,$acad,$exat,$branch,$sem,$PassFail,$sSpi,$sCpi,$subCode){
    ?>
    <div class="startDisplay">

    <p> <strong> Acadamic Year: </strong> <?php echo $acad; ?></p>
    <p> <strong> Exam Type: </strong> <?php echo $exat; ?></p>
    <p> <strong> Branch: </strong> <?php echo $branch; ?></p>
    <p> <strong> Semester: </strong> <?php echo $sem; ?></p>
    <p> <strong> Subject Code: </strong> <?php echo $subCode; ?></p>
    <p> <strong> Grade System: </strong> <?php if(isset($_POST['sGradeGraph'])){echo $_POST['sGradeGraph'];}else{ echo "NA"; }  ?></p>
    <p> <strong> Status: </strong> <?php if($PassFail == '%') echo "All"; else echo $PassFail; ?></p>
    <!-- <p> <strong> Total Pass: </strong> <?php //sleep(3); global $passCount;  echo $passCount;   ?> </p>
    <p> <strong> Total Fail: </strong> <?php // global $failCount; echo $failCount; ?> </p> -->
    <p> <strong> Total Pass: </strong> <span class="spanRemPass"></span>
    <p> <strong> Total Fail: </strong> <span class="spanRemFail"></span>
    <p> <strong> Spi: </strong> <?php if($sSpi == '%') echo "All"; else echo $sSpi; ?></p>
    <p> <strong> Cpi: </strong> <?php if($sCpi == '%') echo "All"; else echo $sCpi; ?></p>
    </div>

    <?php
   global $subgreIndex,$subgrmIndex,$subgrthIndex,$subgrvIndex,$subgriIndex,$subgrprIndex,$subgrIndex,$subCount,$enCount,$nameCount,$resCount,$subCodeCount,$subNameCount; 
?>
<br><br><br><br><br>
<table id="example" class="row-border hover order-column stat-hover table-responsive stat table" style="width:100% !important; margin:auto; margin-bottom:20px; margin-top: -40px; border:1.5px solid #b0abab;">
    <thead class="text-center">
        <tr>
            <th style="font-size: 15px; text-align: center;">Enrollment No.</th>
            <th style="font-size: 15px; text-align: center;">Name</th>
            <th style="font-size: 15px; text-align: center;">Subject-Code</th>
            <th style="width: 20px; font-size: 15px; text-align: center;">TH-ESE</th>
            <th style="font-size: 15px; text-align: center;">TH-PA</th>
            <th style="font-size: 15px; text-align: center;">TH-Total</th>
            <th style="font-size: 15px; text-align: center;">PR-ESE</th>
            <th style="font-size: 15px; text-align: center;">PR-PA</th>
            <th style="font-size: 15px; text-align: center;">PR-Total</th>
            <th style="font-size: 15px; text-align: center;">Subject Grade</th>
            <th style="font-size: 15px; text-align: center;">Status</th>
        </tr>
    </thead>
    <tbody class="text-center">
<?php
   $myqr = "SELECT * FROM DATA WHERE EXAM = '$exat' AND BR_NAME = '$branch'";

   $myqrexe = mysqli_query($conn,$myqr);
   global $finalGradeArray;
   $finalGradeArray = array();
   while ($data = mysqli_fetch_row($myqrexe)) {
    $total =  $data[$subCount];
    $col1 = $enCount;
    $col2 = $nameCount;
    $col3 = $subgreIndex;
    $col4 = $subgrmIndex;
    $col5 = $subgrthIndex;
    $col6 = $subgrvIndex;
    $col7 = $subgriIndex;
    $col8 = $subgrprIndex;
    $col9 = $subgrIndex;
    $col10 = $resCount;
    $col12 = $subNameCount;
    $subCodeCount11 = $subCodeCount;
   
    while($data[$col12] != ''){
        $dataSubCodeCount = (int)$data[$subCodeCount11];
        $userSubCode = (int)$subCode;
        if($userSubCode == $dataSubCodeCount){

        ?>
        
            <tr>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;"><b>
                    <?php echo $data[$col1]; ?>
                </b>
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 18%; vertical-align: middle;">
            <?php  echo $data[$col2];?>
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
                    <?php echo $data[$subCodeCount11]; ?>
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col3]; ?>

            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php  echo $data[$col4];  ?>

            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col5]; ?>
                
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col6]; ?>
                
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php echo $data[$col7]; ?>
                
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php //array_push($finalGradeArray,$data[$col8]); 
            echo $data[$col8]; ?>
                
            </td>
            <td style="font-size: 12px; width: 9%; vertical-align: middle; text-align: center;">
            <?php  array_push($finalGradeArray,$data[$col9]) ; 
            echo $data[$col9]; ?>
                
            </td>
            <td style="text-align: center !important; font-size: 12px; width: 9%; vertical-align: middle;">
            <?php 
                    if($data[$col9] == 'FF'){
                        echo "FAIL";
                    }else{
                        echo "PASS";   
                    }
            ?>
        </td>
    </tr>
<?php

}
else{
    // echo "else";
}
$col12++;
$subCodeCount11++;

}
}
?>           
</tbody>
</table>    
<hr>
    <div class="btnDownload">
    <button id="csv" class="btn btn-info">Download Report</button>  
    </div>
<?php
}

?>

<!-- Graph Function -->
<?php
function graphDrawn($conn,$acad,$exat,$branch,$sem,$PassFail,$sSpi,$sCpi,$subCodeFromSql,$SubjectName){
        // For Spi Graph:
        $query = "SELECT spi as spi from data WHERE AcademicYear = '$acad' AND exam = '$exat' AND BR_NAME = '$branch' AND sem = '$sem'";
        $exec = mysqli_query($conn,$query);
        if($exec){
            $i = 0;
            $l6 = 0;
            $g6l7 = 0;
            $g7l8 = 0;
            $g8l9 = 0;
            $g9l10 = 0;
            while ($raw = mysqli_fetch_array($exec)){
                $spi = $raw["spi"];
                // echo "<br>";
                // echo $i++ . " " . $spi;
                if($spi < 6 ){
                    $l6++;
                }
                if($spi >= 6 && $spi < 7){
                    $g6l7++;

                }
                else if($spi >= 7 && $spi < 8){
                    
                    $g7l8++;
                }
                else if($spi >= 8 && $spi < 9){
                    
                    $g8l9++;
                }
                else if($spi >= 9 && $spi <= 10){
                    
                    $g9l10++;
                }
            }
            
        }
        else{
            echo mysqli_error($conn);
        }


        // Bar chart for display the grade:
        if(isset($_POST['sGradeGraph'])){
            // echo "subject selected";
        $gradeType = $_POST['sGradeGraph'];
        if($gradeType == 'final'){
        // $subValue = $_POST['sSubjectType'];
        // $sub1 = substr($subValue, 0, -2);
        // $sub1 .= 'NA';
        // Conversion Finish And Stored In $sub1 -> SUB$NA;

        // Query To Get Name Of Subject:
        // $querySub = "SELECT $sub1 from data WHERE sem = $sem AND BR_NAME = '$branch' LIMIT 1";
        // $req = mysqli_query($conn,$querySub);
        // while($raw = mysqli_fetch_array($req)){
        //     $SubjectName =  $raw[$sub1];
        // }

        // $query = "select * from data where sem = $sem";
        // $result = mysqli_query($conn, $query);
        
        // $query = "SELECT $subValue from data where sem = $sem AND BR_NAME = '$branch'";
        // $result = mysqli_query($conn, $query);

        // if($result){
        //     $AA = 0;
        //     $AB = 0;
        //     $BB = 0;
        //     $BC = 0;
        //     $CC = 0;
        //     $CD = 0;
        //     $DD = 0;
        //     $FF = 0;
        //     $PS = 0;
        // while($raw = mysqli_fetch_array($result)){
        //         $grade = $raw[$subValue];
        //         if($grade == 'AA' ){
        //             $AA++;
        //         }
        //         else if($grade == 'AB'){
        //             $AB++;

        //         }
        //         else if($grade == 'BB'){
        //             $BB++;
        //         }
        //         else if($grade == 'BC'){
                    
        //             $BC++;
        //         }
        //         else if($grade == 'CC'){
        //             $CC++;
        //         }
        //         else if($grade == 'CD'){
        //             $CD++;
        //         }
        //         else if($grade == 'DD'){
        //             $CD++;
        //         }
        //         else if($grade == 'FF'){
        //             $FF++;
        //         }
        //         else if($grade == 'PS'){
        //             $PS++;
        //         }
        //         else{

        //         }
        //     }
        // }
        // else{
        //     echo mysqli_error($conn);
        // }

        global $finalGradeArray;
        $AA = 0;
        $AB = 0;
        $BB = 0;
        $BC = 0;
        $CC = 0;
        $CD = 0;
        $DD = 0;
        $FF = 0;
        $PS = 0;
        foreach($finalGradeArray as $grade){
            if($grade == 'AA'){
                $AA++;
            }
            else if($grade == 'AB'){
                $AB++;
            }
            else if($grade == 'BB'){
                $BB++;
            }
            else if($grade == 'BC'){
                
                $BC++;
            }
            else if($grade == 'CC'){
                $CC++;
            }
            else if($grade == 'CD'){
                $CD++;
            }
            else if($grade == 'DD'){
                $CD++;
            }
            else if($grade == 'FF'){
                $FF++;
            }
            else if($grade == 'PS'){
                $PS++;
            }
            else{

            }
        }

        }
    }
    else{
        // echo "No subject selected";
    }


    global $finalGradeArray;
    // Pie Chart:
    $failCount = 0;
    $passCount = 0;

    foreach ($finalGradeArray as $var) {
        // echo $var . "<br>";
        if($var == 'FF'){
            $failCount++;
        }else{
            $passCount++;   
        }
    }
        //  Complete Graph
        // }

    // }else{
    //         // echo "Enter Proper Values";
    // }
    ?>
    <script>
        var passCt = <?php echo $passCount; ?>;
        var failCt = <?php echo $failCount; ?>;
        document.getElementsByClassName("spanRemPass")[0].innerText = passCt;
        document.getElementsByClassName("spanRemFail")[0].innerText = failCt;
    </script>

    
    <script>

    //  console.log("TimeoutFunction");

        google.charts.load('current', {'packages':['corechart','bar']});
        google.charts.setOnLoadCallback(drawAllChart);

        function drawAllChart(){
            console.log("main function");
            <?php if($PassFail == '%') {?>
            drawPieChart1();
        <?php  } ?>
        <?php if(isset($sSpi)){ ?>
            drawChart2();
            <?php  } ?>
            <?php if(isset($_POST['sGradeGraph'])){ ?>
            drawChart3();
            <?php } ?>
        }    


    // Pie Chart: Pass/Fail
    <?php if($PassFail == '%') {?>
    function drawPieChart1(){
        

        console.log("function1");
        // var pie = google.visualization.arrayToDataTable([
        //     ['RESULT','Status'],
        //     <?php// while($que = mysqli_fetch_assoc($execpfQuery)){ ?>
        //     ['<?php //echo $que['RESULT']; ?>',<?php //echo $que['pass_fail_count']; ?>],
        //     <?php// } ?>
        // ]);
        
        var pie = google.visualization.arrayToDataTable([
            ['RESULT','Status'],
            ['Pass',<?php echo $passCount; ?>],
            ['Fail',<?php echo $failCount; ?>]
        ]);
        var header = {
            'title' : 'Pass/Fail Ratio:',
            
            'slices': {0:{color: "<?php echo '#'.rand(100000,999999).''; ?>"},1:{color: "<?php echo '#'.rand(100000,999999).'';?>"}}
        };
        var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
        chart.draw(pie, header);
    }
    <?php } ?>
    // Bar Graph : Spi Performance:
    <?php if(isset($sSpi)){ ?>
    function drawChart2() {
        console.log("function2");
            var data = google.visualization.arrayToDataTable([
            ['Spi', 'Students'],
                    ['less than 6',<?php echo $l6; ?>],
                    ['6-7',<?php echo $g6l7; ?>],
                    ['7-8',<?php echo $g7l8; ?>],
                    ['8-9',<?php echo $g8l9; ?>],
                    ['9-10',<?php echo $g9l10; ?>],
                
            ]);

            var options = {
            chart: {
                title: 'Student Performance Based On SPI',
                
            },
            bars: 'vertical', // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_Spi'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    <?php  } ?>
    //   Bar Graph For Final Grade :
    <?php if(isset($_POST['sGradeGraph'])){ ?>
    function drawChart3() {
        console.log("function3");
            var data = google.visualization.arrayToDataTable([
            ['Grade', 'Students'],
                    ['AA',<?php echo $AA; ?>],
                    ['AB',<?php echo $AB; ?>],
                    ['BB',<?php echo $BB; ?>],
                    ['BC',<?php echo $BC; ?>],
                    ['CC',<?php echo $CC; ?>],
                    ['CD',<?php echo $CD; ?>],
                    ['DD',<?php echo $DD; ?>],
                    ['FF',<?php echo $FF; ?>],
                    ['PS',<?php echo $PS; ?>],
            ]);

            var options = {
            chart: {
                title: 'Student Performance Based On Final Grade:',
                
            },
            bars: 'vertical' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_Grade'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    <?php } ?>

    </script>
    <?php if(isset($_POST['search'])){ 
        if(isset($_POST['sAcademic']) && isset($_POST['sExamType']) && isset($_POST['sBranchType']) && isset($_POST['sSemesterType']) && isset($_POST['sSubjectType'])){
    ?>

        <div class="graph">
            <h2>Graphical Representation:</h2>
            <hr>
            <?php if($PassFail == '%') {?>
        <div id="pieChart" style= "border: 1px dotted black; width: 850px; height: 400px; margin: 10px 0px; padding: 5px 10px;"></div>
    <?php } ?>
        <!-- <hr> -->
        <?php if(isset($sSpi)){ ?>
        <div id="barchart_Spi" style= "border: 1px dotted black; width: 850px; height: 400px; margin: 10px 0px; padding: 5px 10px;"></div>
    <?php } ?>
        <!-- <hr> -->
        <?php if(isset($_POST['sGradeGraph'])){ ?>
        <div id="barchart_Grade" style= "border: 1px dotted black; width: 850px; height: 400px; margin: 10px 0px; padding: 5px 10px;"></div>
        <?php } ?>
        </div>
        </div>
    <?php
    }}
}
?>





<?php
    if(isset($_POST['search'])){
        if(isset($_POST['sAcademic']) && isset($_POST['sExamType']) && isset($_POST['sBranchType']) && isset($_POST['sSemesterType']) && isset($_POST['sSubjectType'])){
            $acad = $_POST['sAcademic'];
            $exat = $_POST['sExamType'];
            $branch = $_POST['sBranchType'];
            $sem = $_POST['sSemesterType'];
            $PassFail = $_POST['sPassFail'];
            $sSpi = $_POST['sSpiType'];
            $sCpi = $_POST['sCpiType'];


            // Get Column Names:---------------------------------------------
            $query = "SHOW COLUMNS FROM data";
            $result = mysqli_query($conn,$query);

            $columnArray = array();

            while ($data = mysqli_fetch_array($result)) {
            // echo "<pre>";
            // print_r($data['COLUMN_NAME']);
            array_push($columnArray,$data['Field']);
            }

            $arraySize = sizeof($columnArray);
            // echo $arraySize;
            global $subgreIndex,$subgrmIndex,$subgrthIndex,$subgrvIndex,$subgriIndex,$subgrprIndex,$subgrIndex,$subCount,$enCount,$nameCount,$resCount,$subCodeCount,$subNameCount;
            $i = 0;
            while($i < $arraySize){    
                if($columnArray[$i] == 'SUB1GRE'){
                    $subgreIndex = $i;
                }
                if($columnArray[$i] == 'SUB1GRM'){
                    $subgrmIndex = $i;
                }
                if($columnArray[$i] == 'SUB1GRTH'){
                    $subgrthIndex = $i;
                }
                if($columnArray[$i] == 'SUB1GRV'){
                    $subgrvIndex = $i;
                }
                if($columnArray[$i] == 'SUB1GRI'){
                    $subgriIndex = $i;
                }
                if($columnArray[$i] == 'SUB1GRPR'){
                    $subgrprIndex = $i;
                }
                if($columnArray[$i] == 'SUB1GR'){
                    $subgrIndex = $i;
                }
                if($columnArray[$i] == 'TOTSUBCOUNT'){
                    $subCount = $i;
                }
                if($columnArray[$i] == 'MAP_NUMBER'){
                    $enCount = $i;
                }
                if($columnArray[$i] == 'name'){
                    $nameCount = $i;
                }
                if($columnArray[$i] == 'RESULT'){
                    $resCount = $i;
                }
                if($columnArray[$i] == 'SUB1'){
                    $subCodeCount = $i;
                }
                if($columnArray[$i] == 'SUB1NA'){
                    $subNameCount = $i;
                }
                $i++;
            }
            // Column names: completed :----------------------------------------------


            if(strpos($exat, "Remedial") !== false){
                $subCode = $_POST['sSubjectType'];
                // echo $subCode . "<br>";
                $subCodeFromSql = $subCode;
                displayRecordOfRemedial($conn,$acad,$exat,$branch,$sem,$PassFail,$sSpi,$sCpi,$subCode);
                graphDrawn($conn,$acad,$exat,$branch,$sem,$PassFail,$sSpi,$sCpi,$subCodeFromSql,$subCode);
                
            }
            else{
                $sub = $_POST['sSubjectType'];
                // Convert SUB$GR TO SUB$NA:
                $subCode = substr($sub, 0, -2);
                $sub1 = substr($sub, 0, -2);
                $sub1 .= 'NA';
                $subCodeQuery = "SELECT $subCode from data WHERE AcademicYear = '$acad' AND exam = '$exat' AND BR_NAME = '$branch' AND sem = '$sem' LIMIT 1";
                $subCodeQueryExec = mysqli_query($conn,$subCodeQuery);
                while($data = mysqli_fetch_array($subCodeQueryExec)){
                    $subCodeFromSql = $data[$subCode];        
                }
                // Conversion Finish And Stored In $sub1 -> SUB$NA;
                // Query To Get Name Of Subject:
                $querySub = "SELECT $sub1 from data WHERE AcademicYear = '$acad' AND exam = '$exat' AND BR_NAME = '$branch' AND sem = '$sem' LIMIT 1";
                $req = mysqli_query($conn,$querySub);
                while($raw = mysqli_fetch_array($req)){
                    $SubjectName =  $raw[$sub1];
                }
                displayRecordOfRegular($conn,$acad,$exat,$branch,$sem,$PassFail,$sSpi,$sCpi,$subCodeFromSql,$SubjectName,$subCode);
                graphDrawn($conn,$acad,$exat,$branch,$sem,$PassFail,$sSpi,$sCpi,$subCodeFromSql,$SubjectName);
            }
        }
    }
            ?>
   
<!-- End -->

<!-- <footer class="myFooter">
    <h5 class="">@Developed by <b>Computer Department</b></h5>
</footer>
 -->


<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script> -->

<script>
  $('#csv').on('click',function(){
    $("#example").tableHTMLExport({type:'csv',filename:'student_report.csv'});
  })
  $('#pd').on('click',function(){
    $("#example").tableHTMLExport({type:'pdf',filename:'sample.pdf',orientation: 'p'});
  })
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
  <script src="src/tableHTMLExport.js"></script>
</body>
</html>
