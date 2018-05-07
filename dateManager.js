
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
