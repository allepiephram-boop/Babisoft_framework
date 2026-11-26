<?php
class Facture extends Table {
    public function __construct()
    {
        parent::__construct(50006, 'facture');

        $this->field(1, 'numero', FieldType::text(20), caption:'Numero facture');
        $this->field(2, 'date_facture', FieldType::date(), caption:'Date de la facture');
        $this->field(3, 'date_echeance', FieldType::date(), caption:'Date d\'échéance');
        $this->field(4, 'code_client', FieldType::text(20), tableRelation: new Client(), caption:'Client');
        $this->field(5, 'numero_devis', FieldType::text(20), tableRelation: new Devis(), caption:'Devis d\'origine');
        $this->field(6, 'statut', FieldType::text(20), caption:'Statut');
        $this->field(7, 'total_ht', FieldType::integer(), caption:'Total HT');
        $this->field(8, 'montant_tva', FieldType::integer(), caption:'TVA');
        $this->field(9, 'total_ttc', FieldType::integer(), caption:'Total TTC');

        $this->Keys('numero');
    }
    public function onInsert() {}
    public function onModify() {}
    public function onDelete() {}
}
?>