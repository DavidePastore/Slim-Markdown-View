## Slim Markdown Renderer

[![Latest version][ico-version]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


A renderer for rendering Markdown into a PSR-7 Response object. It works well with Slim Framework 3.


## Installation

Install with [Composer](http://getcomposer.org):

    composer require davidepastore/slim-markdown-view


## Usage With Slim 3

```php
use DavidePastore\Slim\Views\MardownRenderer;

include "vendor/autoload.php";

$app = new Slim\App();
$container = $app->getContainer();
$container['renderer'] = new MarkdownRenderer("./templates");

$app->get('/hello/', function ($request, $response) {
    return $this->renderer->render($response, "/hello.md");
});

$app->run();
```

## Usage with any PSR-7 Project
```php
//Construct the View
$markdownView = new MardownRenderer("./path/to/templates");

//Render a file
$response = $markdownView->render(new Response(), "/path/to/template.md");
```

## Custom Parsedown instance
```php
//Construct the View
$parsedown = Parsedown::instance()->setUrlsLinked(false);
$markdownView = new MardownRenderer("./path/to/templates", $parsedown);

//Render a file
$response = $markdownView->render(new Response(), "/path/to/template.md");
```

## Exceptions
`\RuntimeException` - if template does not exist


## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Davide Pastore](https://github.com/davidepastore)

[ico-version]: https://img.shields.io/packagist/v/DavidePastore/Slim-Markdown-View.svg?style=flat-square
[ico-travis]: https://travis-ci.org/DavidePastore/Slim-Markdown-View.svg?branch=master
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DavidePastore/Slim-Markdown-View.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/davidepastore/Slim-Markdown-View.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/davidepastore/slim-markdown-view.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/davidepastore/slim-markdown-view
[link-travis]: https://travis-ci.org/DavidePastore/Slim-Markdown-View
[link-scrutinizer]: https://scrutinizer-ci.com/g/DavidePastore/Slim-Markdown-View/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DavidePastore/Slim-Markdown-View
[link-downloads]: https://packagist.org/packages/davidepastore/slim-markdown-view
