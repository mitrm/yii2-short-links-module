Yii2 short link , сокращения ссылок
=====================


## Install
```
php composer.phar require --prefer-dist mitrm/yii2-short-links-module "*"
```


- Run migrations:

```
php yii migrate --migrationPath=@mitrm/links/migrations
```

In config file:

```php
    'modules' => [
        'short_link' => [
            'class' => 'mitrm\links\Module',
            'domain' => site.ru // домен короткой ссылки
        ],
    ],
```

## Usage


```php
    'modules' => [
         'short_link' => [
             'class' => 'mitrm\links\Module',
             'domain' => site.ru
         ],
     ],
```
Модальное окно создания простых коротких ссылок
```php
        <?= \mitrm\links\widgets\ShortLinksWidget::widget([
            'toggleButton' => [
                'label' => 'Укоротить ссылку',
                'class' => 'dropdown-toggle',
                'tag' => 'a'
            ]
        ])?>
```
GRUD по адресу /short_link/short-links/index и /short_link/short-links-click/index