<template lang="pug">
    nav.bg-white.py-2.overflow-auto
        div.container-fluid
            div.row.flex-nowrap
                div.col(v-for="weekday in $utils.dates.weekdays(date)")
                    div.card.text-center.border-0(@click="jumpTo(weekday)")
                        div.card-header.border-0.rounded-0(
                            :class="{ 'bg-primary text-white' : $utils.dates.isSameDate(weekday, date) }"
                        )
                            div.font-sm {{ $utils.dates.weekday(weekday) }}
                            div.font-lg.font-weight-bold {{ $utils.dates.day(weekday) }}
</template>

<script>
import { isSameDate } from '@utils/dates';

export default {
    name: 'v-weekdays',

    inject: ['jumpTo'],

    props: {
        date: {
            type: String,
            required: true
        }
    },

    filters: {
        highlights(value) {
            console.log(this.date)
            return {
                'bg-primary text-white': isSameDate(value, this.date)
            }
        }
    }
}
</script>
