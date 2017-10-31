<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use AetherJSONCommentFilteredResponse;

class JsonCommentFilteredResponseTest extends TestCase
{
    public function testResponse()
    {
        $response = new AetherJSONCommentFilteredResponse([
            'foo' => 'bar',
            ' bar' => 'foo',
        ]);

        $out = $response->get();

        $this->assertTrue(strpos($out, '{"foo":"bar"," bar":"foo"}') !== false);

        $this->assertTrue(preg_match('/\/\*[^\*]+\*\//', $out) == true);
    }
}
