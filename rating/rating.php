<?php
include("settings.php");
connect();
$ids=array(1,2,3);
?>
<html>
<head>
<script src="jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="rating.css" />
<script type="text/javascript" src="rating.js"></script>
</head>
<body>
<?php
for($i=0;$i<count($ids);$i++)
	{
		$rating_tableName     = 'ratings';
	 $id=$ids[$i];
 $q="SELECT total_votes, total_value FROM $rating_tableName WHERE id=$id";
$r=mysql_query($q);
if(!$r) echo mysql_error();
while($row=mysql_fetch_array($r))
{
	$v=$row['total_votes'];
	$tv=$row['total_value'];
	$rat=$tv/$v;
	
	}
	
	
	
	$j=$i+1;
	$id=$ids[$i];
echo'<div class="product">
           Rate Item '.$j.'
            <div id="rating_'.$id.'" class="ratings">';
                for($k=1;$k<6;$k++){
					if($rat+0.5>$k)$class="star_".$k."  ratings_stars ratings_vote";
					else $class="star_".$k." ratings_stars ratings_blank";
					echo '<div class="'.$class.'"></div>';
					}
                echo' <div class="total_votes"><p class="voted"> Rating: <strong>'.@number_format($rat).'</strong>/5 ('.$v. '  vote(s) cast) 
            </div>
        </div></div>';}
?>
</body></html>