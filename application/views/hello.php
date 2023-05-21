<?php
foreach($select->result() as $row) :
{
	echo $row->id;
	echo $row->nameStudent;
	echo $row->address;
}
endforeach;
echo 'Total Results: ' . $select->num_rows();
