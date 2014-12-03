<?php
require 'TestDB.php';
 
class MyDBTestCase extends TestDB {
 
    public $fixtures = array(
        'posts',
        'postmeta',
        'options',
        'myschemas'
    );
 
    function testReadDatabase() {
        $conn = $this->getConnection()->getConnection();
 
        // fixtures auto loaded, let's read some data
        $query = $conn->query('SELECT * FROM myschemas');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(2, count($results));
 
        // now delete them
        $conn->query('TRUNCATE myschemas');
 
        $query = $conn->query('SELECT * FROM myschemas');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(0, count($results));
 
        // now reload them
        $ds = $this->getDataSet(array('myschemas'));
        $this->loadDataSet($ds);
 
        $query = $conn->query('SELECT * FROM myschemas');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(2, count($results));
    }
 
}