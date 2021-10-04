# Проект для UI тестов
Проект на базе интернет магазина LiteCart для написания UI тестов на языке php и фреймворке codeception.
Для работы тестов необходимо развернуть [проект litecart](https://github.com/litecart/litecart)

### Для запуска UI тестов:

Установить:
- java на локальную машину
- скачать selenium-server (https://www.selenium.dev/downloads/)
- скачать chromedriver (или любой другой драйвер для вашего брауезра, в проекте используется chrome по умолчанию)
- запуск всех тестов:
```
vendor\bin\codecep run tests\acceptance
```

### Всякие полезные штуки:

- для использования не дефолтного браузера (chrome) нужно запустить тесты с флагом ***--env ie, --env firefox***
- для генерации шаблона UI тестов запустить команду:
 ```
vendor\bin\codecept Templates:generateTemplate --acceptance
```
- в проекте используется библиотека для работы с .env файлами, пример настроек лежит в файле .env.example,
для корректной работы нужно создать файл .env