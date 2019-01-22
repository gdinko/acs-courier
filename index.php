<?

require_once(dirname(__FILE__) . '/Acs/Eps.php');

$acsEps = new Acs_Eps();
		
$data = array(
    'companyId' => '',
    'companyPass' => '', 
    'username' => '', 
    'password' => '', 
    'diakDateParal' => date('Y-m-d'), 
    'diakApostoleas' => '', 
    'diakParalhpthsOnoma' => 'Ανδρέας Τάσιος',
        
    'diakParalhpthsDieth' => '', //address 
    'acDiakParalhpthsDiethAr' => '', //address number 
    'acDiakParalhpthsDiethPer' => 'Ρόδος', //city 
    'diakParalhpthsThlef' => '', //phone 
    'diakParalhpthsTk' => '', //pk
        
    'stationIdDest' => '', 
    'branchIdDest' => 0, 
    'diakTemaxia' => 1, //qtty
    'diakVaros' => 1.0, //weight 
    'diakXrewsh' => 2, 
    'diakWraMexri' => '',
    'diakAntikatPoso' => 22.54, //pay sum
    'diakTroposPlAntikat' => 'Μ',
    'hostName' => '', 
    'diakNotes' => '', //description
    'diakCountry' => 'GR',
    'diakcFiller' => '', 
    'acDiakStoixs' => 'ΑΝ',
    'customerId' => '',
    'diakParalhpthsCell' => '', 
    'diakParalhpthsOrofos' => '', 
    'diakParalhpthsCompany' => '', 
    'withReturn' => 1, 
    'diakcCompCus' => '', 
    'specialDir' => ''
);

try{
    
    $d = $acsEps->createTovar( $data );
    $d = $acsEps->printTovar( $d );
    
    echo $d;

} catch (Exception $e){
    print_r($e);
}