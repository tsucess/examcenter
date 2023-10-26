<?php

            // ALL STUDENTS SIGNED UP 
            $count_all_sql = "SELECT COUNT(*) AS count FROM users";
            $conut_all_query = mysqli_query($dbconnect, $count_all_sql);

            while ($all_row = mysqli_fetch_assoc($conut_all_query)) {
                $all_result = $all_row['count'];
            }
            // REGISTERED STUDENTS 
            $count_reg_sql = "SELECT COUNT(*) AS count FROM registered_subjects";
            $conut_reg_query = mysqli_query($dbconnect, $count_reg_sql);

            while ($row = mysqli_fetch_assoc($conut_reg_query)) {
                $reg_result = $row['count'];
            }

            // SUCCESSFULL APPLICANTS
            $count_success_sql = "SELECT COUNT(*) AS count FROM registered_subjects WHERE payment_status = 'success'";
            $conut_success_query = mysqli_query($dbconnect, $count_success_sql);

            while ($success_row = mysqli_fetch_assoc($conut_success_query)) {
                $success_result = $success_row['count'];
            }

            //PENDING APPLICANTS
            $count_pending_sql = "SELECT COUNT(*) AS count FROM registered_subjects WHERE payment_status = 'pending'";
            $conut_pending_query = mysqli_query($dbconnect, $count_pending_sql);

            while ($pending_row = mysqli_fetch_assoc($conut_pending_query)) {
                $pending_result = $pending_row['count'];
            }



			// CHART JS CODE 

			$gx = ""; $gy = "";
			$gdata = array();
			$glabel = array("2022", "2023", "2024", "2025", "2026", "2027");

			
		function registered ($year, $db) {
			// REGISTERED STUDENTS 
			$count_reg_sql = "SELECT COUNT(*) AS count FROM registered_subjects WHERE year = $year";
			$conut_reg_query = mysqli_query($db, $count_reg_sql);
			
			while ($row = mysqli_fetch_assoc($conut_reg_query)) {
				$reg_result_year = $row['count'];
			}	
			return $reg_result_year;	
		}

		foreach ($glabel as $year) {
			array_push($gdata, registered($year, $dbconnect));
		}

		$gx = implode(',',$glabel);
		$gy = implode(',',$gdata);

?>