<template lang="pug">
    .container-fluid.bg-light.border.py-1
        .row.justify-content-between.align-items-center
            .col-6
                button.btn-sm.btn.btn-primary Create Checklist
            .col-auto
                button.btn-sm.btn.btn-primary
                    | ADD NEW
                    i.fa.fa-plus.ml-2
</template>

<script>
export default {
    name: 'v-toolbar'
}
</script>
