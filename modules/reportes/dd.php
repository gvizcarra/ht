<?php



//***************************************
// This is downloaded from www.plus2net.com //
/// You can distribute this code with the link to www.plus2net.com ///
//  Please don't  remove the link to www.plus2net.com ///
// This is for your learning only not for commercial use. ///////
//The author is not responsible for any type of loss or problem or damage on using this script.//
/// You can use it at your own risk. /////
//*****************************************

require 'config.php';

//////// End of connecting to database ////////

@$cat=$_GET['cat']; // Use this line or below line if register_global is off
//@$cat=$HTTP_GET_VARS['cat']; // Use this line or above line if register_global is off
/*
If register_global is off in your server then after reloading of the page to get the value of cat from query string we have to take special care.
To read more on register_global visit.
  http://www.plus2net.com/php_tutorial/register-globals.php
*/

?>

<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Multiple drop down list box from plus2net</title>
<SCRIPT language=JavaScript>
<!--
function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value;
self.location='dd.php?cat=' + val ;
}
function disableselect()
{
<?Php
if(isset($cat) and strlen($cat) > 0){
echo "document.f1.subcat.disabled = false;";}
else{echo "document.f1.subcat.disabled = true;";}
?>
}
//-->

</script>
</head>

<body onload=disableselect();>

<?Php
///////// Getting the data from Mysql table for first list box//////////
$quer2="SELECT DISTINCT descripcion,id_zona FROM zonas order by id_zona"; 
if(isset($cat) and strlen($cat) > 0){
$quer="SELECT DISTINCT id_zona, id_mes, meses_descripcion FROM v_estrategias where id_zona=$cat order by id_mes"; 
}else{$quer="SELECT DISTINCT id_zona, meses_descripcion FROM v_estrategias order by id_zona"; } 

echo "<form method=post name=f1 action='dd-check.php'>";
echo "<select name='cat' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
foreach ($dbo->query($quer2) as $noticia2) {
if($noticia2['id_zona']==@$cat){echo "<option selected value='$noticia2[id_zona]'>$noticia2[descripcion]</option>"."<BR>";}
else{echo  "<option value='$noticia2[id_zona]'>$noticia2[descripcion]</option>";}
}
echo "</select>";
echo "<select name='subcat'><option value=''>Select one</option>";
foreach ($dbo->query($quer) as $noticia) {
echo  "<option value='$noticia[id_mes]'>$noticia[meses_descripcion]</option>";
}
echo "</select>";
echo "<input type=submit value=Submit>";
echo "<input name="Enviar" type="submit" value="Buscar Datos" class="button2">";
echo "</form>";
?>
<br><br>
<a href=dd.php>Reset and start again</a>
<br><br>
<center><a href='http://www.plus2net.com' rel="nofollow">PHP SQL HTML free tutorials and scripts</a></center> 
</body>

</html>
