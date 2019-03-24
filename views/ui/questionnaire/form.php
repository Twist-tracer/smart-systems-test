<?php
/** @var \App\Entity\Field[] $fields */
?>

<form action="/" class="questionnaire-form">
	<table class="questionnaire-form-fields">
		<?php foreach ($fields as $field) {?>
			<tr class="questionnaire-form-field">
				<td><label for="field-<?=$field->getId()?>"><?=$field->getName()?>:</label></td>
				<td><input id="field-<?=$field->getId()?>" type="<?=$field->getType()?>" ></td>
			</tr>
		<?php }?>
	</table>

	<button type="button" id="questionnaire-form-add-field-button">Добавить поле</button>

	<button type="submit" id="questionnaire-form-submit-button">Отправить анкету</button>
</form>

<script src="/assets/js/ui/questionnaire/form.js"></script>