<?php

namespace azul\punbb_ajustments\notification\mention;

class mention extends \phpbb\notification\type\base
{
    public function get_type(): string
    {
        return 'azul.punbb_ajustments.notification.type.mention';
    }

    public function is_available(): bool
    {
        return true;
    }

    public static function get_item_id($data)
    {
        return $data['message_id'];
    }

    public function find_users_for_notification($data, $options = [])
    {
        return $this->check_user_notification_options([$data['user_id']], $options);
    }

    public function users_to_query()
    {
        return [$this->get_data('sender_id')];
    }

    public function get_title()
    {
        return $this->language->lang(
            'VENDOR_EXTENSION_NOTIFICATION_SAMPLE_TITLE',
            $this->user_loader->get_username($this->get_data('sender_id'), 'no_profile')
        );
    }

    public function get_url()
    {
        return append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", [
            'mode' => 'view',
            'i' => 'pm',
            'p' => $this->get_data('message_id'),
        ]);
    }

    public function get_email_template()
    {
        return false;
    }

    public function get_avatar()
    {
        return $this->user_loader->get_avatar($this->get_data('sender_id'), false, true);
    }

    public function get_forum()
    {
        return $this->language->lang(
            'NOTIFICATION_FORUM',
            $this->get_data('forum_name')
        );
    }

    public function create_insert_array($data, $pre_create_data = [])
    {
        $this->set_data('sender_id', $data['sender_id']);
        $this->set_data('message_id', $data['message_id']);
        $this->set_data('message_subject', $data['message_subject']);

        parent::create_insert_array($data, $pre_create_data);
    }


    static public function get_item_parent_id($type_data)
    {
        // TODO: Implement get_item_parent_id() method.
    }

    public function get_email_template_variables()
    {
        return false;
    }
}