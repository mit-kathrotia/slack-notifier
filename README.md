# slack-notifier
Simple package to send slack messages in Laravel.

## Installation
You can install the package via composer:

```composer require weboccult-laravel/slack-notifier```

## Configuration
- You need to create slack notifier app in your slack workspace.
- Enable Incoming Webhooks in your slack workspace
- Generate Bot User OAuth Token in your slack workspace
- Set SLACK_BOT_USER_OAUTH_TOKEN in .env
- Create an Incoming Webhook for channels
- set these channels in .env
- set auth token, channels & their webhooks in ```config/services.php```

    i.e
    ```
    'slack' => [
            'notifications' => [
                'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
                'general' => env('SLACK_GENERAL_WEBHOOK_URL'),
                'laravel-slack-demo' => env('SLACK_LARAVEL_SLACK_DEMO_WEBHOOK_URL'),
        ],
    ]
    ```
## Examples
1. Simple message

```
slack_send_message("Hello from *slack-notifier*","channel_name");
```

2. Message with heading

```
slack_send_message_with_heading("Welcome to *slack-notifier*","New message for you :wave:","channel_name");
```

3. Message with field blocks
    - Without heading
    ```
    slack_send_message_with_field_block("This is message for you",[
                'System Name' => config('app.name'),
                'System URL' => config('app.url'),
                'System Description' => 'Slack Notifier System'
            ],'general');
    ```

    - With heading
    ```
    slack_send_message_with_field_block("This is message for you",[
                'System Name' => config('app.name'),
                'System URL' => config('app.url'),
                'System Description' => 'Slack Notifier System'
            ],'general', ":bell: Alert :bell:");
    ```
