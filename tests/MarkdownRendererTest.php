<?php

use Slim\Http\Body;
use Slim\Http\Headers;
use Slim\Http\Response;

class MarkdownRendererTest extends \PHPUnit\Framework\TestCase
{
    public function testRenderer()
    {
        $renderer = new \DavidePastore\Slim\Views\MarkdownRenderer(__DIR__.'/mocks/');

        $headers = new Headers();
        $body = new Body(fopen('php://temp', 'r+'));
        $response = new Response(200, $headers, $body);

        $newResponse = $renderer->render($response, 'testTemplate.md');

        $newResponse->getBody()->rewind();

        $this->assertEquals('<p>Hello <em>Parsedown</em>!</p>', $newResponse->getBody()->getContents());
    }

    public function testRendererWithCustomParsedown()
    {
        $parsedown = Parsedown::instance()
                      ->setUrlsLinked(false);
        $renderer = new \DavidePastore\Slim\Views\MarkdownRenderer(__DIR__.'/mocks/', $parsedown);

        $headers = new Headers();
        $body = new Body(fopen('php://temp', 'r+'));
        $response = new Response(200, $headers, $body);

        $newResponse = $renderer->render($response, 'templateWithUrls.md');

        $newResponse->getBody()->rewind();

        $this->assertEquals('<p>You can find Parsedown at http://parsedown.org</p>', $newResponse->getBody()->getContents());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testTemplateNotFound()
    {
        $renderer = new \DavidePastore\Slim\Views\MarkdownRenderer(__DIR__.'/mocks/');

        $headers = new Headers();
        $body = new Body(fopen('php://temp', 'r+'));
        $response = new Response(200, $headers, $body);

        $renderer->render($response, 'adfadftestTemplate.php', []);
    }

    public function testGetTemplate()
    {
        $expected = __DIR__.'/mocks/';
        $renderer = new \DavidePastore\Slim\Views\MarkdownRenderer($expected);
        $this->assertEquals($expected, $renderer->getTemplatePath());
    }

    public function testSetTemplate()
    {
        $renderer = new \DavidePastore\Slim\Views\MarkdownRenderer(__DIR__.'/wrongdir/');
        $expected = __DIR__.'/mocks/';
        $renderer->setTemplatePath($expected);

        $this->assertEquals($expected, $renderer->getTemplatePath());
    }

    public function testGetParsedown()
    {
        $renderer = new \DavidePastore\Slim\Views\MarkdownRenderer(__DIR__.'/mocks/');
        $expected = new \Parsedown();

        $this->assertEquals($expected, $renderer->getParsedown());
    }

    public function testSetParsedown()
    {
        $renderer = new \DavidePastore\Slim\Views\MarkdownRenderer(__DIR__.'/mocks/');
        $expected = \Parsedown::instance()
                      ->setMarkupEscaped(true);
        $renderer->setParsedown($expected);

        $this->assertEquals($expected, $renderer->getParsedown());
    }
}
