<?php

class Test extends PHPUnit_Framework_TestCase
{
    public function testPlugin()
    {
        $obj = new AccessProgram();
    }

    public function testParser()
    {
        $p = new AccessProgramParser();
        $this->assertEquals(true, $p->check('ACCESS'));
        $this->assertEquals(true, $p->check('ACCESS1'));
        $this->assertEquals(false, $p->check('FOO'));

        CoreLocal::set('memberID', '0');
        $this->assertInternalType('array', $p->parse('ACCESS'));

        CoreLocal::set('memberID', '1');
        $this->assertInternalType('array', $p->parse('ACCESS'));
        $this->assertInternalType('array', $p->parse('ACCESS6'));
        $this->assertInternalType('array', $p->parse('ACCESS1'));

        $this->assertEquals(true, AccessProgramParser::adminLoginCallback(true));
        $this->assertEquals(false, AccessProgramParser::adminLoginCallback(false));
    }

    public function testReceipt()
    {
        $r = new AccessProgramReceipt();
        $this->assertInternalType('string', $r->select_condition());
        $this->assertInternalType('string', $r->message(0, '1-1-1'));
        $this->assertInternalType('string', $r->message(1, '1-1-1'));
        $this->assertInternalType('string', $r->standalone_receipt('1-1-1', false));
        $this->assertInternalType('string', $r->standalone_receipt('1-1-1', true));
    }
}

