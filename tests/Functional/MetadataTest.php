<?php

namespace Tests\Functional;

class MetadataTest extends BaseTestCase
{

/**
 * [testGetJSONMetadata description]
 * @return [type]
 */
    public function testGetJSONMetadata()
    {
        $response = $this->runApp('GET', '/item/wayne:vmc21804/metadata');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('application/json', (string)$response->getHeaderLine('Content-type'));
    }
}
