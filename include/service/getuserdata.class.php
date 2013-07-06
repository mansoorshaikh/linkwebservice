<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox_Service
 * @version 		$Id: process.class.php 4067 2012-03-27 11:54:22Z Raymond_Benc $
 */
class Webservice_Service_Getuserdata extends Phpfox_Service 
{
	private $_iLinkId = 0;
	
	/**
	 * Class constructor
	 */	
	public function __construct()
	{	
		
	}
	
	function userData($iUserId)
	{
		return Phpfox::getLib('database')->select('u.profile_page_id, u.status_id, u.view_id, u.user_id, u.server_id, u.user_group_id, u.user_name, u.email, u.gender, u.style_id, u.language_id, u.birthday, u.full_name, u.user_image, u.password, u.password_salt, u.joined, u.hide_tip, u.status, u.footer_bar, u.country_iso, u.time_zone, u.dst_check, u.last_activity, u.im_beep, u.im_hide, u.is_invisible, u.total_spam, u.intrested, u.register_step ')
					->from(Phpfox::getT('user'), 'u')
					->where("u.user_id = '" . Phpfox::getLib('database')->escape($iUserId) . "'")
					->execute('getRow');
	}
}
?>