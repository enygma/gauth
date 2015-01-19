<?php

namespace GAuth;

class AuthTest extends \PHPUnit_Framework_TestCase {


	public function test_instantiate () {
		$auth = new Auth();
	}

	public function test_invalid_init_key_fails () {

		$this->setExpectedException("InvalidArgumentException", "Invalid base32 hash!");
		new Auth('~');
	}

	public function test_valid_init_key_gets_set () {
		$key = 'ABC';
		$auth = new Auth($key);
		$this->assertEquals($key, $auth->getInitKey(), 'Key can be got');
	}

}
