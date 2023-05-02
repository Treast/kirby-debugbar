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

    <?= snippet('debugbar') =>

### How to log ?

```php
\Treast\KirbyDebugbar\Logger::debug('This is a debug');
\Treast\KirbyDebugbar\Logger::emergency('This is an emergency');
\Treast\KirbyDebugbar\Logger::error('This is an error');
\Treast\KirbyDebugbar\Logger::critical('This is a critical');
\Treast\KirbyDebugbar\Logger::info('This is an info');
\Treast\KirbyDebugbar\Logger::warning('This is a warning');
\Treast\KirbyDebugbar\Logger::alert('This is an alert');
\Treast\KirbyDebugbar\Logger::notice('This is a notice');
\Treast\KirbyDebugbar\Logger::log('debug', 'This is a notice');
```

## To Do

- Only activate plugin when `debug === true`
- Refactoring 😮‍💨

## 💡 I would like XXX but it's not yet available?

[Go to the issues](https://github.com/Treast/kirby-debugbar/issues) and submit your idea. If it's relevant, I might add it 🫶.

## ❤️Special Thanks

- To [@maximebf](https://www.github.com/maximebf) for the base package [php-debugbar](https://github.com/maximebf/php-debugbar).
- To [@barryvdh](https://www.github.com/barryvdh) for his [implementation on Laravel](https://github.com/barryvdh/laravel-debugbar).

## ⚠️Warning

Please note that this plugin is provided as is, without any express or implied warranty of operation. By using this plugin, you agree to do so at your own risk. I am not responsible for any direct or indirect damage resulting from the use of this plugin, including loss of data, operating errors, service interruptions, or any other consequence related to the use of this plugin.
