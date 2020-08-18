<?php

namespace codicastudio\LaravelMixpanel\Tests\Unit;

use codicastudio\LaravelMixpanel\Tests\Fixtures\App\MixpanelUserData;
use codicastudio\LaravelMixpanel\Tests\UnitTestCase;

class DataCallbackTest extends UnitTestCase
{
    public function testDataCallbackClassReturnsArray()
    {
        $data = (new MixpanelUserData)->process();

        $this->assertIsArray($data);
    }

    public function testDataCallbackArrayContainsValue()
    {
        $data = (new MixpanelUserData)->process();

        $this->assertArrayHasKey("test", $data);
        $this->assertEquals("value", $data["test"]);
    }
}
