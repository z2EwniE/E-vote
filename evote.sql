SELECT candidates.*, department.department_name, partylists.partylist_name, partylists.partylist_id 

                            FROM candidates
                            
                            LEFT JOIN department ON candidates.candidate_position = department.department_id
                            LEFT JOIN partylists ON candidates.candidate_position = partylists.partylist_id
                            WHERE candidates.candidate_position = position_id
                            
        