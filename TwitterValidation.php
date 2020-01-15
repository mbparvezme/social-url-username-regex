<?php

/**
 * Class TwitterValidation
 *
 * TwitterValidation provides a convenient way to validating
 * twitter URL and username ad also extract username 
 * from the url
 *
 * @author     M. B. Parvez
 * @copyright  2020 M. B. Parvez
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://webdevron.com
 * @version    1.0
 */

class TwitterValidation
{

	/**
	 * Variable that contains the RegEx
	 * to validate an URl
	 */
	protected $urlRegEx = '/(http(s)?:\/\/)?(www\.)?twitter\.com\/(#!\/)?@?([a-zA-Z0-9_]{1,15})/i';


	/**
	 * Variable that contains the RegEx
	 * to validate an username
	 */
	protected $unameRegEx = '/^@?([a-z0-9_]{1,15})$/i';

	public $excludeAt = FALSE;

	public $input;

	public $url;

	public $username;

	public verify(){
		// Verify URL
		if( $this->verifyUrl() )
			return $this->url;
		// Verify Username
		if( $this->verifyUsername() )
			return $this->username;

		// If both mismatch
		return FALSE;
	}

	protected verifyUrl(){
		if(preg_match($this->urlRegEx, $this->input, $matches)){
			$this->url = $matches[5];
			return TRUE;
		}
		return FALSE;
	}

	protected verifyUsername(){
		if(preg_match($this->unameRegEx, $this->input)){
			$this->username = (!$this->excludeAt ? $this->input : str_replace("@", "", $this->input));
			return TRUE;
		}
		return FALSE;
	}

}
