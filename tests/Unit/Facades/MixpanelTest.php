<?php

namespace codicastudio\LaravelMixpanel\Tests\Unit\Facades;

use codicastudio\LaravelMixpanel\Facades\Mixpanel;
use codicastudio\LaravelMixpanel\LaravelMixpanel;
use codicastudio\LaravelMixpanel\Tests\UnitTestCase;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class MixpanelTest extends UnitTestCase
{
    public function testFacadeCanBeReferenced()
    {
        $instance = Mixpanel::getFacadeRoot();

        $this->assertInstanceOf(LaravelMixpanel::class, $instance);
    }
}
