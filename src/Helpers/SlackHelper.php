<?php

namespace App\Helpers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\HeaderBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;
use SebastianBergmann\Type\NullType;

class SlackHelper extends Notification
{
    use Notifiable;
    private $slackMessage;
    public function __construct()
    {
        $this->slackMessage = new SlackMessage();
    }
    public function via(): array
    {
        return ['slack'];
    }
    public function toSlack()
    {
        return $this->slackMessage;
    }
    public function sendNotification()
    {
        return $this->notify($this);
    }
    public function slackSendMessage(string $message, string $channel)
    {
        $this->slackMessage
            ->to($channel)
            ->sectionBlock(function (SectionBlock $block) use ($message) {
                $block->text($message)->markdown();
            })
            ->username(config('app.name'));
        $this->sendNotification();
    }
    public function slackSendMessageWithHeader(string $message, string $header, string $channel)
    {
        $this->slackMessage
            ->to($channel)
            ->headerBlock($header)
            ->dividerBlock()
            ->sectionBlock(function (SectionBlock $block) use ($message) {
                $block->text($message);
            })
            ->username(config('app.name'));
        $this->sendNotification();
    }
    public function slackSendMessageWithFieldBlock(string $message, array $fields, string $channel, string|null $heading)
    {
        $this->slackMessage = $this->slackMessage->to($channel);
        if (isset($heading)) {
            $this->slackMessage = $this->slackMessage->headerBlock($heading);
        }
        $this->slackMessage
            ->sectionBlock(function (SectionBlock $block) use ($message) {
                $block->text($message)->markdown();
            })
            ->dividerBlock()
            ->sectionBlock(function (SectionBlock $block) use ($fields) {
                foreach ($fields as $key => $value) {
                    $block->field('*' . $key . "*\n" . $value)->markdown();
                }
            })
            ->username(config('app.name'));
        $this->sendNotification();
    }

}
