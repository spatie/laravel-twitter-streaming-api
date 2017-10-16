# Easily work with the Twitter Streaming API in a Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-twitter-streaming-api.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-twitter-streaming-api)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/laravel-twitter-streaming-api/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-twitter-streaming-api)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/32372440-dd8f-41c0-9a2e-9d3936b94df0.svg?style=flat-square)](https://insight.sensiolabs.com/projects/32372440-dd8f-41c0-9a2e-9d3936b94df0)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-twitter-streaming-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-twitter-streaming-api)
[![StyleCI](https://styleci.io/repos/78793113/shield?branch=master)](https://styleci.io/repos/78793113)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-twitter-streaming-api.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-twitter-streaming-api)

Twitter provides a streaming API with which you can do interesting things such as listening for tweets that contain specific strings or actions a user might take (e.g. liking a tweet, following someone,...). This package makes it very easy to work with the API.

```php
TwitterStreamingApi::publicStream()
->whenHears('#laravel', function(array $tweet) {
    echo "{$tweet['user']['screen_name']} tweeted {$tweet['text']}";
})
->startListening();
```

Here's [an example Laravel application](https://github.com/spatie/laravel-twitter-streaming-api) with the package pre-installed. It contains [an artisan command](https://github.com/spatie/laravel-twitter-streaming-api-example-app/blob/master/app/Console/Commands/ListenForHashTags.php) to kick off the listening process.

## Installation

You can install the package via composer:

``` bash
composer require spatie/laravel-twitter-streaming-api
```

You must install this service provider.

```php
// config/app.php
'providers' => [
    ...
    Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiServiceProvider::class,
];
```

This package also comes with a facade, which provides an easy way to call the the class.

```php
// config/app.php
'aliases' => [
    ...
    'TwitterStreamingApi' => Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiFacade::class,
];
```

The config file must be published with this command:

```bash
php artisan vendor:publish --provider="Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiServiceProvider" --tag="config"
```

It will be published in `config/laravel-twitter-streaming-api.php`

```php
return [

    /**
     * To work with Twitter's Streaming API you'll need some credentials.
     *
     * If you don't have credentials yet, head over to https://apps.twitter.com/
     */

    'access_token' => env('TWITTER_ACCESS_TOKEN'),

    'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),

    'consumer_key' => env('TWITTER_CONSUMER_KEY'),

    'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
];
```

## Getting credentials

In order to use this package you'll need to get some credentials from Twitter. Head over to the [Application management on Twitter](https://apps.twitter.com/) to create an application.

Once you've created your application, click on the `Keys and access tokens` tab to retrieve your `consumer_key`, `consumer_secret`, `access_token` and `access_token_secret`.

![Keys and access tokens tab on Twitter](https://spatie.github.io/twitter-streaming-api/images/twitter.jpg)

## Usage

Currently, this package works with the public stream and the user stream. Both the `PublicStream` and `UserStream` classes provide a `startListening` function that kicks of the listening process. Unless you cancel it your PHP process will execute that function forever. No code after the function will be run.

In the example below a facade is used. If you don't like facades you can replace them with

```php
app(Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi::class)
```

### The public stream

The public stream can be used to listen for specific words that are being tweeted.

The first parameter of `whenHears` must be a string or an array containing the word or words you want to listen for. The second parameter should be a callable that will be executed when one of your words is used on Twitter.

```php
use TwitterStreamingApi;

TwitterStreamingApi::publicStream()
->whenHears('#laravel', function(array $tweet) {
    echo "{$tweet['user']['screen_name']} tweeted {$tweet['text']}";
})
->startListening();
```

### The user stream

```php
use TwitterStreamingApi;

TwitterStreamingApi::userStream()
->onEvent(function(array $event) {
    if ($event['event'] === 'favorite') {
        echo "Our tweet {$event['target_object']['text']} got favorited by {$event['source']['screen_name']}";
    }
})
->startListening();
```

## Suggestion on how to run in a production environment

When using this in production you could opt to create [an artisan command](https://github.com/spatie/laravel-twitter-streaming-api-example-app/blob/8175995/app/Console/Commands/ListenForHashTags.php) to listen for incoming events from Twitter. You can use [Supervisord](http://supervisord.org/) to make sure that command is running all the time.

## A word to the wise

These APIs work in realtime, so they could report a lot of activity. If you need to do some heavy work processing that activity it's best to put that work in a queue to keep your listening process fast.




## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
