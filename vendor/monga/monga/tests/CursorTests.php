<?php

class CursorTests extends PHPUnit_Framework_TestCase
{
	public function testCursor()
	{
		$database = Monga::connection()
			->database('__database__');

		$collection = $database->collection('_collection');
		$collection->drop();
		$values = array(
			array('name' => 'Bill'),
			array('name' => 'Frank'),
			array('name' => 'George'),
		);

		$ids = $collection->insert($values);

		foreach($values as $index => &$row)
		{
			$row['_id'] = $ids[$index];
		}

		$cursor = $collection->find(function($query){
			$query->orderBy('name', 'asc');
		});
		$asArray = array_values($cursor->toArray());
		$oldCollection = $cursor->getCollection();
		$mongocursor = $cursor->getCursor();
		$this->assertInstanceOf('MongoCursor', $mongocursor);
		$this->assertEquals(3, $cursor->count());
		$this->assertInstanceOf('Monga\Collection', $oldCollection);

		foreach($cursor as $row)
		{
			$this->assertInternalType('array', $row);
		}

		$newCollection = $database->collection('_new_collection_');

		$this->assertEquals($values, $asArray);
		$this->assertInternalType('array', $asArray);
		$this->assertContainsOnly('array', $asArray);

		$refs = $cursor->toRefArray();
		$this->assertInternalType('array', $refs);
		$this->assertContainsOnly('array', $refs);
		$this->assertInternalType('array', $cursor->explain());
		$this->assertInstanceOf('Monga\Cursor', $cursor->partial(false));
		$collection->drop();
	}

	/**
	 * @expectedException BadMethodCallException
	 */
	public function testBadMethodCall()
	{
		$mock = $this->getMockBuilder('MongoCursor')
			->disableOriginalConstructor()
			->getMock();

		$cursor = new Monga\Cursor($mock);

		$cursor->badMethodCall();
	}
}