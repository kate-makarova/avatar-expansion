<?php

namespace vendor\extension;

class ext extends \phpbb\extension\base
{
    /**
     * Enable notifications for the extension.
     *
     * @param mixed  $old_state  State returned by previous call of this method
     * @return mixed             Returns false after last step, otherwise temporary state
     * @access public
     */
    public function enable_step($old_state)
    {
        if ($old_state === false)
        {
            /** @var \phpbb\notification\manager $notification_manager */
            $notification_manager = $this->container->get('notification_manager');

            $notification_manager->enable_notifications('vendor.extension.notification.type.sample');
            return 'notification';
        }

        return parent::enable_step($old_state);
    }

    /**
     * Disable notifications for the extension.
     *
     * @param mixed  $old_state  State returned by previous call of this method
     * @return mixed             Returns false after last step, otherwise temporary state
     * @access public
     */
    public function disable_step($old_state)
    {
        if ($old_state === false)
        {
            /** @var \phpbb\notification\manager $notification_manager */
            $notification_manager = $this->container->get('notification_manager');

            $notification_manager->disable_notifications('vendor.extension.notification.type.sample');

            return 'notification';
        }

        return parent::disable_step($old_state);
    }

    /**
     * Purge notifications for the extension.
     *
     * @param mixed  $old_state  State returned by previous call of this method
     * @return mixed             Returns false after last step, otherwise temporary state
     * @access public
     */
    public function purge_step($old_state)
    {
        if ($old_state === false)
        {
            /** @var \phpbb\notification\manager $notification_manager */
            $notification_manager = $this->container->get('notification_manager');

            $notification_manager->purge_notifications('vendor.extension.notification.type.sample');

            return 'notification';
        }

        return parent::purge_step($old_state);
    }
}