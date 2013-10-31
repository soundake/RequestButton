Nejprve nahrajte do složky `/Components` nebo kamkoliv jinam pokud pouzivate RobotLoader.

Live demo:
	http://addons.petrp.cz/requestbutton/example

Documentation for v0.2
	http://addons.nette.org/cs/requestbutton

Registration:
	Container::extensionMethod('Nette\Forms\Container::addRequestButton', array('\RequestButton\RequestButtonHelper', 'addRequestButton'));
	Container::extensionMethod('Nette\Forms\Container::addRequestButtonBack', array('\RequestButton\RequestButtonHelper', 'addRequestButtonBack'));

