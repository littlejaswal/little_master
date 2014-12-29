function popUp(URL) 
{
day = new Date();
id = day.getTime();
test=eval("page" + id + " = window.open(URL, '" + id + "','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=630,height=700,top=200');");
test.moveTo(120,100);
}