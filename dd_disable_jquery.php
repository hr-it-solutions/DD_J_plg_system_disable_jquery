<?php
/**
 * @package    DD_Disable_JQuery
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2017 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');
jimport('joomla.access.access');

/**
 * Joomla! system plugin to disable jQuery from the front end!
 *
 * @since  Version 1.0.0.0
 */
class PlgSystemDD_Disable_JQuery extends JPlugin
{
	/**
	 * @var $app object JFactoy Application
	 */
	protected $app;

	/**
	 * onBeforeCompileHead
	 *
	 * @since  Version 1.0.0.0
	 * @return void
	 */
	public function onBeforeCompileHead()
	{
		// Front end
		if ($this->app instanceof JApplicationSite)
		{
			$unset = array();

			if ($this->params->get('unset_jquerylib') !== '0')
			{
				$unset[] = JUri::root(true) . '/media/jui/js/jquery.js';
				$unset[] = JUri::root(true) . '/media/jui/js/jquery.min.js';
			}

			if ($this->params->get('unset_noconflict') !== '0')
			{
				$unset[] = JUri::root(true) . '/media/jui/js/jquery-noconflict.js';
			}

			if ($this->params->get('unset_migrate') !== '0')
			{
				$unset[] = JUri::root(true) . '/media/jui/js/jquery-migrate.js';
				$unset[] = JUri::root(true) . '/media/jui/js/jquery-migrate.min.js';
			}

			if (count($unset) > 0)
			{
				$doc = JFactory::getDocument();

				foreach ($doc->_scripts as $key => $script)
				{
					if (in_array($key, $unset))
					{
						unset($doc->_scripts[$key]);
					}
				}
			}
		}
	}
}
