<?php
class Usuario{
    private $id;
    private $login;
    private $senha;
    private $dtcadastro;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getLogin(){
        return $this->login;
    }
    public function setLogin($login){
        $this->login = $login;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getDtCadastro(){
        return $this->dtcadastro;
    }
    public function setDtCadastro($dtcadastro){
        $this->dtcadastro = $dtcadastro;
    }
    
    public function LoadById($id){
        $sql = new Sql();
        $resultado = $sql->Select("SELECT * FROM usuario where idusu = :id", array(
            ":id"=>$id));
        if(isset($resultado[0])){
            $row = $resultado[0];
            $this->setId(utf8_encode($row['idusu']));
            $this->setLogin(utf8_encode($row['login']));
            $this->setSenha($row['senha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));
        }
    }
    public function Login($login, $senha){
        $sql = new Sql();
        $resultado = $sql->Select("SELECT * FROM usuario WHERE login = :login AND senha = :senha", array(
            ":login"=>$login,
            ":senha"=>$senha
        ));
        if(isset($resultado[0])){
            $row = $resultado[0];
            $this->setId(utf8_encode($row['idusu']));
            $this->setLogin(utf8_encode($row['login']));
            $this->setSenha($row['senha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));
        }else{
            throw new Exception("Login e/ou senha inválidos.");
            
        }
    }

    public static function getList(){
        $sql = new Sql();
        return $sql->Select("SELECT * FROM usuario ORDER BY idusu");
    }

    public static  function BusacarLogin($login){
        $sql =  new Sql();
        return $sql->Select("SELECT * FROM usuario WHERE login LIKE :buscar ORDER BY login", array(
            ":buscar"=>"%".$login."%"
        ));
    }

    public function __toString(){
        return json_encode(array(
            "id"=>$this->getId(),
            "login"=>$this->getLogin(),
            "senha"=>$this->getSenha(),
            "dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }


}
?>