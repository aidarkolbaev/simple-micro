<?php

$params = [
    "Enter mysql host: " => [
        "prop" => "host",
        "default" => "127.0.0.1:3306"
    ],
    "Enter mysql username: " => [
        "prop" => "username",
        "default" => null
    ],
    "Enter mysql password: " => [
        "prop" => "password",
        "default" => null
    ],
    "Enter mysql database name: " => [
        "prop" => "dbname",
        "default" => null
    ],
    "Enter charset: " => [
        "prop" => "charset",
        "default" => "utf8"
    ],
    "Enter controllers namespace: " => [
        "prop" => "controllerNamespace",
        "default" => "App\Controller\\"
    ]
];

$result = [];
foreach ($params as $msg => $param) {
    setValue($msg, $param);
}

writeToFile($result);

function writeToFile(array $result) {
    $file = fopen(dirname(__DIR__) . "/app/config/config.php", "w+");
    $data = "<?php

\$config = [
    'database' => [
        'host' => '{$result["host"]}',
        'username' => '{$result["username"]}',
        'password' => '{$result["password"]}',
        'dbname' => '{$result["dbname"]}',
        'charset' => '{$result["charset"]}',
    ],
    'application' => [
        'controllerNamespace' => '${result["controllerNamespace"]}\\'
    ]
];";
    fwrite($file, $data);
    fclose($file);
}

function setValue(string $msg,array $param) {
    global $result;
    echo !empty($param["default"]) ? $msg . "(default: \"" . $param["default"] . "\") " : $msg;
    $value = trim(fgets(STDIN)) ?: $param["default"];
    if (empty($value)) {
        setValue($msg, $param);
    } else {
        $result[$param["prop"]] = $value;
    }
}