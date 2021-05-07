<?php declare(strict_types = 1);

namespace App\FrontModule\Presenters;

use Latte\Engine;
use Nette\Application\UI\Form;
use Nette\Database\DriverException;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Nette\Mail\SmtpMailer;
use Nette\Neon\Neon;

class HomepagePresenter extends BasePresenter
{

	public function renderDefault(): void
	{

	}

	public function renderService(string $slug): void
	{

	}


	protected function createComponentContactForm(): Form
	{
		$form = new Form();

		$form->addText('name', 'Jméno a příjmení')
			->addRule(Form::MAX_LENGTH, 'Maximálné délka je %s znaků', 100)
			->setRequired('Musíte uvést Vaše jméno a příjmení');

		$form->addEmail('email', 'Email')
			->addRule(Form::MAX_LENGTH, 'Maximálné délka je %s znaků', 200)
			->setRequired('Musíte uvést Vaši emailovou adresu');

		$form->addTextArea('content', 'Obsah zprávy')
			->setHtmlAttribute('rows', 6)
			->addRule(Form::MAX_LENGTH, 'Maximálné délka je %s znaků', 1500);

		$form->addInvisibleReCaptcha('recaptcha')
			->setMessage('Jste opravdu člověk?');

		$form->addSubmit('submit', 'Odeslat');

		$form->onSubmit[] = function (Form $form) {
			$values = $form->getValues(true);

//			$mail = new Message();
//
//			$mail->setFrom('vladimir@reality6.cz', 'REALITY6.cz');
//			$mail->addTo($values['email']);
//			$mail->setSubject('REALITY6.cz - Zpráva z kontaktního formuláře');
//			$mail->setBody($values['content']);
//
//			$mailer = new SendmailMailer;
//			$mailer->send($mail);

			$this->flashMessage('Vaše zpráva byla úspěšně odeslána! Ozvu se Vám, jakmile to bude možné.');
			$this->redirect('this#kontakt');
		};

		return $form;
	}

}
