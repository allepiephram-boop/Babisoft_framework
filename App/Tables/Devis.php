    <?php
class Devis extends Table {
    public function __construct()
    {
        parent::__construct(50003, 'devis');

        $this->field(1, 'numero', FieldType::text(20), caption:'Numero devis');
        $this->field(2, 'date_devis', FieldType::date(), caption:'Date du devis');
        $this->field(3, 'date_validite', FieldType::date(), caption:'Valable jusqu\'au');
        $this->field(4, 'code_client', FieldType::text(20), tableRelation: new Client(), caption:'Client');
        $this->field(5, 'statut', FieldType::text(20), caption:'Statut');
        $this->field(6, 'mode_paiement', FieldType::text(30), caption:'Mode de paiement');
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