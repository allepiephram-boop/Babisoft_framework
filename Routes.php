<?php
/**
 * Routes.php — BabiSoft Framework
 * API REST complète — tous modules
 */

header('Content-Type: application/json; charset=utf-8');

// ══════════════════════════════════════════════════════════════
//  HOME
// ══════════════════════════════════════════════════════════════
App::route('GET', '/', function () {
    header('location: public/index.html');
});

// cest pour Lire la liste des clients
App::route('GET', '/clients', function () {
    $client = new Client();
    if ($client->FindSet()) {
        echo $client;
    } else {
        echo '[]';
    }
});

// Ajoute un client
App::route('POST', '/clients', function () {
    $data = getSecureJsonInput();
    if (empty($data)) {
        ErrorCode(400, 'Données JSON manquantes ou invalides');
    }
    if (array_keys($data) !== range(0, count($data) - 1)) {
        $data = [$data];
    }
    App::Insert(Client::class, $data);
    db->commit();  
});
// ══════════════════════════════════════════════════════════════
//  PRODUITS
// ══════════════════════════════════════════════════════════════

// Lire la liste des produits
App::route('GET', '/produits', function () {
    $produit = new Produit();
    if ($produit->FindSet()) {
        echo $produit;
    } else {
        echo '[]';
    }
});

// Ajouter un produit
App::route('POST', '/produits', function () {
    $data = getSecureJsonInput();
    if (empty($data)) {
        ErrorCode(400, 'Données JSON manquantes ou invalides');
    }
    if (array_keys($data) !== range(0, count($data) - 1)) {
        $data = [$data];
    }
    App::Insert(Produit::class, $data);
    db->commit(); 
});

//devis
 define('TAUX_TVA',18);

function bienChamps($rec,array $noms){
      
   $r = [];
   foreach ($nom as $n){
    $r[$n] = $rec->$n->value;
   } 
   return $r;
}


//lire la liste dees devis

App::route('GET','/devis',function () {
   $d= new Devis();
   $liste = [];

   $rows= $d->Findest();
   if ($row){
    foreach($rows as $r){
        $liste[] = bienChamps($r,['numero','date_devis','code_client','statut','mode_paiement','total_ht','montant_tva','total_ttc'])
    }
   }
  echo json_encode($liste, JSON_UNESCAPED_UNICODE);

});
//lire ligne devis et echeance
App::route('GET','/devis/{numero}',function($numero){
    $numero =urldecode($numero);
    $devis = new Devis();
    if (!$devis->get($numero)){
      
    ErrorCode(404,"Devis'$nemero'introuvable");
    }
    $res = bienChamps($devis,['numero','date_devis','date_validite','code_client','satut','mode_paiement','total_ht','montant_tva','total_ttc']);

    $res['lignes'] = [];
    $1 = new LigneDevis();
    $1->setRange('numero_devis',$numero);
    $rows = $1->Findset();
    if ($row){

   foreach ($row as $r){
    $res['lignes'][] = bienChamps($r, ['no_ligne','code_produit','designation',
    'quantite','prix_unitaire','total_ligne']);
   } 
    }
    $res['echeances'] = [];
    $e = new EcheanceDevis();
    $e->setRange('numero_devis',$numero);
    $rows = $e->FindSet();
    if ($rows) {
        foreach ($rows as $r){
            $res['echeances'][] = bienChamps($r,['no_echeance','libelle','pourcentage','montant','date_prevue','statut']);
        }

    }
    echo json_encode($res,JSON_UNESCAPED_UNICODE);
});
// cree un devis

app::route('POST','/devis',function()){
    $data = getSecureJsonInnput();
    if (empty($data)){
        ErrorCode(400,'Données JSON manquantes ou invalides');
    }

}

//les bases
 
$codeclients = $data['code_client'] ?? '';
$lignes      =$data['lignes'] ?? [];
$mode        =$data['mode_paiement'] ?? 'TOTALITE';

if ($codeclient === '') {
    ErrorCode(400,'Le champ code_client est obligatoire');

}
if (!is_array($lignes) || count($lignes) === 0){
    Errorcode(400,'un devis doit au moin avoir une ligne');
}
if (!in_array($mode, ['TOTALITE','AVANCE','ETAPES'])){
    Errorcode(400,'Le mode_paiement doit être TOTALITE, AVANCE ou ETAPES');

}
//calcul

$lignescalculees = [];
$totalHt = 0;
$i = 0;
foreach ($lignes as $1){
    $i++;
    $codeProduit =$1['code_produit'] ?? '';
    $quantite    =(float) ($1['quantite'] ?? 0);
    if ($quantite <= 0) {
        Errorcode(400,"Ligne $i : la quantité doit être supérieure à 0");
    }
    $produit = new produit();
    if (!$produit->get($codeproduit)){
        Errorcode(404,"Ligne $i : produit '$codeproduit'introuvable");

    }
    $prix  = (int) $produit->prix_unitaire->value;
    $totalLigne=(int) round($quantite * $prix);
    $totalHt += $totalLigne;
    $lignescalculees[] = [
        'no_ligne'  => $i,
        'code_produit'=> $codeproduit,
        'designation' => $produit->designation->value,
        'quantite' => $quantite,
        'prix_unitaire' => $prix,
        'total_ligne'  => $totalLigne,
    ];
}
$tva = (int) round($totalHt * TAUX_TVA/100);
$ttc = $totalHt + $tva;

?>
