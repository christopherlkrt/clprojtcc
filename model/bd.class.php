 <?php
 ini_set('display_errors',1);
 ini_set('display_startup_erros',1);
 error_reporting(E_ALL);

 class BD {

	
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "foodplace";
    private $porta = "3306";

	public function __construct() {
			try {
				 $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->banco;charset=utf8", $this->usuario, $this->senha, array( 
				 	PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
				 	PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC));
	 
			} catch (PDOException  $e) {
				 print $e->getMessage();
			}
		}
 }