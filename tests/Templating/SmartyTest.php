<?php

namespace Tests\Templating;

use Tests\TestCase;
use Aether\Templating\Template;

class SmartyTest extends TestCase
{
    public function testGetSmartyEngine()
    {
        $tpl = $this->aether->getTemplate();

        $tpl->set('foo', [
            'a' => 'hello',
            'b' => 'world',
        ]);

        $this->assertContains('hello world', $tpl->fetch('test.tpl'));
    }

    public function testSetAllMethod()
    {
        $tpl = $this->aether->getTemplate();

        $tpl->setAll(['foo' => [
            'a' => 'hello',
            'b' => 'world',
        ]]);

        $this->assertContains('hello world', $tpl->fetch('test.tpl'));
    }

    public function testTemplateExists()
    {
        $tpl = $this->aether->getTemplate();

        $this->assertTrue($tpl->templateExists('test.tpl'));
        $this->assertFalse($tpl->templateExists('martin.tpl'));
    }

    public function testSearchpathIsIncluded()
    {
        $this->setUrl('http://raw.no/searchpath-test');

        $tpl = $this->aether->getTemplate();

        $this->assertContains('Yay!', $tpl->fetch('searchpath-found.tpl'));
    }

    public function testTemplateMethodReturnsTemplateInstance()
    {
        $this->assertInstanceOf(Template::class, \template());
    }

    public function testTemplateMethodReturnsRenderedTemplate()
    {
        $this->assertEquals(" \n", \template('test.tpl'));

        $rendered = \template('test.tpl', ['foo' => [
            'a' => 'lorem',
            'b' => 'ipsum',
        ]]);

        $this->assertContains('lorem ipsum', $rendered);
    }

    public function testTheTemplateClassIsMacroable()
    {
        Template::macro('addOne', function ($value) {
            return $value + 1;
        });

        $template = resolve('template');

        $this->assertEquals(2, $template->addOne(1));
    }

    protected function tearDown()
    {
        array_map('unlink', glob(dirname(__DIR__).'/Fixtures/templates/compiled/*.php'));
    }
}
