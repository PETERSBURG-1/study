<?
function debug($var, $die = false, $all = false)
{
	global $USER;
	if( ($USER->isAdmin()) || ($all == true))
	{
		?>
		<font style="text-align: left; font-size: 15px"><pre><?var_dump($var)?></pre></font><br>
		<?
	}
	if($die)
	{
		die;
	}
}
?>