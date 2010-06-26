<?php
$head = array('bodyclass' => 'item-show-log primary',
              'title' => 'Item Show Log');
head($head);
?>
<h1>Item Show Log</h1>

<?php 

$db = get_db();
$table = $db->getTable('ItemShowLogLog') ;

$rows = $table->fetchAll("SELECT item_id, count(id) AS count FROM `{$db->prefix}item_show_log_logs` GROUP BY `item_id` ORDER BY count DESC LIMIT 100;");

echo "<div class='item-show-log-most-shown'>";
foreach ($rows as $row) {
  echo "<div  class='item-show-log-row'>";
  $item = get_item_by_id($row['item_id']);
  set_current_item($item);
  echo "<span class='item-show-log-thumbnail'>".item_square_thumbnail()."</span>";
  echo "<div class='item-show-log-title'><a href='".item_uri()."'>".item('Dublin Core', 'Title').'</a></div>';
  echo "<span class='item-show-log-count'>Viewed ".$row['count']." times in public view</span>";

  echo "</div>";
}
echo "</div>";



