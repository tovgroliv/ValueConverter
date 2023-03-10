# ValueConverter
 Тестовое задание - парсер курса валют в личном кабинете после авторизации

## Использованные средства
 - [OSpanel](https://ospanel.io/)
 - Apache 2.4
 - Mysql 8.0
 - PHP 7.4
 - [Актуальный кур валют ЦБ РФ](http://www.cbr.ru/scripts/XML_daily.asp)

## Настройка
 1. Установкить OSpanel
 2. Клонировать репозиторий.
 3. Настроить бд Mysql.
    1. Восстановить резервную копию бд Mysql (файл копии ./ValueConverter.sql).
    2. Открыть файл для настройки подклчения к mysql в соответствии с вашей бд (файл ./.env).
    3. Изменить переменные DATA_BASE_SERVER - имя сервера, DATA_BASE_USER - имя пользователя доступа к бд, DATA_BASE_PASSWORD - пароль доступа к бд, DATA_BASE_NAME - имя бд.
 4. Установить cron для автоматической установки актуального курса валют. 
    1. Для OSpanel - перейти в 'настройки' -> 'планировщик задач'.
    2. Для linux - `* */3 * * * /path/to/services/cron/cron.php`