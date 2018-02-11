<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<link href="Beatiful.css" rel="stylesheet" />
<div id = "wrapper">
<head>
    <center>
    <link href="Beatiful.css" rel="stylesheet" />
    <div class = "Head" align = "center">Calculator</div><br><br>
    
    <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn">Choose 
 Menu.......</button>
    <div id="myDropdown" class="dropdown-content">
    <a id= "BMI1" href="#BMI">Body Mass Index (BMI)</a>
    <a id= "BMR1" href="#BMR">Basal Metabolic Rate (BMR)</a>
    <a id= "CO1" href="#CO">คำนวณคอเลสเตอรอล</a>
  </div>
    </form>
</div>
</center>
    
</head>

<body>
    <center>
    
    <form id = "menu1"  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <br>
    <div>Body Mass Index (BMI)</div><br>
    ส่วนสูง/เซนติเมตร: <input type="text" name="h12" placeholder="ส่วนสูง....." id="hin"> <br>
    น้ำหนัก/กิโลกรัม: <input type = "text" name="w12" placeholder="น้ำหนัก....." id="win"><br>
    <input type="submit" name="BMIMENU">
</form>


    <form id = "menu2"  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <br>
    <div>Basal Metabolic Rate (BMR)</div><br>
    ส่วนสูง/เซนติเมตร: <input type="text" name="h122" placeholder="ส่วนสูง....."> <br>
    น้ำหนัก/กิโลกรัม: <input type = "text" name="w122" placeholder="น้ำหนัก....."><br>
    อายุ/ปี: <input type = "text" name="age122" placeholder="อายุ....."><br>
    Gender:
    <input type="radio" name="genderJ"  value="female" checked >Female
    <input type="radio" name="genderJ"  value="male">Male
    <br>
    <label>การออกกำลังกาย :</label>
    <select name="ALLCASE">
      <option value="case0" >-------------</option>
      <option value="case1" >ไม่ได้ออกกำลังกายเลย</option>
      <option value="case2" >ออกกำลังกาย อาทิตย์ละ 1-3วัน</option>
      <option value="case3" >ออกกำลังกาย อาทิตย์ละ 3-5วัน</option>
      <option value="case4" >ออกกำลังกาย อาทิตย์ละ 6-7วัน</option>
      <option value="case5" >ออกกำลังกายอย่างหนักทุกวัน</option>
    </select>
    <br>
    <input type="submit" name="BMRMENU">
    
    </form>
    

    <form id = "menu3"  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <br>
    <div>คำนวณคอเลสเตอรอล</div><br>
    ไขมันแอลดีแอล: <input type="text" name="LDL" placeholder="ไขมันแอลดีแอล....."> <br>
    ไขมันเอชดีแอล: <input type = "text" name="HDL"placeholder="ไขมันเอชดีแอล....."><br>
    ไตรกลีเซอไรด์  <input type = "text" name="TRI"placeholder="ไขมันกลีเซอไรด์....."><br>
    <input type="submit" name="COMENU">
    
    </form>
    <br>  
  <div>ผลลัพธ์</div>
    <br>----------------------------------------<br>
</center>

<script src="jquery-3.3.1.min.js" charset="utf-8"></script>
    <script>
        $('#menu1').hide();
        $('#menu2').hide();
        $('#menu3').hide();
        $('#BMI1').click(function(){
            $('#menu1').show();
            $('#menu2').hide();
            $('#menu3').hide();
            
        });
        $('#BMR1').click(function(){
            $('#menu2').show();
            $('#menu3').hide();
            $('#menu1').hide();
        });
        $('#CO1').click(function(){
            $('#menu3').show();
            $('#menu2').hide();
            $('#menu1').hide();
        });

        function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
    
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

    </script>
<center>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['BMIMENU'])) {
    $weight = htmlspecialchars($_REQUEST['w12']); 
    $hight = ((htmlspecialchars($_REQUEST['h12'])*0.01)**2); 
    if(is_numeric($weight) && is_numeric($hight)){
        $result = $weight/$hight;
        if($result>30){
            echo "ค่าBMI = ".$result."   อ้วนมาก";
        }else if($result<=30 && $result>= 25){
            echo "ค่าBMI = ".$result."   อ้วน";
        }else if($result>=23 && $result<25){
            echo "ค่าBMI = ".$result."   น้ำหนักเกิน";
        }else if($result>=18.6 && $result<23){
            echo "ค่าBMI = ".$result."   น้ำหนักปกติ";
        }else{
            echo "ค่าBMI = ".$result."   ผอมเกินไป";
        }
    }
    else{
        echo "Please input numeric ";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['BMRMENU'])) {
    $weight1 = htmlspecialchars($_REQUEST['w122']); 
    $hight1 = htmlspecialchars($_REQUEST['h122']); 
    $age = htmlspecialchars($_REQUEST['age122']); 
    if(is_numeric($weight1) && is_numeric($hight1) && is_numeric($age)){
        if($_POST['genderJ']=="female"){
            $result = (665+(9.6*$weight1)+(1.8*$hight1)-(4.7*$age));
            if($_POST['ALLCASE']=="case1"){
                $result *= 1.22 ;
            }else if($_POST['ALLCASE']=="case2"){
                $result *= 1.375 ;
            }else if($_POST['ALLCASE']=="case3"){
                $result *= 1.55 ;
            }else if($_POST['ALLCASE']=="case4"){
                $result *= 1.725 ;
            }else if($_POST['ALLCASE']=="case5"){
                $result *= 1.9 ;
            }
            echo "BMR (Basal Metabolic Rate) พลังงานที่จำเป็นพื้นฐานในการมีชีวิตของผู้หญิง =  ".$result. "กิโลแคลอรี่";
        }else if($_POST['genderJ']=="male"){
            $result = (66+(13.7*$weight1)+(5*$hight1)-(6.8*$age));
            if($_POST['ALLCASE']=="case1"){
                $result *= 1.22 ;
            }else if($_POST['ALLCASE']=="case2"){
                $result *= 1.375 ;
            }else if($_POST['ALLCASE']=="case3"){
                $result *= 1.55 ;
            }else if($_POST['ALLCASE']=="case4"){
                $result *= 1.725 ;
            }else if($_POST['ALLCASE']=="case5"){
                $result *= 1.9 ;
            }
            echo "BMR (Basal Metabolic Rate) พลังงานที่จำเป็นพื้นฐานในการมีชีวิตของผู้ชาย =  ".$result. "กิโลแคลอรี่";
            }
        }
    
    else{
        echo "Please input numeric ";
    }
}
    

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['COMENU'])) {
    $L1 = htmlspecialchars($_REQUEST['LDL']); 
    $H1 = htmlspecialchars($_REQUEST['HDL']); 
    $T1 = htmlspecialchars($_REQUEST['TRI']); 
    if(is_numeric($L1) && is_numeric($H1) && is_numeric($T1)){
        $result = $L1+$H1+($T1/5);
        if($result<200){
            echo $result."   ระดับดีมาก";
        }else if($result>=200 && $result<240){
            echo $result."   ระดับค่อนข้างสูง";
        }else if ($result>=240){
            echo $result."   ระดับค่อนข้างสูง";
        }
    }else{
        echo "Please input numeric ";
    }
}




?>
</center>
    
</body>
</div>
</html>