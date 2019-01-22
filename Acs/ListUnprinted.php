<?

require_once(dirname(__FILE__) . '/credit.php');

class Acs_ListUnprinted extends SoapClient
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
		    'wsdl' => "https://services.acscourier.net/ACSReceiptsList-portlet/axis/Plugin_ACSReceiptsList_ACSUnprintedPodsService?wsdl",
		);
		
		//set wsdl url
		parent::SoapClient( $this->_settings['wsdl'] );
		
		$this->_companyId = COMPANYID;
		$this->_companyPass = COMPANYPASS;
		$this->_username = USERNAME;
		$this->_password = PASSWORD;
		$this->_customerId = CUSTOMERID;
	}
	
	public function recipeListUn($_date = '')
    {
    	
    	if(empty($_date)){
    		$_date = date('Y-m-d');
    	}
    	
		try{
			
    		$data = array(
    			'CompanyID' => $this->_companyId,
    			'CompanyPass' => $this->_companyPass,
    			'Username' => $this->_username,
    			'Password' => $this->_password,
    			'dateParal' => $_date,
    			'myData' => 0
    		);
			
			$response = call_user_func_array(array('parent', 'getUnprintedPods'), $data);
    		
    		if(!empty($response->error)){
    			return 'Error: ' . $response->error;
    		} else {
    			return $response;
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