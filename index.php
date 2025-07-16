<?php
// ✅ Settings to disable buffering
@ini_set('output_buffering', 'off');
@ini_set('zlib.output_compression', false);
@ini_set('implicit_flush', true);
@ob_end_clean();
ob_implicit_flush(true);

// ✅ Store used codes
$limitFile = "used_refer_codes.txt";
$usedCodes = file_exists($limitFile) ? file($limitFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['refer'])) {
    $refer = trim($_POST['refer']);

    // ✅ Send headers early (before any HTML)
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: no-cache');
    header('X-Accel-Buffering: no');
    flush();

    // ✅ Check reuse
    if (in_array($refer, $usedCodes)) {
        echo "⚠️ This refer code has already reached 25 limit.<br>";
        echo "<script>setTimeout(() => { window.location.href = 'tg://join?invite=b7pFy1bsFlc0NjY9'; }, 2000);</script>";
        exit;
    }

    // ✅ Helper functions
    function randomIndianMobile() {
        return '8' . rand(2, 9) . rand(10000000, 99999999);
    }
    function randomDeviceId() {
        return substr(md5(uniqid(mt_rand(), true)), 0, 16);
    }
    function randomName() {
        $fn = ['Ajay','Rahul','Aman','Yash','Deep'];
        $ln = ['Sharma','Yadav','Verma','Mishra','Kumar'];
        return $fn[array_rand($fn)] . ' ' . $ln[array_rand($ln)];
    }
    function randomGmail($name) {
        return strtolower(str_replace(' ', '', $name)) . rand(10, 99) . "@gmail.com";
    }
    function randomGAID() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }
    function randomModel() {
        $models = ['Redmi Note 12', 'Vivo T2', 'Lava Blaze 5G', 'Samsung M12', 'iQOO Z6'];
        return $models[array_rand($models)];
    }
    function randomOEM($model) {
        if (stripos($model, 'Redmi') !== false || stripos($model, 'iQOO') !== false) return 'Xiaomi';
        if (stripos($model, 'Vivo') !== false) return 'Vivo';
        if (stripos($model, 'Samsung') !== false) return 'Samsung';
        if (stripos($model, 'Lava') !== false) return 'Lava';
        return 'Android';
    }

    // ✅ Start
    echo "<b>⚙️ Starting Refer Process for <u>$refer</u>...</b><br><br>";
    flush();

    $url = "http://3.109.115.226:3000/login";

    for ($i = 1; $i <= 25; $i++) {
        $deviceId = randomDeviceId();
        $name = randomName();
        $email = randomGmail($name);
        $gaid = randomGAID();
        $model = randomModel();
        $oem = randomOEM($model);
        $mobile = randomIndianMobile();

        $data = [
            "ccode" => "IN",
            "deviceId" => $deviceId,
            "model" => $model,
            "email" => $email,
            "gaid" => $gaid,
            "imei" => "",
            "ip" => "2401:4900:1c3e:76ab:9443:8e1e:bc03:58f1",
            "lat" => 0.0,
            "long" => 0.0,
            "no" => $mobile,
            "name" => $name,
            "oem" => $oem,
            "os" => "P",
            "pkg" => "com.apps.earneasy",
            "referral" => $refer,
            "token" => "f7lbdLzORcOy34lXTh2nRP:APA91bGYTuj9rZYiu066XQhgRVWfzE-_xAHM4sNNez-W-URf9KNq1_IeurxKv9-Rc-xrRw50ON3bfKfVEKGs3pf9GUT0SJQSNPAWq6nudjPo3DV2MOF601I"
        ];

        $headers = [
            "Content-Type: application/json",
            "User-Agent: okhttp/4.12.0",
            "x-app-version: " . rand(100,120) . "." . rand(0,9),
            "x-session-id: " . md5(uniqid()),
            "x-device-info: " . base64_encode(json_encode([
                "model" => $model,
                "oem" => $oem,
                "os" => "Android P",
                "api" => 29
            ])),
            "x-real-ip: " . $data['ip'],
            "bitch: " . $data['no']
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_exec($ch);
        curl_close($ch);

        echo "✅ Refer $i/25 done<br>";
        echo str_repeat(' ', 1024); // Force buffer flush
        flush();

        if ($i < 25) sleep(10);
    }

    // ✅ Save refer
    file_put_contents($limitFile, $refer . PHP_EOL, FILE_APPEND);

    echo "<br><b style='color:green;'>🎉 Done! 25 Refer Completed for $refer.</b>";
    echo "<script>setTimeout(() => { window.location.href = 'tg://join?invite=b7pFy1bsFlc0NjY9'; }, 2000);</script>";
    exit;
}
?>

<!-- ✅ HTML starts after POST exit -->
<!DOCTYPE html>
<html>
<head>
  <title>Hemant Script (Official)</title>
  <link rel="icon" href="http://hemantscripter.xyz/script.png" type="image/jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins');
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(45deg, #FF0001 45%, #ffffff 0%);
      margin: 0; padding: 0;
    }
    .wrapper { padding: 80px 20px 20px; text-align: center; }
    #formContent {
      background: #fff;
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      max-width: 400px;
      box-shadow: 0 30px 60px rgba(0,0,0,0.3);
    }
    input[type="text"], input[type="submit"] {
      padding: 12px;
      width: 80%;
      margin: 10px auto;
      border-radius: 5px;
      border: 1px solid #ccc;
      display: block;
      font-size: 14px;
    }
    input[type="submit"] {
      background: #FF0001;
      color: white;
      border: none;
      cursor: pointer;
      text-transform: uppercase;
    }
    .log {
      background: #f2f2f2;
      padding: 10px;
      margin-top: 15px;
      max-height: 300px;
      overflow-y: auto;
      font-size: 13px;
      color: #111;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div id="formContent">
      <h2 style="color:#FF0001;">Refer Bypass Script</h2>
      <form method="post">
        <input type="text" name="refer" placeholder="Enter Refer Code" required>
        <input type="submit" value="SUBMIT">
      </form>
    </div>
  </div>
</body>
</html>