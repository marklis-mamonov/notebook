
"# REST API Notebook" 

Был разработан REST API для записной книжки.
Приложение было разработано с использованием Laravel.
В базе данных (можно создать с помощью миграций) хранятся записи (notes) со следующими полями:

1. id (bigInt).
2. name (string).
3. company (string).
4. phone (string).
5. email (string).
6. birthdate (date).
7. photo (string).
8. created_at (timestamp).
9. updated_at (timestamp).

В контроллере App/Controllers/Api/v1/NoteController.php было реализовано 5 методов:
1. index (GET /api/v1/notebook/).
2. store (POST /api/v1/notebook/).
3. show (GET /api/v1/notebook/<id>/).
4. update (PUT /api/v1/notebook/<id>/).
5. destroy (DELETE /api/v1/notebook/<id>/).

Метод index позволяет получить данные (все, кроме created_at и updated_at_at) о записях из базы данных постранично. Количество записей на странице определяется параметром per_page (по умолчанию per_page = 10).

Метод store позволяет добавлять новые записи в базу данных. Необходимо отправить форму со следующими данными: name (обязательно), company, phone (обязательно), email (обязательно), birthdate, photo.

Метод show позволяет получить данные об одной записи из базы данных по указанному id.

Метод update позволяет обновлять данные записи с указанным id. Необходимо отправить форму со следующими данными: name, company, phone, email, birthdate, photo.

Метод destroy позволяет удалить запись из базы данных с указанным id.

Документирование методов API проводилось с использованием Swagger (http://localhost:8000/api/documentation).

Тестирование проводилось с использованием встроенного в Laravel PHPUnit (tests/Feature/NotebookApiTest.php). Протестированы все пять методов.