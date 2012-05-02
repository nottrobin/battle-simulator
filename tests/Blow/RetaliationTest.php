<?php

include_once('lib/Blow/BlowFactory.php');
include_once('tests/Blow/BlowTest.php');

class RetaliationTest extends BlowTest {
    protected function getBlow($strength) {
        return (new BlowFactory())->createRetaliation($strength);
    }
}

