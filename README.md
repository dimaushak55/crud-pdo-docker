# CRUD-система з використанням PDO, Docker та MySQL

## Призначення проєкту
Даний проєкт є навчальною лабораторною роботою з дисципліни органiзацiя баз даних.  
Метою роботи є створення повноцінної CRUD-системи для бази даних з використанням:

- PHP 8 (PDO, prepared statements)
- MySQL
- Docker та Docker Compose
- Nginx
- GitHub для керування версіями

Проєкт демонструє безпечну взаємодію з БД, роботу з зовнішніми ключами та контейнеризацію середовища.

---

## Структура проєкту

crud-pdo-docker/
├── app/
│ ├── public/
│ │ └── index.php # Єдина точка входу (роутінг)
│ ├── src/
│ │ ├── Database.php # Підключення до БД через PDO
│ │ ├── ClientDAO.php # CRUD для Client
│ │ ├── ProductDAO.php # CRUD для Product
│ │ ├── OrderDAO.php # CRUD для Order
│ │ └── DeliveryDAO.php # CRUD для Delivery
│ ├── views/
│ │ ├── client/ # Шаблони client
│ │ ├── product/ # Шаблони product
│ │ ├── order/ # Шаблони order
│ │ └── delivery/ # Шаблони delivery
├── .nginx/
│ └── default.conf # Конфігурація Nginx
├── docker-compose.yml # Docker-оточення
└── README.md

---

## Модель даних (сутності)

### Основні сутності:
- **Client** — клієнти
- **Product** — продукти
- **Order** — замовлення
- **Delivery** — доставка

### Звʼязки між сутностями:
- `Order → Client` (Many-to-One)
- `Order → Product` (Many-to-One)
- `Delivery → Order` (One-to-One / One-to-Many)

Усі первинні ключі реалізовані як `AUTO_INCREMENT`, звʼязки — через `FOREIGN KEY`.

---

## Реалізовані CRUD-операції

Для **кожної сутності** реалізовано повний набір CRUD-операцій:

| Сутність  | Create | Read (list + view) | Update | Delete |
|-----------|--------|-------------------|---------|--------|
| Client    |  ✅   |         ✅        |   ✅    |   ✅  |
| Product   |  ✅   |         ✅        |   ✅    |   ✅  |
| Order     |  ✅   |         ✅        |   ✅    |   ✅  |
| Delivery  |  ✅   |         ✅        |   ✅    |   ✅  |

Операції виконуються через HTML-форми з серверним рендерингом.

---

## Інструкція запуску через Docker

### 1 Вимоги
- Docker Desktop
- Docker Compose
- Git
- Windows

---

### 2️ Клонування репозиторію
git clone https://github.com/dimaushak55/crud-pdo-docker.git
cd crud-pdo-docker

---

### 3️ Налаштування змінних середовища
cp app/.env

---

### 4️ Запуск контейнерів
docker compose up -d

---

### 5️ Відкриття застосунку

У браузері:

http://localhost:8080

---

## Як тестувати проєкт

Відкрити головну сторінку

Перейти до списку сутностей (client / product / order / delivery)

Виконати:
- створення запису
- перегляд списку
- редагування
- видалення

Переконатися, що дані коректно зберігаються у БД

Тестування здійснюється через веб-інтерфейс (HTML-форми).

---

## Логування
Перегляд логів Docker:
docker logs crud-pdo-php-1
docker logs crud-pdo-db-1
docker logs crud-pdo-nginx-1