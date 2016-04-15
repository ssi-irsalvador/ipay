<?php
/**
 * Initial Declaration
 */

/**
 * Class Module
 * @author  JIM
 */
class clsMassAssignCC{
	var $conn;
	var $fieldMap;
	var $Data;

	/**
	 * Class Constructor
	 * @param object $dbconn_
	 * @return clsMassAssignCC object
	 */
	function clsMassAssignCC($dbconn_ = null){
		$this->conn =& $dbconn_;
		$this->fieldMap = array(
		 "mnu_name" => "mnu_name"
		,"mnu_desc" => "mnu_desc"
		,"mnu_parent" => "mnu_parent"
		,"mnu_icon" => "mnu_icon"
		,"mnu_ord" => "mnu_ord"
		,"mnu_status" => "mnu_status"
		,"mnu_link_info" => "mnu_link_info"
		);
	}

	/**
	 * Get the records from the database
	 * @param string $id_
	 * @return array
	 */
	function dbFetch($id_ = ""){
		$sql = "select * from cost_center where cc_id=?";
		$rsResult = $this->conn->Execute($sql,array($id_));
		if(!$rsResult->EOF){
			return $rsResult->fields;
		}
	}
	
	/**
	 * Populate array parameters to Data Variable
	 * @param array $pData_
	 * @param boolean $isForm_
	 * @return bool
	 */
	function doPopulateData($pData_ = array(),$isForm_ = false){
		if(count($pData_)>0){
			foreach ($this->fieldMap as $key => $value) {
				if ($isForm_) {
					$this->Data[$value] = $pData_[$value];
				}else {
					$this->Data[$key] = $pData_[$value];
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * Validation function
	 * @param array $pData_
	 * @return bool
	 */
	function doValidateData($pData_ = array(), $kind_of_validation){
		$isValid = true;
		if (empty($pData_['chkAttend'])){
			$isValid = false;
			$_SESSION['eMsg'][] = "Please Select Employee/s to {$kind_of_validation}.";
		}
//		$isValid = false;
		return $isValid;
	}

	/**
	 * Save New Record
	 */
	function doSaveAdd(){
		$flds = array();
		foreach ($this->Data as $keyData => $valData) {
			$valData = addslashes($valData);
			$flds[] = "$keyData='$valData'";
		}
		$fields = implode(", ",$flds);
		$sql = "INSERT INTO /*app_modules*/ SET $fields";
		$this->conn->Execute($sql);
		$_SESSION['eMsg']="Successfully Added.";
	}

	/**
	 * Save Update
	 *
	 */
	function doSaveEdit(){
		$id = $_GET['edit'];
		$flds = array();
		foreach ($this->Data as $keyData => $valData) {
			$valData = addslashes($valData);
			$flds[] = "$keyData='$valData'";
		}
		$fields = implode(", ",$flds);
		$sql = "UPDATE /*app_modules*/ SET $fields WHERE mnu_id=$id";
		$this->conn->Execute($sql);
		$_SESSION['eMsg']="Successfully Updated.";
	}

	/**
	 * Delete Record
	 * @param string $id_
	 */
	function doDelete($id_ = ""){
		$sql = "DELETE FROM /*app_modules*/ WHERE mnu_id=?";
		$this->conn->Execute($sql,array($id_));
		$_SESSION['eMsg']="Successfully Deleted.";
	}

	/**
	 * Get all the Table Listings
	 * @return array
	 */
	function getTableList(){
		// Process the query string and exclude querystring named "p"
		if (!empty($_SERVER['QUERY_STRING'])) {
			$qrystr = explode("&",$_SERVER['QUERY_STRING']);
			foreach ($qrystr as $value) {
				$qstr = explode("=",$value);
				if ($qstr[0]!="p") {
					$arrQryStr[] = implode("=",$qstr);
				}
			}
			$aQryStr = $arrQryStr;
			$aQryStr[] = "p=@@";
			$queryStr = implode("&",$aQryStr);
		}

		//bby: search module
		$qry = array();
		if (isset($_REQUEST['search_field'])) {
			// lets check if the search field has a value
			if (strlen($_REQUEST['search_field'])>0) {
				// lets assign the request value in a variable
				$search_field = $_REQUEST['search_field'];
				// create a custom criteria in an array
				$qry[] = "cc_code like '%$search_field%'";
				$qry[] = "cc_name like '%$search_field%'";
			}
		}

		// put all query array into one criteria string
		$criteria = (count($qry)>0)?" WHERE ".implode(" OR ",$qry):"";

		// Sort field mapping
		$arrSortBy = array(
		 "viewdata"=>"viewdata"
		,"cc_code"=>"cc_code"
		,"cc_name"=>"cc_name"
		);

		if(isset($_GET['sortby'])){
			$strOrderBy = " order by ".$arrSortBy[$_GET['sortby']]." ".$_GET['sortof'];
		}

		// Add Option for Image Links or Inline Form eg: Checkbox, Textbox, etc...
		$viewLink = "";
		$viewAssignedEmployee = "<a href=\"?statpos=mass_assign_cc&cc_id=',am.cc_id,'\"><img src=\"".SYSCONFIG_DEFAULT_IMAGES_INCTEMP."icons/edited/useradd.png\" title=\"View Assigned Employee\" hspace=\"2px\" border=0 width=\"16\" height=\"16\"></a>";
		
		// SqlAll Query
		$sql = "SELECT am.*, CONCAT('$viewAssignedEmployee') as viewdata
						FROM cost_center am
						$criteria
						$strOrderBy";

		// Field and Table Header Mapping
		$arrFields = array(
		 "viewdata"=>""
		,"cc_code"=>"Cost Center Code"
		,"cc_name"=>"Cost Center Name"
		);

		// Column (table data) User Defined Attributes
		$arrAttribs = array(
		"mnu_ord"=>" align='center'",
		"viewdata"=>"width='50' align='center'"
		);

		// Process the Table List
		$tblDisplayList = new clsTableList($this->conn);
		$tblDisplayList->arrFields = $arrFields;
		$tblDisplayList->paginator->linkPage = "?$queryStr";
		$tblDisplayList->sqlAll = $sql;
		$tblDisplayList->sqlCount = $sqlcount;
		return $tblDisplayList->getTableList($arrAttribs);
	}
	/**
	 * Get all the Table Listings for Employees in a Cost Center
	 * @return array
	 */
	function getTableListEmployee(){
		// Process the query string and exclude querystring named "p"
		if (!empty($_SERVER['QUERY_STRING'])) {
			$qrystr = explode("&",$_SERVER['QUERY_STRING']);
			foreach ($qrystr as $value) {
				$qstr = explode("=",$value);
				if ($qstr[0]!="p") {
					$arrQryStr[] = implode("=",$qstr);
				}
			}
			$aQryStr = $arrQryStr;
			$aQryStr[] = "p=@@";
			$queryStr = implode("&",$aQryStr);
		}
		
		//bby: search module
		$qry = array();
		if (isset($_REQUEST['search_field'])) {
			// lets check if the search field has a value
			if (strlen($_REQUEST['search_field']) > 0) {
				// lets assign the request value in a variable
				$search_field = $_REQUEST['search_field'];
				
				// create a custom criteria in an array
				$qry[] = "(pinfo.pi_fname LIKE '%$search_field%' OR pinfo.pi_lname LIKE '%$search_field%' OR dept.ud_name LIKE '%$search_field%')";
			}
		}
		
		$qry[] = "emp_masterfile.emp_stat IN ('1','7','10')";
        $qry[] = "emp_masterfile.emp_id NOT IN (select emp_id FROM cost_center_assignment WHERE cc_id='{$_GET['cc_id']}')";
		// put all query array into one criteria string
		$criteria = (count($qry)>0)?" WHERE ".implode(" AND ",$qry):"";
		
		// Sort field mapping
		$arrSortBy = array(
		"checkbox"=>"checkbox"
		,"emp_idnum"=>"emp_idnum"
		,"pi_lname"=>"pi_lname"
		,"pi_fname"=>"pi_fname"
		,"post_name"=>"post_name"
		,"comp_name"=>"comp_name"
		,"branchinfo_name"=>"branchinfo_name"
		,"ud_name"=>"ud_name"
		,"textbox"=>"textbox"
		);

		if (isset($_GET['sortby'])) {
			$strOrderBy = " ORDER BY {$arrSortBy[$_GET['sortby']]} {$_GET['sortof']}";
		} else {
			$strOrderBy = " ORDER BY pi_lname";
		}
		
		// @note: This is used to count and check all the checkbox.
		// @note: SET t1 = 0
		$sql = "SET @t1:=0";
		$this->conn->Execute($sql);
		// Get total number of records and pass it to the javascript function CheckAll
		$sql2 = "SELECT COUNT(`emp_masterfile`.`emp_idnum`) AS mycount
				FROM
					`emp_masterfile`
					$criteria";
		$rsResult = $this->conn->Execute($sql2);
		if (!$rsResult->EOF) {
			$mycount = $rsResult->fields['mycount'];
		}
		
		// Add Option for Image Links or Inline Form eg: Checkbox, Textbox, etc...
		$chkAttend = "<input type=\"checkbox\" name=\"chkAttend[]\" id=\"chkAttend[',@t1:=@t1+1,']\" value=\"',`emp_masterfile`.`emp_id`,'\" onclick=\"javascript:UncheckAll({$mycount});\">";
		$textbox = "<input type=\"text\" name=\"txtBox[',`emp_masterfile`.`emp_id`,']\" id=\"txtBox[',@t1:=@t1+1,']\" value=\"',100,'\" onclick=\"javascript:UncheckAll({$mycount});\">";
		
		// SqlAll Query
		$sql = "SELECT
					`emp_masterfile`.`emp_idnum`
					, `emp_masterfile`.`emp_id`
					, `emp_personal_info`.`pi_lname`
					, `emp_personal_info`.`pi_fname`
					, `emp_position`.`post_name`
					, `company_info`.`comp_name`
					, `branch_info`.`branchinfo_name`
					, `app_userdept`.`ud_name`
					,  CONCAT('$chkAttend') AS chkbox
					,  CONCAT('$textbox') AS textbox
				FROM
					`emp_masterfile`
					INNER JOIN `emp_personal_info` 
						ON (`emp_personal_info`.`pi_id` = `emp_masterfile`.`pi_id`)
					INNER JOIN `emp_position` 
						ON (`emp_position`.`post_id` = `emp_masterfile`.`post_id`)
					INNER JOIN `company_info` 
						ON (`company_info`.`comp_id` = `emp_masterfile`.`comp_id`)
					LEFT JOIN `branch_info` 
						ON (`emp_masterfile`.`branchinfo_id` = `branch_info`.`branchinfo_id`)
					LEFT JOIN `app_userdept` 
						ON (`emp_masterfile`.`ud_id` = `app_userdept`.`ud_id`)
					$criteria
					$strOrderBy";

		// Field and Table Header Mapping
		$arrFields = array(
		"chkbox"=>"<input title=\"Select All\" type=\"checkbox\" name=\"chkAttendAll\" id=\"chkAttendAll\" onclick=\"javascript:CheckAll({$mycount});\" style=\"margin-left: 3px;\" />"
		//"chkbox"=>"Action"
		,"emp_idnum"=>"Emp No."
		,"pi_lname"=>"Last Name"
		,"pi_fname"=>"First Name"
		,"post_name"=>"Position"
		,"comp_name"=>"Company"
		,"branchinfo_name"=>"Location"
		,"ud_name"=>"Department"
		,"textbox"=>"Percentage"
		);
		
		// Column (table data) User Defined Attributes
		$arrAttribs = array(
		"chkbox"=>"width='30' align='center'"
		);
		
		// Process the Table List
		$tblDisplayList = new clsTableList($this->conn);
		$tblDisplayList->arrFields = $arrFields;
		$tblDisplayList->paginator->linkPage = "?$queryStr";
		$tblDisplayList->sqlAll = $sql;
		$tblDisplayList->sqlCount = $sqlcount;
		$tblDisplayList->tblBlock->templateFile = "table_no_fieldset.tpl.php";
		$tblDisplayList->tblBlock->assign("noSearchStart","<!--");
		$tblDisplayList->tblBlock->assign("noSearchEnd","-->");
		
		return $tblDisplayList->getTableList($arrAttribs);
	}
	
	/**
	 * Get all the Table Listings for Employees in a Cost Center
	 * @return array
	 */
	function getTableListEmployeeWithCC(){
		// Process the query string and exclude querystring named "p"
		if (!empty($_SERVER['QUERY_STRING'])) {
			$qrystr = explode("&",$_SERVER['QUERY_STRING']);
			foreach ($qrystr as $value) {
				$qstr = explode("=",$value);
				if ($qstr[0]!="p") {
					$arrQryStr[] = implode("=",$qstr);
				}
			}
			$aQryStr = $arrQryStr;
			$aQryStr[] = "p=@@";
			$queryStr = implode("&",$aQryStr);
		}
		
		//bby: search module
		$qry = array();
		if (isset($_REQUEST['search_field'])) {
			// lets check if the search field has a value
			if (strlen($_REQUEST['search_field']) > 0) {
				// lets assign the request value in a variable
				$search_field = $_REQUEST['search_field'];
				
				// create a custom criteria in an array
				$qry[] = "(pinfo.pi_fname LIKE '%$search_field%' OR pinfo.pi_lname LIKE '%$search_field%' OR dept.ud_name LIKE '%$search_field%')";
			}
		}
		
		$qry[] = "emp_masterfile.emp_stat IN ('1','7','10')";
        $qry[] = "emp_masterfile.emp_id IN (select emp_id FROM cost_center_assignment WHERE cc_id='{$_GET['cc_id']}')";
		$qry[] = "cost_center_assignment.cc_id='{$_GET['cc_id']}'";
        // put all query array into one criteria string
		$criteria = (count($qry)>0)?" WHERE ".implode(" AND ",$qry):"";
		
		// Sort field mapping
		$arrSortBy = array(
		"checkbox"=>"checkbox"
		,"emp_idnum"=>"emp_idnum"
		,"pi_lname"=>"pi_lname"
		,"pi_fname"=>"pi_fname"
		,"post_name"=>"post_name"
		,"comp_name"=>"comp_name"
		,"branchinfo_name"=>"branchinfo_name"
		,"ud_name"=>"ud_name"
		,"textbox"=>"textbox"
		);

		if (isset($_GET['sortby'])) {
			$strOrderBy = " ORDER BY {$arrSortBy[$_GET['sortby']]} {$_GET['sortof']}";
		} else {
			$strOrderBy = " ORDER BY pi_lname";
		}
		
		// @note: This is used to count and check all the checkbox.
		// @note: SET t1 = 0
		$sql = "SET @t1:=0";
		$this->conn->Execute($sql);
		// Get total number of records and pass it to the javascript function CheckAll
		$sql2 = "SELECT COUNT(`emp_masterfile`.`emp_idnum`) AS mycount
				FROM
					`emp_masterfile`
					$criteria";
		$rsResult = $this->conn->Execute($sql2);
		if (!$rsResult->EOF) {
			$mycount = $rsResult->fields['mycount'];
		}
		
		// Add Option for Image Links or Inline Form eg: Checkbox, Textbox, etc...
		$chkAttend = "<input type=\"checkbox\" name=\"chkAttend[]\" id=\"chkAttend[',@t1:=@t1+1,']\" value=\"',`emp_masterfile`.`emp_id`,'\" onclick=\"javascript:UncheckAll({$mycount});\">";
		$textbox = "<input type=\"text\" name=\"txtBox[',`emp_masterfile`.`emp_id`,']\" id=\"txtBox[',@t1:=@t1+1,']\" value=\"',`cost_center_assignment`.`cc_assign_pct`,'\" >";
		// SqlAll Query
		$sql = "SELECT
					`emp_masterfile`.`emp_idnum`
					, `emp_masterfile`.`emp_id`
					, `emp_personal_info`.`pi_lname`
					, `emp_personal_info`.`pi_fname`
					, `emp_position`.`post_name`
					, `company_info`.`comp_name`
					, `branch_info`.`branchinfo_name`
					, `app_userdept`.`ud_name`
					, `cost_center_assignment`.`cc_assign_pct`
					,  CONCAT('$chkAttend') AS chkbox
					,  CONCAT('$textbox') AS textbox
				FROM
					`emp_masterfile`
					INNER JOIN `emp_personal_info` 
						ON (`emp_personal_info`.`pi_id` = `emp_masterfile`.`pi_id`)
					INNER JOIN `emp_position` 
						ON (`emp_position`.`post_id` = `emp_masterfile`.`post_id`)
					INNER JOIN `company_info` 
						ON (`company_info`.`comp_id` = `emp_masterfile`.`comp_id`)
					LEFT JOIN `branch_info` 
						ON (`emp_masterfile`.`branchinfo_id` = `branch_info`.`branchinfo_id`)
					LEFT JOIN `app_userdept` 
						ON (`emp_masterfile`.`ud_id` = `app_userdept`.`ud_id`)
					JOIN `cost_center_assignment` 
						ON (`cost_center_assignment`.`emp_id` = `emp_masterfile`.`emp_id`)
					$criteria
					$strOrderBy";

		// Field and Table Header Mapping
		$arrFields = array(
		"chkbox"=>"<input title=\"Select All\" type=\"checkbox\" name=\"chkAttendAll\" id=\"chkAttendAll\" onclick=\"javascript:CheckAll({$mycount});\" style=\"margin-left: 3px;\" />"
		//"chkbox"=>"Action"
		,"textbox"=>"Percentage"
		,"emp_idnum"=>"Emp No."
		,"pi_lname"=>"Last Name"
		,"pi_fname"=>"First Name"
		,"post_name"=>"Position"
		,"comp_name"=>"Company"
		,"branchinfo_name"=>"Location"
		,"ud_name"=>"Department"
		);
		
		// Column (table data) User Defined Attributes
		$arrAttribs = array(
		"chkbox"=>"width='30' align='center'"
		);
		
		// Process the Table List
		$tblDisplayList = new clsTableList($this->conn);
		$tblDisplayList->arrFields = $arrFields;
		$tblDisplayList->paginator->linkPage = "?$queryStr";
		$tblDisplayList->sqlAll = $sql;
		$tblDisplayList->sqlCount = $sqlcount;
		$tblDisplayList->tblBlock->templateFile = "table_no_fieldset.tpl.php";
		$tblDisplayList->tblBlock->assign("noSearchStart","<!--");
		$tblDisplayList->tblBlock->assign("noSearchEnd","-->");
		
		return $tblDisplayList->getTableList($arrAttribs);
	}
	
	function getTotalEmployee($id_ = null){
		$sql = "select count(distinct emp_id) as total_ from cost_center_assignment where cc_id=?";
		$rsResult = $this->conn->Execute($sql,array($id_));
		if(!$rsResult->EOF){
			return $rsResult->fields['total_'];
		}
	}
	
	function assignEmployee($pData) {
		$flds = array();
		$flds_ = array();
		$ctr = 0;
		do {
			$flds_[] = "cc_id='{$_GET['cc_id']}'";
			$flds_[] = "emp_id='{$pData['chkAttend'][$ctr]}'";
			$flds_[] = "cc_assign_pct='{$pData['txtBox'][$pData['chkAttend'][$ctr]]}'";
			$fields_ = implode(", ",$flds_);
			$sql_insert = "INSERT INTO cost_center_assignment SET $fields_";
			$this->conn->Execute($sql_insert);
			$flds_ = "";
			$fields_ = "";
			$ctr++;
		} while($ctr < sizeof($pData['chkAttend']));
		
		$sql_cc = "SELECT cc_name FROM `cost_center` WHERE `cc_id` = '{$_GET['cc_id']}'";
		$sql_cc_result = $this->conn->Execute($sql_cc);
		
		$_SESSION['eMsg']="Successfully Assigned Employee/s to {$sql_cc_result->fields['cc_name']}.";
	}
	
	function removeEmployee($pData = null){
		$flds_ = array();
		$ctr = 0;
		do {
			$flds_[] = "cc_id='{$_GET['cc_id']}'";
			$flds_[] = "emp_id='{$pData['chkAttend'][$ctr]}'";
			$fields_ = "WHERE ".implode("AND ",$flds_);
			$sql = "DELETE FROM cost_center_assignment $fields_";
			$this->conn->Execute($sql);
			$flds_ = "";
			$fields_ = "";
			$ctr++;
		} while($ctr < sizeof($pData['chkAttend']));
		$sql_cc = "SELECT cc_name FROM `cost_center` WHERE `cc_id` = '{$_GET['cc_id']}'";
		$sql_cc_result = $this->conn->Execute($sql_cc);
		
		$_SESSION['eMsg']="Successfully Deleted Employee/s to {$sql_cc_result->fields['cc_name']}.";
	}
	
	function updateEmployee($pData = null){
		$flds_ = array();
		$ctr = 0;
		foreach($pData['txtBox'] as $key => $value){
			$flds_[] = "cc_id='{$_GET['cc_id']}'";
			$flds_[] = "emp_id='{$key}'";
			$fields_ = "WHERE ".implode("AND ",$flds_);
			$sql = "UPDATE cost_center_assignment SET cc_assign_pct='$value' $fields_";
			$this->conn->Execute($sql);
			$flds_ = "";
			$fields_ = "";
		}
		$sql_cc = "SELECT cc_name FROM `cost_center` WHERE `cc_id` = '{$_GET['cc_id']}'";
		$sql_cc_result = $this->conn->Execute($sql_cc);
		
		$_SESSION['eMsg']="Successfully Update Employee/s in {$sql_cc_result->fields['cc_name']}.";
	}
}
?>