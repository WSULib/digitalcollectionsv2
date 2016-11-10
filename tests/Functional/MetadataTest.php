<?php

namespace Tests\Functional;

class MetadataTest extends BaseTestCase
{

    /**
     * Test that the /item/{pid}/metadata route returns correct header
     */
    public function testGetJSONMetadata()
    {
        $response = $this->runApp('GET', '/item/wayne:EM02_90_88_1/metadata');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('application/json', (string)$response->getHeaderLine('Content-type'));
    }

}