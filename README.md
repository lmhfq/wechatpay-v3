# wechatpay-v3

一个很好用的的微信支付 V3 的 API

## 安装

```
composer require lmh/wechatpay-v3
```

### 敏感参数加解密

在设置请求的参数($query 或 $params)时，无需手动对敏感参数进行加解密。仅需要在 $options 参数中申明需要加解密的参数（支持点运算符）即可。 例如：

```php
$options = [
    // 加密
    'encode_params' => [
        'id_card_info.id_card_name',
        'id_card_info.id_card_number',
        'account_info.account_name',
        'account_info.account_number',
        'contact_info.contact_name',
        'contact_info.contact_id_card_number',
        'contact_info.mobile_phone',
        'contact_info.contact_email',
    ],
    // 解密
    'decode_params' => [
        'account_validation.account_name',
        'account_validation.pay_amount',
    ]
];

```