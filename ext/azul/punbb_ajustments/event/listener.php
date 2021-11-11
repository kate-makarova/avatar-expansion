<?php

namespace azul\punbb_ajustments\event;

class listener implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    static public function getSubscribedEvents()
    {
        return ['core.submit_pm_after' => 'send_mention_notification'];
    }

    /** @var \phpbb\notification\manager */
    protected $notification_manager;

    public function __construct(\phpbb\notification\manager $notication_manager)
    {
        $this->notification_manager   = $notification_manager;
    }

    public function send_mention_notification(\phpbb\event\data $event)
    {
        // For the sake of this tutorial, we assume that the PM is send to a single user
        $this->notification_manager->add_notifications('vendor.extension.notification.type.sample', [
            'user_id'         => array_key_first($event['pm_data']['recipients']),
            'sender_id'       => $event['data']['from_user_id'],
            'message_id'      => $event['data']['msg_id'],
            'message_subject' => $event['subject'],
        ]);
    }
}
