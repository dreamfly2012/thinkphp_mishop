<?php
/**
 * ============================================================================
 * 版权所有 2015-2018
 * 网站地址: https://www.xiaoxiang.ga
 * ----------------------------------------------------------------------------
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 本程序采用thinkphp v5.0开发
 * ============================================================================
 * Author: chiqing_85
 * Time: 2018/4/29 14:38
 */
return array (
    //应用ID,您的APPID。
    'app_id' => "2016091400513033",

    //商户私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEAyjP0T3L+8QFgjN9GziYZBQ4gL8T5Ij7HH0KOOZllCNNshYYTrpLlaA1hzny1ueqBTFkv6TzvxVybNxktp1pC9QrPBMhODF9o/+5LXSnyGrKd7mdth/tydvPZDNgEgeVcvBiIycKENpTZvTScSOFdPYB8rW6FZTsm9VkLCpFg25WpONH4CEdywgc8pndTq6owfQ2jdwh8iI59280dTRloSCGr7IOOhJYtIkQQ2pqNQwyWKkI7pHD8wt5C5QM+/EDaJ+AK5+TDaNfP7AKthcb74D9Vl4J9auSExAyXcs7dvFAH/K/hwgvESWpXMwHYcChf+/rhfX65kameC1uEfCgzeQIDAQABAoIBAQCygGD5zjvPiHayhd0c2bcWply1rv58Q81HBFtH7+moe/R+f1lasKVCUSX5wlAvGx0fyFAqZ7gHk/QWFO0fougfKHaO80ErXQL1hGkVipUHCo2vS7D+7XQkHKqM0xpPjaprBoGjE0viX09E32/kSsckJwxpknrCXhDLYNsFbkeCMC5CM+XCuoGYCNrz4qIFTJMfdytWcObNaS3R4EitktBYrHQcIQlewaLG3qrITruplnsGwHbQV2MZRssFG+taKGH7D8B0p/zFobstRe1sgK9NyXK5W4H4Y6E1CnxDZRPa2VQkcC+IXVXQeO9LBUhwFvG7PLmn/Le/JFFXFfqNwfGBAoGBAPkkpT3qggQAwJDFB7naDTMrYPmhE1ihalY9WqW1KvtUK433atLe/9GrnTV47zDvoev8HDq19ji1o12kDpHtjVAICVgDpT81ojsUo31dfKrEWK+QaOYehqZDjxPgeXCVslIthqdaLYqDx2FfBI0GtSTkfXMqV1ikQWNmjwU+o7zpAoGBAM/Elq0InWQElJ6losd2I9bspRbEwdHXstVMdoSTno6sMg++AIkiMzhwQqT12L35/6EU7LMCvpetIawrSrzGMB7ofUUqqc3QSPaPTcKMIdtYA4OYKLIuBLOFNEE0KHJVKisc+H4wCk4nXFBmkIwcSa2EiLlBr/CPDR6CPB/b+mgRAoGACKve2HXWCp+gFCnXZ/+P4A0NdgLGMpqDofbGtefFVDQMxActf6NlUf3gHeFUqeZdQ2Jl9SEqLbUct4CjRS74cSWmdZrC4J1URSwluJJNaYAl+g5TqFa9pwHI9A8nCuUa7MNK4X5BAYYupVPyS5pFKcCOITkDC0HESNpj9fHFLykCgYAQxUOMUAe0TRJaA/CxvP2DmbJxtgwXDhwnT3a5mNjRl2CrGKEecJ5FzfnzKs0F+KoDrJa2lGAiCh2PsibkOfMka4vBC4KNVGSvUj3qmDkbZW1TL/MI/uHuQ7BGGxmwsOMoe7wrI2GRkWfILZ85UAc6dFo86epztnhOoCCOSclaoQKBgQC9zwHDq+2Twz8SpGMXvR4nF68axwi+GP53bsTb9SeXbQ06j05jq3qwm+FKL8cRtG4MQJA3bkxd0y6ty0uOEPVRbeFcVis9U+NlC3Aj40RUHoUCcw3sOttFPUHnOPu63tYB0po6OL5TV3sEjjXzecn0M8zsym6hJGSDocvCgd1h6Q==",

    //异步通知地址
    'notify_url' => "http://yii.com/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",

    //同步跳转
    'return_url' => "http://yii.com/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmzocn+UpL7YfvxDGTcX7CeJ9aRWEn2vkl13pQ39ZwC9iPf/ZczvnxB/haHc8Rha7SHSoQZZ9yOAjIrLHj+ExD5DkX2miHFVf6hCf0E8kAT1BtJ2MxcdNIvjLoPPeU9pv10QNmlHG4Zx9CO7fgsJ4FPKMTTxqdVPx2eMTk/zg9x8JPZbLA1gbqZYlFrU0Zhwv924hWoxexGwGY6T7C7HlsIPzS6CmKre7YdbjGwBbAZcUnKveng16b+MPwYnZme5RtUu3Q7VzXd5z/KYO3LpxSK0IrgWqNPOhXpTba3TKgmxn4o5o0JBhm6/q8rI1CxYvY0gwANBORBFHuyx0Mg9nLwIDAQAB",
);