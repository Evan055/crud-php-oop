<?php
    class connection {
        private $host= "localhost";
        private $username= "root";
        private $password= "";
        private $database= "data_diri";
        
        protected $koneksi;

        public function __construct() {
            if (!isset($this->koneksi)) {
                $this->koneksi= new mysqli($this->host, $this->username, $this->password, $this->database);

                if(!$this->koneksi) {
                    echo "Database Gagal Koneksi!";
                    exit;
                }
            }
            return $this->koneksi;
        }
    }
?>