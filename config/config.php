
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(1);

ob_start();
session_start();

if (strcmp(basename($_SERVER["SCRIPT_NAME"]), basename(__FILE__)) === 0) {
    header("location: /");
    exit;
}

date_default_timezone_set('Africa/Luanda');

// CONFIGURAÇÕES TIDB CLOUD
define("NOME_DB", "test");
define("NOME_SERVER_DB", "gateway01.eu-central-1.prod.aws.tidbcloud.com");
define("PORTA_DB", "4000");
define("USUARIO_DB", "2JfvizAdu6FMGru.root");
define("SENHA_DB", "kyDIFGs7m4gVigbG");

// CONEXÃO COM O BANCO
try {
    $conn = new PDO(
        "mysql:host=" . NOME_SERVER_DB .
        ";port=" . PORTA_DB .
        ";dbname=" . NOME_DB .
        ";charset=utf8mb4",
        USUARIO_DB,
        SENHA_DB,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_SSL_CA => "/etc/ssl/certs/ca-certificates.crt",
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true
        )
    );
} catch (PDOException $e) {
    error_log("Erro de conexão TiDB: " . $e->getMessage());
    http_response_code(500);
    exit("Banco de dados temporariamente indisponível.");
}

// VARIÁVEIS
$sid = isset($_SESSION['logado']) ? $_SESSION['logado'] : '';
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/Mobile_Detect.php");
$detect = new Mobile_Detect;

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/conteudo.php");

$uid = getIdBySid($sid);
