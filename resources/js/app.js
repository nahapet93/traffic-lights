import './bootstrap';
import jQuery from 'jquery';

window.$ = jQuery;

$(document).ready(function () {
    const green = 1;
    const yellow_ok = 2;
    const red = 3;
    const yellow_too_soon = 4;

    const colors = {
        [green]: {
            class: 'green',
            duration: 5000
        },
        [yellow_ok]: {
            class: 'yellow',
            duration: 2000
        },
        [red]: {
            class: 'red',
            duration: 5000
        },
        [yellow_too_soon]: {
            class: 'yellow',
            duration: 2000
        }
    }

    let state;
    let period = 0;
    let delay = 0;

    /**
     *  Период, после которого каждый цвет на светофоре повторяется (суммируем продолжительность появления всех цветов)
     */
    for (let value of Object.values(colors)) {
        period += value.duration;
    }

    /**
     * Задержка, после которого каждый цвет появляется (суммируем продолжительность появления цветов до него)
     * После этой задержки повторяется по периоду, считанному в прежней функции
     */
    for (let [key, value] of Object.entries(colors)) {
        setTimeout(function () {
            function start() {
                state = key;
                setActiveColor(state);
                setTimeout(start, period);
            }

            start();
        }, delay);

        delay += value.duration;
    }

    /**
     *  Менять вид элемента исходя из того, какой цвет на данный момент активен
     */
    function setActiveColor(state) {
        const class_name = colors[state]['class'];

        $(`.${class_name}`).css('border', '2px solid').css('opacity', 0.5);
        $('.circle').not(`.${class_name}`).css('border', 'none').css('opacity', 1);
    }

    /**
     *  Сохранить статус в базе и показывать на таблице
     */
    function addLog(state) {
        $.ajax({
            url: "/logs",
            method: "POST",
            data: {
                state: state,
                _token: $('input[name="_token"]').attr('value')
            },
            datatype: "json"
        }).done(function (data) {
            $(`<tr><td>${data.message}</td></tr>`).prependTo("#log_table > tbody");
        });
    }

    /**
     *  Привязать сохранение к нажатию
     */
    $('#run').click(function () {
        addLog(state);
    });
});

