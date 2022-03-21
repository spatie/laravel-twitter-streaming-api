
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# Easily work with the Twitter Streaming API in a Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-twitter-streaming-api.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-twitter-streaming-api)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![Test Status](https://img.shields.io/github/workflow/status/spatie/laravel-twitter-streaming-api/run-tests?label=tests&style=flat-square)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-twitter-streaming-api.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-twitter-streaming-api)

Twitter provides a streaming API with which you can do interesting things such as listening for tweets that contain
specific strings or actions a user might take (e.g. liking a tweet, following someone,...). This package makes it very
easy to work with the API.

```php
TwitterStreamingApi::publicStream()
->whenHears('#laravel', function(array $tweet) {
    echo "{$tweet['user']['screen_name']} tweeted {$tweet['text']}";
})
->startListening();
```

Here's [an example Laravel application](https://github.com/spatie/laravel-twitter-streaming-api-example-app) with the
package pre-installed. It
contains [an artisan command](https://github.com/spatie/laravel-twitter-streaming-api-example-app/blob/master/app/Console/Commands/ListenForHashTags.php)
to kick off the listening process.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-twitter-streaming-api.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-twitter-streaming-api)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can
support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards
on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

``` bash
composer require spatie/laravel-twitter-streaming-api
```

The config file must be published with this command:

```bash
php artisan vendor:publish --provider="Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiServiceProvider" --tag="config"
```

It will be published in `config/laravel-twitter-streaming-api.php`

```php
return [

    /*
     * To work with Twitter's Streaming API you'll need some credentials.
     *
     * If you don't have credentials yet, head over to https://developers.twitter.com/
     */

    'handle' => env('TWITTER_HANDLE'),

    'api_key' => env('TWITTER_API_KEY'),

    'api_secret_key' => env('TWITTER_API_SECRET_KEY'),

    'bearer_token' => env('TWITTER_BEARER_TOKEN'),
];
```

## Getting credentials

In order to use this package you'll need to get some credentials from Twitter. Head over to
the [Developer Portal on Twitter](https://developers.twitter.com/) to create an application.

Once you've created your application, click on the `Keys and tokens` tab to retrieve your `bearer_token`, `api_key`
and `api_secret_key`.

![Keys and tokens tab on Twitter](docs/tokens.png)

## Usage

Currently, this package works with the public stream and the user stream. Both the `PublicStream` and `UserStream`
classes provide a `startListening` function that kicks of the listening process. Unless you cancel it your PHP process
will execute that function forever. No code after the function will be run.

In the example below a facade is used. If you don't like facades you can replace them with

```php
app(Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi::class)
```

### The public stream

The public stream can be used to listen for specific words that are being tweeted.

The first parameter of `whenHears` must be a string, or an array containing the word or words you want to listen for. The
second parameter should be a callable that will be executed when one of your words is used on Twitter.

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

When using this in production you could opt to
create [an artisan command](https://github.com/spatie/laravel-twitter-streaming-api-example-app/blob/8175995/app/Console/Commands/ListenForHashTags.php)
to listen for incoming events from Twitter. You can use [Supervisord](http://supervisord.org/) to make sure that command
is running all the time.

## A word to the wise

These APIs work in realtime, so they could report a lot of activity. If you need to do some heavy work processing that
activity it's best to put that work in a queue to keep your listening process fast.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security

If you've found a bug regarding security please mail [security@spatie.be](mailto:security@spatie.be) instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
