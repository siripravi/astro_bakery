<!--<div class="content">
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" placeholder="Enter email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" placeholder="Password" class="form-control">
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="checkbox">
                                            <span class="icons"><span class="first-icon fa fa-square-o"></span><span class="second-icon fa fa-check-square-o"></span></span><input type="checkbox" data-toggle="checkbox" value="">
                                            Subscribe to newsletter
                                        </label>    
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-fill btn-warning btn-wd">Login</button>
                                </div>  -->
<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Sign In</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a>
            </div>
        </div>

        <div style="padding-top:30px" class="panel-body">
            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'login-form',
                // 'type' => 'vertical',
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'errorMessageCssClass' => 'alert alert-danger',
                'htmlOptions' => array()
            )
            ); ?>

            <?php echo $form->error($model, 'username', array('errorCssClass' => 'alert alert-danger')); ?>
            <?php echo $form->error($model, 'password', array('errorCssClass' => 'alert alert-danger')); ?>

            <?php echo $form->textFieldRow($model, 'username', array()); ?>

            <?php echo $form->passwordFieldRow($model, 'password', array()); ?>
            <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-round')); ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>