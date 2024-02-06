<?php
class sendMail extends CAction
{

	public function run()
	{
		$this->layout = '//layouts/dialoglayout';
		$model = new ContactForm();
		$stmt = $this->controller->loadModel($id);
		$model->name = "Invoice Admin";
		$model->subject = "Invoice from Prime Party Rentals";
		$model->email = $stmt->customer->email1;
		$model->cc = 'purnachandra.valluri@gmail.com';
		//$invoice->statement->customer->email2;
		$model->filename = Yii::app()->basePath . '/../files/invoices/' . $id . '.pdf';

		$model->body = "Please find the attached invoice";
		if (isset($_POST['ContactForm'])) {
			$model->attributes = $_POST['ContactForm'];
			$model->cc = preg_replace('/\s+/', '', $model->cc);
			$toMailStr = $model->email . ',' . $model->cc;
			$toMailArr = explode(",", $toMailStr);
			if ($model->validate()) {
				if ($model->contact($toMailArr)) {
					// echo "success";
					Yii::app()->session->setFlash('invSent');
					DialogBox::closeDialogBox('success', '/statement/viewPdf/id/' . $id);
					return;
					//return $this->refresh();
				} else {
					return $this->render('contact', array('model' => $model, ));
				}
			}

		}
		$this->render('contact', array('model' => $model));
	}
}