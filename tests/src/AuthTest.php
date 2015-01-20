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

        $expected = $this->base64values;

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


    public function test_set_and_get_code_length () {

        $length = 123;
        $auth = new Auth();
        $auth->setCodeLength($length);
        $this->assertEquals($length, $auth->getCodeLength());
    }


    public function test_generate_a_init_code () {

        $auth = new Auth();
        $code = $auth->generateCode();
        $this->assertEquals(16, strlen($code), 'Default code is 16 chars');

        $base64values = array_keys($this->base64values);
        $code_letters = str_split($code);

        foreach ($code_letters as $letter) {
            $this->assertContains($letter, $base64values, 'Key consists of base 64 values');
        }
    }


    public function test_generate_a_code_of_length () {
        $auth = new Auth();
        $code = $auth->generateCode(4);
        $this->assertEquals(4, strlen($code), 'Default code is 16 chars');
    }


    public function test_validate_a_valid_code () {

        $key = 'ABC';
        $auth = new Auth($key);
        $code = '424535';
        $timestamp = 1421707340;

        $result = $auth->validateCode($code, null, $timestamp);
        $this->assertTrue($result, 'This is a known good code');

    }


    public function test_validate_a_valid_code_false_when_out_of_range () {

        $key = 'ABC';
        $code = '424535';
        $timestamp = 1421707340;

        $auth = new Auth($key);
        $auth->setRange(1);

        $result = $auth->validateCode($code, null, $timestamp);
        $this->assertFalse($result, 'This was a known good code 2 seconds ago');        
    }


    public function test_validate_a_code_of_wrong_length_fails () {

        $this->setExpectedException('InvalidArgumentException');

        $auth = new Auth();
        $auth->setCodeLength(10);
        $auth->validateCode('lt10');
    
    }


    public function test_validate_with_different_init_key_is_false () {

        $key = 'DEF';
        $auth = new Auth($key);
        $code = '424535';
        $timestamp = 1421707340;

        $result = $auth->validateCode($code, null, $timestamp);
        $this->assertFalse($result, 'This is a known good code for key ABC');

    }


    public function test_validate_after_time_has_passed_is_false () {

        $key = 'ABC';
        $auth = new Auth($key);
        $code = '424535';

        $result = $auth->validateCode($code);
        $this->assertFalse($result, 'This was a known good code, but that was then');
    }


    private $base64values = array(
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
}
