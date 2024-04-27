<?php
    class Conexion {
        private $servername = "mysql";
        private $port = "3306";
        private $username = "root";
        private $password = "root";
        private $dbname = "crud_compras";
        private $conn;
    
        public function conectar() {
            // Crear conexión
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname, $this->port);
    
            // Verificar conexión
            if ($this->conn->connect_error) {
                die("Conexión fallida: " . $this->conn->connect_error);
            }
            //echo "Conexión exitosa <br>";
        }
    
        public function cerrar() {
            // Cerrar la conexión
            $this->conn->close();
        }
    
        public function getConnection() {
            return $this->conn;
        }
    }
?>
