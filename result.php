<?php
error_reporting(0);
session_id("session1");
session_start();

include 'connection2.php';

$page = "'#advanature_details";


if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);
	
	$query="select * from faculty where (username = '$username' AND password = '$password')";		
	// echo $query;
    $login_check=mysqli_query($conn,$query);
	$data = mysqli_fetch_array($login_check);
	$check = mysqli_num_rows($login_check);
	if($check==1)
	{
		setcookie("result", $data['username'], time() + (86400 * 30 * 30), "/");		
		$_COOKIE["result"] = $data['username'];		
		session_id("session1");
		session_start();
		$_SESSION[$_COOKIE["result"]]=$_COOKIE["result"];
		session_write_close();
        $page = "'#login";
		echo "<script>alert('Login Successful');</script>";
	}else
	{
		$page = "'#login";
		echo "<script>alert('Data entered is incorrect');</script>";
	}
}

if(isset($_POST["submit"]))
{
 /*if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
    $count = 1;  
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
       if($count!=1)
       {
           $query = "INSERT INTO data(St_Id, extype, examid, exam, DECLARATIONDATE, AcademicYear, sem, MAP_NUMBER, UNIT_NO, EXAMNUMBER, name, instcode, instName, CourseName, BR_CODE, BR_NAME, SUB1, SUB2, SUB3, SUB4, SUB5, SUB6, SUB7, SUB8, SUB9, SUB10, SUB11, SUB12, SUB13, SUB14, SUB15, SUB1NA, SUB2NA, SUB3NA, SUB4NA, SUB5NA, SUB6NA, SUB7NA, SUB8NA, SUB9NA, SUB10NA, SUB11NA, SUB12NA, SUB13NA, SUB14NA, SUB15NA, SUB1CR, SUB2CR, SUB3CR, SUB4CR, SUB5CR, SUB6CR, SUB7CR, SUB8CR, SUB9CR, SUB10CR, SUB11CR, SUB12CR, SUB13CR, SUB14CR, SUB15CR, SUB1GR, SUB2GR, SUB3GR, SUB4GR, SUB5GR, SUB6GR, SUB7GR, SUB8GR, SUB9GR, SUB10GR, SUB11GR, SUB12GR, SUB13GR, SUB14GR, SUB15GR, SUB1AB, SUB2AB, SUB3AB, SUB4AB, SUB5AB, SUB6AB, SUB7AB, SUB8AB, SUB9AB, SUB10AB, SUB11AB, SUB12AB, SUB13AB, SUB14AB, SUB15AB, SUB1B, SUB2B, SUB3B, SUB4B, SUB5B, SUB6B, SUB7B, SUB8B, SUB9B, SUB10B, SUB11B, SUB12B, SUB13B, SUB14B, SUB15B, SUB1GRI, SUB2GRI, SUB3GRI, SUB4GRI, SUB5GRI, SUB6GRI, SUB7GRI, SUB8GRI, SUB9GRI, SUB10GRI, SUB11GRI, SUB12GRI, SUB13GRI, SUB14GRI, SUB15GRI, SUB1GRTH, SUB2GRTH, SUB3GRTH, SUB4GRTH, SUB5GRTH, SUB6GRTH, SUB7GRTH, SUB8GRTH, SUB9GRTH, SUB10GRTH, SUB1GRE, SUB2GRE, SUB3GRE, SUB4GRE, SUB5GRE, SUB6GRE, SUB7GRE, SUB8GRE, SUB9GRE, SUB10GRE, SUB1GRM, SUB2GRM, SUB3GRM, SUB4GRM, SUB5GRM, SUB6GRM, SUB7GRM, SUB8GRM, SUB9GRM, SUB10GRM, SUB1GRPR, SUB2GRPR, SUB3GRPR, SUB4GRPR, SUB5GRPR, SUB6GRPR, SUB7GRPR, SUB8GRPR, SUB9GRPR, SUB10GRPR, SUB1GRV, SUB2GRV, SUB3GRV, SUB4GRV, SUB5GRV, SUB6GRV, SUB7GRV, SUB8GRV, SUB9GRV, SUB10GRV, BCK1, BCK2, BCK3, BCK4, BCK5, BCK6, BCK7, BCK8, BCK9, BCK10, BCK11, TOTBACKL, CURBACKL, SPI_TOTCR, SPI_ERTOTCR, SPI, CPI_TOTCR, CPI_ERTOTCR, CPI, CGPA_TOTCR, CGPA_ERTOTCR, CGPA, TRIAL, RESULT, UFM, less50Perc, TOTSUBCOUNT, ACPC_CPI, TOTBCKEXAMID, REMARK, CreatedDate, Modifydate, CreatedBy, ModifyBy, STPI1_CR, STPI1_ERCR, STPI1, STPI2_CR, STPI2_ERCR, STPI2, ACPC_CR, ACPC_ERCR, IsNewFormat, REG, IscmsExport, SUB11GRTH, SUB12GRTH, SUB11GRE, SUB11GRM, SUB12GRM, SUB11GRPR, SUB12GRPR, SUB11GRV, SUB12GRV, SUB12GRE, SUB13GRTH, SUB14GRTH, SUB15GRTH, SUB13GRE, SUB14GRE, SUB15GRE, SUB13GRM, SUB14GRM, SUB15GRM, SUB13GRPR, SUB14GRPR, SUB15GRPR, SUB13GRV, SUB14GRV, SUB15GRV, SentToPrint, hp_cur_totcr, hp_ctotcr, Date_100Pt) VALUES ('". $data[0]."', '". $data[1]."', '". $data[2]."', '". $data[3]."', '". $data[4]."', '". $data[5]."', '". $data[6]."', '". $data[7]."', '". $data[8]."', '". $data[9]."', '". $data[10]."', '". $data[11]."', '". $data[12]."', '". $data[13]."', '". $data[14]."', '". $data[15]."', '". $data[16]."', '". $data[17]."', '". $data[18]."', '". $data[19]."', '". $data[20]."', '". $data[21]."', '". $data[22]."', '". $data[23]."', '". $data[24]."', '". $data[25]."', '". $data[26]."', '". $data[27]."', '". $data[28]."', '". $data[29]."', '". $data[30]."', '". $data[31]."', '". $data[32]."', '". $data[33]."', '". $data[34]."', '". $data[35]."', '". $data[36]."', '". $data[37]."', '". $data[38]."', '". $data[39]."', '". $data[40]."', '". $data[41]."', '". $data[42]."', '". $data[43]."', '". $data[44]."', '". $data[45]."', '". $data[46]."', '". $data[47]."', '". $data[48]."', '". $data[49]."', '". $data[50]."', '". $data[51]."', '". $data[52]."', '". $data[53]."', '". $data[54]."', '". $data[55]."', '". $data[56]."', '". $data[57]."', '". $data[58]."', '". $data[59]."', '". $data[60]."', '". $data[61]."', '". $data[62]."', '". $data[63]."', '". $data[64]."', '". $data[65]."', '". $data[66]."', '". $data[67]."', '". $data[68]."', '". $data[69]."', '". $data[70]."', '". $data[71]."', '". $data[72]."', '". $data[73]."', '". $data[74]."', '". $data[75]."', '". $data[76]."', '". $data[77]."', '". $data[78]."', '". $data[79]."', '". $data[80]."', '". $data[81]."', '". $data[82]."', '". $data[83]."', '". $data[84]."', '". $data[85]."', '". $data[86]."', '". $data[87]."', '". $data[88]."', '". $data[89]."', '". $data[90]."', '". $data[91]."', '". $data[92]."', '". $data[93]."', '". $data[94]."', '". $data[95]."', '". $data[96]."', '". $data[97]."', '". $data[98]."', '". $data[99]."', '". $data[100]."', '". $data[101]."', '". $data[102]."', '". $data[103]."', '". $data[104]."', '". $data[105]."', '". $data[106]."', '". $data[107]."', '". $data[108]."', '". $data[109]."', '". $data[110]."', '". $data[111]."', '". $data[112]."', '". $data[113]."', '". $data[114]."', '". $data[115]."', '". $data[116]."', '". $data[117]."', '". $data[118]."', '". $data[119]."', '". $data[120]."', '". $data[121]."', '". $data[122]."', '". $data[123]."', '". $data[124]."', '". $data[125]."', '". $data[126]."', '". $data[127]."', '". $data[128]."', '". $data[129]."', '". $data[130]."', '". $data[131]."', '". $data[132]."', '". $data[133]."', '". $data[134]."', '". $data[135]."', '". $data[136]."', '". $data[137]."', '". $data[138]."', '". $data[139]."', '". $data[140]."', '". $data[141]."', '". $data[142]."', '". $data[143]."', '". $data[144]."', '". $data[145]."', '". $data[146]."', '". $data[147]."', '". $data[148]."', '". $data[149]."', '". $data[150]."', '". $data[151]."', '". $data[152]."', '". $data[153]."', '". $data[154]."', '". $data[155]."', '". $data[156]."', '". $data[157]."', '". $data[158]."', '". $data[159]."', '". $data[160]."', '". $data[161]."', '". $data[162]."', '". $data[163]."', '". $data[164]."', '". $data[165]."', '". $data[166]."', '". $data[167]."', '". $data[168]."', '". $data[169]."', '". $data[170]."', '". $data[171]."', '". $data[172]."', '". $data[173]."', '". $data[174]."', '". $data[175]."', '". $data[176]."', '". $data[177]."', '". $data[178]."', '". $data[179]."', '". $data[180]."', '". $data[181]."', '". $data[182]."', '". $data[183]."', '". $data[184]."', '". $data[185]."', '". $data[186]."', '". $data[187]."', '". $data[188]."', '". $data[189]."', '". $data[190]."', '". $data[191]."', '". $data[192]."', '". $data[193]."', '". $data[194]."', '". $data[195]."', '". $data[196]."', '". $data[197]."', '". $data[198]."', '". $data[199]."', '". $data[200]."', '". $data[201]."', '". $data[202]."', '". $data[203]."', '". $data[204]."', '". $data[205]."', '". $data[206]."', '". $data[207]."', '". $data[208]."', '". $data[209]."', '". $data[210]."', '". $data[211]."', '". $data[212]."', '". $data[213]."', '". $data[214]."', '". $data[215]."', '". $data[216]."', '". $data[217]."', '". $data[218]."', '". $data[219]."', '". $data[220]."', '". $data[221]."', '". $data[222]."', '". $data[223]."', '". $data[224]."', '". $data[225]."', '". $data[226]."', '". $data[227]."', '". $data[228]."', '". $data[229]."', '". $data[230]."', '". $data[231]."', '". $data[232]."', '". $data[233]."', '". $data[234]."', '". $data[235]."', '". $data[236]."', '". $data[237]."', '". $data[238]."', '". $data[239]."', '". $data[240]."', '". $data[241]."', '". $data[242]."', '". $data[243]."', '". $data[244]."')";    
           mysqli_query($conn, $query);       
       }
        $count++;
    }      
   fclose($handle);
   $page = "'#login";
   echo "<script>alert('Upload done');</script>";
  }else
  {
    echo "<script>alert('Error Occured');</script>";
  }
 }*/
    $file=$_FILES['file']['tmp_name'];
    
    $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    if($ext=='xls'){
        require('PHPExcel/PHPExcel.php');
        require('PHPExcel/PHPExcel/IOFactory.php');
                
        $obj=PHPExcel_IOFactory::load($file);                
        foreach($obj->getWorksheetIterator() as $sheet){
            $getHighestRow=$sheet->getHighestRow();

            for($i=0;$i<=$getHighestRow;$i++){                
                if($i!=0)
                {   
                    $data[0] = $sheet->getCellByColumnAndRow(0,$i)->getValue();
                    $data[1] = $sheet->getCellByColumnAndRow(1,$i)->getValue();
                    $data[2] = $sheet->getCellByColumnAndRow(2,$i)->getValue();
                    $data[3] = $sheet->getCellByColumnAndRow(3,$i)->getValue();
                    $data[4] = $sheet->getCellByColumnAndRow(4,$i)->getValue();
                    $data[5] = $sheet->getCellByColumnAndRow(5,$i)->getValue();
                    $data[6] = $sheet->getCellByColumnAndRow(6,$i)->getValue();             
                    $data[7] = $sheet->getCellByColumnAndRow(7,$i)->getValue();
                    $data[8] = $sheet->getCellByColumnAndRow(8,$i)->getValue();
                    $data[9] = $sheet->getCellByColumnAndRow(9,$i)->getValue();
                    $data[10] = $sheet->getCellByColumnAndRow(10,$i)->getValue();
                    $data[11] = $sheet->getCellByColumnAndRow(11,$i)->getValue();
                    $data[12] = $sheet->getCellByColumnAndRow(12,$i)->getValue();
                    $data[13] = $sheet->getCellByColumnAndRow(13,$i)->getValue();
                    $data[14] = $sheet->getCellByColumnAndRow(14,$i)->getValue();
                    $data[15] = $sheet->getCellByColumnAndRow(15,$i)->getValue();
                    $data[16] = $sheet->getCellByColumnAndRow(16,$i)->getValue();
                    $data[17] = $sheet->getCellByColumnAndRow(17,$i)->getValue();
                    $data[18] = $sheet->getCellByColumnAndRow(18,$i)->getValue();
                    $data[19] = $sheet->getCellByColumnAndRow(19,$i)->getValue();
                    $data[20] = $sheet->getCellByColumnAndRow(20,$i)->getValue();
                    $data[21] = $sheet->getCellByColumnAndRow(21,$i)->getValue();
                    $data[22] = $sheet->getCellByColumnAndRow(22,$i)->getValue();
                    $data[23] = $sheet->getCellByColumnAndRow(23,$i)->getValue();
                    $data[24] = $sheet->getCellByColumnAndRow(24,$i)->getValue();
                    $data[25] = $sheet->getCellByColumnAndRow(25,$i)->getValue();
                    $data[26] = $sheet->getCellByColumnAndRow(26,$i)->getValue();
                    $data[27] = $sheet->getCellByColumnAndRow(27,$i)->getValue();
                    $data[28] = $sheet->getCellByColumnAndRow(28,$i)->getValue();
                    $data[29] = $sheet->getCellByColumnAndRow(29,$i)->getValue();
                    $data[30] = $sheet->getCellByColumnAndRow(30,$i)->getValue();
                    $data[31] = $sheet->getCellByColumnAndRow(31,$i)->getValue();
                    $data[32] = $sheet->getCellByColumnAndRow(32,$i)->getValue();
                    $data[33] = $sheet->getCellByColumnAndRow(33,$i)->getValue();
                    $data[34] = $sheet->getCellByColumnAndRow(34,$i)->getValue();
                    $data[35] = $sheet->getCellByColumnAndRow(35,$i)->getValue();
                    $data[36] = $sheet->getCellByColumnAndRow(36,$i)->getValue();
                    $data[37] = $sheet->getCellByColumnAndRow(37,$i)->getValue();
                    $data[38] = $sheet->getCellByColumnAndRow(38,$i)->getValue();
                    $data[39] = $sheet->getCellByColumnAndRow(39,$i)->getValue();
                    $data[40] = $sheet->getCellByColumnAndRow(40,$i)->getValue();
                    $data[41] = $sheet->getCellByColumnAndRow(41,$i)->getValue();
                    $data[42] = $sheet->getCellByColumnAndRow(42,$i)->getValue();
                    $data[43] = $sheet->getCellByColumnAndRow(43,$i)->getValue();
                    $data[44] = $sheet->getCellByColumnAndRow(44,$i)->getValue();
                    $data[45] = $sheet->getCellByColumnAndRow(45,$i)->getValue();
                    $data[46] = $sheet->getCellByColumnAndRow(46,$i)->getValue();
                    $data[47] = $sheet->getCellByColumnAndRow(47,$i)->getValue();
                    $data[48] = $sheet->getCellByColumnAndRow(48,$i)->getValue();
                    $data[49] = $sheet->getCellByColumnAndRow(49,$i)->getValue();
                    $data[50] = $sheet->getCellByColumnAndRow(50,$i)->getValue();
                    $data[51] = $sheet->getCellByColumnAndRow(51,$i)->getValue();
                    $data[52] = $sheet->getCellByColumnAndRow(52,$i)->getValue();
                    $data[53] = $sheet->getCellByColumnAndRow(53,$i)->getValue();
                    $data[54] = $sheet->getCellByColumnAndRow(54,$i)->getValue();
                    $data[55] = $sheet->getCellByColumnAndRow(55,$i)->getValue();
                    $data[56] = $sheet->getCellByColumnAndRow(56,$i)->getValue();
                    $data[57] = $sheet->getCellByColumnAndRow(57,$i)->getValue();
                    $data[58] = $sheet->getCellByColumnAndRow(58,$i)->getValue();
                    $data[59] = $sheet->getCellByColumnAndRow(59,$i)->getValue();
                    $data[60] = $sheet->getCellByColumnAndRow(60,$i)->getValue();
                    $data[61] = $sheet->getCellByColumnAndRow(61,$i)->getValue();
                    $data[62] = $sheet->getCellByColumnAndRow(62,$i)->getValue();
                    $data[63] = $sheet->getCellByColumnAndRow(63,$i)->getValue();
                    $data[64] = $sheet->getCellByColumnAndRow(64,$i)->getValue();
                    $data[65] = $sheet->getCellByColumnAndRow(65,$i)->getValue();
                    $data[66] = $sheet->getCellByColumnAndRow(66,$i)->getValue();
                    $data[67] = $sheet->getCellByColumnAndRow(67,$i)->getValue();
                    $data[68] = $sheet->getCellByColumnAndRow(68,$i)->getValue();
                    $data[69] = $sheet->getCellByColumnAndRow(69,$i)->getValue();
                    $data[70] = $sheet->getCellByColumnAndRow(70,$i)->getValue();
                    $data[71] = $sheet->getCellByColumnAndRow(71,$i)->getValue();
                    $data[72] = $sheet->getCellByColumnAndRow(72,$i)->getValue();
                    $data[73] = $sheet->getCellByColumnAndRow(73,$i)->getValue();
                    $data[74] = $sheet->getCellByColumnAndRow(74,$i)->getValue();
                    $data[75] = $sheet->getCellByColumnAndRow(75,$i)->getValue();
                    $data[76] = $sheet->getCellByColumnAndRow(76,$i)->getValue();
                    $data[77] = $sheet->getCellByColumnAndRow(77,$i)->getValue();
                    $data[78] = $sheet->getCellByColumnAndRow(78,$i)->getValue();
                    $data[79] = $sheet->getCellByColumnAndRow(79,$i)->getValue();
                    $data[80] = $sheet->getCellByColumnAndRow(80,$i)->getValue();
                    $data[81] = $sheet->getCellByColumnAndRow(81,$i)->getValue();
                    $data[82] = $sheet->getCellByColumnAndRow(82,$i)->getValue();
                    $data[83] = $sheet->getCellByColumnAndRow(83,$i)->getValue();
                    $data[84] = $sheet->getCellByColumnAndRow(84,$i)->getValue();
                    $data[85] = $sheet->getCellByColumnAndRow(85,$i)->getValue();
                    $data[86] = $sheet->getCellByColumnAndRow(86,$i)->getValue();
                    $data[87] = $sheet->getCellByColumnAndRow(87,$i)->getValue();
                    $data[88] = $sheet->getCellByColumnAndRow(88,$i)->getValue();
                    $data[89] = $sheet->getCellByColumnAndRow(89,$i)->getValue();
                    $data[90] = $sheet->getCellByColumnAndRow(90,$i)->getValue();
                    $data[91] = $sheet->getCellByColumnAndRow(91,$i)->getValue();
                    $data[92] = $sheet->getCellByColumnAndRow(92,$i)->getValue();
                    $data[93] = $sheet->getCellByColumnAndRow(93,$i)->getValue();
                    $data[94] = $sheet->getCellByColumnAndRow(94,$i)->getValue();
                    $data[95] = $sheet->getCellByColumnAndRow(95,$i)->getValue();
                    $data[96] = $sheet->getCellByColumnAndRow(96,$i)->getValue();
                    $data[97] = $sheet->getCellByColumnAndRow(97,$i)->getValue();
                    $data[98] = $sheet->getCellByColumnAndRow(98,$i)->getValue();
                    $data[99] = $sheet->getCellByColumnAndRow(99,$i)->getValue();
                    $data[100] = $sheet->getCellByColumnAndRow(100,$i)->getValue();
                    $data[101] = $sheet->getCellByColumnAndRow(101,$i)->getValue();
                    $data[102] = $sheet->getCellByColumnAndRow(102,$i)->getValue();
                    $data[103] = $sheet->getCellByColumnAndRow(103,$i)->getValue();
                    $data[104] = $sheet->getCellByColumnAndRow(104,$i)->getValue();
                    $data[105] = $sheet->getCellByColumnAndRow(105,$i)->getValue();
                    $data[106] = $sheet->getCellByColumnAndRow(106,$i)->getValue();
                    $data[107] = $sheet->getCellByColumnAndRow(107,$i)->getValue();
                    $data[108] = $sheet->getCellByColumnAndRow(108,$i)->getValue();
                    $data[109] = $sheet->getCellByColumnAndRow(109,$i)->getValue();
                    $data[110] = $sheet->getCellByColumnAndRow(110,$i)->getValue();
                    $data[111] = $sheet->getCellByColumnAndRow(111,$i)->getValue();
                    $data[112] = $sheet->getCellByColumnAndRow(112,$i)->getValue();
                    $data[113] = $sheet->getCellByColumnAndRow(113,$i)->getValue();
                    $data[114] = $sheet->getCellByColumnAndRow(114,$i)->getValue();
                    $data[115] = $sheet->getCellByColumnAndRow(115,$i)->getValue();
                    $data[116] = $sheet->getCellByColumnAndRow(116,$i)->getValue();
                    $data[117] = $sheet->getCellByColumnAndRow(117,$i)->getValue();
                    $data[118] = $sheet->getCellByColumnAndRow(118,$i)->getValue();
                    $data[119] = $sheet->getCellByColumnAndRow(119,$i)->getValue();
                    $data[120] = $sheet->getCellByColumnAndRow(120,$i)->getValue();
                    $data[121] = $sheet->getCellByColumnAndRow(121,$i)->getValue();
                    $data[122] = $sheet->getCellByColumnAndRow(122,$i)->getValue();
                    $data[123] = $sheet->getCellByColumnAndRow(123,$i)->getValue();
                    $data[124] = $sheet->getCellByColumnAndRow(124,$i)->getValue();
                    $data[125] = $sheet->getCellByColumnAndRow(125,$i)->getValue();
                    $data[126] = $sheet->getCellByColumnAndRow(126,$i)->getValue();
                    $data[127] = $sheet->getCellByColumnAndRow(127,$i)->getValue();
                    $data[128] = $sheet->getCellByColumnAndRow(128,$i)->getValue();
                    $data[129] = $sheet->getCellByColumnAndRow(129,$i)->getValue();
                    $data[130] = $sheet->getCellByColumnAndRow(130,$i)->getValue();
                    $data[131] = $sheet->getCellByColumnAndRow(131,$i)->getValue();
                    $data[132] = $sheet->getCellByColumnAndRow(132,$i)->getValue();
                    $data[133] = $sheet->getCellByColumnAndRow(133,$i)->getValue();
                    $data[134] = $sheet->getCellByColumnAndRow(134,$i)->getValue();
                    $data[135] = $sheet->getCellByColumnAndRow(135,$i)->getValue();
                    $data[136] = $sheet->getCellByColumnAndRow(136,$i)->getValue();
                    $data[137] = $sheet->getCellByColumnAndRow(137,$i)->getValue();
                    $data[138] = $sheet->getCellByColumnAndRow(138,$i)->getValue();
                    $data[139] = $sheet->getCellByColumnAndRow(139,$i)->getValue();
                    $data[140] = $sheet->getCellByColumnAndRow(140,$i)->getValue();
                    $data[141] = $sheet->getCellByColumnAndRow(141,$i)->getValue();
                    $data[142] = $sheet->getCellByColumnAndRow(142,$i)->getValue();
                    $data[143] = $sheet->getCellByColumnAndRow(143,$i)->getValue();
                    $data[144] = $sheet->getCellByColumnAndRow(144,$i)->getValue();
                    $data[145] = $sheet->getCellByColumnAndRow(145,$i)->getValue();
                    $data[146] = $sheet->getCellByColumnAndRow(146,$i)->getValue();
                    $data[147] = $sheet->getCellByColumnAndRow(147,$i)->getValue();
                    $data[148] = $sheet->getCellByColumnAndRow(148,$i)->getValue();
                    $data[149] = $sheet->getCellByColumnAndRow(149,$i)->getValue();
                    $data[150] = $sheet->getCellByColumnAndRow(150,$i)->getValue();
                    $data[151] = $sheet->getCellByColumnAndRow(151,$i)->getValue();
                    $data[152] = $sheet->getCellByColumnAndRow(152,$i)->getValue();
                    $data[153] = $sheet->getCellByColumnAndRow(153,$i)->getValue();
                    $data[154] = $sheet->getCellByColumnAndRow(154,$i)->getValue();
                    $data[155] = $sheet->getCellByColumnAndRow(155,$i)->getValue();
                    $data[156] = $sheet->getCellByColumnAndRow(156,$i)->getValue();
                    $data[157] = $sheet->getCellByColumnAndRow(157,$i)->getValue();
                    $data[158] = $sheet->getCellByColumnAndRow(158,$i)->getValue();
                    $data[159] = $sheet->getCellByColumnAndRow(159,$i)->getValue();
                    $data[160] = $sheet->getCellByColumnAndRow(160,$i)->getValue();
                    $data[161] = $sheet->getCellByColumnAndRow(161,$i)->getValue();
                    $data[162] = $sheet->getCellByColumnAndRow(162,$i)->getValue();
                    $data[163] = $sheet->getCellByColumnAndRow(163,$i)->getValue();
                    $data[164] = $sheet->getCellByColumnAndRow(164,$i)->getValue();
                    $data[165] = $sheet->getCellByColumnAndRow(165,$i)->getValue();
                    $data[166] = $sheet->getCellByColumnAndRow(166,$i)->getValue();
                    $data[167] = $sheet->getCellByColumnAndRow(167,$i)->getValue();
                    $data[168] = $sheet->getCellByColumnAndRow(168,$i)->getValue();
                    $data[169] = $sheet->getCellByColumnAndRow(169,$i)->getValue();
                    $data[170] = $sheet->getCellByColumnAndRow(170,$i)->getValue();
                    $data[171] = $sheet->getCellByColumnAndRow(171,$i)->getValue();
                    $data[172] = $sheet->getCellByColumnAndRow(172,$i)->getValue();
                    $data[173] = $sheet->getCellByColumnAndRow(173,$i)->getValue();
                    $data[174] = $sheet->getCellByColumnAndRow(174,$i)->getValue();
                    $data[175] = $sheet->getCellByColumnAndRow(175,$i)->getValue();
                    $data[176] = $sheet->getCellByColumnAndRow(176,$i)->getValue();
                    $data[177] = $sheet->getCellByColumnAndRow(177,$i)->getValue();
                    $data[178] = $sheet->getCellByColumnAndRow(178,$i)->getValue();
                    $data[179] = $sheet->getCellByColumnAndRow(179,$i)->getValue();
                    $data[180] = $sheet->getCellByColumnAndRow(180,$i)->getValue();
                    $data[181] = $sheet->getCellByColumnAndRow(181,$i)->getValue();
                    $data[182] = $sheet->getCellByColumnAndRow(182,$i)->getValue();
                    $data[183] = $sheet->getCellByColumnAndRow(183,$i)->getValue();
                    $data[184] = $sheet->getCellByColumnAndRow(184,$i)->getValue();
                    $data[185] = $sheet->getCellByColumnAndRow(185,$i)->getValue();
                    $data[186] = $sheet->getCellByColumnAndRow(186,$i)->getValue();
                    $data[187] = $sheet->getCellByColumnAndRow(187,$i)->getValue();
                    $data[188] = $sheet->getCellByColumnAndRow(188,$i)->getValue();
                    $data[189] = $sheet->getCellByColumnAndRow(189,$i)->getValue();
                    $data[190] = $sheet->getCellByColumnAndRow(190,$i)->getValue();
                    $data[191] = $sheet->getCellByColumnAndRow(191,$i)->getValue();
                    $data[192] = $sheet->getCellByColumnAndRow(192,$i)->getValue();
                    $data[193] = $sheet->getCellByColumnAndRow(193,$i)->getValue();
                    $data[194] = $sheet->getCellByColumnAndRow(194,$i)->getValue();
                    $data[195] = $sheet->getCellByColumnAndRow(195,$i)->getValue();
                    $data[196] = $sheet->getCellByColumnAndRow(196,$i)->getValue();
                    $data[197] = $sheet->getCellByColumnAndRow(197,$i)->getValue();
                    $data[198] = $sheet->getCellByColumnAndRow(198,$i)->getValue();
                    $data[199] = $sheet->getCellByColumnAndRow(199,$i)->getValue();
                    $data[200] = $sheet->getCellByColumnAndRow(200,$i)->getValue();
                    $data[201] = $sheet->getCellByColumnAndRow(201,$i)->getValue();
                    $data[202] = $sheet->getCellByColumnAndRow(202,$i)->getValue();
                    $data[203] = $sheet->getCellByColumnAndRow(203,$i)->getValue();
                    $data[204] = $sheet->getCellByColumnAndRow(204,$i)->getValue();
                    $data[205] = $sheet->getCellByColumnAndRow(205,$i)->getValue();
                    $data[206] = $sheet->getCellByColumnAndRow(206,$i)->getValue();
                    $data[207] = $sheet->getCellByColumnAndRow(207,$i)->getValue();
                    $data[208] = $sheet->getCellByColumnAndRow(208,$i)->getValue();
                    $data[209] = $sheet->getCellByColumnAndRow(209,$i)->getValue();
                    $data[210] = $sheet->getCellByColumnAndRow(210,$i)->getValue();
                    $data[211] = $sheet->getCellByColumnAndRow(211,$i)->getValue();
                    $data[212] = $sheet->getCellByColumnAndRow(212,$i)->getValue();
                    $data[213] = $sheet->getCellByColumnAndRow(213,$i)->getValue();
                    $data[214] = $sheet->getCellByColumnAndRow(214,$i)->getValue();
                    $data[215] = $sheet->getCellByColumnAndRow(215,$i)->getValue();
                    $data[216] = $sheet->getCellByColumnAndRow(216,$i)->getValue();
                    $data[217] = $sheet->getCellByColumnAndRow(217,$i)->getValue();
                    $data[218] = $sheet->getCellByColumnAndRow(218,$i)->getValue();
                    $data[219] = $sheet->getCellByColumnAndRow(219,$i)->getValue();
                    $data[220] = $sheet->getCellByColumnAndRow(220,$i)->getValue();
                    $data[221] = $sheet->getCellByColumnAndRow(221,$i)->getValue();
                    $data[222] = $sheet->getCellByColumnAndRow(222,$i)->getValue();
                    $data[223] = $sheet->getCellByColumnAndRow(223,$i)->getValue();
                    $data[224] = $sheet->getCellByColumnAndRow(224,$i)->getValue();
                    $data[225] = $sheet->getCellByColumnAndRow(225,$i)->getValue();
                    $data[226] = $sheet->getCellByColumnAndRow(226,$i)->getValue();
                    $data[227] = $sheet->getCellByColumnAndRow(227,$i)->getValue();
                    $data[228] = $sheet->getCellByColumnAndRow(228,$i)->getValue();
                    $data[229] = $sheet->getCellByColumnAndRow(229,$i)->getValue();
                    $data[230] = $sheet->getCellByColumnAndRow(230,$i)->getValue();
                    $data[231] = $sheet->getCellByColumnAndRow(231,$i)->getValue();
                    $data[232] = $sheet->getCellByColumnAndRow(232,$i)->getValue();
                    $data[233] = $sheet->getCellByColumnAndRow(233,$i)->getValue();
                    $data[234] = $sheet->getCellByColumnAndRow(234,$i)->getValue();
                    $data[235] = $sheet->getCellByColumnAndRow(235,$i)->getValue();
                    $data[236] = $sheet->getCellByColumnAndRow(236,$i)->getValue();
                    $data[237] = $sheet->getCellByColumnAndRow(237,$i)->getValue();
                    $data[238] = $sheet->getCellByColumnAndRow(238,$i)->getValue();
                    $data[239] = $sheet->getCellByColumnAndRow(239,$i)->getValue();
                    $data[240] = $sheet->getCellByColumnAndRow(240,$i)->getValue();
                    $data[241] = $sheet->getCellByColumnAndRow(241,$i)->getValue();
                    $data[242] = $sheet->getCellByColumnAndRow(242,$i)->getValue();
                    $data[243] = $sheet->getCellByColumnAndRow(243,$i)->getValue();
                    $data[244] = $sheet->getCellByColumnAndRow(244,$i)->getValue();
                    if($i==1)
                    {                           
                        for($k=0;$k<245;$k++){
                            $column .= $data[$k].",";
                        }
                        $column = rtrim($column,',');
                        // echo $column;
                        // exit;

                    }
                    mysqli_query($conn,"INSERT INTO data($column) VALUES ('". $data[0]."', '". $data[1]."', '". $data[2]."', '". $data[3]."', '". $data[4]."', '". $data[5]."', '". $data[6]."', '". $data[7]."', '". $data[8]."', '". $data[9]."', '". $data[10]."', '". $data[11]."', '". $data[12]."', '". $data[13]."', '". $data[14]."', '". $data[15]."', '". $data[16]."', '". $data[17]."', '". $data[18]."', '". $data[19]."', '". $data[20]."', '". $data[21]."', '". $data[22]."', '". $data[23]."', '". $data[24]."', '". $data[25]."', '". $data[26]."', '". $data[27]."', '". $data[28]."', '". $data[29]."', '". $data[30]."', '". $data[31]."', '". $data[32]."', '". $data[33]."', '". $data[34]."', '". $data[35]."', '". $data[36]."', '". $data[37]."', '". $data[38]."', '". $data[39]."', '". $data[40]."', '". $data[41]."', '". $data[42]."', '". $data[43]."', '". $data[44]."', '". $data[45]."', '". $data[46]."', '". $data[47]."', '". $data[48]."', '". $data[49]."', '". $data[50]."', '". $data[51]."', '". $data[52]."', '". $data[53]."', '". $data[54]."', '". $data[55]."', '". $data[56]."', '". $data[57]."', '". $data[58]."', '". $data[59]."', '". $data[60]."', '". $data[61]."', '". $data[62]."', '". $data[63]."', '". $data[64]."', '". $data[65]."', '". $data[66]."', '". $data[67]."', '". $data[68]."', '". $data[69]."', '". $data[70]."', '". $data[71]."', '". $data[72]."', '". $data[73]."', '". $data[74]."', '". $data[75]."', '". $data[76]."', '". $data[77]."', '". $data[78]."', '". $data[79]."', '". $data[80]."', '". $data[81]."', '". $data[82]."', '". $data[83]."', '". $data[84]."', '". $data[85]."', '". $data[86]."', '". $data[87]."', '". $data[88]."', '". $data[89]."', '". $data[90]."', '". $data[91]."', '". $data[92]."', '". $data[93]."', '". $data[94]."', '". $data[95]."', '". $data[96]."', '". $data[97]."', '". $data[98]."', '". $data[99]."', '". $data[100]."', '". $data[101]."', '". $data[102]."', '". $data[103]."', '". $data[104]."', '". $data[105]."', '". $data[106]."', '". $data[107]."', '". $data[108]."', '". $data[109]."', '". $data[110]."', '". $data[111]."', '". $data[112]."', '". $data[113]."', '". $data[114]."', '". $data[115]."', '". $data[116]."', '". $data[117]."', '". $data[118]."', '". $data[119]."', '". $data[120]."', '". $data[121]."', '". $data[122]."', '". $data[123]."', '". $data[124]."', '". $data[125]."', '". $data[126]."', '". $data[127]."', '". $data[128]."', '". $data[129]."', '". $data[130]."', '". $data[131]."', '". $data[132]."', '". $data[133]."', '". $data[134]."', '". $data[135]."', '". $data[136]."', '". $data[137]."', '". $data[138]."', '". $data[139]."', '". $data[140]."', '". $data[141]."', '". $data[142]."', '". $data[143]."', '". $data[144]."', '". $data[145]."', '". $data[146]."', '". $data[147]."', '". $data[148]."', '". $data[149]."', '". $data[150]."', '". $data[151]."', '". $data[152]."', '". $data[153]."', '". $data[154]."', '". $data[155]."', '". $data[156]."', '". $data[157]."', '". $data[158]."', '". $data[159]."', '". $data[160]."', '". $data[161]."', '". $data[162]."', '". $data[163]."', '". $data[164]."', '". $data[165]."', '". $data[166]."', '". $data[167]."', '". $data[168]."', '". $data[169]."', '". $data[170]."', '". $data[171]."', '". $data[172]."', '". $data[173]."', '". $data[174]."', '". $data[175]."', '". $data[176]."', '". $data[177]."', '". $data[178]."', '". $data[179]."', '". $data[180]."', '". $data[181]."', '". $data[182]."', '". $data[183]."', '". $data[184]."', '". $data[185]."', '". $data[186]."', '". $data[187]."', '". $data[188]."', '". $data[189]."', '". $data[190]."', '". $data[191]."', '". $data[192]."', '". $data[193]."', '". $data[194]."', '". $data[195]."', '". $data[196]."', '". $data[197]."', '". $data[198]."', '". $data[199]."', '". $data[200]."', '". $data[201]."', '". $data[202]."', '". $data[203]."', '". $data[204]."', '". $data[205]."', '". $data[206]."', '". $data[207]."', '". $data[208]."', '". $data[209]."', '". $data[210]."', '". $data[211]."', '". $data[212]."', '". $data[213]."', '". $data[214]."', '". $data[215]."', '". $data[216]."', '". $data[217]."', '". $data[218]."', '". $data[219]."', '". $data[220]."', '". $data[221]."', '". $data[222]."', '". $data[223]."', '". $data[224]."', '". $data[225]."', '". $data[226]."', '". $data[227]."', '". $data[228]."', '". $data[229]."', '". $data[230]."', '". $data[231]."', '". $data[232]."', '". $data[233]."', '". $data[234]."', '". $data[235]."', '". $data[236]."', '". $data[237]."', '". $data[238]."', '". $data[239]."', '". $data[240]."', '". $data[241]."', '". $data[242]."', '". $data[243]."', '". $data[244]."')");
                }                               
            }
        }
        echo "<script>alert('Upload completed successfully')</script>";
    }else{
        echo "<script>alert('Invalid file format')</script>";
    }
}

if(isset($_POST['search']))
{
    $enroll = mysqli_real_escape_string($conn,$_POST['enroll']);
    $query = "select * from data where MAP_NUMBER = '$enroll' ORDER BY sem";
    $result = mysqli_query($conn, $query);
    
}

if(isset($_GET['logout']))
{
	unset($_SESSION[$_COOKIE["result"]]);
	session_write_close();
	setcookie("result", "", time() - (86400 * 30 * 30), "/");
	$page = "'#login";
	echo"<script>
		alert('Logged out successfully');		
		window.location = 'result.php';
		</script>";
}
?>
<html>

<?php include('header.php'); ?>
<section id="cor"></section>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="container-fluid" style="margin-bottom: 150px;">
    <div class="row" id="super-of-submenu">
        <div class="col-md-3">
            <ul class="dept-side-menu" id="dept-side-menu" style="line-height: 1;">
                <li>Result
                    <h5 style="color: white; margin-top: 5px;"><?php if(isset($_SESSION[$_COOKIE['result']])) { echo " Welcome ".$_COOKIE['result']; }?> </h5>
                </li>
                <li class="sub-menu" id="login_submenu"> Upload Data </li>
                <li class="sub-menu" id="advanature_details_submenu">Search Result </li>
                <li class="sub-menu" id="advanature_details_faculty_submenu">Faculty </li>
                <?php if(isset($_SESSION[$_COOKIE['result']])) { ?> <li class="sub-menu" id="logout_submenu"> Logout </li> <?php }?>
            </ul>
        </div>

        <div class="col-md-9" id="ncc-content">
            <!-- <div class="row" style="border: 0px solid black;margin-left:2%;margin-right:2%;">
                <div class="col-md-7 col-xs-7 mx-auto"> -->
            <!-- </div>
            </div> -->
            <h2 class="dept-title"> RESULT SECTION </h2>
            <div class="px-3 mb-4" id="advanature_details" style="border: 1px solid #003865;">
                <!-- <h4 class="headingsall bg-light"> </h4> -->
                <!-- <div class="row" style="border-top: 1px solid #003865;"> -->
                <div class="row">
                    <section class="col-lg-12 col-md-12 col-sm-12" <?php if ($result !="" ) { echo "style='padding: 10px 10px 0px 10px;'"; } else { echo "style='padding: 10px;'"; } ?>>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 p-1">
                                                <input type="number" name="enroll" class="form-control search-slt" placeholder="Enrollment Number" value="<?php if (isset($enroll))
                                                            {
                                                                echo $enroll;
                                                            } ?>"> </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 p-1" style="text-align: center;">
                                                <input type="submit" name="search" value="Search" class="btn wrn-btn col-lg-12 col-md-12 col-sm-12" style="height: 35px; width: 50%;"> </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <?php if ($result != "")
                            { ?>
                    <div class="p-3 mb-2 col-12">

                        <p>Enrollment Number :
                            <?php 
                                            echo $enroll; 
                                            $query1 = "select name, extype, br_code, br_name from data where MAP_number = '$enroll'";
                                            $result1 = mysqli_query($conn, $query1);
                                            if($data1 = mysqli_fetch_row($result1)){
                                                echo "<br>Name : ".$data1[0]."<br>";
                                                echo "Branch : ".$data1[1]."-".$data1[2]."-".$data1[3]."<br>";
                                            }
                                        ?>
                        </p>


                        <?php 
                                        while($data = mysqli_fetch_row($result)){
                                            $total = $data[196];
                                            $code_idx = 16;
                                            $name_idx = 31;
                                            $sub_grade_idx = 61;
                                    ?>


                        <table id="example" class="row-border hover order-column stat-hover table-responsive stat table" style="width:100% !important; margin:auto; margin-bottom:20px; margin-top: -40px;">
                            <h4><?php echo "SEM - ".$data[6]; ?> </h4>
                            <thead class="text-center">
                                <tr>
                                    <th>SUB CODE</th>
                                    <th>SUB NAME</th>
                                    <th>SUB GRADE</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">

                                <?php                                    
                                                for($i = 1; $i <= $total; $i++){ ?>
                                <tr>
                                    <td>
                                        <?php echo $data[$code_idx++]; ?>
                                    </td>
                                    <td>
                                        <?php echo $data[$name_idx++]; ?>
                                    </td>
                                    <td>
                                        <?php echo $data[$sub_grade_idx++]; ?>
                                    </td>

                                </tr>

                                <?php

                                            } ?>
                                <br><br>
                                <?php
                                                }
                                                // $latest_data = "SELECT spi, cpi from data where MAP_NUMBER = '$enroll' && DECLARATIONDATE = (Select max(DECLARATIONDATE) from data where MAP_NUMBER = '$enroll')";
                                                // $latest = mysqli_query($conn, $latest_data);
                                                // if($temp = mysqli_fetch_row($latest)){
                                                //     var_dump($temp);
                                                // }

                                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                                } ?>
                </div>
            </div>

            <div class="px-3 mb-4 p-2" id="faculty" style="border: 1px solid #003865;">
                <?php if(!isset($_SESSION[$_COOKIE['result']])) { ?>
                <section class="login section-padding">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="login-form login-area">
                                    <h3 style="text-align: center; color:#003975 !important;">
                                        Login to Upload Data
                                    </h3>
                                    <div class="text-center" style="margin-top: 10px;" id="google_translate_element"></div>
                                    <form role="form" class="login-form" id="login_form" action="" method="POST">
                                        <div class="form-group">
                                            <div class="input-icon"> <i class="lni-user"></i>
                                                <input type="text" id="sender-email" class="form-control" name="username" placeholder="Username" required> </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-icon" id="pass"> <i class="lni-lock"></i>
                                                <input type="password" id="password_login" class="form-control" name="password" placeholder="Password" required> </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-xs-12 p-1">
                                                        <input type="submit" id="passbtn" name="login" value="Login" class="btn btn-common log-btn">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php } ?>
                <?php if(isset($_SESSION[$_COOKIE['result']])) { ?>
                <section class="faculty section-padding">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <?php 
                                            //$select = "select map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data";
                                            //$student = mysqli_query($conn, $select);
                                            //if ($student != "")

                                            //{ ?>
                                <div class="p-3 mb-2 col-12">
                                <form  action="" method="POST">
                                <div class="row">
                                   <div class = "col">
                                      <label for= "Year">Select Acadamic Year: </label>
                                       <select id="Year" name="year">
                                           <option value="" selected>all</option>
                                           <option value="2018-2019">2018-2019</option>
                                           <option value="2019-2020">2019-2020</option>
                                           <option value="2020-2021">2020-2021</option>                     
                                       </select>
                                   </div>
                                 <div class = "col">
                                      <label for= "branch">Select Branch: </label>
                                       <select id="branch" name="branch">
                                           <option value="" selected>All</option>
                                           <option value="CHEMICAL ENGINEERING">Chemical Engineering</option>
                                           <option value="me">Mechanical Engineering</option>
                                           <option value="CIVIL ENGINEERING">Civil Engineering</option>             
                                       </select>
                                   </div>
                                     <div class = "col">
                                      <label for="sem">Select Semester: </label><br>
                                       <select id="sem" name="sem">
                                           <option value="" selected>All</option>
                                           <option value="1">1</option>
                                           <option value="2">2</option>
                                           <option value="3">3</option>
                                           <option value="4">4</option>
                                           <option value="5">5</option>
                                           <option value="6">6</option>
                                           <option value="7">7</option>
                                           <option value="8">8</option>
                                       </select>
                                    </div>
                                   </div>
                                   <div class="col text-center my-3">
                                    <input type="submit" class="btn btn-outline-dark" name="search_record" value="Search">
                                   </div>
                                    </form>
                                   <div class ="row my-3">
                                   </div>
                                   <!-- <hr> -->
                                    <!-- <h4 class="headingsall col-md-12"></h4> -->
                                    <?php 
                                    if((isset($_POST['search_record']))){
                                    ?>
                                    <div id="dispTable">
                                    <table id="example" class="row-border hover order-column stat-hover table-responsive stat table" style="width:100% !important; margin:auto; margin-bottom:20px; margin-top: -40px;">

                                        <thead class="text-center">
                                            <tr>
                                                <th>Enrollment No.</th>
                                                <th>Name</th>
                                                <th>Semester</th>
                                                <th>Exam Year</th>
                                                <th>SPI</th>
                                                <th>CPI</th>
                                                <th>CGPA</th>
                                                <th>Total Backlog</th>
                                                <th>Current Backlog</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center" style="text-align: justify !important;">
                                        
                                            <?php
                                            // if(isset($_POST['search_record'])){ 
                                                
                                                $page = "'#faculty";                                                
                                                $year = $_POST['year'];
                                                $branch = $_POST['branch'];
                                                $sem = $_POST['sem'];                              
                                                
                                                    if($year != "" && $branch != "" && $sem != ""){
                                                        $query = "SELECT map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data WHERE AcademicYear = '$year' AND BR_NAME = '$branch' AND sem = '$sem'";
                                                    }
                                                    elseif($year == "" && $branch != "" && $sem != ""){
                                                        $query = "SELECT map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data WHERE BR_NAME = '$branch' AND sem = '$sem'";
                                                    }
                                                    elseif($year != "" && $branch != "" && $sem == ""){
                                                        $query = "SELECT map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data WHERE AcademicYear = '$year' AND BR_NAME = '$branch'";
                                                    }
                                                    elseif($year != "" && $branch == "" && $sem != ""){
                                                        $query = "SELECT map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data WHERE AcademicYear = '$year' AND sem = '$sem'";
                                                    }
                                                    elseif($year == "" && $branch != "" && $sem == ""){
                                                        $query = "SELECT map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data WHERE BR_NAME = '$branch' ";
                                                    }
                                                    elseif($year == "" && $branch == "" && $sem != ""){
                                                        $query = "SELECT map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data WHERE sem = '$sem'";
                                                    }
                                                    if($year != "" && $branch == "" && $sem == ""){
                                                        $query = "SELECT map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data WHERE AcademicYear = '$year'";
                                                    }
                                                    else if($year == "" && $branch == "" && $sem == ""){
                                                        $query = "SELECT map_number, name, sem, exam, spi, cpi, cgpa, TOTBACKL,CURBACKL,RESULT from data";
                                                    }
                                                    else{
                                                        // echo "Something Went Wrong...";
                                                    }
                                                        $student = mysqli_query($conn,$query) or die('Error');
                                                        // echo $query;
                                                        if(mysqli_num_rows($student) > 0 ){
                                                        //    while ($data = mysqli_fetch_assoc($student)){ 
                                                            while($data = mysqli_fetch_row($student)){
                                            ?>
                                            
                                            <tr>
                                                <th style="text-align: center !important">
                                                    <?php echo $data[0]; ?>
                                                </th>
                                                <td>
                                                    <?php echo $data[1]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data[2]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data[3]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data[4]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data[5]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data[6]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data[7]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data[8]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data[9]; ?>
                                                </td>
                                            </tr>
                                            <?php
    }}
?>
                                        </tbody>
                                    </table>
                                    
                                    </div>
                                        <?php
                                        if($year != "" && $branch != "" && $sem != ""){
                                            
                                            $pfQuery = "SELECT count(*) as pass_fail_count,RESULT, case when RESULT = 'FAIL' then 'Fail' when RESULT = 'PASS' then 'Pass' end as RESULT FROM data WHERE AcademicYear = '$year' AND BR_NAME = '$branch' AND sem = '$sem' GROUP BY RESULT;";
                                        }
                                        elseif($year == "" && $branch != "" && $sem != ""){
                                            
                                            $pfQuery = "SELECT count(*) as pass_fail_count,RESULT, case when RESULT = 'FAIL' then 'Fail' when RESULT = 'PASS' then 'Pass' end as RESULT FROM data WHERE BR_NAME = '$branch' AND sem = '$sem' GROUP BY RESULT;";
                                        }
                                        elseif($year != "" && $branch != "" && $sem == ""){
                                            
                                            $pfQuery = "SELECT count(*) as pass_fail_count,RESULT, case when RESULT = 'FAIL' then 'Fail' when RESULT = 'PASS' then 'Pass' end as RESULT FROM data WHERE AcademicYear = '$year' AND BR_NAME = '$branch' GROUP BY RESULT;";
                                        }
                                        elseif($year != "" && $branch == "" && $sem != ""){
                                            
                                            $pfQuery = "SELECT count(*) as pass_fail_count,RESULT, case when RESULT = 'FAIL' then 'Fail' when RESULT = 'PASS' then 'Pass' end as RESULT FROM data WHERE AcademicYear = '$year' AND sem = '$sem' GROUP BY RESULT;";
                                        }
                                        elseif($year == "" && $branch != "" && $sem == ""){
                                            
                                            $pfQuery = "SELECT count(*) as pass_fail_count,RESULT, case when RESULT = 'FAIL' then 'Fail' when RESULT = 'PASS' then 'Pass' end as RESULT FROM data WHERE BR_NAME = '$branch' GROUP BY RESULT;";
                                        }
                                        elseif($year == "" && $branch == "" && $sem != ""){
                                            
                                            $pfQuery = "SELECT count(*) as pass_fail_count,RESULT, case when RESULT = 'FAIL' then 'Fail' when RESULT = 'PASS' then 'Pass' end as RESULT FROM data WHERE sem = '$sem' GROUP BY RESULT;";
                                        }
                                        if($year != "" && $branch == "" && $sem == ""){
                                            
                                            $pfQuery = "SELECT count(*) as pass_fail_count,RESULT, case when RESULT = 'FAIL' then 'Fail' when RESULT = 'PASS' then 'Pass' end as RESULT FROM data WHERE AcademicYear = '$year' GROUP BY RESULT;";
                                        }
                                        else if($year == "" && $branch == "" && $sem == ""){
                                            
                                            $pfQuery = "SELECT count(*) as pass_fail_count,RESULT, case when RESULT = 'FAIL' then 'Fail' when RESULT = 'PASS' then 'Pass' end as RESULT FROM data GROUP BY RESULT;";
                                        }
                                        else{

                                        }
                                            // Code For Pass / Fail Count In Php: Do not Delete:::
                                            
                                            // echo $pfQuery;

                                            // $pfQuery = "SELECT count(*) as pass_fail_count,RESULT FROM test_mis GROUP BY RESULT";
                                            // $stmt = $conn -> prepare($pfQuery);
                                            // $stmt -> execute();
                                            // $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            // echo "<pre>";
                                            // print_r($arr);
                                            $execpfQuery = mysqli_query($conn,$pfQuery) or die('Something Went Wrong!!');
                                            // $i = 0;
                                            // while($que = mysqli_fetch_array($execpfQuery)){
                                            //     // echo "<pre>";
                                            //     // print_r($que);
                                            //     $label[$i] = $que["RESULT"];
                                            //     $pfCount[$i] = $que["pass_fail_count"];
                                            //     $i++;
                                            // }



                                            // $data = array();
                                            // foreach ($data as $key) {
                                            //     $data[] = array(
                                            //         'label'  => $data['RESULT'],
                                            //         'pfCount'  => $data['pass_fail_count'],
                                            //         'color'  => '#'.rand(100000,999999).''
                                            //     );
                                            // }
                                            // echo json_encode($data);
                                        ?>
                                    <?php  
                                    }
                                    ?>
                                    
                                </div>
                                <?php
//} ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php 
                if((isset($_POST['search_record']))){?>
                    <div id="pieChart"></div>
                <?php } ?>
                <?php } ?>
            </div>
            <div class="px-3 mb-4 p-2" id="login" style="border: 1px solid #003865;">
                <?php if(!isset($_SESSION[$_COOKIE['result']])) { ?>
                <section class="login section-padding">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="login-form login-area">
                                    <h3 style="text-align: center; color:#003975 !important;">
                                        Login to Upload Data
                                    </h3>
                                    <div class="text-center" style="margin-top: 10px;" id="google_translate_element"></div>
                                    <form role="form" class="login-form" id="login_form" action="" method="POST">
                                        <div class="form-group">
                                            <div class="input-icon"> <i class="lni-user"></i>
                                                <input type="text" id="sender-email" class="form-control" name="username" placeholder="Username" required> </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-icon" id="pass"> <i class="lni-lock"></i>
                                                <input type="password" id="password_login" class="form-control" name="password" placeholder="Password" required> </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-xs-12 p-1">
                                                        <input type="submit" id="passbtn" name="login" value="Login" class="btn btn-common log-btn">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php } ?>

                <?php if(isset($_SESSION[$_COOKIE['result']])) { ?>
                <section class="login section-padding">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="login-form login-area">
                                    <h3 style="text-align: center; color:#003975 !important;">
                                        Select CSV file
                                    </h3>
                                    <div class="text-center" style="margin-top: 10px;" id="google_translate_element"></div>
                                    <form role="form" class="login-form" action="" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12" style="text-align: center; margin-top: 10px;">
                                                <div class="form-group">
                                                    <div class="input-icon"> <i class="lni-user"></i>
                                                        <label>Select CSV File:</label>
                                                        <input type="file" name="file" accept=".xls" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="form-group mb-3">
                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-xs-12 p-1">
                                                                <input type="submit" name="submit" value="Upload" class="btn btn-info" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php } ?>
            </div>
            <div class="px-3 mb-4" id="advanature_events" style="border: 1px solid #003865;"></div>
            <div class="px-3 mb-4" id="advanature_gallery" style="border: 1px solid #003865;"> </div>
            <div id="event_glance"> </div>
            <div class="px-3 mb-4" id="iQuest_2021" style="border: 1px solid #003865;"> </div>
        </div>
    </div>
</div>

<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>
<script>
    $(document).ready(function() {
        var tempArray = ["2021", "2020"];
        window.count = tempArray.length;
        window.year = tempArray;
        show_events(year[0]);
        $(window).on("load", function() {
            // if (!window.matchMedia("(max-width: 700px)").matches) { 
            if ($(window).width() > 800) {
                window.stickyTop = $('#dept-side-menu').offset().top;
                $(window).scroll(function() {
                    // stickyTop1 = $('#dept-side-menu').offset().top;
                    windowTop = $(window).scrollTop();
                    // console.log(stickyTop + " asd " +windowTop);
                    // console.log(stickyTop/2 < windowTop && (stickyTop*2)<$('#footer').offset().top);
                    // console.log(stickyTop/2 < windowTop);
                    // console.log((stickyTop*2)<$('#footer').offset().top);
                    // console.log('st: ' + stickyTop);
                    // console.log('wt: ' + windowTop);
                    // console.log('st1: ' + stickyTop1);
                    // console.log('ft: ' + ($('#footer').offset().top - 25));
                    // console.log($('#dept-side-menu').outerHeight());
                    // console.log($('#no').outerHeight());
                    // console.log(stickyTop1 + $('#dept-side-menu').height());
                    // console.log('h: ' + window.h);
                    if (stickyTop / 4 < windowTop && (windowTop + $('#dept-side-menu').outerHeight() + $('#no').outerHeight()) < ($('#footer').offset().top - 25) && $('#ncc-content').outerHeight() > $('#dept-side-menu').outerHeight() + 20) {
                        // console.log("if");
                        $('#dept-side-menu').css({
                            'position': 'fixed',
                            'width': '23%',
                            'top': '100px'
                        });
                    } else {
                        // console.log("else");
                        $('#dept-side-menu').css({
                            'position': 'relative',
                            'width': '100%',
                            'top': '0px'
                        });
                    }
                });
            }
        })
    });
    $(document).ready(function() {
        window.count = 4;
        $('#advanature_details').hide();
        $('#advanature_events').hide();
        $('#advanature_gallery').hide();
        $('#event_glance').hide();
        $('#iQuest_2021').hide();
        $('#login').hide();
        $('#faculty').hide();
        $('#advanature_details_submenu').removeClass('sub-menu-active')
        $('#advanature_events_submenu').removeClass('sub-menu-active')
        $('#advanature_gallery_submenu').removeClass('sub-menu-active')
        $('#event_glance_submenu').removeClass('sub-menu-active')
        $('#iQuest_2021_submenu').removeClass('sub-menu-active')
        $('#login_submenu').removeClass('sub-menu-active')
        $('#advanature_details_faculty_submenu').removeClass('sub-menu-active')
        $(<?php echo $page . "'"; ?>).show();

        $(<?php echo $page . "_submenu'"; ?>).addClass('sub-menu-active')
        $('#advanature_details_submenu').click(function() {
            $('#advanature_details').show(function() {
                $('#advanature_details_submenu').addClass('sub-menu-active')
            });
            $('#advanature_events').hide(function() {
                $('#advanature_events_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_gallery').hide(function() {
                $('#advanature_gallery_submenu').removeClass('sub-menu-active')
            });
            $('#event_glance').hide(function() {
                $('#event_glance_submenu').removeClass('sub-menu-active')
            });
            $('#iQuest_2021').hide(function() {
                $('#iQuest_2021_submenu').removeClass('sub-menu-active')
            });
            $('#faculty').hide(function() {
                $('#advanature_details_faculty_submenu').removeClass('sub-menu-active')
            });
            $('#login').hide(function() {
                $('#login_submenu').removeClass('sub-menu-active')
            });
        })
        $('#advanature_events_submenu').click(function() {
            $('#advanature_details').hide(function() {
                $('#advanature_details_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_events').show(function() {
                $('#advanature_events_submenu').addClass('sub-menu-active')
            });
            $('#advanature_gallery').hide(function() {
                $('#advanature_gallery_submenu').removeClass('sub-menu-active')
            });
            $('#event_glance').hide(function() {
                $('#event_glance_submenu').removeClass('sub-menu-active')
            });
            $('#iQuest_2021').hide(function() {
                $('#iQuest_2021_submenu').removeClass('sub-menu-active')
            });
            $('#faculty').hide(function() {
                $('#advanature_details_faculty_submenu').removeClass('sub-menu-active')
            });
            $('#login').hide(function() {
                $('#login_submenu').removeClass('sub-menu-active')
            });
        })
       
        $('#advanature_details_faculty_submenu').click(function() {
            $('#faculty').show(function() {
                $('#advanature_details_faculty_submenu').addClass('sub-menu-active')
            });
            $('#advanature_details').hide(function() {
                $('#advanature_details_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_events').hide(function() {
                $('#advanature_events_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_gallery').hide(function() {
                $('#advanature_gallery_submenu').removeClass('sub-menu-active')
            });
            $('#event_glance').hide(function() {
                $('#event_glance_submenu').removeClass('sub-menu-active')
            });
            $('#iQuest_2021').hide(function() {
                $('#iQuest_2021_submenu').removeClass('sub-menu-active')
            });
            $('#login').hide(function() {
                $('#login_submenu').removeClass('sub-menu-active')
            });
        })
        $('#advanature_gallery_submenu').click(function() {
            $('#advanature_details').hide(function() {
                $('#advanature_details_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_events').hide(function() {
                $('#advanature_events_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_gallery').show(function() {
                $('#advanature_gallery_submenu').addClass('sub-menu-active')
            });
            $('#event_glance').hide(function() {
                $('#event_glance_submenu').removeClass('sub-menu-active')
            });
            $('#iQuest_2021').hide(function() {
                $('#iQuest_2021_submenu').removeClass('sub-menu-active')
            });
            $('#faculty').hide(function() {
                $('#advanature_details_faculty_submenu').removeClass('sub-menu-active')
            });
            $('#login').hide(function() {
                $('#login_submenu').removeClass('sub-menu-active')
            });
        })
        $('#event_glance_submenu').click(function() {
            $('#advanature_details').hide(function() {
                $('#advanature_details_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_events').hide(function() {
                $('#advanature_events_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_gallery').hide(function() {
                $('#advanature_gallery_submenu').removeClass('sub-menu-active')
            });
            $('#event_glance').show(function() {
                $('#event_glance_submenu').addClass('sub-menu-active')
            });
            $('#iQuest_2021').hide(function() {
                $('#iQuest_2021_submenu').removeClass('sub-menu-active')
            });
            $('#faculty').hide(function() {
                $('#advanature_details_faculty_submenu').removeClass('sub-menu-active')
            });
            $('#login').hide(function() {
                $('#login_submenu').removeClass('sub-menu-active')
            });
        })
        $('#login_submenu').click(function() {
            $('#login').show(function() {
                $('#login_submenu').addClass('sub-menu-active')
            });
            $('#advanature_details').hide(function() {
                $('#advanature_details_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_events').hide(function() {
                $('#advanature_events_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_gallery').hide(function() {
                $('#advanature_gallery_submenu').removeClass('sub-menu-active')
            });
            $('#event_glance').hide(function() {
                $('#event_glance_submenu').removeClass('sub-menu-active')
            });
            $('#faculty').hide(function() {
                $('#advanature_details_faculty_submenu').removeClass('sub-menu-active')
            });
            $('#iQuest_2021').hide(function() {
                $('#iQuest_2021_submenu').removeClass('sub-menu-active')
            });
        })
        $('#logout_submenu').click(function() {
            window.location = '?logout';
        })
        $('#iQuest_2021_submenu').click(function() {
            $('#advanature_details').hide(function() {
                $('#advanature_details_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_events').hide(function() {
                $('#advanature_events_submenu').removeClass('sub-menu-active')
            });
            $('#advanature_gallery').hide(function() {
                $('#advanature_gallery_submenu').removeClass('sub-menu-active')
            });
            $('#event_glance').hide(function() {
                $('#event_glance_submenu').removeClass('sub-menu-active')
            });
            $('#iQuest_2021').show(function() {
                $('#iQuest_2021_submenu').addClass('sub-menu-active')
            });
            $('#faculty').hide(function() {
                $('#advanature_details_faculty_submenu').removeClass('sub-menu-active')
            });
            $('#login').hide(function() {
                $('#login_submenu').removeClass('sub-menu-active')
            });
        });
    });

    function myFunction(x) {
        if (x.matches) { // If media query matches
            var content = document.getElementById('ncc-content')
            content.classList.add('order-1')
        } else {
            var content = document.getElementById('ncc-content')
            content.classList.remove('order-1')
        }
    }
    var x = window.matchMedia("(max-width: 768px)")
    myFunction(x) // Call listener function at run time
    x.addListener(myFunction) // Attach listener function on state changes
    $("#event_year_selection").change(function() {
        show_events(this.value);
    })

    function show_events(val) {
        for (i = 0; i < count; i++) {
            if (val == year[i]) $('#' + year[i] + '_events').show();
            else $('#' + year[i] + '_events').hide();
        }
    }

</script>



<!-- Google Chart .....  -->
<script>
// alert("Hello");
// Google Pie Chart:
// google.load("visualization", "1",{'packages':['corechart']});
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawPieChart);
// console.log(document.getElementById('pieChart'));
function drawPieChart(){
    

    var pie = google.visualization.arrayToDataTable([
        ['RESULT','Status'],
        <?php while($que = mysqli_fetch_assoc($execpfQuery)){ ?>
        ['<?php echo $que['RESULT']; ?>',<?php echo $que['pass_fail_count']; ?>],
        <?php } ?>
    ]);

    // var pie = google.visualization.arrayToDataTable([
    //         ['RESULT','pfCount'],
    //         <?php foreach($arr as $key => $val ) { ?>
    //         ['<?php echo $val['RESULT']; ?>',<?php echo $val['pass_fail_count']; ?>],
    //         <?php } ?>
    //     ]);


    var header = {
        'title' : 'Pass/Fail Ratio:',
        
        // 'slices': {0:{color: '#666666'},1:{color: '#0066FF'}}
        'slices': {0:{color: "<?php echo '#'.rand(100000,999999).''; ?>"},1:{color: "<?php echo '#'.rand(100000,999999).'';?>"}}
    };
    var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
    chart.draw(pie, header);
}
</script>





<script>
    // var hash1 = window.location.hash;
    // if (hash1) {
    //     $('html, body').animate({
    //         scrollTop: $(hash1).offset().top
    //     });
    // }
    $(window).ready(function() {
        document.getElementById("nv").style.padding = "1rem 1rem";
        if ($(window).width() > 1270) {
            $('#fzl_vgec').addClass('col-lg-5');
            $('#fzl_vgec').addClass('col-md-6');
            $('#fzl_vgec').removeClass('col-lg-11');
            $('#fzl_vgec').removeClass('col-md-11');
            // $('#fzl_logo').addClass('col-lg-7');
            // $('#fzl_logo').addClass('col-md-6');
            $('#fzl_logo').removeClass('col-lg-1');
            $('#fzl_logo').removeClass('col-md-1');
            $('#navbarContent').removeClass('show');
        } else {
            $('#fzl_vgec').addClass('col-lg-11');
            $('#fzl_vgec').addClass('col-md-11');
            $('#fzl_vgec').removeClass('col-lg-5');
            $('#fzl_vgec').removeClass('col-md-6');
            $('#fzl_logo').addClass('col-lg-1');
            $('#fzl_logo').addClass('col-md-1');
            $('#fzl_logo').removeClass('col-lg-7');
            $('#fzl_logo').removeClass('col-md-6');
        }
        if ($(window).width() < 390) {
            document.getElementById("logo").style.width = "50px";
            document.getElementById("logo").style.height = "50px";
        }
        if ($(window).width() < 380) {
            $('.in').removeClass('px-3');
        } else {
            $('.in').addClass('px-3');
        }
    });
    $(window).resize(function() {
        if ($(window).width() > 1270) {
            $('#fzl_vgec').addClass('col-lg-5');
            $('#fzl_vgec').addClass('col-md-6');
            $('#fzl_vgec').removeClass('col-lg-11');
            $('#fzl_vgec').removeClass('col-md-11');
            $('#fzl_logo').addClass('col-lg-7');
            $('#fzl_logo').addClass('col-md-6');
            $('#fzl_logo').removeClass('col-lg-1');
            $('#fzl_logo').removeClass('col-md-1');
            $('#navbarContent').removeClass('show');
        } else {
            $('#fzl_vgec').addClass('col-lg-11');
            $('#fzl_vgec').addClass('col-md-11');
            $('#fzl_vgec').removeClass('col-lg-5');
            $('#fzl_vgec').removeClass('col-md-6');
            $('#fzl_logo').addClass('col-lg-1');
            $('#fzl_logo').addClass('col-md-1');
            $('#fzl_logo').removeClass('col-lg-7');
            $('#fzl_logo').removeClass('col-md-6');
        }
        if ($(window).width() < 380) {
            $('.in').removeClass('px-3');
        } else {
            $('.in').addClass('px-3');
        }
    });

</script>
<?php include('footer.php'); ?>
<script defer src="nav.js"></script>
<script>    
    // Chart Api:

    // function makeChart(){
    //     $.ajax({
    //         url: "data.php",
    //         method: "POST", 
    //         data : {action : 'fetch'},
    //         dataType:"JSON",
    //         success:function(data){
    //             var label = [];
    //             var pfCount = [];
    //             var color = [];

    //             for(var count = 0; count < data.length; count++){
    //                 label.push(data[count].label);
    //                 pfCount.push(data[count].pfCount);
    //                 color.push(data[count].color);
    //             }
    //         }   
    //         var chartData = {
    //             labels: label;
    //             datasets:[{
    //                 label : 'Pass-Fail Ratio',
    //                 backgroundColor: color,
    //                 color : '#fff',
    //                 data : pfCount
    //             }]
    //         };

    //         var option = {
    //             responsive: true,
    //             scales:{
    //                 yAxes : [{
    //                     ticks: {
    //                         min: 0
    //                     }
    //                 }]
    //             }
    //         };

    //         var groupChart = $($pieChart);
    //         var graph1 = new Chart(groupChart,{
    //             type : "pie",
    //             data : chartData
    //         });

    //     })
    // }
    
</script>
<!-- jQuery -->

<script src="js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable();
        $('#example tbody').on('mouseenter', 'td', function() {
            var colIdx = table.cell(this).index().column;
            $(table.cells().nodes()).removeClass('highlight');
            $(table.column(colIdx).nodes()).addClass('highlight');
        });
        $(".sorting:contains(More)").removeClass('sorting');
    });
</script>
</body>

</html>
