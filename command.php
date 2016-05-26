<?php

	include_once 'DialogConditionFactory.php';
	include_once 'RPGUser.php';
	include_once 'RPGCharacter.php';
	include_once 'RPGNPC.php';
	include_once 'RPGFloor.php';
	include_once 'UISettings.php';
	include_once 'DataGameUI.php';
	include_once 'constants.php';
	
	session_start();
	
	global $arrStateValues;

	if(isset($_POST['command'])){
		// todo: security so they can't inject $_POST
		$_SESSION['objRPGCharacter']->setEventNodeID($_POST['command']);
		if(isset($_POST['eventAction' . $_POST['command']])){
			DialogConditionFactory::evaluateAction($_POST['eventAction' . $_POST['command']]);
		}
	}
	
	if(isset($_POST['traverse']) && $_SESSION['objRPGCharacter']->getTownID() == 0){
		$objFloor = new RPGFloor($_SESSION['objRPGCharacter']->getFloor());
		$objFloor->setApplicableEvents($_SESSION['objRPGCharacter']->getRPGCharacterID());
		$intEventID = $objFloor->generateRandomEvent();
		$_SESSION['objRPGCharacter']->setEventID($intEventID);		
		$_SESSION['objRPGCharacter']->setEventNodeID(0);
		$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
	}
	
	if(isset($_POST['exitField'])){
		// todo: security to check if the "exit flag" for the floor is true to allow them to exit whenever they want
		// if character has viewed the exit first floor event once before
		if($_SESSION['objRPGCharacter']->hasViewedEvent(11)){
			// give them the short leave tower event
			$_SESSION['objRPGCharacter']->setEventID(12);
			$_SESSION['objRPGCharacter']->setEventNodeID(0);
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
		}
		else{
			// give them the long leave tower event
			$_SESSION['objRPGCharacter']->setEventID(11);
			$_SESSION['objRPGCharacter']->setEventNodeID(0);
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
			$_SESSION['objRPGCharacter']->setViewedEvent(11);
		}
	}
	
	if(isset($_POST['exitTown'])){
		// todo: security to check if the "exit flag" is set to true to allow them to exit town
		// what must be true: in Tower Entrance location (hub), time of day is afternoon (this will be added later)
	}
	
	if(isset($_POST['return'])){
		if($_SESSION['objRPGCharacter']->getTownID() == 0){
			$objFloor = new RPGFloor($_SESSION['objRPGCharacter']->getFloor());
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues[$objFloor->getFloorType()]);
		}
		else{
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Town']);
		}
	}
	
	if(isset($_POST['itemAction']) && isset($_POST['itemInstanceID'])){
		// will there even be weapon/item requirements?
		if($_SESSION['objRPGCharacter']->hasItem($_POST['itemInstanceID'])){
			if($_POST['itemAction'] == 'use'){
				$_SESSION['objRPGCharacter']->eatItem($_POST['itemInstanceID'], $_POST['itemHPHeal']);
			}
			else if($_POST['itemAction'] == 'drop'){
				$_SESSION['objRPGCharacter']->dropItem($_POST['itemInstanceID']);
			}
			else if($_POST['itemAction'] == 'equip'){
				$strEquipFunction = 'equip' . $_POST['itemType'];
				$_SESSION['objRPGCharacter']->$strEquipFunction($_POST['itemInstanceID'], $_POST['itemID']);
			}
			else if($_POST['itemAction'] == 'unequip'){
				$strUnequipFunction = 'unequip' . $_POST['itemType'];
				$_SESSION['objRPGCharacter']->$strUnequipFunction();
			}
		}
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>