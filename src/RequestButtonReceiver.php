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
use soundake\helpers\MyForm;

/**
 * Umožnuje zpracovat a vrátit požadavek od RequestButtonu.
 * Zjednodušuje práci s RequestButtonem (není potřeba volat pomocnou metodu).
 */
class RequestButtonReceiver extends MyForm
{
	/**
	 * Přidá do action backlink, aby formulář i po odeslání věděl kam se má vrátit.
	 *
	 * @param Link|string
	 * @return self
	 */
	public function setAction($url)
	{
		return parent::setAction(RequestButtonHelper::prepareAction($this, $url));
	}

	/**
	 * Když je vráceno na určitý stav formuláře, naplní ho daty.
	 *
	 * @return self
	 */
	protected function receiveHttpData()
	{
		return RequestButtonHelper::prepareHttpData($this, parent::receiveHttpData());
	}

	/**
	 * Přesměruje zpět na RequestButton a potlačí v uživatelských událostech případný redirect.
	 *
	 * @return self
	 * @throw AbortException
	 */
	public function fireEvents()
	{
		try {
			parent::fireEvents();
		} catch (AbortException $e) {}
		RequestButtonHelper::redirectBack($this);
		if (isset($e)) throw $e;
	}

}
