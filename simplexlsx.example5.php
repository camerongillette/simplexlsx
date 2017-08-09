<?php
$filepath = $_GET['filepath'];

$xlsx = new SimpleXLSX($filepath,false,true);

//Get all worksheet id's
$worksheetIds = [];
$allSheets = $xlsx->sheets();
while ($currentSheet = current($allSheets)) {
    array_push($worksheetIds,key($allSheets));
    next($allSheets);
}

echo '<table cellpadding="10">';
foreach($worksheetIds as $worksheetId){
    echo '<tr><td valign="top">';
    list($num_cols, $num_rows) = $xlsx->dimension($worksheetId);
    echo '<h1>Sheet ' . $worksheetId . '</h1>';
    echo '<table>';
    foreach( $xlsx->rows($worksheetId) as $r ) {
            echo '<tr>';
            for( $i=0; $i < $num_cols; $i++ )
                    echo '<td>'.( (!empty($r[$i])) ? $r[$i] : '&nbsp;' ).'</td>';
            echo '</tr>';
    }
    echo '</table></td></tr>';
}
echo '</table>';
?>
