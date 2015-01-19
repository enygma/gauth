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
		$this->assertEquals($key, $auth->getInitKey(), 'Valid key can be got');
	}


	public function test_base64_lookup_is_correct () {

		$expected = array(
            'A' => 0,
            'B' => 1,
            'C' => 2,
            'D' => 3,
            'E' => 4,
		    'F' => 5,
		    'G' => 6,
		    'H' => 7,
		    'I' => 8,
		    'J' => 9,
		    'K' => 10,
		    'L' => 11,
		    'M' => 12,
		    'N' => 13,
		    'O' => 14,
		    'P' => 15,
		    'Q' => 16,
		    'R' => 17,
		    'S' => 18,
		    'T' => 19,
		    'U' => 20,
		    'V' => 21,
		    'W' => 22,
		    'X' => 23,
		    'Y' => 24,
		    'Z' => 25,
		    2 => 26,
		    3 => 27,
		    4 => 28,
		    5 => 29,
		    6 => 30,
		    7 => 31,
        );
        $auth = new Auth();
        $this->assertEquals($expected, $auth->getLookup());
	}


	public function test_get_and_set_range () {

		$range = 54;
		$auth = new Auth();
		$auth->setRange($range);
		$this->assertEquals($range, $auth->getRange(), 'Range is set correctly');
	}

	public function test_invalid_range_fails () {

		$this->setExpectedException('InvalidArgumentException');
		$auth = new Auth();
		$auth->setRange("cat");
	
	}


	public function test_set_and_get_refresh () {

		$refresh = 43;
		$auth = new Auth();
		$auth->setRefresh($refresh);
		$this->assertEquals($refresh, $auth->getRefresh(), 'Refresh is set and got OK');
	
	}


	public function test_invalid_refresh_fails () {

		$this->setExpectedException('InvalidArgumentException');
		$auth = new Auth();
		$auth->setRefresh("litter");

	}

	
}
