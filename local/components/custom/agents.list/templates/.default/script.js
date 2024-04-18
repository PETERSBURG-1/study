BX.ready(function() {
    /*
    1. Спомощью document.querySelectorAll получить все DOM-элементы с классом star
    2. Повесить обработчик события на click
    Пример: BX.bind(element, "click", clickStar);
     */
    BX.bindDelegate(document.body, "click", { className: "star" }, clickStar);
});
function clickStar(event) {
    event.preventDefault();
    let agentID = $(this).data('id');
    let isActive = $(this).hasClass('active'); // Проверяем, активна ли звезда

    /*
    Получить agentID, в template.php добавьте тегу в классов star атрибут dataset
    cо значением ID элемента Агента
    (https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/dataset)
     */

    if (agentID) { // если ID есть, то делаем ajax-запрос
        BX.ajax // https://dev.1c-bitrix.ru/api_help/js_lib/ajax/bx_ajax_runcomponentaction.php
            .runComponentAction(
                "custom:agents.list", // название компонента
                "clickStar", // название метода, который будет вызван из class.php
                {
                    mode: "class", //это означает, что мы хотим вызывать действие из class.php
                    data: {
                        agentID: agentID // параметры, которые передаются на бэк
                    },
                }
            )
            .then( // если на бэке нет ошибок выполниться
                BX.proxy((response) => {
                    console.log(response); // консоле можно будет увидеть ответ от бэка, для разработки в конечном коде лучше убрать
                    let data = response.data;
                    if (data['action'] == 'success') {
                        // Отобразить пользоватиелю, что агент добавлен в избраное (желтая звездочка, есть в верстке)
                        updateStarState(agentID, !isActive); // Используем функцию
                    }

                }, this)
            )
            .catch( // если на бэке есть ошибки выполниться
                BX.proxy((response) => {
                    console.log(response.errors);
                }, this)
            );
    }

}

function updateStarState(agentID, isActive) {
    let selector = '.star[data-id="' + agentID + '"]';
    let starElement = document.querySelector(selector);
    if (starElement) {
        if (isActive) {
            starElement.classList.add("active");
        } else {
            starElement.classList.remove("active");
        }
    }

    // Обновляем состояние в localStorage
    updateLocalStorage(agentID, isActive);
}

function updateLocalStorage(agentID, isActive) {
    let selectedAgents = JSON.parse(localStorage.getItem('selected_agents')) || {};
    selectedAgents[agentID] = isActive;
    localStorage.setItem('selected_agents', JSON.stringify(selectedAgents));
}

// Функция для загрузки состояния звезд из localStorage при загрузке страницы
function loadStarStateFromLocalStorage() {
    let selectedAgents = JSON.parse(localStorage.getItem('selected_agents')) || {};
    Object.keys(selectedAgents).forEach(agentID => {
        let isActive = selectedAgents[agentID];
        updateStarState(agentID, isActive);
    });
}

// Загружаем состояние звезд при загрузке страницы
loadStarStateFromLocalStorage();
