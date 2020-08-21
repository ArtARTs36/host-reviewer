<?php

use App\Repository\HostRepository;

class HostRepositoryTest extends TestCase
{
    public function testCreate()
    {
        $repo = new HostRepository();

        self::assertTrue($repo->create('test', 'test', 'test')->id > 0);
    }
}
