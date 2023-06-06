# PHP Debug Bar for KirbyCMS

![Demonstration](https://user-images.githubusercontent.com/3629578/235644730-5c40eed9-048f-4bbb-b72a-5d5441e50549.gif)

## ✨ Features

- Integration of [PHP Debug Bar](https://github.com/maximebf/php-debugbar)
- Easy log messages
- Preview configuration, hooks called, files, page variables, requests & exceptions
- More soon 👀 ...

## 🔌 Installation

### Composer (highly recommended)

    composer require treast/kirby-debugbar

### Git submodule

    git submodule add https://github.com/Treast/kirby-debugbar.git site/plugins/debugbar

### Manual

Download this [zip](https://github.com/Treast/kirby-debugbar/archive/refs/heads/main.zip) and unzip it in `site/plugins/debugbar`.

## 💻 Usage

Add this snippet at the bottom of your footer & enjoy !

    <?= snippet('debugbar') ?>

### How to log ?

```php
$site->logger()->debug('This is a debug');
$site->logger()->emergency('This is an emergency');
$site->logger()->error('This is an error');
$site->logger()->critical('This is a critical');
$site->logger()->info('This is an info');
$site->logger()->warning('This is a warning');
$site->logger()->alert('This is an alert');
$site->logger()->notice('This is a notice');
$site->logger()->log('debug', 'This is also a debug');
// Or you can chain with the ->log() function
$site->log()->title()->log();
$page->children()->log()->first()->log();
```

### Options

#### Explanations

| Option name                      | Default | Type      | Description                                                        |
| -------------------------------- | ------- | --------- | ------------------------------------------------------------------ |
| `treast.debugbar.force`          | `false` | `boolean` | If enabled, will display the debug bar even with `debug === false` |
| `treast.debugbar.tabs.logs`      | `true`  | `boolean` | Show logs tab                                                      |
| `treast.debugbar.tabs.config`    | `true`  | `boolean` | Show config tab                                                    |
| `treast.debugbar.tabs.events`    | `true`  | `boolean` | Show events tab                                                    |
| `treast.debugbar.tabs.files`     | `true`  | `boolean` | Show files tab                                                     |
| `treast.debugbar.tabs.variables` | `true`  | `boolean` | Show variables tab                                                 |
| `treast.debugbar.tabs.request`   | `true`  | `boolean` | Show request tab                                                   |
| `treast.debugbar.tabs.exception` | `true`  | `boolean` | Show exceptions tab                                                |

#### config.php

```php
<?php

return [
  'treast.debugbar' => [
    'force' => false,
    'tabs' => [
      'logs' => true,
      'config' => true,
      'events' => true,
      'files' => true,
      'variables' => true,
      'request' => true,
      'exceptions' => true
    ]
  ]
];
```

## To Do

- ~~Only activate plugin when `debug === true`~~
- Refactoring 😮‍💨

## 💡 I would like XXX but it's not yet available?

[Go to the issues](https://github.com/Treast/kirby-debugbar/issues) and submit your idea. If it's relevant, I might add it 🫶.

## ❤️Special Thanks

- To [@maximebf](https://www.github.com/maximebf) for the base package [php-debugbar](https://github.com/maximebf/php-debugbar).
- To [@barryvdh](https://www.github.com/barryvdh) for his [implementation on Laravel](https://github.com/barryvdh/laravel-debugbar).
- To [@genxbe](https://www.github.com/genxbe) for his chaining methods [on his plugin](https://github.com/genxbe/kirby3-ray).

## ⚠️Warning

Please note that this plugin is provided as is, without any express or implied warranty of operation. By using this plugin, you agree to do so at your own risk. I am not responsible for any direct or indirect damage resulting from the use of this plugin, including loss of data, operating errors, service interruptions, or any other consequence related to the use of this plugin.
