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
<div id="loginbox" style="margin-top:20px;" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
    <div class="card">
        <div class="header">
            <h4 class="title"><i class="pe-7s-lock"></i>Sign In</h4>
            <!-- <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>  -->
        </div>

        <div style="padding-top:8px" class="content">
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'login-form',
                'type' => 'vertical',
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'errorMessageCssClass' => 'alert alert-danger',
                'htmlOptions' => array()
            )
            );
            ?>

            <?php //echo $form->error($model,'username',array('errorCssClass'=>'alert alert-danger'));  ?>
            <?php //echo $form->error($model,'password',array('errorCssClass'=>'alert alert-danger')); ?>

            <?php echo $form->textFieldRow($model, 'username', array('class' => 'form-control')); ?>

            <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'form-control')); ?>
            <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-round pull-right')); ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>