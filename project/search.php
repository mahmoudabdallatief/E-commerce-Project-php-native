<?php
$search_query = mysqli_real_escape_string($conn, trim($_POST['search_query']));
if (empty($search_query) || $search_query === '') {
  // If the search query is empty or contains only spaces, redirect back to the previous page
  header("Location: $_SERVER[HTTP_REFERER]");
  exit();
}
// Retrieve the search query



    $sql = "SELECT prro.id, prro.name, cat.cat 
            FROM prro 
            JOIN cat ON prro.cat = cat.id 
            WHERE prro.name LIKE '%$search_query%' 
            OR cat.cat LIKE '%$search_query%' 
            OR cat.cat = '$search_query' 
            OR prro.name = '$search_query'
            UNION
            SELECT p.id, p.name, c.cat
            FROM prro p
            JOIN cat c ON p.cat = c.id
            WHERE c.cat IN (
                SELECT cat
                FROM cat
                WHERE cat LIKE '%$search_query%' 
                OR parent IN (
                    SELECT id
                    FROM cat
                    WHERE cat = '$search_query' OR
                    cat LIKE '%$search_query%'
                    
                )
            )
            ORDER BY id ASC 
            LIMIT 5";

    $result = mysqli_query($conn, $sql);

    // Return the results as a JSON-encoded array
    $rows = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    } else {
        $rows[] = array("message" => "No results found");
    }
    echo json_encode($rows);
 

mysqli_close($conn);
?>