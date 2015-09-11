<?php

//connect to the database
mysql_connect('db1.mmrs.jp', 'pv1_adm', 'cc1256cc') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('pv1_adm_mrs') or die("I couldn't find the database table ($table) make sure it's spelt right!");

?>