<?php
    include "connection2.php";
?>


<?php 
if(empty($_POST['branch']) || empty($_POST['sem']) || empty($_POST['subject']) ){
    echo " Note: Please Select Branch, Semester, Subject: ";
}
else{
    // echo "Hello";
if(isset($_POST['search'])){
    $sem = $_POST['sem'];
    $branchCheck = $_POST['branch']; 
    $subValue = $_POST['subject'];

    // Convert SUB$GR TO SUB$NA:
    $sub1 = substr($subValue, 0, -2);
    $sub1 .= 'NA';
    // Conversion Finish And Stored In $sub1 -> SUB$NA;

    // Query To Get Name Of Subject:
    $querySub = "SELECT $sub1 from data WHERE sem = $sem AND BR_NAME = '$branchCheck' LIMIT 1";
    $req = mysqli_query($conn,$querySub);
    while($raw = mysqli_fetch_array($req)){
        $SubjectName =  $raw[$sub1];
    }

    // $query = "select * from data where sem = $sem";
    // $result = mysqli_query($conn, $query);
    
    $query = "SELECT $subValue from data where sem = $sem AND BR_NAME = '$branchCheck'";
    $result = mysqli_query($conn, $query);
    if($result){
        $AA = 0;
        $AB = 0;
        $BB = 0;
        $BC = 0;
        $CC = 0;
        $CD = 0;
        $DD = 0;
        $FF = 0;
        $PS = 0;
    while($raw = mysqli_fetch_array($result)){
            $grade = $raw[$subValue];
            if($grade == 'AA' ){
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
    else{
        echo mysqli_error($conn);
    }
    // echo $val;

}else{
    // echo "Search : Error";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>Subject Analysis Using Php - Ajax</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <label for="branch">Select Branch: </label>
            <select id="branch" name="branch" onchange="selectedBranch(this.value)">
                <option selected disabled> Select Branch</option>
                <?php 
                    $exam_query = "Select BR_NAME from data group by BR_NAME";
                    $r = mysqli_query($conn, $exam_query);
                        while($d1 = mysqli_fetch_row($r)) {
                            echo "<option value='$d1[0]'>$d1[0]</option>";
                        }
                ?>
            </select>

            <label for="sem">Select Semester: </label>
            <select id="sem" name="sem" onchange="selectedSem(this.value)" >
            <option selected disabled>Select Semester</option>
                <?php 
                    // $exam_query = "Select sem from data group by sem";
                    // $r = mysqli_query($conn, $exam_query);
                    //     while($d1 = mysqli_fetch_row($r)) {
                    //         echo "<option value='$d1[0]'>$d1[0]</option>";
                    //     }
                ?>
            </select>

            <label for="subject">Select Subject: </label>
            <select id="subject" name="subject" onchange= 'selectedSubject(this)'>
                <option selected  >Select Subject</option>
            </select>
            <input type="submit" name="search" value="Search" class="btn wrn-btn col-lg-2 col-md-12 col-sm-12">
            <input type="submit" class="btn btn-outline-dark" name="reset_btn" value="Reset" >
            <!-- <button type="reset" value="Reset">Reset</button> -->
            <input type="hidden" name="brName" id="brName">
</form>
<?php  

if(isset($_POST['search'])){
?>
    <br><br><br>
    <div id="barchart_material" style="width: 900px; height: 500px; display: block; margin: auto; "></div>
    <?php
}
?>
</body>
<?php
if(isset($_POST['Reset'])){
    header("Refresh:0");
}
    
?>
<script>
    function selectedBranch(branch){
        // alert(branch);
        
        const ajaxReq2 = new XMLHttpRequest();
        ajaxReq2.open("GET","http://localhost/STS-master/getSubjectData.php?br="+branch+"&status=true" ,'TRUE');
        ajaxReq2.send();
        ajaxReq2.onreadystatechange = function(){
            if(ajaxReq2.readyState == 4 && ajaxReq2.status == 200){
                document.getElementById("sem").innerHTML = ajaxReq2.responseText;
            }
        }
        document.getElementById("brName").value = branch;
        
    }
    
    function selectedSem(sem){
        let brName = document.getElementById("brName").value;
        console.log(brName);
        // document.getElementById('sem').value = ;
        // alert(sem);
        const ajaxReq = new XMLHttpRequest();
        ajaxReq.open("GET","http://localhost/STS-master/getSubjectData.php?sem="+sem+"&br="+brName+"&status=false",'TRUE');
        ajaxReq.send();
        ajaxReq.onreadystatechange = function(){
            if(ajaxReq.readyState == 4 && ajaxReq.status == 200){
                document.getElementById("subject").innerHTML = ajaxReq.responseText;
            }
            
        }
    }
    
    function selectedSubject(e){
        console.log(e);
    }
</script>

<!-- <script>
        
        // console.log(document.getElementById('subject').label);
    function selectedSub(sub){
        let select = document.getElementById('subject');    
        for(var i = 0;i < select.labels.length; i++){
            console.log(select.labels[i].textContent);
        }
        // console.log(sub);
    }
</script> -->
    

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
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
            subtitle: 'Branch: <?php echo $branchCheck;?> || Semester: <?php echo $sem;?> || Subject: <?php echo $SubjectName; ?>',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
</script>



</html>