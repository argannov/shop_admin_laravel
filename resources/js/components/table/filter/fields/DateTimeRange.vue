<template>
    <div class="form-group">
        <label>{{ title }}:</label>

        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
            <input autocomplete="off"
                   v-bind:name="name"
                   v-bind:value="defaultValue"
                   type="text"
                   class="form-control pull-right"
                   id="reservationtime">
        </div>
    </div>
</template>

<script>
    export default {
        name: "DateTimeRange",
        data: function () {
            return {
                picker: Object
            }
        },
        props: {
            title: {
                type: String,
                default: function () {
                    return '';
                }
            },
            name: {
                type: String,
                default: function () {
                    return '';
                }
            },
            value: {
                type: String,
            }
        },
        computed: {
            defaultValue: function () {
                return this.value ? this.value : '';
            }
        },
        mounted: function () {

            let startDate = new Date();
            let endDate = new Date();

            if (this.value) {
                let range = this.value.split(' - ');
                if (range.length === 2) {
                    startDate = new Date(range[0].split('/').reverse().join('-'));
                    endDate = new Date(range[1].split('/').reverse().join('-'));
                }
            }

            let $picker = $('#reservationtime');
            $picker.daterangepicker({
                opens: 'right',
                autoUpdateInput: false,
                timePicker: true,
                timePicker24Hour: true,
                startDate: startDate,
                endDate: endDate,
                locale: {
                    format: 'DD/MM/YYYY',
                    "separator": " - ",
                    "applyLabel": "Применить",
                    "cancelLabel": "Отмена",
                    "fromLabel": "С",
                    "toLabel": "До",
                    "daysOfWeek": [
                        "Вс",
                        "Пн",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Сб"
                    ],
                    "monthNames": [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ],
                    "firstDay": 1
                }
            });

            $picker.on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $picker.on('cancel.daterangepicker', function(ev, picker) {
                $picker.val('');
            });
        }
    }
</script>
