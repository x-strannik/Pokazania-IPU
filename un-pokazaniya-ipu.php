<?php 
/*
Plugin Name: Pokazania IPU
Plugin URI: https://kodabra.unchikov.ru/pokazania-ipu/
Description: Передача показаний счётчиков ЖКХ (шорткод [un_pokazaniya_ipu])
Author: Elena Unchikova
Version: 1.0.0
Author URI: https://kodabra.unchikov.ru/
License: GPL2
*/

// Выход при прямом доступе.
     if ( ! defined( 'ABSPATH' ) ) { exit; }
   
add_shortcode( 'un_pokazaniya_ipu', 'un_pokazaniya_ipu_f' ); // шорткод [un_pokazaniya_ipu]
function un_pokazaniya_ipu_f() {
ob_start();

// *******************************************************
?> 
<link rel="stylesheet" href="<?php echo plugins_url( 'script/chosen.min.css' , __FILE__ );?>">
<style type="text/css">
.select_wrp {
	width: 100%;
}
div.wpcf7 .ajax-loader {
    display: none;
}
div.wpcf7 .ajax-loader.is-active {
    visibility: hidden !important;
}
[type="button"], [type="submit"], [type="reset"] {
    height: 4em !important;
	font-size: 110%;
    font-weight: 700;
}
</style>
<script src="<?php echo plugins_url( 'script/chosen.jquery.min.js' , __FILE__ );?>"></script>
<div id="pokzn" class="" style="">
<?php
$opt_val1 = get_option('un-pokazaniya-ipu-option-maxlength');
if (($opt_val1!=='') and isset($opt_val1))
{
$ov1 = $opt_val1;	
}else{
$ov1 = '12';	
}

$opt_val2 = get_option('un-pokazaniya-ipu-option-datan');
if (($opt_val2!=='') and isset($opt_val2))
{
$ov2 = $opt_val2;	
}else{
$ov2 = '15';	
}

$opt_val3 = get_option('un-pokazaniya-ipu-option-datak');
if (($opt_val3!=='') and isset($opt_val3))
{
$ov3 = $opt_val3;	
}else{
$ov3 = '25';	
}

$opt_val4 = get_option('un-pokazaniya-ipu-option-email');
if (($opt_val4!=='') and isset($opt_val4))
{
$ov4 = $opt_val4;	
}else{
$ov4 = get_option('admin_email');	
}

$opt_val5 = get_option('un-pokazaniya-ipu-option-zagolovok');
if (($opt_val5!=='') and isset($opt_val5))
{
$ov5 = $opt_val5;	
}else{
$ov5 = 'Передать показания приборов учета горячей воды';	
}

$opt_val6 = get_option('un-pokazaniya-ipu-option-email');
if (($opt_val6!=='') and isset($opt_val6))
{
$ov6 = $opt_val6;	
}else{
$ov6 =  get_option('admin_email');	
}

$opt_val7 = get_option('un-pokazaniya-ipu-option-logo');
if (($opt_val7!=='') and isset($opt_val7))
{
$ov7 = $opt_val7;	
}else{
$ov7 =  get_custom_logo();	
}
?>
<span class="zag" id="zag"><h2 style="text-align: center !important;margin-top: -40px;" id="rezzet"><?php echo $ov5;?></h2></span>		
<p>
<div class="datotpr" style="text-align: right; padding-right: 1.06383%; max-width: var(--max-cf7sg-form-width,940px);">
<span class="">Дата последнего сообщения: </span><span id="dot" class="dot" style=""></span>
</div>
<div class="dattek">
<?php
$date_today = date("d.m.y");
$today[1] = date("H:i:s"); 
?>
<input type="hidden" name="dte" <?php echo "value='$date_today'";?> class="dte" id="dte" />
</div>

<form action="" method="post" id="pokacc" class=""> 
       <div class="field">
<span>
<input type='text' placeholder="Введите номер лицевого счета" name='serch' <?php if(isset($str)) echo "value='$str'";?> size="40" id="nl" style="width: 100%;" <?php echo "maxlength='$ov1' minlength='$ov1'";?>>
</span>
<p class="info-tip">&nbsp;</p>        
      </div>    
      <div class="field">
<div class="select_wrp">
<select class="js-chosen" type='text' name='serch1' <?php if(isset($str1)) echo "value='$str1'";?> style="width: 100%;" id="uli" >
		<option value=""></option>
		<?php include( plugin_dir_path( __FILE__ ) . 'ipu/street.php' ); ?>		
</select>
</div>
<p class="info-tip">&nbsp;</p>            
      </div>
        
<script>
jQuery(function($) {	
	document.getElementById( "tema" ).value = "Показания ИПУ через сайт";
	document.getElementById( "dop30" ).style = "display: none;";
if(localStorage.getItem('uli')) {
		$('.js-chosen').chosen({
		width: '100%',
		no_results_text: 'Совпадений не найдено',
		placeholder_text_single: [localStorage.getItem('uli')]
	});
		} else {
        $('.js-chosen').chosen({
		width: '100%',
		no_results_text: 'Совпадений не найдено',
		placeholder_text_single: 'Выберите улицу'
	});
		}	

});
</script>
     
      <div class="field">
<input type='submit' name='go' value="Найти счетчики" class="icon-down-big wm-button text-center color-red" id="ns" style="width: 100%;" form="pokacc">           
      </div>
</form>

<?php
include( plugin_dir_path( __FILE__ ) . 'ipu/massiv.php' );

function search($mass,$scht,$ulitsa)
{
$i=0;
do
if(($mass[$i]['scht'] == $scht) and ($mass[$i]['ulitsa'] == $ulitsa))
return array('sct' => $mass[$i]['scht'], 'ip1' => $mass[$i]['ipu1'], 'adr' => $mass[$i]['adres'], 'pkp1' => $mass[$i]['pkzp1'], 'ip2' => $mass[$i]['ipu2'], 'pkp2' => $mass[$i]['pkzp2'], 'ip3' => $mass[$i]['ipu3'], 'pkp3' => $mass[$i]['pkzp3']);

while(++$i<count($mass));
}

if(isset($_POST['go']) and !empty($_POST['serch']) and !empty($_POST['serch1']))
{
        $str = trim($_POST['serch']);
		$str1 = trim($_POST['serch1']);       
        $ids = search($mass,$str,$str1);   
		
if(isset($ids))
{    
?>
<script type='text/javascript'>
jQuery(document).ready(function($) {
  $('#ipun').val('<?php echo $ids['sct']; ?>');
  document.getElementById( "ipun" ).readOnly = true;
  $('#ipua').val('<?php echo $ids['adr']; ?>');
  document.getElementById( "ipua" ).readOnly = true;
  $('#ipus1').val('<?php echo $ids['ip1']; ?>');
  document.getElementById( "ipus1" ).readOnly = true;
  
  var xx = parseFloat('<?php echo $ids['pkp1']; ?>');
  if ((xx) || (xx == 0)) {
  $('#ipup1').val(xx);
  }
  document.getElementById( "ipup1" ).readOnly = true;
  
  $('#ipus2').val('<?php echo $ids['ip2']; ?>');
  document.getElementById( "ipus2" ).readOnly = true;
  
  var yy = parseFloat('<?php echo $ids['pkp2']; ?>');
  if ((yy) || (yy == 0)) {
  $('#ipup2').val(yy);
  }  
  document.getElementById( "ipup2" ).readOnly = true;
  
  $('#ipus3').val('<?php echo $ids['ip3']; ?>');
  document.getElementById( "ipus3" ).readOnly = true;
  
  var zz = parseFloat('<?php echo $ids['pkp3']; ?>');
  if ((zz) || (zz == 0)) {
  $('#ipup3').val(zz);
  }    
  document.getElementById( "ipup3" ).readOnly = true;
  
  document.getElementById( "tema" ).value = "Показания ИПУ от ЛС через сайт"; 
if (device.mobile() || device.tablet()) {
document.getElementById( "klnd" ).style = "display: none;";
document.getElementById( "pokzn" ).style = "width: 100%;";
} else {
document.getElementById( "klnd" ).style = "display: block;";
document.getElementById( "pokzn" ).style = "width: 70%;";
}
});
</script>
<?php
if ((($ids['ip1'])!=='') and isset($ids['ip1']))
{    
?>
<script type='text/javascript'>
jQuery(document).ready(function($) {
  document.getElementById( "iput1" ).style = "border: 2px dashed red";
});
</script>
<?php
}
if ((($ids['ip2'])!=='') and isset($ids['ip2']))
{    
?>
<script type='text/javascript'>
jQuery(document).ready(function($) {
  document.getElementById( "iput2" ).style = "border: 2px dashed red";
  document.getElementById( "iput2" ).required = true;
});
</script>
<?php
}
else {
?>
<script type='text/javascript'>
jQuery(document).ready(function($) {
  document.getElementById( "dop20" ).style = "display: none;";
});
</script>
<?php
}
if ((($ids['ip3'])!=='') and isset($ids['ip3']))
{    
?>
<script type='text/javascript'>
jQuery(document).ready(function($) {
  document.getElementById( "iput3" ).style = "border: 2px dashed red";
  document.getElementById( "iput3" ).required = true;
  document.getElementById( "dop30" ).style = "display: block;";
});
</script>
<?php
}
}
else echo '     
            <div class="field" style="color: red;">
Ничего не найдено! Введите правильный номер лицевого счета и улицу для поиска или заполните форму отправки показаний вручную.
            </div>         
<script type="text/javascript">
jQuery(document).ready(function($) {
if (device.mobile() || device.tablet()) {
document.getElementById( "klnd" ).style = "display: none;";
document.getElementById( "pokzn" ).style = "width: 100%;";
} else {
document.getElementById( "klnd" ).style = "display: block;";
document.getElementById( "pokzn" ).style = "width: 70%;";
}
});
</script>  
      ';
}
else echo '
            <div class="field">
<span  id="podsk">Введите номер лицевого счета и улицу для поиска или заполните форму отправки показаний вручную.</span>
            </div>
      ';
?>
</p>
<hr class="wm-divider" style="margin-bottom:0px;margin-top:20px">
<hr class="wm-divider" style="margin-bottom:0px;margin-top:20px">
<p>
<link rel="stylesheet" href="<?php echo plugins_url( 'script/style.css' , __FILE__ );?>" />
<script src="<?php echo plugins_url( 'script/gsap.min.js' , __FILE__ );?>"></script>
<div class="msg" onclick="gsapMsg.reverse()"></div>
<form action="<?php echo plugins_url( 'send.php' , __FILE__ );?>" method="post" id="form" onsubmit="send(event, '<?php echo plugins_url( 'send.php' , __FILE__ );?>')" class="">
      <div class="tem">
        <input type="hidden" name="subject" value="" class="" id="tema" />
		<input type="hidden" name="hurl" value="<?php echo home_url();?>" class="" id="hurl" />
		<input type="hidden" name="blgname" value="<?php echo get_bloginfo( 'name' );?>" class="" id="blgname" />
		<input type="hidden" name="blglogo" value="<?php echo $ov7;?>" class="" id="blglogo" />
		<input type="hidden" name="ov6" value="<?php echo $ov6;?>" class="" id="ov6" />
      </div>
            <div class="field"><label for="email" class="input-label">Ваша электронная почта:</label><span class=""><input type="email" name="email" value="" size="40" class="" id="ipum" aria-invalid="false" /></span>
              <p class="info-tip"></p>
            </div>
          <br>
            <div class="field"><label for="name" class="input-label">№ лицевого счета (000000012345):</label><span class=""><input type="tel" name="tel-610" value="" size="40" <?php echo "maxlength='$ov1' minlength='$ov1'";?> class="" id="ipun" aria-invalid="false"/></span>
              <p class="info-tip"></p>
            </div>
          <br>  
            <div class="field"><label>Адрес:<em style="color: red;">*</em></label><span class=""><input type="text" name="text-657" value="" size="40" class="" id="ipua" aria-required="true" aria-invalid="false" required/></span>
              <p class="info-tip"></p>
            </div>
          <br>
        <hr class="wm-divider" style="margin-bottom:0px;margin-top:20px">
      <br>
            <div class="field"><label>Счетчик 1 (номер, наименование или описание):<em style="color: red;">*</em></label><span class=""><input type="text" name="text-491" value="" size="40" class="" id="ipus1" aria-required="true" aria-invalid="false" required /></span>
              <p class="info-tip"></p>
            </div>
         <br>
            <div class="field"><label>Предыдущие показания:</label><span class=""><input type="text" name="text-876" value="" size="40" class="" id="ipup1" aria-invalid="false" /></span>
              <p class="info-tip"></p>
            </div>
          <br>
            <div class="field"><label>Текущие показания:<em style="color: red;">*</em></label><span class=""><input type="text" name="text-383" value="" size="40" class="" id="iput1" aria-required="true" aria-invalid="false" required  oninput="fn1(this);" /></span>
              <span id="info1" class=""><p class="info-tip"></p></span>
            </div>
          <br>
        <hr class="wm-divider" style="margin-bottom:0px;margin-top:20px">
      <br>
      <div id="dop20">
              <div class="field"><label>Счетчик 2 (номер, наименование или описание):</label><span class=""><input type="text" name="text-978" value="" size="40" class="" id="ipus2" aria-invalid="false" /></span>
                <p class="info-tip"></p>
              </div>
            <br>
              <div class="field"><label>Предыдущие показания:</label><span class=""><input type="text" name="text-789" value="" size="40" class="" id="ipup2" aria-invalid="false" /></span>
                <p class="info-tip"></p>
              </div>
            <br>
              <div class="field"><label>Текущие показания:</label><span class=""><input type="text" name="text-145" value="" size="40" class="" id="iput2" aria-invalid="false"  oninput="fn2(this);" /></span>
                <span id="info2" class=""><p class="info-tip"></p></span>
              </div>
            <br>
          <hr class="wm-divider" style="margin-bottom:0px;margin-top:20px">
        <br>
      </div>
      <div id="dop30">
              <div class="field" id="dop31"><label>Счетчик 3 (номер, наименование или описание):</label><span class=""><input type="text" name="text-926" value="" size="40" class="" id="ipus3" aria-invalid="false" /></span>
                <p class="info-tip"></p>
              </div>
            <br>
              <div class="field" id="dop32"><label>Предыдущие показания:</label><span class=""><input type="text" name="text-60" value="" size="40" class="" id="ipup3" aria-invalid="false" /></span>
                <p class="info-tip"></p>
              </div>
            <br>
              <div class="field" id="dop33"><label>Текущие показания:</label><span class=""><input type="text" name="text-419" value="" size="40" class="" id="iput3" aria-invalid="false"  oninput="fn3(this);" /></span>
                <span id="info3" class=""><p class="info-tip"></p></span>
              </div>
            <br>
          <hr class="wm-divider" style="margin-bottom:0px;margin-top:20px">
        <br>
      </div>
            <div class="field"><label for="texta" class="area-label">Дополнительная информация:</label><span class=""><textarea name="textarea-340" id="texta" cols="40" rows="4" class="" aria-invalid="false"></textarea></span>
              <p class="info-tip"></p>
            </div> 
            <div class="field"><label>&nbsp;</label><button type="submit" name="submit_ipu" class="submit button" style="height: auto;float:none;width: 100%" id="enableNotifications1">Отправить показания</button><br>
              <p class="info-tip"></p><br>
              <button type="submit" name='' class="icon-ccw wm-button text-center color-gray" style="height: auto;float:none;width: 100%" id="" form="pokacc"> Очистить форму</button>
            </div>
<div class="" aria-hidden="true"></div>
</form>
</p>
<script src="<?php echo plugins_url( 'script/script.js' , __FILE__ );?>"></script>
</div> 	
<?php
if((date('d') < $ov2) or (date('d') > $ov3)) // or and
{ 
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
  document.getElementById( "nl" ).readOnly = true; 
  document.getElementById( "uli" ).readOnly = true;
  document.getElementById( "podsk" ).innerHTML="Передать показания счетчиков можно с <?php echo $ov2;?>-го по <?php echo $ov3;?>-е число месяца.";
  document.getElementById( "podsk" ).style = "color: red;";
  document.getElementById( "ipum" ).readOnly = true;
  document.getElementById( "ipun" ).readOnly = true;
  document.getElementById( "ipua" ).readOnly = true;
  document.getElementById( "ipus1" ).readOnly = true;
  document.getElementById( "ipus2" ).readOnly = true;
  document.getElementById( "ipus3" ).readOnly = true;
  document.getElementById( "ipup1" ).readOnly = true;
  document.getElementById( "ipup2" ).readOnly = true;
  document.getElementById( "ipup3" ).readOnly = true;
  document.getElementById( "iput1" ).readOnly = true;
  document.getElementById( "iput2" ).readOnly = true;
  document.getElementById( "iput3" ).readOnly = true;
  document.getElementById( "texta" ).readOnly = true;
  document.getElementById( "enableNotifications1" ).type = "reset";
  document.getElementById( "ns" ).type = "reset";  
});
</script>
<?php
}
?>
<script type="text/javascript">
$('#ipun').on('input', function(){
	this.value = this.value.replace(/[^0-9]/g, '');
});
$('#iput1').on('input', function(){
	this.value = this.value.replace(/[^0-9\.\,]/g, '');
});
$('#iput2').on('input', function(){
	this.value = this.value.replace(/[^0-9\.\,]/g, '');
});
$('#iput3').on('input', function(){
	this.value = this.value.replace(/[^0-9\.\,]/g, '');
});
$('#ipup1').on('input', function(){
	this.value = this.value.replace(/[^0-9\.\,]/g, '');
});
$('#ipup2').on('input', function(){
	this.value = this.value.replace(/[^0-9\.\,]/g, '');
});
$('#ipup3').on('input', function(){
	this.value = this.value.replace(/[^0-9\.\,]/g, '');
});

function fn1(that) {
var x = parseFloat(document.getElementById("ipup1").value);
if ((x) || (x == 0)) {	
var v = parseFloat(that.value);	
    if (((!v) && (v !== 0)) || (v < x)) {		
		document.getElementById( "iput1" ).style = "border: 2px dashed red";
		document.getElementById( "info1" ).innerHTML="<p class='info-tip'>минимальное значение: "+x+"</p>";
		document.getElementById( "info1" ).class = "info";
		document.querySelector('[id="enableNotifications1"]').setAttribute('disabled', true);
        } else {      
		document.getElementById( "iput1" ).style = "border: 2px dashed green";
		document.getElementById( "info1" ).innerHTML="";
		document.getElementById( "info1" ).class = "";
		
		var yyy = document.getElementById("info2").class;
		var zzz = document.getElementById("info3").class;
		if ((yyy != "info") && (zzz != "info")) {	
		document.querySelector('[id="enableNotifications1"]').removeAttribute('disabled');
		}
		}
}		
};
function fn2(that) {
var y = parseFloat(document.getElementById("ipup2").value);
if ((y) || (y == 0)) {	
var w = parseFloat(that.value);	
    if (((!w) && (w !== 0)) || (w < y)) {		
		document.getElementById( "iput2" ).style = "border: 2px dashed red";
		document.getElementById( "info2" ).innerHTML="<p class='info-tip'>минимальное значение: "+y+"</p>";
		document.getElementById( "info2" ).class = "info";
		document.querySelector('[id="enableNotifications1"]').setAttribute('disabled', true);
        } else {      
		document.getElementById( "iput2" ).style = "border: 2px dashed green";
		document.getElementById( "info2" ).innerHTML="";
		document.getElementById( "info2" ).class = "";
		
		var xxx = document.getElementById("info1").class;
		var zzz = document.getElementById("info3").class;
		if ((xxx != "info") && (zzz != "info")) {	
		document.querySelector('[id="enableNotifications1"]').removeAttribute('disabled');
		}
		}
}		
};
function fn3(that) {
var z = parseFloat(document.getElementById("ipup3").value);
if ((z) || (z == 0)) {	
var q = parseFloat(that.value);	
    if (((!q) && (q !== 0)) || (q < z)) {		
		document.getElementById( "iput3" ).style = "border: 2px dashed red";
		document.getElementById( "info3" ).innerHTML="<p class='info-tip'>минимальное значение: "+z+"</p>";
		document.getElementById( "info3" ).class = "info";
		document.querySelector('[id="enableNotifications1"]').setAttribute('disabled', true);
        } else {      
		document.getElementById( "iput3" ).style = "border: 2px dashed green";
		document.getElementById( "info3" ).innerHTML="";
		document.getElementById( "info3" ).class = "";
		
		var xxx = document.getElementById("info1").class;
		var yyy = document.getElementById("info2").class;
		if ((xxx != "info") && (yyy != "info")) {	
		document.querySelector('[id="enableNotifications1"]').removeAttribute('disabled');
		}
		}
}		
};
</script> 
<script type='text/javascript'>
jQuery(document).ready(function($) {
  function save_user_inputs(ev){
    $("input").each(function(index, $input){
      if (($input.name == "") || ($input.name == "dte")){
        return true;
      }  	  
      localStorage.setItem("input." + $input.name, $input.value);
	  localStorage.setItem('uli', document.getElementById("uli").value);
      localStorage.setItem('ipum', document.getElementById("ipum").value); 	  
    }); 
    return true;
  } 

  function load_user_inputs(){
    var input_names = Object.keys(localStorage);
    for(var i=0; i<input_names.length; i++){
      var input_name = input_names[i];
      if ((!input_name.startsWith("input.serch")) && (!input_name.startsWith("input.email"))){
        continue;
      }   
      var $input = $("[name='"+input_name.split(".")[1]+"']")
      $input.val(localStorage[input_name]);
    }   
  } 
  var $in = localStorage.getItem('uli'); 
  
  $(document).on('submit', save_user_inputs);  
  load_user_inputs();
  
  document.getElementById("uli").value=$in; 
  var $vdte = localStorage.getItem('dte'); 
  document.getElementById("dot").innerHTML=$vdte; 
  
var $vdtet = document.getElementById("dte").value; 
let str = $vdte;
var $firstD = str.slice(3, 5);
let str1 = $vdtet;
var $secondD = str1.slice(3, 5);
if($firstD < $secondD) {
  document.getElementById( "dot" ).style = "color: red";
} else {
  document.getElementById( "dot" ).style = "color: green;";
}  
});
</script> 
<?php
// *******************************************************
 
return ob_get_clean();
}

include( plugin_dir_path( __FILE__ ) . 'options.php' ); 
?>