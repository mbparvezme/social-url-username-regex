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
	protected $urlRegEx = '/(?:https?:\/\/)?(?:www\.)?twitter\.com\/(?:#!\/)?@?([a-zA-Z0-9_]{1,15})/i';


	/**
	 * Variable that contains the RegEx
	 * to validate an username
	 */
	protected $unameRegEx = '/^@?([a-zA-Z0-9_]{1,15})$/';
	
	
	public $inputData;
	
	
	public $validData;
	
	
	public $returnFormat;


	function __construct( $input = "" ) {
		$this->inputData = $input;
		$this->returnFormat = 1;
	}
	
	
	public verify(){
		// Verify URL OR Username
		if( $this->verifyUrl() OR $this->verifyUsername() ) return $this->validData;
		// If both mismatch
		else return FALSE;
	}


	protected verifyUrl(){
		if(preg_match($this->urlRegEx, $this->inputData, $matches)){
			$this->validData = ($this->returnFormat < 2) ? $matches[$this->returnFormat] : $matches;
			return TRUE;
		}
		return FALSE;
	}


	protected verifyUsername(){
		if(preg_match($this->unameRegEx, $this->inputData, $matches)){
			if($this->returnFormat == 0)
				$this->validData = $this->inputData;
			if($this->returnFormat == 1)
				$this->validData = $matches[1];
			if($this->returnFormat == 2)
				$this->validData = '@'.$matches[1];
			return TRUE;
		}
		return FALSE;
	}

}
