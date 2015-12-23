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
    private $client;
    
    private $urls = array(
        '/',
        '/login',
        '/register/'
    );
    
    public function testIndex()
    {
        $this->client = static::createClient();
        
        foreach ($this->urls as $url) {
            $this->assertEquals(200, $this->request($url), "Unexpected HTTP status code for GET " . $url);
        }
    }
    
    /**
     * get page by url
     */
    private function request($url)
    {
        $this->client->request('GET', $url);
        
        return $this->client->getResponse()->getStatusCode();
    }
}
