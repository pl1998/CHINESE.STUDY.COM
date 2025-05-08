<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection wx_openid
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection mail_host
     * @property Grid\Column|Collection mail_port
     * @property Grid\Column|Collection mail_username
     * @property Grid\Column|Collection mail_password
     * @property Grid\Column|Collection mail_encryption
     * @property Grid\Column|Collection mail_from_address
     * @property Grid\Column|Collection mail_from_name
     * @property Grid\Column|Collection paypal_client_id
     * @property Grid\Column|Collection paypal_secret
     * @property Grid\Column|Collection paypal_mode
     * @property Grid\Column|Collection currency
     * @property Grid\Column|Collection start_time
     * @property Grid\Column|Collection pay_status
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection end_time
     * @property Grid\Column|Collection last_name
     * @property Grid\Column|Collection fisrt_name
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection pay_price
     * @property Grid\Column|Collection zoom_url
     * @property Grid\Column|Collection repeat
     * @property Grid\Column|Collection order_no
     * @property Grid\Column|Collection transaction_id
     * @property Grid\Column|Collection pay_code
     * @property Grid\Column|Collection pay_time
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection expires_at
     * @property Grid\Column|Collection app_name
     * @property Grid\Column|Collection admin_id
     * @property Grid\Column|Collection attr_name
     * @property Grid\Column|Collection attr_type
     * @property Grid\Column|Collection attr_value
     * @property Grid\Column|Collection sort
     * @property Grid\Column|Collection email_verified_at
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection wx_openid(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection mail_host(string $label = null)
     * @method Grid\Column|Collection mail_port(string $label = null)
     * @method Grid\Column|Collection mail_username(string $label = null)
     * @method Grid\Column|Collection mail_password(string $label = null)
     * @method Grid\Column|Collection mail_encryption(string $label = null)
     * @method Grid\Column|Collection mail_from_address(string $label = null)
     * @method Grid\Column|Collection mail_from_name(string $label = null)
     * @method Grid\Column|Collection paypal_client_id(string $label = null)
     * @method Grid\Column|Collection paypal_secret(string $label = null)
     * @method Grid\Column|Collection paypal_mode(string $label = null)
     * @method Grid\Column|Collection currency(string $label = null)
     * @method Grid\Column|Collection start_time(string $label = null)
     * @method Grid\Column|Collection pay_status(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection end_time(string $label = null)
     * @method Grid\Column|Collection last_name(string $label = null)
     * @method Grid\Column|Collection fisrt_name(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection pay_price(string $label = null)
     * @method Grid\Column|Collection zoom_url(string $label = null)
     * @method Grid\Column|Collection repeat(string $label = null)
     * @method Grid\Column|Collection order_no(string $label = null)
     * @method Grid\Column|Collection transaction_id(string $label = null)
     * @method Grid\Column|Collection pay_code(string $label = null)
     * @method Grid\Column|Collection pay_time(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection expires_at(string $label = null)
     * @method Grid\Column|Collection app_name(string $label = null)
     * @method Grid\Column|Collection admin_id(string $label = null)
     * @method Grid\Column|Collection attr_name(string $label = null)
     * @method Grid\Column|Collection attr_type(string $label = null)
     * @method Grid\Column|Collection attr_value(string $label = null)
     * @method Grid\Column|Collection sort(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection email
     * @property Show\Field|Collection wx_openid
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection mail_host
     * @property Show\Field|Collection mail_port
     * @property Show\Field|Collection mail_username
     * @property Show\Field|Collection mail_password
     * @property Show\Field|Collection mail_encryption
     * @property Show\Field|Collection mail_from_address
     * @property Show\Field|Collection mail_from_name
     * @property Show\Field|Collection paypal_client_id
     * @property Show\Field|Collection paypal_secret
     * @property Show\Field|Collection paypal_mode
     * @property Show\Field|Collection currency
     * @property Show\Field|Collection start_time
     * @property Show\Field|Collection pay_status
     * @property Show\Field|Collection status
     * @property Show\Field|Collection end_time
     * @property Show\Field|Collection last_name
     * @property Show\Field|Collection fisrt_name
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection pay_price
     * @property Show\Field|Collection zoom_url
     * @property Show\Field|Collection repeat
     * @property Show\Field|Collection order_no
     * @property Show\Field|Collection transaction_id
     * @property Show\Field|Collection pay_code
     * @property Show\Field|Collection pay_time
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection token
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection expires_at
     * @property Show\Field|Collection app_name
     * @property Show\Field|Collection admin_id
     * @property Show\Field|Collection attr_name
     * @property Show\Field|Collection attr_type
     * @property Show\Field|Collection attr_value
     * @property Show\Field|Collection sort
     * @property Show\Field|Collection email_verified_at
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection wx_openid(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection mail_host(string $label = null)
     * @method Show\Field|Collection mail_port(string $label = null)
     * @method Show\Field|Collection mail_username(string $label = null)
     * @method Show\Field|Collection mail_password(string $label = null)
     * @method Show\Field|Collection mail_encryption(string $label = null)
     * @method Show\Field|Collection mail_from_address(string $label = null)
     * @method Show\Field|Collection mail_from_name(string $label = null)
     * @method Show\Field|Collection paypal_client_id(string $label = null)
     * @method Show\Field|Collection paypal_secret(string $label = null)
     * @method Show\Field|Collection paypal_mode(string $label = null)
     * @method Show\Field|Collection currency(string $label = null)
     * @method Show\Field|Collection start_time(string $label = null)
     * @method Show\Field|Collection pay_status(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection end_time(string $label = null)
     * @method Show\Field|Collection last_name(string $label = null)
     * @method Show\Field|Collection fisrt_name(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection pay_price(string $label = null)
     * @method Show\Field|Collection zoom_url(string $label = null)
     * @method Show\Field|Collection repeat(string $label = null)
     * @method Show\Field|Collection order_no(string $label = null)
     * @method Show\Field|Collection transaction_id(string $label = null)
     * @method Show\Field|Collection pay_code(string $label = null)
     * @method Show\Field|Collection pay_time(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection expires_at(string $label = null)
     * @method Show\Field|Collection app_name(string $label = null)
     * @method Show\Field|Collection admin_id(string $label = null)
     * @method Show\Field|Collection attr_name(string $label = null)
     * @method Show\Field|Collection attr_type(string $label = null)
     * @method Show\Field|Collection attr_value(string $label = null)
     * @method Show\Field|Collection sort(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     */
    class Show {}

    /**
     * @method \Dcat\Admin\Form\Extend\Distpicker\Form\Distpicker distpicker(...$params)
     * @method \Dcat\Admin\Form\Extend\Diyforms\Form\DiyForm diyForm(...$params)
     * @method \Dcat\Admin\Form\Extend\FormMedia\Form\Field\Iconimg iconimg(...$params)
     * @method \Dcat\Admin\Form\Extend\FormMedia\Form\Field\Photo photo(...$params)
     * @method \Dcat\Admin\Form\Extend\FormMedia\Form\Field\Photos photos(...$params)
     * @method \Dcat\Admin\Form\Extend\FormMedia\Form\Field\Video video(...$params)
     * @method \Dcat\Admin\Form\Extend\FormMedia\Form\Field\Audio audio(...$params)
     * @method \Dcat\Admin\Form\Extend\FormMedia\Form\Field\Files files(...$params)
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     * @method $this distpicker(...$params)
     */
    class Column {}

    /**
     * @method \Dcat\Admin\Form\Extend\Distpicker\Filter\DistpickerFilter distpicker(...$params)
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     * @method $this diyForm(...$params)
     */
    class Field {}
}
