<?php
/**
 * Slim Framework (http://slimframework.com).
 *
 * @link      https://github.com/DavidePastore/Markdown-View
 */
namespace DavidePastore\Slim\Views;

use Psr\Http\Message\ResponseInterface;

/**
 * Class MarkdownRenderer.
 */
class MarkdownRenderer
{
    /**
     * @var string
     */
    protected $templatePath;

    /**
     * The Parsedown instance.
     *
     * @var \Parsedown
     */
    protected $parsedown;

    /**
     * SlimRenderer constructor.
     *
     * @param string     $templatePath
     * @param \Parsedown $parsedown    The instance to use to parse.
     */
    public function __construct($templatePath = '', $parsedown = null)
    {
        $this->templatePath = $templatePath;
        if ($parsedown === null) {
            $this->parsedown = new \Parsedown();
        } else {
            $this->parsedown = $parsedown;
        }
    }

    /**
     * Render a template.
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param ResponseInterface $response
     * @param string            $template
     *
     * @return ResponseInterface
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function render(ResponseInterface $response, $template)
    {
        $output = $this->fetch($template);

        $response->getBody()->write($output);

        return $response;
    }

    /**
     * Get the template path.
     *
     * @return string
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * Set the template path.
     *
     * @param string $templatePath
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * Get the parsedown.
     *
     * @return \Parsedown
     */
    public function getParsedown()
    {
        return $this->parsedown;
    }

    /**
     * Set the parsedown.
     *
     * @param \Parsedown
     */
    public function setParsedown($parsedown)
    {
        $this->parsedown = $parsedown;
    }

    /**
     * Renders a template and returns the result as a string.
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param $template
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function fetch($template)
    {
        if (!is_file($this->templatePath.$template)) {
            throw new \RuntimeException("View cannot render `$template` because the template does not exist");
        }
        $output = $this->parsedown->text(file_get_contents($this->templatePath.$template));

        return $output;
    }
}
