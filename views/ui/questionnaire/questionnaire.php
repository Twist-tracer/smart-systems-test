<?php

/** @var \App\View $this */

?>

<div class="questionnaire">
    <h1 class="questionnaire-title">Анкета</h1>
	<?=$this->render('ui/questionnaire/form', ['fields' => $fields])?>
</div>