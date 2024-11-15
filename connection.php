<?php

/**
 * La clase Connection proporciona una conexion a la base de datos MySQL.
 */
class Connection
{
    private $host = "localhost"; // Direccion del servidor de la base de datos
    private $username = "root"; // Nombre de usuario de la base de datos
    private $password = ""; // Contraseoa de la base de datos
    private $database = "agenda"; // Nombre de la base de datos
    private $conn; // Objeto de conexion

    /**
     * Constructor de la clase Connection.
     * Crea una nueva instancia de conexion a la base de datos MySQL.
     */
    public function __construct()
    {
        // Establece la conexion con la base de datos al instanciar la clase
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Verifica si hay errores de conexion
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error); // Termina la ejecucion del script si hay un error de conexion
        }
    }

    /**
     * Obtiene la conexion a la base de datos.
     * @return mysqli La conexion a la base de datos MySQL.
     */
    public function getConnection()
    {
        return $this->conn; // Devuelve el objeto de conexion a la base de datos
    }
}

?>