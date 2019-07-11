<?php 
class User {
 
	public $userid;
	private $firstName;
	private $lastName;
	private $role;
	private $dob;
	private $gender;
	private $phoneNumber;
	private $Email;
	private $username;
	private $password;

 
	function __construct( $userid, $firstName,$lastName, $role , $dob,$gender, $phoneNumber , $Email,$username, $password ) {
		$this->userid = $userid;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->role = $role;
		$this->dob = $dob;
		$this->gender = $gender;
		$this->phoneNumber = $phoneNumber;
		$this->Email = $Email;
		$this->username = $username;
		$this->password = $password;
	}
 
	function getuserid() {
		return $this->userid;
	}
	function getfirstName() {
		return $this->firstName;
	}
	function getlastName() {
		return $this->lastName;
	}
	function getrole() {
		return $this->role;
	}
	function getdob() {
		return $this->dob;
	}
	function getgender() {
		return $this->gender;
	}
	function getphoneNumber() {
		return $this->phoneNumber;
	}
	function getEmail() {
		return $this->Email;
	}
	function getusername() {
		return $this->username;
	}
	function getpassword() {
		return $this->password;
	}
 
	/*function isAdult() {
		return $this->age >= 18?"an Adult":"Not an Adult";
	}*/
 
}

 ?>