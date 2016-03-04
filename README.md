8bitProject - Locator Service
=============================

Реализован сервис для поучения данных о раположении объектов. Для того, чтобы протестировать его работу,
был создан Mock, который имитирует работу внешнего сервиса, отдавая случайные данные из задающегося множества ответов.

Url клиентского сервиса.<br/>
Главная страница для выбора возможных операций с учётом расширения функционала (CRUD): [http://localhost:8000/](http://localhost:8000/) <br/>
Получение списка местоположений объектов: [http://localhost:8000/locations](http://localhost:8000/locations) <br/>

Url mock-а: [http://localhost:8001/mock_service](http://localhost:8001/mock_service) <br/>

Для демонстрации проекта необходимо запустить 2 сервера. <br/>
Для клиентского сервиса: **php app/console server:start** <br/>
Для Mock-а: **php app/console server:start localhost:8001** <br/>
