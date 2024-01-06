# Wait... JS and PHP? How's that?

> Nota: Esta documentación está siendo traducida: [> Ver en español](https://github.com/fadrian06/JSPHP/blob/docs/LEAME.md)

📚 JSPHP is a powerful PHP library that provides a set of classes designed to mimic the behavior of **JavaScript's primitive classes** such as Number, String, and more.

🎯 With JSPHP, PHP developers can leverage familiar JavaScript concepts and functionalities in their PHP projects. 🌈

This library aims to bridge the gap between JavaScript and PHP, allowing developers to write cleaner and more efficient code.

> **✨ Whether you're a PHP developer looking to explore JavaScript-like features or a JavaScript developer working with PHP, JSPHP is the perfect tool to enhance your development experience. 💪**
>
> **Give your PHP projects a touch of JavaScript with JSPHP! 🚀**

## Requirements

- [PHP version 7 or greater](https://php.net)

## Installation

🚀 Getting started with using JSPHP is super easy! Just follow these simple steps:

**1- First, install JSPHP using composer:**
```bash
composer require faslatam/jsphp
```

**2. Include the composer autoloader:**
```php
<?php

require '/path/to/vendor/autoload.php';

# Finally, you're all set! You can now start using JSPHP in your projects.

$name = String('foo');
echo $name->toUpperCase(); # Output: FOO

$user = JSON::parse('{ "id": 1, "name": "foo" }');
echo $user->name; # Output: foo

```

## Components

JSPHP is divided in components that are equivalent to JS classes. Some components
are under development, feel free to contribute adding extra functionalities.

| Component     | Status                   |
|---------------|--------------------------|
| [JSON]()      | ℹ️ _(under development)_ |
| [Math]()      | ℹ️ _(under development)_ |
| [JSString]()  | ℹ️ _(under development)_ |
| [JSNumber]()  | ❌ _(unimplement)_       |
| [JSArray]()   | ❌ _(unimplement)_       |
| [JSObject]()  | ❌ _(unimplement)_       |
| [undefined]() | ✅ _(finished)_          |
