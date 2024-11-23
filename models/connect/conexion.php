<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';

        class Conexion{
        private $host;
        private $namedb;
        private $userdb;
        private $passworddb;
        private $charset;
        private static $pdo = null;

        public function __construct(){
            $this->host = DB_HOST;
            $this->namedb = DB_NAME;
            $this->userdb = DB_USER;
            $this->passworddb = DB_PASSWORD;
            $this->charset = 'utf8';

            if( self::$pdo == null ){
                $this->conectar();
            }
        }

        private function conectar(){
            $dsn = "mysql:host={$this->host};dbname={$this->namedb};charset={$this->charset}";
            try {
                self::$pdo = new PDO($dsn, $this->userdb, $this->passworddb);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Hubo un error al conectar con la base de datos: ' . $e->getMessage());
            }
        }

        public static function obtenerconexion(){
            if ( self:: $pdo == null){
                new self;
            }
            return self::$pdo;
        }

        public function contesta(){
            $dsn = "mysql:host={$this->host};dbname={$this->namedb};charset={$this->charset}";
            return $dsn;
        }
    }
?>