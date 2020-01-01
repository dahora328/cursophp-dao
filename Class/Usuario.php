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
        $resultado = $sql->Select("SELECT * FROM usuario u where idusu = :id", array(
            ":id"=>$id));
        if(isset($resultado[0])){
            $row = $resultado[0];
            $this->setId(utf8_encode($row['idusu']));
            $this->setLogin(utf8_encode($row['login']));
            $this->setSenha($row['senha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));
        }
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