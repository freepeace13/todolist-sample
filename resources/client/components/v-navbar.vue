<template lang="pug">
    nav.navbar.navbar-expand-lg.navbar-light.bg-white
        .container-fluid
            button.btn.btn-light.btn-sm
                i.fa.fa-angle-double-left

            a.navbar-brand.ml-3.text-center(href="#")
                div.font-weight-bold
                    | {{ $utils.dates.weekday(date) }}
                div.font-sm
                    | {{ $utils.dates.shortdate(date) }}

            button.btn.btn-light.btn-sm
                i.fa.fa-angle-double-right

    //- header.shadow-sm
    //-     .container-fluid
    //-         .row.align-items-center.h-100
    //-             .col.text-left
    //-                 i.fa.fa-chevron-left
    //-             .col.text-center
    //-                 h1 TODAY
    //-             .col.text-right
    //-                 i.fa.fa-chevron-right
</template>

<script>
export default {
    name: 'v-navbar',

    props: {
        date: {
            type: String,
            required: true
        }
    }
}
</script>
