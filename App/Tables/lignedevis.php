<?php
class LigneDevis extends Table {
    public function __construct()
    {
        parent::__construct(50005, 'ligne_devis');

        $this->field(1, 'numero_devis', FieldType::text(20), tableRelation: new Devis(), caption:'Numero devis');
        $this->field(2, 'no_ligne', FieldType::integer(), caption:'Numero ligne');
        $this->field(3, 'code_produit', FieldType::text(20), tableRelation: new Produit(), caption:'Produit');
        $this->field(4, 'designation', FieldType::text(150), caption:'Désignation');
        $this->field(5, 'quantite', FieldType::decimal('(10,2)'), caption:'Quantité');
        $this->field(6, 'prix_unitaire', FieldType::integer(), caption:'Prix unitaire');
        $this->field(7, 'total_ligne', FieldType::integer(), caption:'Total ligne');

        $this->Keys('numero_devis', 'no_ligne');
    }
    public function onInsert() {}
    public function onModify() {}
    public function onDelete() {}
}
?>