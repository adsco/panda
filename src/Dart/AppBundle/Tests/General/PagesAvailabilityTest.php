<?php

namespace Dart\AppBundle\Tests\General;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test pages for 200 response code
 *
 * @package \Dart\AppBundle
 * @subpackage Tests
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class PagesAvailabilityTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /app/boxnet/");
        
    }
    
    /**
     * get page by url
     */
    private function getPage()
    {
        
    }
}
