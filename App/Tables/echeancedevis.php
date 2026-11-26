<?php
class EcheanceDevis extends Table {
    public function __construct()
    {
        parent::__construct(50004, 'echeance_devis');

        $this->field(1, 'numero_devis', FieldType::text(20), tableRelation: new Devis(), caption:'Numero devis');
        $this->field(2, 'no_echeance', FieldType::integer(), caption:'Numero échéance');
        $this->field(3, 'libelle', FieldType::text(100), caption:'Libellé');
        $this->field(4, 'pourcentage', FieldType::integer(), caption:'Pourcentage');
        $this->field(5, 'montant', FieldType::integer(), caption:'Montant');
        $this->field(6, 'date_prevue', FieldType::date(), caption:'Date prévue');
        $this->field(7, 'statut', FieldType::text(20), caption:'Statut');

        $this->Keys('numero_devis', 'no_echeance');
    }
    public function onInsert() {}
    public function onModify() {}
    public function onDelete() {}
}
?>