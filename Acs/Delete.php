<?

require_once(dirname(__FILE__) . '/credit.php');

class Acs_Delete extends SoapClient
{
	
	private $_settings;
	
	private $_companyId;
	private $_companyPass;
	private $_username;
	private $_password;
	private $_customerId;
	
	public function __construct( $_settings = array() )
	{
		$this->_settings = array(
		    'wsdl' => "https://services.acscourier.net/ACSDeleteVoucher-portlet/axis/Plugin_DeleteVoucher_ACSDeleteVoucherService?wsdl",
		);
		
		//set wsdl url
		parent::SoapClient( $this->_settings['wsdl'] );

		$this->_companyId = COMPANYID;
		$this->_companyPass = COMPANYPASS;
		$this->_username = USERNAME;
		$this->_password = PASSWORD;
		$this->_customerId = CUSTOMERID;
	}
	
	public function deleteTovar( $_no_pod )
    {
		try{
			
    		$data = array(
    			'CompanyID' => $this->_companyId,
    			'CompanyPass' => $this->_companyPass,
    			'Username' => $this->_username,
    			'Password' => $this->_password,
    			'NoPod' => $_no_pod 
    		);
			
			$response = call_user_func_array(array('parent', 'deleteACSDeleteVoucher'), $data);
    		
    		if(!empty($response->errorMsg)){
    			return 'Error: ' . $response->errorMsg;
    		} else {
    			return 1; 	
    		}
    		
		} catch (Exception $e){
			print_r($e);
		}
    }
    
    public function listFunctions()
    {
    	return parent::__getFunctions();
    }
	
}