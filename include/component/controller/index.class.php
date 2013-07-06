<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox_Component
 * @version 		$Id: controller.class.php 103 2009-01-27 11:32:36Z Raymond_Benc $
 */
class TestModule_Component_Controller_Index extends Phpfox_Component {
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
    $aVals = array();
    
    $aVals['userId']          = $this->request()->get('userId','');
    $aVals['link']['url']     = str_replace("+","/",$this->request()->get('url',''));
    $aVals['link']['title']   = $this->request()->get('title','');
    $aVals['action']          = $this->request()->get('action','');
    $aVals['iframe']          = $this->request()->get('iframe',1);
    $aVals['status_info']     = $this->request()->get('statusInfo','');
    $aVals['privacy']         = $this->request()->get('privacy',0);
    $aVals['privacy_comment'] = $this->request()->get('privacyComment',0);
     
     if($this->request()->get('embedCode','') != '')
    {
            $aVals['link']['embed_code']  = str_replace("+","/",$this->request()->get('embedCode',''));
			$aVals['link']['image_hide']  = 0;
			$aVals['link']['image']       = str_replace("+","/",$this->request()->get('image',''));
			$aVals['link']['description'] = $this->request()->get('description','');
    }
    
		if(isset($aVals['userId']))
		{
			$iUserId = $aVals['userId'];
			$aUser = Phpfox::getService('webservice.getuserdata')->userData($iUserId);
			Phpfox::getService('user.auth')->setUser($aUser);
			
			if(Phpfox::getUserId() > 0)
			{
				if(Phpfox::getService('link.process')->add($aVals) != '');
                {
                    Phpfox::getService('user.auth')->logout();
                    echo "successfully inserted";
                }
			}
		}
   //     Phpfox::getLib('template')->setTemplate('blank');
	}
    /**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('mobilewebservice.component_controller_index_clean')) ? eval($sPlugin) : false);
	}
}
?>