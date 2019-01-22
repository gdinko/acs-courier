<?

require_once(dirname(__FILE__) . '/credit.php');

class Acs_List extends SoapClient
{
	private $_settings;
	
	private $_companyId;
	private $_companyPass;
	private $_username;
	private $_password;
	private $_customerId;
	
	private $_print_list_url = 'http://acs-eud.acscourier.gr/Eshops/getlist.aspx?MainID=%s&MainPass=%s&UserID=%s&UserPass=%s&MassNumber=%s&DateParal=%s';
	
	public function __construct( $_settings = array() )
	{
		$this->_settings = array(
		    'wsdl' => "https://services.acscourier.net/ACSReceiptsList-portlet/axis/Plugin_ACSReceiptsList_ACSReceiptsListService?wsdl",
		);
		
		//set wsdl url
		parent::SoapClient( $this->_settings['wsdl'] );
		
		$this->_companyId = COMPANYID;
		$this->_companyPass = COMPANYPASS;
		$this->_username = USERNAME;
		$this->_password = PASSWORD;
		$this->_customerId = CUSTOMERID;
	}
	
	public function recipeList($_date = '')
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
			
			$response = call_user_func_array(array('parent', 'createACSReceiptsList'), $data);
    		
    		if(!empty($response->error)){
    			return 'Error: ' . $response->error;
    		} else {
    			return array($response->massNumber);
    		}
    		
		} catch (Exception $e){
			print_r($e);
		}
    }
    
    public function printList($_list_number)
    {
    	return file_get_contents(
   			sprintf($this->_print_list_url, 
   			$this->_companyId, 
   			$this->_companyPass, 
   			$this->_username, 
   			$this->_password, 
   			$_list_number,
   			date('Y-m-d'))
   		);
    }
    
    public function listFunctions()
    {
    	return parent::__getFunctions();
    }
	
}