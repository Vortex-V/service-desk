<!-- TOC -->
  * [Задача](#задача)
  * [Основной функционал](#основной-функционал)
  * [Таблицы](#таблицы)
<!-- TOC -->

## Задача
Разработать Service Desk

## Roadmap

Аутентификация
* [ ] Страница регистрации
* [ ] Страница входа

Панель администратора
* Пользователи
  * [ ] Список
  * [ ] Создание
  * [ ] Редактирование 
  * [ ] Привязка к роли
  * [ ] Удаление
* Контактные данные
  * [ ] Список
  * [ ] Создание
  * [ ] Редактирование
  * [ ] Привязка к пользователю
  * [ ] Удаление
* Сервисы/Услуги
  * [ ] Список
  * [ ] Создание
  * [ ] Редактирование
  * [ ] Привязка ответственных менеджеров
  * [ ] Удаление
* Клиенты
  * [ ] Список
  * [ ] Создание
  * [ ] Редактирование
  * [ ] Карточка
  * [ ] Привязка услуг
  * [ ] Удаление
* Заявки
  * [ ] Список
  * [ ] Ссылка на карточку
  * [ ] Удаление
* Типы заявок
  * [ ] Список
  * [ ] Создание
  * [ ] Редактирование
  * [ ] Удаление
* Приоритеты заявок
  * [ ] Список
  * [ ] Создание
  * [ ] Редактирование
  * [ ] Удаление

Заявки
  * [ ] Список
  * [ ] Фильтры
  * [ ] Создание
* Карточка заявки
  * Отображать
    * [ ] Данные пользователя клиента
    * [ ] Автор
    * [ ] Описание
    * [ ] Статус
  * [ ] Сдвиг по статусу
  * Комментарии
    * [ ] Отправка
    * [ ] Редактирование
    * [ ] Упоминание пользователя

## Черновик схемы базы данных
    users
    id          int
    email       string
    password    string
    role        string      // Сделаем проще заместо RBAC : admin|manager|client
    created_at  timestamp
    updated_at  timestamp
    deleted_at  timestamp
    
    contacts
    id              int
    user_id         int
    first_name      string
    last_name       string
    patronymic      string
    phone           string
    created_at  timestamp
    updated_at  timestamp
    deleted_at  timestamp
    
    services
    id          int
    title       string
    created_at  timestamp
    updated_at  timestamp
    deleted_at  timestamp
    
    service_users // ответственные
    service_id      int
    user_id         int
    
    clients
    id              int
    name            string
    created_at  timestamp
    updated_at  timestamp
    deleted_at  timestamp
    
    legal_details
    id              int
    client_id       int
    inn             string
    kpp             string
    ogrn            string
    bik             string
    country             string
    city                string
    street              string
    house               string      
    postcode            string
    created_at  timestamp
    updated_at  timestamp
    deleted_at  timestamp
    
    client_users
    client_id           int
    user_id             int
    
    client_services // сервисы, которыми пользуется клиент
    id              int
    client_id       int
    service_id      int
    
    tickets
    id                  int
    description         string
    status              : draft, new, in_work, closed, rejected
    created_at  timestamp
    updated_at  timestamp
    deleted_at  timestamp
    
    ticket_types
    id          int
    ticket_id   int
    title       string
    
    ticket_priorities
    id          int
    ticket_id   int
    title       string
    
    ticket_users
    id          int
    user_id     int
    ticket_id   int
    type : applicant|author|manager|watcher
    
    comments
    id              int
    user_id         int
    ticket_id       int
    body            string
    created_at  timestamp
    updated_at  timestamp
    deleted_at  timestamp
    
    comment_mentions
    id          int
    comment_id  int
    user_id     int
