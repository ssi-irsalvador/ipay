<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/compbanks.class.php');
Application::app_initialize();
$dbconn = Application::db_open();
//$dbconn->debug=1;
$cmap = array(
"default" => "emp_masterfile.tpl.php"
,"add" => "emp_masterfile_form.tpl.php"
,"edit" => "emp_masterfile_form.tpl.php"
,"empinfo" => "employmentdetails_form.tpl.php"
);
$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
);
$cmapKey = isset($_GET['add'])?"add":$cmapKey;
$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['empinfo'])?"empinfo":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['empinfodelete'])?"empinfodelete":$cmapKey;
$cmapKey = isset($_GET['empsalaryinfodelete'])?"empsalaryinfodelete":$cmapKey;
$cmapKey = isset($_GET['bendelete'])?"bendelete":$cmapKey;
$cmapKey = isset($_GET['loandelete'])?"loandelete":$cmapKey;
$cmapKey = isset($_GET['leavedelete'])?"leavedelete":$cmapKey;
$cmapKey = isset($_GET['depnddelete'])?"depnddelete":$cmapKey;
$cmapKey = isset($_GET['REDdepnddelete'])?"REDdepnddelete":$cmapKey;
$cmapKey = isset($_POST['loan'])?"loan":$cmapKey;
$cmapKey = isset($_POST['loanupdate'])?"loanupdate":$cmapKey;
$cmapKey = isset($_POST['leaveupdate'])?"leaveupdate":$cmapKey;
$cmapKey = isset($_POST['deduction'])?"deduction":$cmapKey;
$cmapKey = isset($_POST['addben'])?"benefit":$cmapKey;
$cmapKey = isset($_POST['benefitupdate'])?"benefitupdate":$cmapKey;
$cmapKey = isset($_POST['add_govinfo'])?"add_govinfo":$cmapKey;
$cmapKey = isset($_POST['add_bankinfo'])?"add_bankinfo":$cmapKey;
$cmapKey = isset($_POST['add_ot'])?"add_ot":$cmapKey;
$cmapKey = isset($_POST['add_leave'])?"add_leave":$cmapKey;
$cmapKey = isset($_POST['add_compensation'])?"add_compensation":$cmapKey;
$cmapKey = isset($_POST['update_compensation'])?"update_compensation":$cmapKey;
$cmapKey = isset($_POST['update_bankinfo'])?"update_bankinfo":$cmapKey;
$cmapKey = isset($_POST['add_depnd'])?"add_depnd":$cmapKey;
$cmapKey = isset($_POST['update_depnd'])?"update_depnd":$cmapKey;
$cmapKey = isset($_POST['add_dependent'])?"add_dependent":$cmapKey;
$cmapKey = isset($_POST['update_dependent'])?"update_dependent":$cmapKey;
//get the employee picture
if (isset($_GET['img'])) {
	$sql = "select emp_picture from emp_masterfile where emp_id = ?";
	$rsResult = $dbconn->Execute($sql,array($_GET['img']));
	if (!$rsResult->EOF) {
		if (!empty($rsResult->fields['emp_picture'])){
				header("Content-type: image/jpeg");
				print $rsResult->fields['emp_picture'];
		} else {
			header("Content-type: image/jpeg");
			echo file_get_contents(SYSCONFIG_THEME_PATH.SYSCONFIG_THEME."/images/nopic.PNG");
		}
	}
	exit;
}
// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Employee Master File');
$mainBlock->templateDir .= "admin";
// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];
/*-!-!-!-!-!-!-!-!-*/
$centerPanelBlock->assign("salaryactive",$SalaryActive);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);
$objClsCompBanks = new clsCompBanks($dbconn);
$centerPanelBlock->assign('bnkaccntype',$objClsCompBanks->bnkaccntype());
$centerPanelBlock->assign('departments',$objClsEMP_MasterFile->departments());
$centerPanelBlock->assign('comp',$objClsEMP_MasterFile->comp());
$centerPanelBlock->assign('emptype',$objClsEMP_MasterFile->emptype());
$centerPanelBlock->assign('empcateg',$objClsEMP_MasterFile->empcateg());
$centerPanelBlock->assign('empstat_',$objClsEMP_MasterFile->empstat());
$centerPanelBlock->assign('branch',$objClsEMP_MasterFile->brachlist());
$centerPanelBlock->assign('position',$objClsEMP_MasterFile->position());
$centerPanelBlock->assign("emp_bank_info",$objClsEMP_MasterFile->emp_bank_info());
$centerPanelBlock->assign("taxep",$objClsEMP_MasterFile->tax_exemption());
$centerPanelBlock->assign("loan",$objClsEMP_MasterFile->loan());
$centerPanelBlock->assign("loantype",$objClsEMP_MasterFile->loantype());
$centerPanelBlock->assign("loanList",$objClsEMP_MasterFile->loanList());
$centerPanelBlock->assign("loanData",$objClsEMP_MasterFile->loanData());
$centerPanelBlock->assign("benData",$objClsEMP_MasterFile->benData());
$centerPanelBlock->assign("benList",$objClsEMP_MasterFile->benList());
$centerPanelBlock->assign("otList",$objClsEMP_MasterFile->otList());
$centerPanelBlock->assign("leaveList",$objClsEMP_MasterFile->leaveList());
$centerPanelBlock->assign("payelement",$objClsEMP_MasterFile->payelement());
//$centerPanelBlock->assign('tblDataList',$objClsEMP_MasterFile->getTableList());
$centerPanelBlock->assign('govTableList',$objClsEMP_MasterFile->govTableList());
$centerPanelBlock->assign('gov',$_SESSION['govList']);
$centerPanelBlock->assign('deduction_type',$objClsEMP_MasterFile->deductiontype());
$centerPanelBlock->assign('salary_type',$objClsEMP_MasterFile->salarytype());
$centerPanelBlock->assign('leave_type',$objClsEMP_MasterFile->leavetype());
$centerPanelBlock->assign('getPGroup',$objClsEMP_MasterFile->getPGroup());
$centerPanelBlock->assign('getFactorRate',$objClsEMP_MasterFile->getFactorRate());

switch ($cmapKey) {
	case 'add':
		$arrbreadCrumbs['Employee Information'] = 'transaction.php?statpos=emp_masterfile';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
		// save add new
			if (!$objClsEMP_MasterFile->doValidateData($_POST)) {
				$objClsEMP_MasterFile->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEMP_MasterFile->Data_pinfo);
//				printa($objClsEMP_MasterFile->Data_pinfo);
			} else {
				$objClsEMP_MasterFile->doPopulateData($_POST);
				$emp_id = $objClsEMP_MasterFile->doSaveAdd();
				header("Location: transaction.php?statpos=emp_masterfile&empinfo=".$emp_id."#tab-1");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Employee Information'] = 'transaction.php?statpos=emp_masterfile';
		$arrbreadCrumbs['View'] = "";
		if (count($_POST)>0) {
			$objClsEMP_MasterFile->doPopulateData($_POST);
			$objClsEMP_MasterFile->doSaveAdd(true);
			//$objClsEMP_MasterFile->doSaveEdit();
			//$objClsEMP_MasterFile->seepost();exit;
			header("Location: transaction.php?statpos=emp_masterfile&empinfo=".$_GET['edit']."#tab-1");
			exit;
		} else {
			$oData = $objClsEMP_MasterFile->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case 'empinfo':
		$arrbreadCrumbs['Employee Information'] = 'transaction.php?statpos=emp_masterfile';
		$arrbreadCrumbs['Employment Details'] = "";
		/*$centerPanelBlock->assign("otListTbl",$objClsEMP_MasterFile->getotTableList());*/
		if (count($_POST)>0) {
			// update
			if(!$objClsEMP_MasterFile->doValidateData($_POST)){
				$objClsEMP_MasterFile->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEMP_MasterFile->Data_basic);
//				printa($objClsEMP_MasterFile->Data);
			} else {
				if (isset($_POST['btnsearch'])) {
					$var = $objClsEMP_MasterFile->getSearch($_POST['emp_idnum']);
					if (!$var['emp_id']=='') {
						header("Location: transaction.php?statpos=emp_masterfile&empinfo=".$var['emp_id']."#tab-1");
					} else {
						header("Location: transaction.php?statpos=emp_masterfile&empinfo=".$_GET['empinfo']."#tab-1");
						$_SESSION['eMsg']="No record found.";
					}
					exit;
				} else {
					if(!isset($_POST['prev_emp'])){
						if ($objClsEMP_MasterFile->validate()) {
							$objClsEMP_MasterFile->doPopulateData($_POST);
							$objClsEMP_MasterFile->doSaveAdd(true);//set true to update
							//$objClsEMP_MasterFile->doSaveBasicRate($_GET['empinfo']);
							header("Location: transaction.php?statpos=emp_masterfile&empinfo=".$_GET['empinfo']."#tab-1");
						} else {
							$oData = $objClsEMP_MasterFile->returnPost();
							$centerPanelBlock->assign("oData",$oData);
						}
					} else {
						$taxSettings = $objClsEMP_MasterFile->getTaxSettings($_GET['empinfo']);
						if($objClsEMP_MasterFile->doValidatePrevEmp($_POST,$taxSettings['bldsched_period'])){
							$fieldMapPrevious = ($taxSettings['bldsched_period']==2 ? $objClsEMP_MasterFile->fieldMapPrevEmpMWE : $objClsEMP_MasterFile->fieldMapPrevEmp);
							$prevEmp = $objClsEMP_MasterFile->populateData($fieldMapPrevious);
							$objClsEMP_MasterFile->doSavePrevEmp($_POST,$_GET['empinfo']);
						}
						$centerPanelBlock->assign("getFirstRec",$objClsEMP_MasterFile->getFirstEmp());
						$centerPanelBlock->assign("getLastRec",$objClsEMP_MasterFile->getLastEmp());
						$centerPanelBlock->assign("getPrevRec",$objClsEMP_MasterFile->getPrevEmp($_GET['empinfo']));
						$centerPanelBlock->assign("getNextRec",$objClsEMP_MasterFile->getNextEmp($_GET['empinfo']));
						
						$centerPanelBlock->assign("oData_",$objClsEMP_MasterFile->dbFetchBasicRate($_GET['empsalaryinfoedit']));
						$centerPanelBlock->assign("oDataBank",$objClsEMP_MasterFile->dbFetchBankInfo($_GET['empinfoedit']));
						$centerPanelBlock->assign("oDataLeave",$objClsEMP_MasterFile->dbFetchLeave($_GET['leaveedit']));
						
						$oData = $objClsEMP_MasterFile->dbFetch($_GET['empinfo']);
			//			printa($oData);
						$centerPanelBlock->assign("oData",$oData);
						$centerPanelBlock->assign('tblDataList',$objClsEMP_MasterFile->getSalaryList());
						$centerPanelBlock->assign('bank_info',$objClsEMP_MasterFile->getBankinfoList());
						$centerPanelBlock->assign('dependList',$objClsEMP_MasterFile->dependList());
						$centerPanelBlock->assign("oDataDepnd",$objClsEMP_MasterFile->dbFetchDependent($_GET['depndedit']));
						$centerPanelBlock->assign("oData_count_dependent",$objClsEMP_MasterFile->count_dependent());
						$centerPanelBlock->assign("prevEmp",$_POST);
						$centerPanelBlock->assign("showForm","block");
						$centerPanelBlock->assign("taxSettings",$objClsEMP_MasterFile->getTaxSettings($_GET['empinfo']));
					}
				 }
			}	
		} else {
			$centerPanelBlock->assign("getFirstRec",$objClsEMP_MasterFile->getFirstEmp());
			$centerPanelBlock->assign("getLastRec",$objClsEMP_MasterFile->getLastEmp());
			$centerPanelBlock->assign("getPrevRec",$objClsEMP_MasterFile->getPrevEmp($_GET['empinfo']));
			$centerPanelBlock->assign("getNextRec",$objClsEMP_MasterFile->getNextEmp($_GET['empinfo']));
			
			$centerPanelBlock->assign("oData_",$objClsEMP_MasterFile->dbFetchBasicRate($_GET['empsalaryinfoedit']));
			$centerPanelBlock->assign("oDataBank",$objClsEMP_MasterFile->dbFetchBankInfo($_GET['empinfoedit']));
			$centerPanelBlock->assign("oDataLeave",$objClsEMP_MasterFile->dbFetchLeave($_GET['leaveedit']));
			
			$oData = $objClsEMP_MasterFile->dbFetch($_GET['empinfo']);
//			printa($oData);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsEMP_MasterFile->getSalaryList());
			$centerPanelBlock->assign('bank_info',$objClsEMP_MasterFile->getBankinfoList());
			$centerPanelBlock->assign('dependList',$objClsEMP_MasterFile->dependList());
			$centerPanelBlock->assign("oDataDepnd",$objClsEMP_MasterFile->dbFetchDependent($_GET['depndedit']));
			$centerPanelBlock->assign("oData_count_dependent",$objClsEMP_MasterFile->count_dependent());
			$prevEmp = $objClsEMP_MasterFile->getPrevEmpRecord($_GET['empinfo']);
			if($prevEmp > 1){
				$showForm = "block";
			} else {
				$showForm = "none";
			}
			$centerPanelBlock->assign("prevEmp",$prevEmp);
			$centerPanelBlock->assign("showForm",$showForm);
			$centerPanelBlock->assign("taxSettings",$objClsEMP_MasterFile->getTaxSettings($_GET['empinfo']));
		}
		break;
	case "delete":
		$objClsEMP_MasterFile->doDelete('main',$_GET['delete']);
		header("Location: transaction.php?statpos=emp_masterfile");
		exit;
		break;
	case "empinfodelete":
		$objClsEMP_MasterFile->doDelete('bank_info',$_GET['empinfodelete']);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_GET['empinfo'].'#tab-4');
		break;
	case "empsalaryinfodelete":
		$objClsEMP_MasterFile->doDelete('salary_info',$_GET['empsalaryinfodelete']);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_GET['empinfo'].'#tab-2');
		break;
	case "bendelete":
		$objClsEMP_MasterFile->doDelete('ben_info',$_GET['bendelete']);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_GET['empinfo'].'#tab-7');
		break;
	case "leavedelete":
		$objClsEMP_MasterFile->doDelete('leave_info',$_GET['leavedelete']);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_GET['empinfo'].'#tab-6');
		break;
	case "loandelete":
		$objClsEMP_MasterFile->doDelete('loan_info',$_GET['loandelete']);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_GET['empinfo'].'#tab-8');
		break;
	case "depnddelete":
		$objClsEMP_MasterFile->doDelete('dependent_info',$_GET['depnddelete']);
//		$objClsEMP_MasterFile->updateTaxExemption($_GET['empinfo']);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-9');
		break;
	case 'deduction':
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-7');
		break;
	case 'loan':
		$objClsEMP_MasterFile->saveLoan();
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-8');
		break; 
	case 'add_govinfo':
		$objClsEMP_MasterFile->saveGovInfo();
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-3');
		break;
	case 'add_ot':
		$objClsEMP_MasterFile->saveOTInfo($_GET['empinfo']);
		header("Location: transaction.php?statpos=emp_masterfile&empinfo=".$_GET['empinfo']."#tab-5");
		exit;
		break;
	case 'add_leave':
		$objClsEMP_MasterFile->saveLeaveInfo();
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-6');
		exit;
		break;
	case 'add_bankinfo':
		$objClsEMP_MasterFile->saveBankInfo();
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-4');
		break;	
	case 'add_compensation':
		$objClsEMP_MasterFile->add_compensation();
		break;
	case 'update_compensation':
		$objClsEMP_MasterFile->add_compensation(true);//set true to update
		break;
	case 'update_bankinfo':
		$objClsEMP_MasterFile->saveBankInfo(true);//set true to update
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-4');
		break;
   	case 'loanupdate':
		$objClsEMP_MasterFile->saveLoan(true);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-8');
		break;
	case 'leaveupdate':
		$objClsEMP_MasterFile->saveLeaveInfo(true);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-6');
		break;
	case 'benefit':
		$objClsEMP_MasterFile->saveBen();
		header('Location: ?statpos=emp_masterfile&empinfo='.$_GET['empinfo'].'#tab-7');
	case 'benefitupdate':
		$objClsEMP_MasterFile->saveBen(true);
		header('Location: ?statpos=emp_masterfile&empinfo='.$_GET['empinfo'].'#tab-7');
		break;
	case 'add_dependent':
		$objClsEMP_MasterFile->add_dependent();
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-9');
		break;
	case 'update_dependent':
		$objClsEMP_MasterFile->update_dependent();
		header('Location: ?statpos=emp_masterfile&empinfo='.$_SESSION['emplid'].'#tab-9');
		break;
	default:
		$arrbreadCrumbs['Employee Information'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsEMP_MasterFile->getTableList());
		break;
		
}
if(isset($_SESSION['eMsg'])){
	$centerPanelBlock->assign('eMsg',$_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}
/*-!-!-!-!-!-!-!-!-*/
$mainBlock->assign('centerPanel',$centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs',$mainBlock->breadCrumbs);
$mainBlock->displayBlock();
?>