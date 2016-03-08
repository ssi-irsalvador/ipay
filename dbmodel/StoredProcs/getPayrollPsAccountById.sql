DELIMITER $$

DROP FUNCTION IF EXISTS `getPayrollPsAccountById`$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getPayrollPsAccountById`(p_id INT) RETURNS varchar(300) CHARSET latin1
BEGIN
 DECLARE val varchar(300); SELECT REPLACE(psa_name,' ','_') INTO val FROM payroll_ps_account WHERE psa_id=p_id; 
SET val = REPLACE(val,'/','_'); 
SET val = REPLACE(val,'-','_');
RETURN val;
 END$$

DELIMITER ;