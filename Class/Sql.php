<?php 
class Sql extends PDO{
    private $conexao;

    public function __construct(){
        $this->conexao = new PDO("mysql:host=localhost;dbname=php", "root", "",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
    }

    private function SetParams($statment, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $this->SetParam($statment, $key, $value);
            
        }
    }

    private function SetParam($statment, $key, $value){
        $statment->bindParam($key, $value);
    }

    public function Query($rawQuery, $params = array()){
        $stmt = $this->conexao->prepare($rawQuery);
        $this->SetParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function Select($rawQuery, $params = array()):array{
        $stmt = $this->Query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>