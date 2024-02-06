<?php if (Yii::app()->user->hasFlash('contact')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('contact'); ?>
	</div>

<?php else: ?>

	<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title' => "send message",
		//.ucfirst($model->getHeader2()),
		'htmlOptions' => array('style' => "border:none;")
	)
	);

	?>
	<div style="min-height:220px">

		<p>XXXXXXXX
			Please check the pdf document is already generated before sending email
		</p>

		<div class="form">

			<?php $form = $this->beginWidget('CActiveForm', array(
				'id' => 'contact-form',
				'enableClientValidation' => true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
				),
			)
			); ?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>
			<div class="row-fluid">
				<div class="span8">
					<?php echo $form->labelEx($model, 'email'); ?>
					<?php echo $form->textField($model, 'email'); ?>
					<?php echo $form->error($model, 'email'); ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span8">
					<?php echo $form->labelEx($model, 'cc'); ?>
					<?php echo $form->textArea($model, 'cc', array('rows' => 6, 'cols' => 50, 'class' => 'span9')); ?>
					<?php echo $form->error($model, 'cc'); ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span8">
					<?php echo $form->labelEx($model, 'body'); ?>
					<?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 80, 'class' => 'span9')); ?>
					<?php echo $form->error($model, 'body'); ?>
				</div>
			</div>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Submit'); ?>
			</div>

			<?php $this->endWidget(); ?>

		</div><!-- form -->
	</div>
	<?php $this->endWidget(); ?>
<?php endif; ?>