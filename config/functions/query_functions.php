<?php 
    function gen_mul_team_query($basic_query, $active_team_array){
			               
			               for($i=0; $i < count($active_team_array); $i++ ){
			               
        			               if($i == 0){
        			                   $gen_query = "$basic_query AND team='$active_team_array[$i]'";
        			               }else{
        			                   $gen_query .= " UNION $basic_query AND team='$active_team_array[$i]'";
        			                 //  $gen_query .= " OR team='$active_team_array[$i]'";
        			               }
			            }
			       
			            return $gen_query;
			          }
    function gen_mul_team_query_without_where($basic_query, $active_team_array){
			               
			               for($i=0; $i < count($active_team_array); $i++ ){
			               
        			               if($i == 0){
        			                   $gen_query = "$basic_query WHERE team='$active_team_array[$i]'";
        			               }else{
        			                   $gen_query .= " UNION ALL $basic_query WHERE team='$active_team_array[$i]'";
        			                 //  $gen_query .= " OR team='$active_team_array[$i]'";
        			               }
			            }
			            return $gen_query;
			          }
    function gen_mul_allowed_team($basic_query, $active_team_array){
			               
			               for($i=0; $i < count($active_team_array); $i++ ){
			               
        			               if($i == 0){
        			                   $gen_query = "$basic_query WHERE team_id='$active_team_array[$i]'";
        			               }else{
        			                   $gen_query .= " UNION ALL $basic_query WHERE team_id='$active_team_array[$i]'";
        			                 //  $gen_query .= " OR team='$active_team_array[$i]'";
        			               }
			            }
			            return $gen_query;
			          }
	function gen_mul_team_query_for_mul_assigneee($basic_query, $active_team_array){
			               
			               for($i=0; $i < count($active_team_array); $i++ ){
			               
        			               if($i == 0){
        			                   $gen_query = "$basic_query AND team LIKE '%$active_team_array[$i]%'";
        			               }else{
        			                   $gen_query .= " UNION $basic_query AND team LIKE '%$active_team_array[$i]%'";
        			                 //  $gen_query .= " OR team='$active_team_array[$i]'";
        			               }
			            }
			            return $gen_query;
			          }
    	function gen_mul_team_query_for_mul_assigneee_without_where($basic_query, $active_team_array){
			               
			               for($i=0; $i < count($active_team_array); $i++ ){
			               
        			               if($i == 0){
        			                   $gen_query = "$basic_query WHERE team LIKE '%$active_team_array[$i]%'";
        			               }else{
        			                   $gen_query .= " UNION $basic_query WHERE team LIKE '%$active_team_array[$i]%'";
        			                 //  $gen_query .= " OR team='$active_team_array[$i]'";
        			               }
			            }
			            return $gen_query;
			          }

?>