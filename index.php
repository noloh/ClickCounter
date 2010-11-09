<?php
require_once('/PATH/TO/NOLOH');

class ClickCounter extends WebPage
{
	/**
	* Limit of number of clicks. 
	* When clicks exceed this limit prompt for reset
	*/
	const ClickLimit = 5;
	/**
	* Current Number of Clicks
	* @var integer
	*/
	private $ClickNumber = 0;
	/**
	* Constructor
	*/
	function ClickCounter()
	{
		parent::WebPage('Classic Click Counter');
		//Instantiate Button with left and top of 100
		$button = new Button('Click Me', 100, 100, null, null);
		//Set Click Event of $button. Triggers CountClick with $button as param
		$button->Click = new ServerEvent($this, 'CountClick', $button);
		//Adds the button to show
		$this->Controls->Add($button);
	}
	/**
	* Increases the ClickNumber
	* 
	* @param Button $button
	*/
	function CountClick($button)
	{
		//Increase ClickNumber by one
		++$this->ClickNumber;
		//Checks if you've exceeded your click limit
		if($this->ClickNumber == self::ClickLimit)
		{
			$button->Text = 'Reset';
			$button->Click = new ServerEvent('Application', 'Reset');
		}
		else
		{
			//Check whether to use time or times
			$time = $this->ClickNumber == 1?'time':'times';
			//Set Text of button to number of clicks
			$button->Text = "You've clicked {$this->ClickNumber} $time";
		}
	}
}
?>