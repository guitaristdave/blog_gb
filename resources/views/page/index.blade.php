@section('page.title', __('Главная'))

<div class="flex flex-col gap-8 items-center leading-8 text-lg text-gray-600 pt-0 sm:pt-6 lg:pt-20">
    <div class="text-2xl sm:text-4xl font-bold text-gray-800">Дипломный проект "Блог"</div>
    <div>В данном проекте мы:</div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 justify-center text-center">
        <div class="flex items-center bg-gray-50 rounded-xl p-6">
            Исследуем и реализуем адаптивную платформу для ведения личных блогов
        </div>
        <div class="flex items-center bg-gray-50 rounded-xl p-6">
            Проектируем интерфейс и функциональность с учетом пользовательских сценариев
        </div>
        <div class="flex items-center bg-gray-50 rounded-xl p-6">
            Оптимизируем производительность для мобильных устройств
        </div>
    </div>
    <a href="https://github.com/guitaristdave/blog_gb" class="text-sm font-semibold leading-6 text-gray-800">
        GitHub <span aria-hidden="true">→</span>
    </a>
</div>
