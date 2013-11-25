<?php
/*
Plugin Name: WizardGo Audio Player - Hear your content aloud
Plugin URI: http://www.wizardgo.com
Description: WizardGo Audio Player is a plugin that allows your visitors to listen to a beautiful narration of your posts.  Engage and amaze your users, allowing them to interact with your content in a new way, by listening to it.  You think this *sounds* too good to be true?  We challenge you to give it a try and draw your own conclusions!  Visitors will love to hear your content aloud!
Version: 0.5
Author: WizardGo
Author URI: http://www.wizardgo.com
License: GPLv2 or later
*/

defined( '_JEXEC' ) OR die( 'Restricted access.' );
jimport( 'joomla.plugin' );
jimport( 'joomla.html.parameter' );

class plgContentWizardgo extends JPlugin{
	protected $_plugin;
	protected $_pluginParams;
	protected $_document;
	protected $_userID;
	protected $_voiceID;
	protected $_excludeIDs = array();
	protected $_includeIDs = array();

    static private $instance = NULL;


	function plgContentWizardgo(&$subject, $params){
		parent::__construct($subject, $params);

		$this->_plugin = JPluginHelper::getPlugin('content', 'wizardgo');
		$this->_document = JFactory::getDocument();

	}

	// Get instance of this class
	static function getInstance(){
	    return self::$instance;
	}

    // Stadard Joomla Plugin Hook
	public function onContentAfterDisplay($context, &$article, &$params, $limitstart){
	    $script = "<script>(function(id) {  var js, jss = document.getElementsByTagName('script')[0];  if (document.getElementById(id)) return;  js = document.createElement('script'); js.id = id;  js.src = 'http://wizardgo.com/player/embed.js';  jss.parentNode.insertBefore(js, jss);}('wizardgo-player'));</script>";
	    $currentView = JRequest::getCmd('view');
	    $permalink = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $article->text = sprintf('<div class="wg-player" data-canonical="%s"></div><div class="wg-player-content">%s</div>%s', $permalink, $article->text, $script);
	}
}
