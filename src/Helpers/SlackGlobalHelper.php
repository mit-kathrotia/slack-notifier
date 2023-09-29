<?php
use App\Helpers\SlackHelper;

if (!function_exists('slack_send_message') ){
    /**
     * It sends a message via Slack to specified channel or default channel if no channel is specified
     *
     * @param  mixed $message
     * @param  mixed $channel
     * @return void
     */
    function slack_send_message(string $message, string $channel = 'default'){
        return (new SlackHelper)->slackSendMessage($message,$channel);
    }
}
if (!function_exists('slack_send_message_with_heading') ){
    /**
     * It sends a message with Heading via Slack to specified channel or default channel if no channel is specified
     *
     * @param  mixed $message
     * @param  mixed $heading
     * @param  mixed $channel
     * @return void
     */
    function slack_send_message_with_heading(string $message, string $heading, string $channel = 'default')
    {
        return (new SlackHelper)->slackSendMessageWithHeader($message,$heading,$channel);

    }
}
if (!function_exists('slack_send_message_with_field_block') ){
    /**
     * It sends a message with field blocks via Slack to specified channel or default channel if no channel is specified. you can pass heading too as a parameter if required.
     *
     * @param  mixed $message
     * @param  mixed $channel
     * @return void
     */
    function slack_send_message_with_field_block(string $message, array $fields ,string $channel = 'default', $heading = NULL){
        return (new SlackHelper)->slackSendMessageWithFieldBlock($message,$fields,$channel,$heading);
    }
}

