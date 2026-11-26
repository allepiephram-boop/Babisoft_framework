<?php
class Produit extends Table {
    public function __construct()
    {
        parent::__construct(50002, 'produit');

        $this->field(1, 'code', FieldType::text(20), caption:'Code produit');
        $this->field(2, 'designation', FieldType::text(150), caption:'Désignation');
        $this->field(3, 'types', FieldType::text(100), caption:'Type');
        $this->field(4, 'categorie', FieldType::text(50), caption:'Catégorie');
        $this->field(5, 'unite', FieldType::text(20), caption:'Unité');
        $this->field(6, 'prix_unitaire', FieldType::integer(), caption:'Prix unitaire');

        $this->Keys('code');
    }
    public function onInsert() {}
    public function onModify() {}
    public function onDelete() {}
}
?>