create table `cost_center_assignment` (  
	`cc_assign` tinyint NOT NULL AUTO_INCREMENT , 
	`cc_id` tinyint NOT NULL , 
	`emp_id` tinyint NOT NULL , 
	`cc_assign_pct` decimal NOT NULL , 
	PRIMARY KEY (`cc_assign`));