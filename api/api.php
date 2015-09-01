<?php 
/*
///////////////////////////////////////////////////////

// Class consists functions for REST Webservice. 

///////////////////////////////////////////////////////
created by: Rahul Vyas
*/
 			
require_once("Rest.inc.php");
require_once("general_operation_cls.php");

class API extends REST {

	public $data = "";
	
	private $objService = NULL;

	public function __construct(){
		parent::__construct();				// Init parent contructor
		$this->objService = new General_Operation(); // Init general operation class
	}
	
	/*
	 * Public method for access api.
	 * This method dynmically call the method based on the query string
	 *
	 */
	public function processApi(){
		$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
		if((int)method_exists($this,$func) > 0)
			$this->$func();
		else
			$this->response('',404);	// If the method not exist with in this class, response would be "Page not found".
	}
	
	public function getCompanies(){
		
		// Check post method
		if($this->get_request_method() != "POST"){
			//$this->response('Error!!',406);
		}						
		
		$result = $this->objService->getCompanies();			
		$this->response($this->json($result), 200);
	}
	
	public function getCompany(){
		
		// Check post method
		if($this->get_request_method() != "POST"){
			$this->response('Error!!',406);
		}									
					
		$result = $this->objService->getCompany($this->_request);			
		$this->response($this->json($result), 200);
	}		
			
	public function createCompany(){
		
		// Check post method
		if($this->get_request_method() != "POST"){
			$this->response('Error!!',406);
		}
		
		// Call create company function
		$result = $this->objService->createCompany($this->_request);			
		$this->response($this->json($result), 200);
		
	}

	public function updateCompany(){
		
		// Check post method
		if($this->get_request_method() != "POST"){
			$this->response('Error!!',406);
		}
		
		$result = $this->objService->updateCompany($this->_request);			
		$this->response($this->json($result), 200);			
	}
	
	public function deleteCompany(){
		
		// Check post method
		if($this->get_request_method() != "POST"){
			$this->response('Error!!',406);
		}
		
		$result = $this->objService->deleteCompany($this->_request);			
		$this->response($this->json($result), 200);			
	}
	
	/*
	 *	Encode array into JSON
	*/
	private function json($data){
		if(is_array($data)){
			return json_encode($data);
		}
	}
}	

// Initiiate Library

$api = new API;
$api->processApi();
?>