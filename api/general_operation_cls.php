<?php 
/*
///////////////////////////////////////////////////////

// Class consists functions required for Webservice. 

///////////////////////////////////////////////////////
created by: Rahul Vyas
*/

require_once('../system/dbclass.php');


class General_Operation
{
	private $dbWebServiceObj;			//this is the declaration of object variable	
    public $params = array();
	
	// Function is called automatically as it is constructure method
	function __construct(){
		// Define DB level object
		$this->dbWebServiceObj	=	new DbClass();				
	}
	
	/*********************************************************************
	Get company list
	
	Response: 	Array
			-	ComapnyID
			-	Name
			-	Address
			-	City
			-	Country
			-	Email 
			-	Phone		

	*********************************************************************/
	
	function getCompanies(){
		$result = array();
		$sql = "select * from companies";				
		$result["success"] = 1;
		$result["data"] = $this->dbWebServiceObj->sqlQuery($sql);
		return $result;
	}
	
	/*********************************************************************
	Get company details
	Post Field:
			-	ComapnyID
	Response: 	Array
			-	ComapnyID
			-	Name
			-	Address
			-	City
			-	Country
			-	Email 
			-	Phone	
			- 	Directors (Array)
	*********************************************************************/
	
	function getCompany($post){
	
		$result = array();		
		$CompanyID 	= $post['CompanyID'];
		
		if($this->isNotEmpty($CompanyID)){
			$sql = "select * from companies WHERE CompanyID = ".$CompanyID;							
			$res = $this->dbWebServiceObj->sqlQuery($sql);
			$result["success"] = 1;
			if(isset($res[0]) and !empty($res[0])){
				$result["data"] = $res[0];
				$result["data"]['Directors'] = $this->getDirectors($CompanyID);
			}else{
				$result["data"] = array();
			}			
		}else{
			$result = array('success'=> 0, 'error'=>'Invalid field values'); 
		}
		return $result;
	}
	
	/*********************************************************************
	Get Director list
	Parameter : 
			- ComapnyID
	Response: Array
			-	DirectorID
			-	ComapnyID
			-	Name
	*********************************************************************/
	
	function getDirectors($CompanyID){
		$sql = "select Name from directors WHERE CompanyID = ".$CompanyID;							
		$res = $this->dbWebServiceObj->sqlQuery($sql);
		return $res;
	}
	
	/*********************************************************************
	Create company
	Post Field:			
			-	Name
			-	Address
			-	City
			-	Country
			-	Email 
			-	Phone	
			- 	Directors (Array)
	Response: Array
			- success (0 or 1)
			
	*********************************************************************/
	
	function createCompany($post){
		
		$result = array();
		
		$Name 		= $post['Name'];
		$Address 	= $post['Address'];
		$City 		= $post['City'];
		$County 	= $post['County'];
		$Email 		= $post['Email'];
		$Phone 		= $post['Phone'];			
		$Directors 	= $post['Directors'];
		
		if($this->isNotEmpty($Name) and $this->isNotEmpty($Address) and $this->isNotEmpty($City) and $this->isNotEmpty($County)){		
			$sql = "Insert into companies(Name,Address,City,County,Email,Phone) values('".$Name."','".$Address."','".$City."','".$County."','".$Email."','".$Phone."')";
			$Id	= $this->dbWebServiceObj->insert($sql);			
			if($Id > 0){
				if(isset($Directors) and !empty($Directors)){
					$this->addDirectors($Id,$Directors);
				}
				$result = array('success'=> 1);
			}else{
				$result = array('success'=> 0, 'error'=>'Insert option failed');
			}
			
		}else{		
			$result = array('success'=> 0, 'error'=>'Invalid field values');
		}
		
		return $result;
	}
	/*********************************************************************
	Update company
	Post Field:	
			- 	ComapnyID
			-	Name
			-	Address
			-	City
			-	Country
			-	Email 
			-	Phone	
			- 	Directors (Array)
	Response: Array
			- success (0 or 1)
			
	*********************************************************************/
	function updateCompany($post){
		
		$result = array();
		
		$ComapnyID 	= $post['ComapnyID'];
		$Name 		= $post['Name'];
		$Address 	= $post['Address'];
		$City 		= $post['City'];
		$County 	= $post['County'];
		$Email 		= $post['Email'];
		$Phone 		= $post['Phone'];			
		$Directors 	= $post['Directors'];		
		
		if($this->isNotEmpty($Name) and $this->isNotEmpty($Address) and $this->isNotEmpty($City) and $this->isNotEmpty($County)){		
			
			$sql_u = "Update companies SET Name = '".$Name."',Address = '".$Address."',City = '".$City."',County = '".$County."',Email = '".$Email."',Phone = '".$Phone."' WHERE CompanyID = ".$ComapnyID;			
			$res =	$this->dbWebServiceObj->sqlQuery($sql_u);			
			if($res > 0){				
				if(isset($Directors) and !empty($Directors)){
					$this->addDirectors($ComapnyID,$Directors);
				}
				$result = array('success'=> 1);
			}else{
				$result = array('success'=> 0, 'error'=>'update operation failed');			
			}
			
		}else{		
			$result = array('success'=> 0, 'error'=>'Invalid field values');
		}
		
		return $result;
	}
	/*********************************************************************
	Delete company
	Post Field:	
			- 	ComapnyID		
	Response: Array
			- success (0 or 1)
			
	*********************************************************************/
	function deleteCompany($post){
		
		$result = array();		
		$ComapnyID = $post['CompanyID'];
		
		if(isset($ComapnyID) and !empty($ComapnyID)){
			
			$sql = "DELETE FROM companies WHERE CompanyID = ".$ComapnyID;
			$res =	$this->dbWebServiceObj->sqlQuery($sql);
			
			$sql_d = "DELETE FROM directors WHERE CompanyID = ".$ComapnyID;
			$res =	$this->dbWebServiceObj->sqlQuery($sql_d);
			
			$result = array('success'=> 1);
		}else{
			$result = array('success'=> 0, 'error'=>'delete operation failed');		
		}
		return $result;
	}
	/*********************************************************************
	Add company Directors
	Parameter:	
			- 	ComapnyID		
			- 	Directors (Array) 
			
	*********************************************************************/
	function addDirectors($ComapnyID,$Directors){
		
		$sql_u = "DELETE FROM directors WHERE CompanyID = ".$ComapnyID;
		$res =	$this->dbWebServiceObj->sqlQuery($sql_u);		
		
		foreach($Directors as $Director){
			$sql_i = "Insert into directors(CompanyID,Name) values(".$ComapnyID.",'".$Director."')";
			$Id	= $this->dbWebServiceObj->insert($sql_i);
		}		
	}
	
	/*******************************************************
	Post field validation - Is empty or not
	********************************************************/
	
	function isNotEmpty($field){
		if(isset($field) and !empty($field)){
			return true;
		}else{
			return false;
		}
	}
	
}
?>