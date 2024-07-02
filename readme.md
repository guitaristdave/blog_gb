### Дипломный проект "Блог"
<details class="block"><summary>Первый запуск (.env создавать не требуется)</summary>

```sh
composer create-project
sh scripts/build.sh
exit
```
```text
- Создаст .env файл
- Сгенерирует ключ
- Соберет проект
- Выполнит миграции
- Соберет фронт
```

</details>
<details class="block"><summary>Production</summary>

```sh
sh scripts/build.sh && exit # Сборка (+ миграции, фронт)
```
```sh
sh scripts/rebuild.sh && exit # Чистая сборка (+ миграции, фронт)
```
```sh
sh scripts/run.sh && exit # Запуск
```
```sh
sh scripts/stop.sh && exit # Остановка
```

</details>
<details class="block" open><summary>Development</summary>

```sh
sh scripts/build.sh && exit # Сборка (+ миграции, фронт)
```
```sh
sh scripts/rebuild.sh && exit # Чистая сборка (+ миграции, фронт)
```
```sh
bash scripts/run-dev.sh && exit # Запуск (+ фронт в dev режиме)
```
```sh
sh scripts/migrate.sh && exit # Применение миграций (на запущенные контейнеры)
```
```sh
sh scripts/stop.sh && exit # Остановка
```

</details>

### TODO:
- Главная
- Поправить роуты (пройтись по TODO)
- Исправить редиректы при невалидных данных (для авторизации/регистрации)

<details class="block"><summary>Info</summary>

- [Laravel readme](./laravel.README.md)
```text
php artisan db:seed
php artisan storage:link
```

</details>

#### <div class="hidden">Other</div>
<details class="block hidden"><summary>Стили для IDE</summary>

<style>
h1, h2, h3, h4, h5, h6 {
    font-weight: 800;
    margin: 0 0 10px;
    padding: 20px 0 10px;
}
.block {
    margin: 0 0 0 1em;
    padding: 0 0 1em;
}
.block > summary {
    margin: 0 0 0 -1em;
    font-weight: bold;
    cursor: pointer;
}
.block pre {
    border-radius: 10px;
    margin: 10px 0;
    padding: 0.8em 1em;
}
.block pre + pre {
    margin: -8px 0 10px;
}
.hidden {
  display: none;
}
</style>

</details>
