// function mydate()
// {
// document.getElementById("dt").hidden=false;
// document.getElementById("ndt").hidden=true;
// }
// function mydate1()
// {
//  d=new Date(document.getElementById("dt").value);
// dt=d.getDate();
// mn=d.getMonth();
// mn++;
// yy=d.getFullYear();
// document.getElementById("ndt").value=dt+"/"+mn+"/"+yy
// document.getElementById("ndt").hidden=false;
// document.getElementById("dt").hidden=true;
// }

// function mydate(field1, field2)
// {
// document.getElementById(field1).hidden=false;
// document.getElementById(field2).hidden=true;
// }
// function mydate1(field1, field2)
// {
// d=new Date(document.getElementById(field1).value);
// dt=d.getDate();
// mn=d.getMonth();
// mn++;
// yy=d.getFullYear();
// document.getElementById(field2).value=dt+"/"+mn+"/"+yy
// document.getElementById(field2).hidden=false;
// document.getElementById(field1).hidden=true;
// }

function mydate(field1, field2)
{
document.getElementsByName(field1)[0].hidden=false;
document.getElementsByName(field2)[0].hidden=true;
}
function mydate1(field1, field2)
{
d=new Date(document.getElementById(field1).value);
dt=d.getDate();
mn=d.getMonth();
mn++;
yy=d.getFullYear();
document.getElementsByName(field2)[0].value=dt+"/"+mn+"/"+yy
document.getElementsByName(field2)[0].hidden=false;
document.getElementsByName(field1)[0].hidden=true;
}
