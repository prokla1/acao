<?php
/**
 * redireciona para outro modulo caso o modulo solicitado nao existir
 * entao se for o url de um parceiro, manda pro modulo do parceiro
 * @author jus
 *
 */

class Plugins_Parceiro extends Zend_Controller_Plugin_Abstract
{

	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$dispatcher = Zend_Controller_Front::getInstance()->getDispatcher();
	
		if (!$dispatcher->isDispatchable($request)) {
	
			$url = $request->getControllerName();
	
			$request->setModuleName('default');
			$request->setControllerName('parceiro');
			//$request->setActionName('url');
			$request->setParam('url', $url);
	
			/** Prevents infinite loop if you make a mistake in the new request **/
			if ($dispatcher->isDispatchable($request)) {
				$request->setDispatched(false);
			}
	
		}
	
	}

}