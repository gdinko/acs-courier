<?

require_once(dirname(__FILE__) . '/credit.php');

class Acs_Eps extends SoapClient
{
	private $_settings;
	
	private $_companyId;
	private $_companyPass;
	private $_username;
	private $_password;
	private $_customerId;
	
	private $_get_pdf_url = 'https://acs-eud2.acscourier.net/Test/Eshops/GetVoucher.aspx?MainID=%s&MainPass=%s&UserID=%s&UserPass=%s&voucherno=%s&PrintType=2&StartFromNumber=1';

	public function __construct( $_settings = array() )
	{
		$this->_settings = array(
		    'wsdl' => "https://services.acscourier.net/ACSCreateVoucher-portlet/axis/Plugin_ACSCreateVoucher_ACSVoucherService?wsdl",
		);
		
		//set wsdl url
		parent::SoapClient( $this->_settings['wsdl'] );
		
		$this->_companyId = COMPANYID;
		$this->_companyPass = COMPANYPASS;
		$this->_username = USERNAME;
		$this->_password = PASSWORD;
		$this->_customerId = CUSTOMERID;
		
	}
	
	public function createTovar( $_data )
    {
		try{
			
    		$response = call_user_func_array(array('parent', 'createVoucher'), $_data);
    		if(!empty($response->errorMsg)){
    			return $response->errorMsg;
    		} else {
    			return array($response->no_pod); 	
    		}
    		
		} catch (Exception $e){
			print_r($e);
		}
    }
    
    public function printTovar( $_no_pod )
    {
   		return file_get_contents(
   			sprintf($this->_get_pdf_url, 
   			$this->_companyId, 
   			$this->_companyPass, 
   			$this->_username, 
   			$this->_password, 
   			$_no_pod)
   		);
    }
    
    public function listFunctions()
    {
    	return parent::__getFunctions();
    }
	
	
}