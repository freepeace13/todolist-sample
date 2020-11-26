<template lang="pug">
    dl.row.mb-0
        dt.col-sm-1
            div.custom-control.custom-checkbox
                input(
                    type="checkbox"
                    class="custom-control-input"
                    :id="$vnode.key"
                    :value="checked"
                    :checked="checked"
                    @input="checkboxCheck"
                )
                label(
                    class="custom-control-label"
                    :for="$vnode.key"
                )
        dd.col-sm-11.mb-0
            dl.row.mb-0
                dt.col-sm-10
                    div.h-auto.font-weight-light(
                        :class="{ 'd-none': editing }"
                        v-html="checked ? `<del>${text}</del>` : text"
                        @click="toggleEditMode"
                    )

                    textarea(
                        ref="input"
                        type="text"
                        :class="['form-control border-0', { 'd-none': !editing }]"
                        :value="text || ''"
                        @input="$emit('text:input', $event.target.value)"
                        @blur="$emit('text:blur', $event.target.value), editing = false"
                    )
                dd.col-sm-2.mb-0
                    button.btn.btn-light.btn-sm(@click="$emit('click:append')")
                        i.fa.fa-trash-o.text-danger
</template>

<script>
export default {
    props: {
        text: {
            validator(prop) {
                return typeof prop === 'undefined'
                    || typeof prop === 'string'
                    || prop === null;
            }
        },

        checked: {
            type: Boolean,
            default: false
        },

        withoutCheckbox: {
            type: Boolean,
            default: false
        },
    },

    data: () => ({
        editing: false
    }),

    methods: {
        checkboxCheck($event) {
            this.$emit('checkbox:input', ($event.target.value === 'false') ? true : false);
        },

        toggleEditMode() {
            this.editing = !this.editing;

            if (this.editing) {
                this.$nextTick(() => this.$refs.input.focus());
            }
        }
    },
}
</script>
