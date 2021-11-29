<?php

$deci = "";
$number = "" ;
$ones = array("صفر","واحد","اثنين","ثلاثة","أربع","خمسة", "ست","سبعة","ثمانية","تسعة");
$tens = array("عشرة","عشرون","ثلاثين","أربعين","خمسون","ستين","سبعون","ثمانون","تسعون"); 
$hundreds = array("مائة","مائتان","ثلاثمائة","أربعمائة","خمسمائة","ستمائة","سبعمائة","ثمان مائة","تسعمائة");
$thousands = array("ألف","ألفان","ثلاثة آلاف","أربعة آلاف","خمسة آلاف","ستة آلاف","سبعة آلاف","ثمانية آلاف","تسعة آلاف");
$tenThousands = array("عشرة آلاف",
      "عشرين ألف",
      "ثلاثين ألف",
      "أربعين ألف",
      "خمسين ألف",
      "ستين ألف",
      "سبعين ألف",
      "ثمانين ألف",
      "تسعين ألف");
    
$hundredThousand = array("مائة ألف",
      "مائتان ألف",
      "ثلاثمائة ألف",
      "أربعمائة ألف",
      "خمسمائة ألف",
      "ستمائة ألف",
      "سبعمائة ألف",
      "ثمانمائة ألف",
      "تسعة مئة ألف");
$afterTen = array("عشرة",
      "أحد عشر",
      "اثنا عشر",
      "ثلاثة عشر",
      "أربعة عشر",
      "خمسة عشر",
      "ستة عشر",
      "سبعة عشر",
      "ثمانية عشر",
      "تسعة عشر");
	 

function number_to_words_in_arabic($number)
{ 
       return inWords ($number);        
}
     

function inWords ($num) {
	
	
		  
    if (strlen($num) > 0){
		
        if (strpos($num, ".") == true){
            $numDeci = substr($num, strpos($num, ".") + 1);
			
            if(strlen($numDeci) == 1){
                $numDeci .= 0;
                $deci = $numDeci;  
		
                
            } else{
                
                $deci = substr($numDeci, 0, 2);    
                //console.log(deci);
            }
			
			
            $number = substr($num, 0, strpos($num, "."));
           
        }
		else
        {
          $number = $num;
		  
		 
          $deci = "";
		  
        }
		
        if (strlen($number) == 1 ){
            $number = $ones[$number];
			 
        }
        else if (strlen($number) == 2){
			
            $number = tensWord($number);
			
			
			
        }
        else if (strlen($number) == 3){
            $number = hundredWord($number);
        }
        else if (strlen($number) == 4){
            $number = thousandsWord($number);
        }
        else if (strlen($number) == 5) {
            $number= tenThousandsWord($number);
        }
        else if (strlen($number) == 6){
            $number = hundredThousandWord($number);
        }
        else if (strlen($number) == 7 ){
            $number = million($number);  
        }
        else if (strlen($number) == 8 ){
            $number = tenMillion($number);
        }
        else if (strlen($number) == 9 ){
            $number = hundredMillion($number);
        } else {
            $number = "Not Allow";       
        }
                              
        $deci = !($deci == "00" || $deci == "") ? " و" . tensWord($deci) . " هللة " : "";
        
		
		
    }

    return $number . " ريال" . $deci;
    
}
    
    function tensWord($x)
    {
	 
    // access global varibles
	global $ones;
	global $tens;
	global $hundreds;
	global $thousands;
	global $tenThousands;
	global $hundredThousand;
	global $afterTen;
	
      if ($x < 20)
      {
		  
        if (substr($x, 0, 1) == "0"){
			
          return  $ones[substr($x,1)];
        }
		
		
        return $afterTen[$x - 10];
      }
      if (substr($x,1) == "0"){
		 
        return $tens[substr($x, 0, 1) - 1];
      }
     
	  return $ones[substr($x,1)] . " و " . $tens[substr($x,0,1) - 1];
    }


    function hundredWord($x){
    
	// access global varibles
	global $ones;
	global $tens;
	global $hundreds;
	global $thousands;
	global $tenThousands;
	global $hundredThousand;
	global $afterTen;
	
       if (substr($x,0, 1) == "0" ){
         return "";  
       } else {
           return " " . $hundreds[substr($x,0, 1) - 1] . (substr($x,1) == "00" ? "" : " و " . tensWord(substr($x,1)));
       }
    }
    
    function thousandsWord($x)
    {
		// access global varibles
	global $ones;
	global $tens;
	global $hundreds;
	global $thousands;
	global $tenThousands;
	global $hundredThousand;
	global $afterTen;
	
      $str = substr($x,0, 1) == "0" ? "" : " " . $thousands[substr($x,0, 1) - 1];
      if (substr($x,1) != "000"){
          
        $str = substr($x,1) < 100 ? $str . " و " . tensWord(substr($x,2)) : $str . " و " . hundredWord(substr($x,1));
      }
      return $str;
    }

    function tenThousandsWord($x)
    {
		// access global varibles
	global $ones;
	global $tens;
	global $hundreds;
	global $thousands;
	global $tenThousands;
	global $hundredThousand;
	global $afterTen;
	
      $str = substr($x,0, 2) == "00" ? "" : tensWord(substr($x,0, 2)) . " ألف";
      if (substr($x,2) != "000"){
        $str = substr($x,2) < 100 ? $str . " و " . tensWord(substr($x,3)) : $str . " و " . hundredWord(substr($x,2));
      }
      return $str;
    }

    function hundredThousandWord($x)
    {
		// access global varibles
	global $ones;
	global $tens;
	global $hundreds;
	global $thousands;
	global $tenThousands;
	global $hundredThousand;
	global $afterTen;
	
      $str = substr($x,0, 3) == "000" ? "" : hundredWord(substr($x,0, 3)) . " ألف";
      if (substr($x,3) != "000"){
        $str = substr($x,3) < 100 ? $str . " و " . tensWord(substr($x,4)) : $str . " و " . hundredWord(substr($x,3));
      }
      return $str;
    }

    function million($x)
    {
		// access global varibles
	global $ones;
	global $tens;
	global $hundreds;
	global $thousands;
	global $tenThousands;
	global $hundredThousand;
	global $afterTen;
	
      $str = substr($x,0, 1) == "0" ? "" : ones[substr($x,0, 1)] . " مليون";
      if (substr($x,1) != "000000"){
        $str = substr($x,1) < 100000 ? $str  . tenThousandsWord(substr($x,2)) : $str . " و " . hundredThousandWord(substr($x,1));
      }
      return $str;
    }

    function tenMillion($x)
    {
		// access global varibles
	global $ones;
	global $tens;
	global $hundreds;
	global $thousands;
	global $tenThousands;
	global $hundredThousand;
	global $afterTen;
	
      $str = substr($x,0, 2) == "00" ? "" : tensWord(substr($x,0, 2)) . " مليون";
      if (substr($x,2) != "000000")
        $str =substr($x,2) < 100000 ? $str .  tenThousandsWord(substr($x,3)) : $str . " و " . hundredThousandWord(substr($x,2));
      return $str;
    }

    function hundredMillion($x)
    {
		// access global varibles
	global $ones;
	global $tens;
	global $hundreds;
	global $thousands;
	global $tenThousands;
	global $hundredThousand;
	global $afterTen;
	
      $str = substr($x,0, 3) == "000" ? "" : hundredWord(substr($x,0, 3)) . " مليون";
      if (substr($x,3) != "000000")
        $str = substr($x,3) < 100000 ? $str .  tenThousandsWord(substr($x,4)) : $str . " و " . hundredThousandWord(substr($x,3));
      return $str;
    }

   
    
?>