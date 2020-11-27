<template lang="pug">
    nav.navbar.navbar-expand-lg.navbar-light.bg-white
        .container-fluid
            button.btn.btn-light.btn-sm(@click="toPreviousDate")
                i.fa.fa-angle-double-left

            a.navbar-brand.ml-3.text-center(href="#")
                div.font-weight-bold
                    | {{ $utils.dates.weekday(date) }}
                div.font-sm
                    | {{ $utils.dates.longdate(date) }}

            button.btn.btn-light.btn-sm(@click="toNextDate")
                i.fa.fa-angle-double-right
</template>

<script>
import moment from 'moment';

export default {
    name: 'v-navigator',

    inject: ['jumpTo'],

    props: {
        date: {
            type: String,
            required: true
        }
    },

    methods: {
        toPreviousDate() {
            this.jumpTo(moment(this.date).subtract(1, 'days'));
        },

        toNextDate() {
            this.jumpTo(moment(this.date).add(1, 'days'));
        }
    }
}
</script>
