<?php namespace VojtaSvoboda\BugSnag\Tests;

use Bugsnag\Client;
use PluginTestCase;

require_once __DIR__ . '/../vendor/autoload.php';

class PluginTest extends PluginTestCase
{
    public function testComposerWasFine()
    {
        $this->assertTrue(class_exists(Bugsnag\Client::class));
    }
}
