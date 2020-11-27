<template lang="pug">
    div.custom-control.custom-checkbox
        input(
            type="checkbox"
            class="custom-control-input"
            :id="$vnode.key"
            :value="value"
            :checked="value"
            @input="toggleCheck"
        )

        label(class="custom-control-label" :for="$vnode.key")
</template>

<script>
export default {
    name: 'v-check-input',

    props: {
        value: {
            type: Boolean,
            default: false
        }
    },

    methods: {
        toggleCheck($event) {
            console.log($event);
            this.$emit('input', ($event.target.value === 'false') ? true : false);
        }
    }
}
</script>
