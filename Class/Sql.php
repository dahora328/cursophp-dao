<?php 
class Sql extends PDO{
    private $conexao;

    public function __construct(){
        $this->conexao = new PDO("mysql:host=localhost;dbname=php", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
    }

    private function SetParams($stament, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $this->SetParam($key, $value);
        }
    }

    private function SetParam($stament, $key, $value){
        $stament->bindParam($key, $value);
    }

    public function Query($rawQuery, $params = array()){
        $stmt = $this->conexao->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function Select($rawQuery, $params = array()):array{
        $stmt = $this->Query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>