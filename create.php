<?php

define('HTML_TEMPLATE', 'temp3.php');

if (!file_exists(HTML_TEMPLATE))
	die( HTML_TEMPLATE . ' est manquant');

if (isset($_REQUEST['save'])) {
	$inputs = filter_input_array(INPUT_POST, array(
		'page_name' => FILTER_SANITIZE_ENCODED,
		'page_title' => FILTER_SANITIZE_ENCODED,
		'page_content' => FILTER_UNSAFE_RAW,
		'page_pagedomaine' => FILTER_SANITIZE_ENCODED,
		'page_titremenu' => FILTER_SANITIZE_ENCODED,
	  'page_titre' => FILTER_UNSAFE_RAW,
		'page_soustitre' => FILTER_UNSAFE_RAW,
		'page_image' => FILTER_UNSAFE_RAW,
	));

	$buffer = file_get_contents(HTML_TEMPLATE);
	$buffer = str_replace(array('%title%', '%content%', '%pagedomaine%', '%titremenu%', '%titre%', '%soustitre%', '%image%'),
	array($inputs['page_title'], $inputs['page_content'], $inputs['page_pagedomaine'], $inputs['page_titremenu'], $inputs['page_titre'], $inputs['page_soustitre'], $inputs['page_image']), $buffer);
	if (file_put_contents($path = "pages/{$inputs['page_name']}.php", $buffer))
		echo('Fichier Créé: '. realpath($path));
	else
		die('Impossible de créer: ' . realpath($path));
}

$varTexteArea= str_replace('\n', '<br />', nl2br($_POST['textArea']));


?>
<form method="post">
	<label for="page_name">Nom de la page</label><input type="text" name="page_name" id="page_name" /> </br>
	<label for="page_title">Titre de la page</label><input type="text" name="page_title" id="page_title" /> </br>
<label for="page_pagedomaine">menu domaine</label><input type="text" name="page_pagedomaine" id="page_pagedomaine" /> </br>
<label for="page_titremenu">menu titre</label><input type="text" name="page_titremenu" id="page_titremenu" /> </br>
<label for="page_title">Titre</label><input type="text" name="page_titre" id="page_titre" /> </br>
<label for="page_title">soustitre</label><input type="text" name="page_soustitre" id="page_soustitre" /> </br>
<label for="page_title">image</label><input type="text" name="page_image" id="page_image" /> </br> </br>
<label for="page_content">Contenu</label><textarea name="page_content" id="page_content"> <!-- comment --> </textarea> </br>
	<input type="submit" name="save" value="Créer" />
	<input type="reset" value="Reinitialiser" />
</form>

<form method="post" enctype="multipart/form-data" action="upload.php">
<p>
<input type="file" name="fichier" >
<input type="submit" name="upload" value="Uploader">
</p>
</form>
