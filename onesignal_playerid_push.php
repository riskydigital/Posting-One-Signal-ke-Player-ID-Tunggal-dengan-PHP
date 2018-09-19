<?PHP

//Ganti dg POST kalau siap dijalankan. Tentu ubah jg kirimnya dg web.post 😜
//Silakan ubah dg kode yg lebih bagus & reliable jika memungkinkan.

$getjudul=$_GET["judul"];
$getisi=$_GET["isi"];
$getgaram=$_GET["garam"];
$getapp=$_GET["app"];
$getfoto=$_GET["foto"];
$getplayerid=$_GET["playerid"];

if  ($getgaram!="InidiisisembarangBiarTidakSemuaPostindDiProses")
{
echo "maaf pengiriman gagal 😜.";
exit();
}

function sendMessage($strapp,$playerid,$strJudul,$strIsi,$strfoto){
$strkodeapp='';

if (strlen($strfoto)>0)
{
$foto=$strfoto;
}
else
{
//BUAT ANDROID FOTO INI NDAK MUNCUL BRAY. APP CHROME ATAU LAINNYA 🤣
//ini foto default silakan ganti sesukamu
$foto="https://simplychicforcheap.files.wordpress.com/2012/09/breathe-easy.jpg";
}

switch ($strapp) {
    case 'app1':
        $strkodeapp="ISI_DG_KODE_APP1";
		$strapi="REST_API_KEY_APP1";
        break;
    case 'app2':
        $strkodeapp="ISI_DG_KODE_APP2";
		$strapi="REST_API_KEY_APP2";
        break;
    case 'app3':
        $strkodeapp="ISI_DG_KODE_APP3";
		$strapi="REST_API_KEY_APP3";
        break;
    case 'app4':
        $strkodeapp="ISI_DG_KODE_APP4";
		$strapi="REST_API_KEY_APP4";
        break;
    case 'app_dst':
        $strkodeapp="ISI_DG_KODE_APP_DST";
		$strapi="REST_API_KEY_APP_DST";
        break;
	default:
        $strkodeapp="ISI_DG_KODE_APP_DEFAULT";
		$strapi="REST_API_KEY_APP_DEFAULT";
}

    $content = array(
        "en" => $strIsi
        );
    $judul = array(
        "en" => $strJudul
        );
 
    $fields = array(
        'app_id' => $strkodeapp,
//        'included_segments' => array('All'), //kl kirim semua comment ini dibuka atau bikin logic antara kirim tunggal/all/segment
        'data' => array("foo" => "bar"),
        'large_icon' =>"ic_launcher_round.png",
		'headings' => $judul,
		'chrome_web_image' => $foto,
		'include_player_ids' => [$playerid],
        'contents' => $content
    );

    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8",
                                               "Authorization: Basic $strapi"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$response = sendMessage($getapp,$getplayerid,$getjudul,$getisi,$getfoto);
$return["allresponses"] = $response;
$return = json_encode( $return);
echo "sip";
?>
