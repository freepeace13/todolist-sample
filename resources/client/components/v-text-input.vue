<template lang="pug">
    div.v-text-input
        div.h-100.font-weight-light(
            v-if="!write"
            v-html="crossout ? `<del>${value}</del>` : $utils.str.title(value)"
            @click="enableWrite"
        )

        textarea(
            v-else
            ref="input"
            class="form-control border-0"
            :value="$utils.str.title(value)"
            @input="$listeners.input || (() => {})"
            @focus="$listeners.focus || (() => {})"
            @blur="disableWrite"
        )
</template>

<script>
export default {
    name: 'v-text-input',

    props: {
        value: {
            validator(prop) {
                return (typeof prop === 'undefined')
                    || (typeof prop === 'string')
                    || prop === null;
            }
        },

        crossout: {
            type: Boolean,
            default: false
        }
    },

    data: () => ({
        write: false
    }),

    methods: {
        enableWrite() {
            this.write = true;
            this.$nextTick(() => this.$refs.input.focus());
        },

        disableWrite($event) {
            this.write = false;
            this.$emit('blur', $event.target.value);
        }
    }
}
</script>
