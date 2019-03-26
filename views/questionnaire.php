<?php

/** @var \App\View $this */
/** @var \App\Entity\Field[] $fields */
/** @var \App\Entity\QuestionnaireFieldValue[] $values */

foreach ($fields as $key => $field) {
	$fields[$field->getId()] = $field;
}

?>

<table>
	<?php foreach ($values as $value) { ?>

		<tr>
			<td><?=$fields[$value->getFieldId()]->getName()?>:</td>
			<td><?=$value->getValue()?></td>
		</tr>

	<?php } ?>
</table>
