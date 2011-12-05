<?php
namespace RequestButton;

/**
 * RequestButton
 * Umoznuje presmerovat se mezi formulari a neztratit neulozeny obsah.
 *
 * @author Petr Prochazka http://petrp.cz petr@petrp.cz
 * @copyright 2009 Petr Procházka
 * @copyright 2011 Lukas Hroch
 * @version 0.2
 * @package RequestButton
 */

/**
 * Neuloží formulář a vrátí se zpět na RequestButton.
 * Když není RequestButton požadavek, tak se tento button nezobrazuje.
 */
class RequestButtonBack extends \Nette\Forms\Controls\SubmitButton
{

	/**
	 * @param string Text v buttonu.
	 */
	public function __construct($caption = NULL)
	{
		parent::__construct($caption);
		parent::setValidationScope(false);
		$this->monitor('Nette\Application\UI\Presenter');
	}

	/**
	 * Když není RequestButton požadavek, tak se tento button nezobrazuje.
	 *
	 * @param IPresenter
	 */
	protected function attached($parent)
	{
		if ($parent instanceof \Nette\Application\IPresenter)
		{
	    $backlinkId = $this->form->presenter->getParam(\RequestButton::BACKLINK_KEY);
	    if (!$backlinkId OR !\RequestButtonStorage::is($backlinkId))
			{
			  $this->setDisabled(true);
			  $this->getParent()->removeComponent($this);
			}
		}
		parent::attached($parent);
	}

	/**
	 * Po kliknutí redirect na RequestButton.
	 */
	public function click()
	{
		\RequestButtonHelper::redirectBack($this->form);
	}
}
