<?php

class MongaTests extends PHPUnit_Framework_TestCase
{
	public function testMongaId()
	{
		$id = Monga::id('516ba5033b21c50005a93f76');

		$this->assertInstanceOf('MongoId', $id);
	}

	public function testMongoData()
	{
		$data = Monga::data('something');

		$this->assertInstanceOf('MongoBinData', $data);
	}

	public function testMongoDataWithType()
	{
		$data = Monga::data('something', MongoBinData::CUSTOM);

		$this->assertInstanceOf('MongoBinData', $data);
		$this->assertEquals($data->bin, 'something');
		$this->assertEquals($data->type, MongoBinData::CUSTOM);
	}

	public function testMongaCode()
	{
		$code = Monga::code('__code__');

		$this->assertInstanceOf('MongoCode', $code);

		$string = (string) $code;
		$this->assertEquals('__code__', $string);
	}

	public function testMongaDate()
	{
		// random time
		$time = time() - 100;
		$date = Monga::date($time, 2);

		$this->assertInstanceOf('MongoDate', $date);
		$this->assertEquals($time, $date->sec);
	}

	public function testMongaRegex()
	{
		$regex = Monga::regex('/(.*)/imu');

		$this->assertInstanceOf('MongoRegex', $regex);
		$this->assertEquals('imu', $regex->flags);
	}

	/**
	 * @expectedException MongoException
	 */
	public function testInvalidRegex()
	{
		$regex = Monga::regex('#(.*)#imu');
	}

	public function testMongaConnection()
	{
		$connection = Monga::connection();
		$this->assertInstanceOf('Monga\\Connection', $connection);
	}
}