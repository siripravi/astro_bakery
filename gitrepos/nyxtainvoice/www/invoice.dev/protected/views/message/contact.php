<?php if (Yii::app()->user->hasFlash('contact')): ?>
    <?php echo Yii::app()->user->getFlash('contact'); ?>
<?php else: ?>
    <div class="card">
        <div class="header">
            <h4 class="title">
                Send Message
            </h4>
            <p class="category">
                Please check the pdf document is already generated before sending email
            </p>
        </div>
        <div class="content">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'contact-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('class' => 'form-horizontal')
            )
            );
            ?>
            <?php echo $form->errorSummary($model); ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
                <div class="input-group col-lg-8">
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <?php echo $form->labelEx($model, 'cc'); ?>
                    <?php echo $form->textArea($model, 'cc', array('rows' => 6, 'cols' => 50, 'class' => 'span9', 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'cc'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <?php echo $form->labelEx($model, 'body'); ?>
                    <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 80, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'body'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo CHtml::submitButton('SEND', array('class' => 'btn btn-fill btn-primary')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
<?php endif; ?>