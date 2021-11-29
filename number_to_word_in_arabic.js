function number_to_words_in_arabic(number){
        
    
         document.write(inWords (number));
          
        }
        
    
        
var deci = "";
var number = "" ;
var ones = ["صفر","واحد","اثنين","ثلاثة","أربع","خمسة", "ست","سبعة","ثمانية","تسعة"];
var tens = ["عشرة","عشرون","ثلاثين","أربعين","خمسون","ستين","سبعون","ثمانون","تسعون"]; 
var hundreds = ["مائة","مائتان","ثلاثمائة","أربعمائة","خمسمائة","ستمائة","سبعمائة","ثمان مائة","تسعمائة"];
var thousands = ["ألف","ألفان","ثلاثة آلاف","أربعة آلاف","خمسة آلاف","ستة آلاف","سبعة آلاف","ثمانية آلاف","تسعة آلاف"];
var tenThousands = ["عشرة آلاف",
      "عشرين ألف",
      "ثلاثين ألف",
      "أربعين ألف",
      "خمسين ألف",
      "ستين ألف",
      "سبعين ألف",
      "ثمانين ألف",
      "تسعين ألف"];
    
var hundredThousand = ["مائة ألف",
      "مائتان ألف",
      "ثلاثمائة ألف",
      "أربعمائة ألف",
      "خمسمائة ألف",
      "ستمائة ألف",
      "سبعمائة ألف",
      "ثمانمائة ألف",
      "تسعة مئة ألف"];
var afterTen = ["عشرة",
      "أحد عشر",
      "اثنا عشر",
      "ثلاثة عشر",
      "أربعة عشر",
      "خمسة عشر",
      "ستة عشر",
      "سبعة عشر",
      "ثمانية عشر",
      "تسعة عشر"];

function inWords (num) {
    if (num.length > 0){
        if (num.indexOf(".") >= 0){
            var numDeci = num.substring(num.indexOf(".")+1);
            if(numDeci.length == 1){
                numDeci += 0;
                deci = numDeci;    
                
            } else{
                
                deci = numDeci.substring(0, 2);    
                console.log(deci);
            }
            number = num.substring(0, num.indexOf("."));
            
        } else
        {
          number = num;
          deci = "";
        }
        if (number.length == 1 ){
            number = ones[number];
        }
        else if (number.length == 2){
            number = tensWord(number);
        }
        else if (number.length == 3){
            number = hundredWord(number);
        }
        else if (number.length == 4){
            number = thousandsWord(number);
        }
        else if (number.length == 5) {
            number= tenThousandsWord(number);
        }
        else if (number.length == 6){
            number = hundredThousandWord(number);
        }
        else if (number.length == 7 ){
            number = million(number);  
        }
        else if (number.length == 8 ){
            number = tenMillion(number);
        }
        else if (number.length == 9 ){
            number = hundredMillion(number);
        } else {
            number = "Not Allow";       
        }
                              
        deci = !(deci == "00" || deci == "") ? " و" + tensWord(deci) + " هللة " : "";
        
    }
    return number + " ريال" + deci;
    
}
    
    function tensWord(x)
    {
      if (x < 20)
      {
        if (x.substring(0, 1) == "0"){
          return ones[x.substring(1)];
        }
        return afterTen[x - 10];
      }
      if (x.substring(1) == "0"){
        return tens[x.substring(0, 1) - 1];
      }
      return ones[x.substring(1)] + " و " + this.tens[x.substring(0, 1) - 1];
    }

    function hundredWord(x){
    
       if (x.substring(0, 1) == "0" ){
         return "";  
       } else {
           return " " + hundreds[x.substring(0, 1) - 1] + (x.substring(1) == "00" ? "" : " و " + tensWord(x.substring(1)));
       }
    }
    
    function thousandsWord(x)
    {
      var str = x.substring(0, 1) == "0" ? "" : " " + thousands[x.substring(0, 1) - 1];
      if (x.substring(1) != "000"){
          console.log(x.substring(1));
        str = x.substring(1) < 100 ? str + " و " +tensWord(x.substring(2)) : str + " و " + this.hundredWord(x.substring(1));
      }
      return str;
    }

    function tenThousandsWord(x)
    {
      var str = x.substring(0, 2) == "00" ? "" : tensWord(x.substring(0, 2)) + " ألف";
      if (x.substring(2) != "000"){
        str = x.substring(2) < 100 ? str + " و " +tensWord(x.substring(3)) : str + " و " + this.hundredWord(x.substring(2));
      }
      return str;
    }

    function hundredThousandWord(x)
    {
      var str = x.substring(0, 3) == "000" ? "" : hundredWord(x.substring(0, 3)) + " ألف";
      if (x.substring(3) != "000"){
        str = x.substring(3) < 100 ? str + " و " +tensWord(x.substring(4)) : str + " و " + this.hundredWord(x.substring(3));
      }
      return str;
    }

    function million(x)
    {
      var str = x.substring(0, 1) == "0" ? "" : ones[x.substring(0, 1)] + " مليون";
      if (x.substring(1) != "000000"){
        str = x.substring(1) < 100000 ? str  + tenThousandsWord(x.substring(2)) : str + " و " + hundredThousandWord(x.substring(1));
      }
      return str;
    }

    function tenMillion( x)
    {
      var str = x.substring(0, 2) == "00" ? "" : tensWord(x.substring(0, 2)) + " مليون";
      if (x.substring(2) != "000000")
        str = x.substring(2) < 100000 ? str +  tenThousandsWord(x.substring(3)) : str + " و " + hundredThousandWord(x.substring(2));
      return str;
    }

    function hundredMillion(x)
    {
      var str = x.substring(0, 3) == "000" ? "" : hundredWord(x.substring(0, 3)) + " مليون";
      if (x.substring(3) != "000000")
        str = x.substring(3) < 100000 ? str +  tenThousandsWord(x.substring(4)) : str + " و " + hundredThousandWord(x.substring(3));
      return str;
    }