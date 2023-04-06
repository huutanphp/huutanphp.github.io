
error_reporting(1);
$BBlack="\033[1;30m" ; 
$BRed="\033[1;31m" ;
$BGreen="\033[1;32m" ;
$BYellow="\033[1;33m" ;
$BBlue="\033[1;34m" ;
$BPurple="\033[1;35m" ;
$BCyan="\033[1;36m" ;
$BWhite="\033[1;37m" ;
$Blue="\033[0;34m";
$lime="\033[1;32m";
$red="\033[1;31m";
$xanh="\033[1;32m";
$cyan="\033[1;36m";
$yellow="\033[1;33m";
$turquoise="\033[1;34m";
$maugi="\033[1;35m";
$white= "\033[1;37m";
/***[ Banner ]***/
$banner="\033[1;96m
                ▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒
                ▒▒▒▒▒▒▒▒▄▄▄▄▄▄▄▄▒▒▒▒▒▒
                ▒▒█▒▒▒▄██████████▄▒▒▒▒
                ▒█▐▒▒▒████████████▒▒▒▒
                ▒▌▐▒▒██▄▀██████▀▄██▒▒▒
                ▐┼▐▒▒██▄▄▄▄██▄▄▄▄██▒▒▒
                ▐┼▐▒▒██████████████▒▒▒
                ▐▄▐████─▀▐▐▀█─█─▌▐██▄▒
                ▒▒█████──────────▐███▌
                ▒▒█▀▀██▄█─▄───▐─▄███▀▒
                ▒▒█▒▒███████▄██████▒▒▒
                ▒▒▒▒▒██████████████▒▒▒
                ▒▒▒▒▒██████████████▒▒▒
                ▒▒▒▒▒█████████▐▌██▌▒▒▒
                ▒▒▒▒▒▐▀▐▒▌▀█▀▒▐▒█▒▒▒▒▒
                ▒▒▒▒▒▒▒▒▒▒▒▐▒▒▒▒▌▒▒▒▒▒
                ▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒   \n
           $do ███████BẢN QUYỀN-MR HIỆP███████ \n
    ███╗   ███╗██████╗     ██╗  ██╗██╗███████╗██████╗ 
    ████╗ ████║██╔══██╗    ██║  ██║██║██╔════╝██╔══██╗
    ██╔████╔██║██████╔╝    ███████║██║█████╗  ██████╔╝
    ██║╚██╔╝██║██╔══██╗    ██╔══██║██║██╔══╝  ██╔═══╝ 
    ██║ ╚═╝ ██║██║  ██║    ██║  ██║██║███████╗██║     
    ╚═╝     ╚═╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚═╝╚══════╝╚═╝     

\n
 \033[1;96m 🎮=========================================================🎮\033[0m\n
 
 \033[1;31m   Bản quyền : Mr Hiệp 
  \033[1;33m   Zalo :  0372902603       
  \033[1;36m   Tool Gộp 2022
  \033[1;32m   Youtube Chủ Tool :  Mr Hiệp                                    \033[1;34m        
     Mua Code Tool Liên Hệ Zalo : 0372902603\n
  \033[1;96m 🎮=========================================================🎮\033[0m\n";






 




@system('clear'); $string = strlen($banner); for($i=0; $i<=$string; $i++){ echo $banner[$i];usleep(100);}
echo"$cyan Nhập Tên Tài Khoản: ";
$tk=trim(fgets(STDIN));
echo"$cyan Nhập Số Ạc Muốn Reng: ";
$a=trim(fgets(STDIN));

#echo"$cyan Nhập Thời gian tạo ạc: ";
#$h=trim(fgets(STDIN));
$h=60;


//$tk="hiepj";
///echo"$cyan Nhập Tên Tài Khoản: ";
#$pass=trim(fgets(STDIN));
for($v=0;$v<= $a;$v++){
  

  
  

  
$rd= rand();


$email="minhiep$rd@gmail.com";



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://sso.garena.com/api/register');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$tk$v&email=$email&password=979940b1fa83833e7719dfd5686b6ca8a1a67d9e7dae72999bcaae88f4374c3a1ace10e4dfd7573fe87489d7778cf271119a8cc59aab6d4e6b1a4579ffba36aef52589cfae9cbeed55c214ce5d025e95298f5067fd14c20890aa9ed8968d1655bcb3631b978b9fc6e242e09ac1563fa509e067d325d685286535f110d415c5cb&location=VI&redirect_uri=&locale=vi&mobile_no=&otp=&format=json&id=1662953367967");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
$headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'Cookie: _ga=GA1.1.1725536383.1665139754; _ga_1M7M9L6VPX=GS1.1.1673250418.11.0.1673250429.0.0.0; datadome=3FWVW6nTeTDo5Va2ZwygOlLgS1LtX50j8TWNjVo8yMeSMDM7PEJmdDk8wDGkPHYOmiGWtIMG7xF2LboXuEsZSWGxWY5wWF1_zHk9sNY9iqo98iLoy5lNEkEQs0lju9TN';
$headers[] = 'Origin: https://sso.garena.com';
$headers[] = 'Referer: https://sso.garena.com/ui/register?locale=vi';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 11; M2010J19SG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Mobile Safari/537.36';
$headers[] = 'X-Requested-With: XMLHttpRequest';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"107\", \"Not=A?Brand\";v=\"24\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'X-Datadome-Clientid: 3FWVW6nTeTDo5Va2ZwygOlLgS1LtX50j8TWNjVo8yMeSMDM7PEJmdDk8wDGkPHYOmiGWtIMG7xF2LboXuEsZSWGxWY5wWF1_zHk9sNY9iqo98iLoy5lNEkEQs0lju9TN';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);



$id = explode('username": "', $result)[1];

$id = explode('"', $id)[0];

$so++;

echo $BCyan."[$so] $BGreen Tạo Thành Công \033[1;31mTài Khoản : \033[1;33m$id \033[1;31mMật Khẩu : \033[1;33mDatnguyen@#123 \n";

$f = fopen("acgarena.txt","a");
$luu = fwrite($f,"$id | Datnguyen@#123\n");
fclose($f);
if($so == $a){
echo $cyan."Đã Lưu Vào File acgarena.txt Đợi Khoản 30 phút chạy típ nhé \n"; die;
}

for ($i=$h;$i>-1;$i--){ echo "●HƠI LÂU NHƯNG REG TỚI GIÀ NHÉ MÁY ĐẠI KA - Đợi $i Giây \r"; sleep(1);}


}
function chay($so){
  for($v=0;$v<= $so;$v++){
    echo "\033[1;36m"."▬";usleep(20000);echo "\033[1;37m"."▬";usleep(20000);echo "\033[1;36m"."▬";usleep(20000);echo "\033[1;37m"."▬";usleep(20000);
} echo "\n";


}



