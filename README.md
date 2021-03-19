# PHP-KHL-SDK
👾 一个由PHP编写，为语音软件KaiHeiLa API的使用提供更方便的库

## 如何安装

## 样例
非常简单!

```php
$config = \KaiHeiLaSDK\Configuration::getInstance();

$config->token = '填上你机器人的Token';

$config->logger = \KaiHeiLaSDK\Log\NullLogger::class;

$messages = \KaiHeiLaSDK\APIPoints\MessageAPI::getMessageList('4151648703920684');

echo '最新的一条消息发送者：' . $messages->items[0]->author->username;
```

## 文档

正在编写中.

## 开发计划

1. 完成对代码的优化
2. 支持对事件的解析
