<?php
class Client extends Table {
    public function __construct()
    {
        parent::__construct(50001, 'client');

        $this->field(1, 'code', FieldType::text(20), caption:'code_client');
         $this->field(2, 'Nom', FieldType::text(100), caption:'Nom_clients');
        $this->field(3, 'email', FieldType::text(100), caption:'Email');
         $this->field(4, 'adresse', FieldType::text(150), caption:'adresse_client');
          $this->field(5, 'telephone', FieldType::text(30), caption:'contacts');

        $this->Keys('code');
    }
    public function onInsert() {}
    public function onModify() {}
    public function onDelete() {}
}
?>