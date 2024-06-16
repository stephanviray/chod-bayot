const nav = document.getElementById('ul_id') ;


const hamIcon = () =>{
   nav.classList.toggle('active') ; //adds a class name active to the selected element.
   const icon = document.getElementById('hamburger-icon');
   icon.textContent = icon.textContent == "menu" ? "menu_open" : "menu";
}

//dob and age calculation:
function age()
{
var userinp=document.getElementById("select_dob").value;
var DOB=new Date(userinp);//converts the user selected in systems format.

    //gets year,month and day from the converted date.
    var year = DOB.getFullYear();
    var month = DOB.getUTCMonth()+1;//we are adding +1 here because javascript returns month in terms of 0 to 11
    var day = DOB.getUTCDate();

    var date = new Date();//gets the current date from system.
    //gets current year , month and days from thr system date.
     var c_year = date.getFullYear();
     var c_month= date.getMonth()+1;
     var c_day=date.getDate();
     var m1=[31,28,31,30,31,30,31,31,30,31,30,31];
     if(day>c_day)
     {
        c_day=c_day+m1[c_month-1];
        c_month=c_month-1;
     }
     if(month>c_month)
     {
        c_month=c_month+12;
        c_year=c_year-1;
    }
    var d=c_day-day;
    var m=c_month-month;
    var y=c_year-year;




    document.getElementById('disp_age').className='visible';
    if(m>1)
    return document.getElementById('disp_age').innerHTML="You are:"+y+" years "+m+" months "+d+" days old.";
    else
    return document.getElementById('disp_age').innerHTML="You are:"+y+" years "+m+" month "+d+" days old.";
}

//auto recommendation:-
const doc_list={
   "General":["Dr.A","Dr.B","Dr.C"],
   "ENT":["Dr.D","Dr.E"],
   "Cardiologist":["Dr.F","Dr.G"],
   "Neurologist":["Dr.H","Dr.I"],
   "Orthopedic":["Dr.J","Dr.K","Dr.L"],
   "Others":["We will suggest you shortly"]
}
window.onload=function()
{
   var x = document.getElementById("opd");
   var d =document.getElementById("doc_sel");

   for(var i in doc_list)
   {
      console.log(i);
      x.options[x.options.length]=new Option(i,i);
   }
   x.onchange=function()
   {
      d.length=1;
      for(var y in doc_list[this.value] )
      {
         var temp=doc_list[this.value][y];
         d.options[d.options.length]=new Option(temp,y)
      }
   }

   function sub()
   {
      document.getElementById('texto').innerHTML = "Thank you"; 
   }
}
//user input verifications:
function checkInp1()
{
    var x=document.getElementById("fname").value;
    var regex=/^[a-zA-Z]+$/;
    if (!x.match(regex))
    {
        alert("Must input string");
        
    }
}

   function checkInp2()
{
    var x=document.getElementById("lname").value;
    var regex=/^[a-zA-Z]+$/;
    if (!x.match(regex))
    {
        alert("Must input string");
        
        
    }
}

function checkInp3()
{
    var x=document.getElementById("pnumb").value;
    if ((x%1) != 0) 
    {
        alert("Must input numbers");
        
    }
}

function mysub()
{
   alert("Your Appointment has been booked");
}
