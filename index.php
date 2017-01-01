<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta property="og:image" content="/st/og-image.png"/>

	<title>Texture Perception Experiment</title>

	<meta name="keywords" content="sortable, reorder, list, javascript, html5, drag and drop, dnd, animation, groups, angular, ng-sortable, react, mixin, effects, rubaxa"/>
	<meta name="description" content="Sortable - is a minimalist JavaScript library for reorderable drag-and-drop lists on modern browsers and touch devices. No jQuery. Supports Meteor, AngularJS, React and any CSS library, e.g. Bootstrap."/>
	<meta name="viewport" content="width=device-width, initial-scale=0.5"/>

	<link href="//rubaxa.github.io/Ply/ply.css" rel="stylesheet" type="text/css"/>
	<link href="//fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet" type="text/css"/>

	<link href="st/app.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="jquery-1.12.3.min.js"></script>
	
	<style>
	#rightImage
	{
	    float:left;
	    position:relative;
	    /*box-shadow:2px -2px 10px 3px #888, inset 2px -2px 10px 3px #888;*/
	}
	#rightImage:hover img
	{
	    height: 900px;
	    width: 600px;
	    /*box-shadow:4px -4px 10px 3px #888, inset 4px -4px 10px 3px #888;*/
	}
	 </style>
<style type="text/css">.img-wrapper {
    display: inline-block;
    overflow: hidden;
}
<?php
if(false){
if(isset($_SESSION["cur_im"])){
if($_SESSION["cur_im"] != 2 && $_SESSION["cur_im"] != 10){
	?>
img.form:hover {
    transform:scale(2) translate(0px,25%);
    -ms-transform:scale(2) translate(0px,25%); /* IE 9 */
    -moz-transform:scale(2) translate(0px,25%); /* Firefox */
    -webkit-transform:scale(2) translate(0px,25%); /* Safari and Chrome */
    -o-transform:scale(2) translate(0px,25%); /* Opera */
}
<?php
}}}
?>
		</style>
</head>
<body>
	<?php
	if(!isset($_SESSION["mejl"])){$input = array("checkerboard.png","blades.png","grid.png","pebbles.png","ink.png","rough.png","chicago_nasa.png","noise.png","smarties.png","greenmarble.png","orangemarble.png","straw.png");
		?>
				<h1 data-force="20" data-force-y="2.5">Welcome to the Texture Perception Experiment</h1>
				<br/>
				<h1 data-force="20" data-force-y="2.5">Please maximize your window.</h1>
	<br/>
				
	                        <h1>You will be shown a small texture, and larger textures created by various state-of-the-art algorithms. Sort these by how much they look like the original. The experiment takes about 15 minutes.</h1>
<br/>
								   <h1 data-force="20" data-force-y="2.5">Complete the experiment for a chance to win £50 of book tokens!</h1>
	                        <h1 data-force="20" data-force-y="2.5">Please enter your email if you wish to enter the draw:</h1>
<br/>
		<center> <form id="myForm" action="submit.php" method="post">
			your email:<input type="text" name="mejl">
			<br/>
			<table border=2 width=300px><tr><td><input type="checkbox" name="agree" value="agree"><small>
			I confirm that I have read the information on this page. I understand that my participation is voluntary and that I am free to withdraw at any time without giving any reason, without my medical, social care, education, being affected, and I agree to take part in the study.</small></tr></td></table>
			<br/>
		<input type="submit" value="Get started!"></form>
	</center>
	<br/>
	
		<?php
		}else{
	$input = array("smarties.png","checkerboard.png","blades.png","grid.png","pebbles.png","ink.png","rough.png","chicago_nasa.png","noise.png","greenmarble.png","orangemarble.png","straw.png");
	$cur_im = $input[array_rand($input, 1)];
if(!isset($_SESSION["cur_im"])){
$_SESSION["cur_im"] = 0;
}else{
//$_SESSION["cur_im"] = $_SESSION["cur_im"] + 1;
}
if($_SESSION["cur_im"]>=count($input)){
$_SESSION["cur_im"] = 0;
$alldone = true;
}
$cur_im = $input[$_SESSION["cur_im"]];
	?>

	<?php
	if(!$alldone){
	?>
	<div class="container">
		<div style="padding: 10px 50px 0; height: 130px;">
			<h1 data-force="20" data-force-y="2.5">Sort the bottom images by order of realism (Drag and Drop, then press Submit)</h1>
                        <h1 data-force="20" data-force-y="2.5">Order the bottom row from left to right according to how similar to the reference you think they are.</h1>
		</div>
	</div>
	<center>
		Reference<br/>
<img <?php
if($cur_im=="checkerboard.png" || $cur_im=="straw.png"){
?>style="max-width:85px;"<?php
}
?> width="6%" src="exemplar/<?php echo $cur_im; ?>"/></center>

        <div width="100%">
        <img style="position: relative; top: -250px;" src="worst.png" align="right" />
        <img style="position: relative; top: -250px;" src="best.png" align="left" />
        </div>

<br/><br/><br/>
<?php
$methods=array("Ashikhmin","reference_output","resynthesizer","self_tuning","quilting","Sykora","CNNMRF");
shuffle($methods);
?>
	<!-- Connected lists -->
	<div class="container" width="100%">
		<div data-force="100" class="block" vertical-align="middle">
			<form id="myForm" action="submit.php" method="post">
			<ul id="foo" class="block__list_tags">
				<input type="hidden" id="window_width" name="window_width" value="-1">
				<input type="hidden" id="window_height" name="window_height" value="-1">
				<input type="hidden" id="document_width" name="document_width" value="-1">
				<input type="hidden" id="document_height" name="document_height" value="-1">
				<input type="hidden" id="screen_width" name="screen_width" value="-1">
				<input type="hidden" id="screen_height" name="screen_height" value="-1">
				<input type="hidden" id="texture" value="<?php echo $cur_im; ?>">
	<li><input type="hidden" name="method1" value="1<?php echo $methods[0]; ?>"><img class="form" width="100%" src="<?php echo $methods[0]; ?>/<?php echo $cur_im; ?>"/></li>
	<li><input type="hidden" name="method2" value="2<?php echo $methods[1]; ?>"><img class="form" width="100%" src="<?php echo $methods[1]; ?>/<?php echo $cur_im; ?>"/></li>
	<li><input type="hidden" name="method3" value="3<?php echo $methods[2]; ?>"><img class="form" width="100%" src="<?php echo $methods[2]; ?>/<?php echo $cur_im; ?>"/></li>
	<li><input type="hidden" name="method4" value="4<?php echo $methods[3]; ?>"><img class="form" width="100%" src="<?php echo $methods[3]; ?>/<?php echo $cur_im; ?>"/></li>
	<li><input type="hidden" name="method5" value="5<?php echo $methods[4]; ?>"><img class="form" width="100%" src="<?php echo $methods[4]; ?>/<?php echo $cur_im; ?>"/></li>
        <li><input type="hidden" name="method6" value="6<?php echo $methods[5]; ?>"><img class="form" width="100%" src="<?php echo $methods[5]; ?>/<?php echo $cur_im; ?>"/></li>
        <li><input type="hidden" name="method7" value="7<?php echo $methods[6]; ?>"><img class="form" width="100%" src="<?php echo $methods[6]; ?>/<?php echo $cur_im; ?>"/></li>
			</ul>
			<input type="submit" value="Submit">
<b>                        <?php
echo "Image " . ($_SESSION["cur_im"]+1) . " out of 12";
}else{
echo "<br/><br/><br/><br/><br/><br/><br/>Thank you! You've annotated all images.<br/><br/>We will contact you by email once the experiment is over.";
}
}
                        ?>
</b>
			</form>
		</div>
	</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>&nbsp;
<script type="text/javascript">

$(document).ready(function(){
 $("#window_width").val($(window).width());   // returns width of browser viewport
 $("#window_height").val($(window).height());   // returns height of browser viewport
 $("#document_width").val($(document).width()); // returns width of HTML document
 $("#document_height").val($(document).height()); // returns height of HTML document
 $("#screen_width").val(screen.width); // returns width of HTML document
 $("#screen_height").val(screen.height); // returns height of HTML document
});

$( window ).resize(function() {
 $("#window_width").val($(window).width());   // returns width of browser viewport
 $("#window_height").val($(window).height());   // returns height of browser viewport
 $("#document_width").val($(document).width()); // returns width of HTML document
 $("#document_height").val($(document).height()); // returns height of HTML document
 $("#screen_width").val(screen.width); // returns width of HTML document
 $("#screen_height").val(screen.height); // returns height of HTML document
});

</script>
	<script src="Sortable.js"></script>
	<script src="//rubaxa.github.io/Ply/Ply.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
	<script src="ng-sortable.js"></script>

	<script src="st/app.js"></script>

	<script src="//yandex.st/highlightjs/7.5/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
